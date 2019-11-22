<?php

namespace App\Http\Controllers;

use App\Posts;
use Log;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use App\Contracts\Services\Post\PostServiceInterface;

class PostUpdateController extends Controller
{
    private $postService;

    /**
     * Create a new controller instance.
     *
     * @return void
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
    public function clearpost(Request $request)
    {
        //clear post
        $d = Session::get('Clear');
        $d->title = '';
        $d->description = '';
        Session::forget('Clear');
        return view('post.postupdate', ['ptt' => $d]);
    }

    /**
     * Show the specified list data on update form.
     *
     * @param  \App\Posts  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Posts::find($id);
        Session::put('Clear', $post);
        return view('post.postupdate', ['ptt' => $post]);
    }

    /**
     * Check validate data from update form
     *
     * @param  \App\Posts  $pdata
     * @return \Illuminate\Http\Response
     */
    public function confirm(Request $request)
    {
        if (isset($request->title) && isset($request->description)) {

            if (Posts::where('title', $request->title)->exists()) {
                return back()->with('postError', 'Post already exists!!')->withInput();
            }

            $cdata = new Posts();
            $cdata->id = $request->postId;
            $cdata->title = $request->title;
            $cdata->description = $request->description;
            $cdata->status = $request->status;

            Session::put('Upost', $cdata);
            $data = Session::get('Upost');

            if (Session::has('Upost')) {
                Session::put('New', $cdata);
                $data = Session::get('New');
            }
            return view('post.postupdateconfirm')->with(['pdata' => $data]);
        }
        else {
            $validator = Validator::make($request->all(), [
                'title' => 'required|max:255',
                'description' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect('postupdate')
                    ->withErrors($validator)
                    ->withInput();
            }
        }
    }

    /**
     * Show update confirmation data on update form when clicked cancel.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancelupdate(Request $request)
    {
        //cancel post
        if (Session::has('Upost')) {
            $data = Session::get('Upost');
        }else {
            $data = Session::get('New');
        }
        return view('post.postupdate')->with(['ptt' => $data]);
    }

    /**
     * Update created post data in db.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (Session::has('Upost')) {
            $rows = Session::get('Upost');
            $this->postService->update($rows);
            Session::forget('Upost');
        }
        elseif (Session::has('New')) {
            $rows = Session::get('New');
            $this->postService->update($rows);
            Session::forget('New');
        }
        return redirect('/postlist');
    }
}
