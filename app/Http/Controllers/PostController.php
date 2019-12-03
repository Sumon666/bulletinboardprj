<?php

namespace App\Http\Controllers;

use App\Posts;
use App\Exports\PostsExport;
use Maatwebsite\Excel\Facades\Excel;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use App\Contracts\Services\Post\PostServiceInterface;

/**
 * SystemName : Bulletin Board System
 * ModuleName : Post.
 */
class PostController extends Controller
{
    private $postService;

    /**
     * Create a new controller instance.
     *
     * @param PostServiceInterface $postService
     */
    public function __construct(PostServiceInterface $postService)
    {
        $this->postService = $postService;
    }

    /**
     * Clear the form data.
     *
     * @return \Illuminate\Http\Response
     */
    public function clearPost(Request $request)
    {
        //clear post
        $request->title = '';
        $request->description = '';

        return view('post.post');
    }

    /**
     * Show the specified data from new post form.
     *
     * @param \App\Posts $pdata
     *
     * @return \Illuminate\Http\Response
     */
    public function showPost(Request $request)
    {
        if (isset($request->title) && isset($request->description)) {
            if (Posts::where('title', $request->title)->exists()) {
                return redirect('post')->with(['postError' => trans('messages.e_0001')])->withInput();
            }

            $pdata = new Posts();
            $pdata->title = $request->title;
            $pdata->description = $request->description;

            Session::put('Post', $pdata);
            $data = Session::get('Post');

            if (Session::has('Post')) {
                Session::put('New', $pdata);
                $data = Session::get('New');
            }

            return view('post.postconfirm')->with(['pdata' => $data]);
        } else {
            $validator = Validator::make($request->all(), [
                'title' => 'required|max:255',
                'description' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect('post')
                    ->withErrors($validator)
                    ->withInput();
            }
        }
    }

    /**
     * Show confirmation data on post form when clicked cancel.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancelPost(Request $request)
    {
        //cancel post
        if (Session::has('Post')) {
            $data = Session::get('Post');
        } else {
            $data = Session::get('New');
        }

        return view('post.post')->with(['data' => $data]);
    }

    /**
     * Store new created post in db.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Session::has('Post')) {
            $data = Session::get('Post');
            $this->postService->addPost($data);
            Session::forget('Post');
        } elseif (Session::has('New')) {
            $data = Session::get('New');
            $this->postService->addPost($data);
            Session::forget('New');
        }

        return redirect('/postlist');
    }

    /**
     * Display a listing of the posts.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPostList()
    {
        $sdata = Input::get('sname');
        if (isset($sdata)) {
            $plist = $this->postService->searchPost($sdata);

            return view('post.postlist', ['postlist' => $plist]);
        } elseif (!isset($sdata)) {
            $plist = $this->postService->getList();

            return view('post.postlist', ['postlist' => $plist]);
        } else {
            return view('post.postlist')->with(['listInfo' => trans('messages.m_0001')])->withInput();
        }
    }

    /**
     *Get post detail.
     *
     * @param $title
     *
     * @return \Illuminate\Http\Response
     */
    public function getPostDetail($title)
    {
        $dlist = $this->postService->getPostDetail($title);

        return view('post.postDetail', ['dlist' => $dlist]);
    }

    /**
     * Remove post data.
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $this->postService->delete($id);

        return redirect('/postlist');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function downloadExcel()
    {
        return Excel::download(new PostsExport(), 'postlist.csv');
    }

    /**
     *upload csv.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function uploadCSV(Request $request)
    {
        $file = $request->file('file');

        // File Details
        $filename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $tempPath = $file->getRealPath();
        $fileSize = $file->getSize();
        $mimeType = $file->getMimeType();

        // Valid File Extensions
        $valid_extension = array('csv');

        // 2MB in Bytes
        $maxFileSize = 2097152;

        // Check file extension
        if (in_array(strtolower($extension), $valid_extension)) {
            // Check file size
            if ($fileSize <= $maxFileSize) {
                // File upload location
                $location = 'uploads';

                // Upload file
                $file->move($location, $filename);

                // Import CSV to Database
                $filepath = public_path($location.'/'.$filename);

                // Reading file
                $file = fopen($filepath, 'r');

                $importData_arr = array();
                $i = 0;
                $u = 1;

                while (($filedata = fgetcsv($file, 1000, ',')) !== false) {
                    $num = count($filedata);
                    for ($c = 0; $c < $num; ++$c) {
                        $importData_arr[$i][] = $filedata[$c];
                    }
                    ++$i;
                }

                fclose($file);

                $this->postService->getUploadCSV($importData_arr);
            } else {
                return redirect()->back()->with(['error' => trans('messages.e_0002')]);
            }
        }

        return redirect('postlist');
    }
}
