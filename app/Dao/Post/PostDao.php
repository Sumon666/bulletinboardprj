<?php

namespace App\Dao\Post;

use App\Contracts\Dao\Post\PostDaoInterface;
use App\Posts;
use App\User;
use Auth;
use Config;
use DateTime;
use Illuminate\Support\Facades\DB;

class PostDao implements PostDaoInterface
{
    /**
     * Add new post.
     *
     * @param $data
     *
     * @return
     */
    public function addPost($data)
    {
        $title = $data->title;
        $description = $data->description;
        $post = new Posts();
        $post->title = $title;
        $post->description = $description;
        $post->status = 1;
        $post->create_user_id = auth()->user()->id;
        $post->updated_user_id = auth()->user()->id;
        $post->created_at = new DateTime('now');
        $post->updated_at = new DateTime('now');
        $post->save();
    }

    /**
     * Get Post List.
     *
     * @param
     *
     * @return $plist
     */
    public function getList()
    {
        $auth_id = Auth::user()->id;

        if (Auth::user()->type == 0) {
            $plist = DB::table('posts')
                ->join('users', 'posts.create_user_id', '=', 'users.id')
                ->select('posts.title', 'posts.description', 'posts.created_at', 'posts.id', 'users.name')
                ->whereNull('posts.deleted_at')
                ->paginate(Config::get('constants.pagination.adminpaginate'));
        } elseif (Auth::user()->type == 1) {
            $plist = DB::table('posts')
                ->join('users', 'posts.create_user_id', '=', 'users.id')
                ->select('posts.title', 'posts.description', 'posts.created_at', 'posts.id', 'users.name')
                ->where('users.id', $auth_id)
                ->whereNull('posts.deleted_at')
                ->paginate(Config::get('constants.pagination.userpaginate'));
        }

        return $plist;
    }

    /**
     * Get search Post.
     *
     * @param $sdata
     *
     * @return $plist
     */
    public function searchPost($sdata)
    {
        $auth_id = Auth::user()->id;

        if (Auth::user()->type == 0) {
            $plist = DB::table('posts')
                ->join('users', 'posts.create_user_id', 'users.id')
                ->select('posts.title', 'posts.description', 'posts.created_at', 'posts.id', 'users.name')
                ->whereNull('posts.deleted_at')
                ->where('users.name', 'LIKE', '%'.$sdata.'%')
                ->orwhere('posts.title', 'LIKE', '%'.$sdata.'%')
                ->orwhere('posts.description', 'LIKE', '%'.$sdata.'%')
                ->paginate(Config::get('constants.pagination.adminpaginate'));
        } elseif (Auth::user()->type == 1) {
            $plist = DB::table('posts')
                ->join('users', 'posts.create_user_id', 'users.id')
                ->select('posts.title', 'posts.description', 'posts.created_at', 'posts.id', 'users.name')
                ->where('users.id', $auth_id)
                ->whereNull('posts.deleted_at')
                ->where('posts.title', 'LIKE', '%'.$sdata.'%')
                ->orwhere('posts.description', 'LIKE', '%'.$sdata.'%')
                ->paginate(Config::get('constants.pagination.userpaginate'));
        }

        return $plist;
    }

    /**
     * Get Post detail.
     *
     * @param $title
     *
     * @return $dlist
     */
    public function getPostDetail($title)
    {
        if (Auth::user()->type == 0) {
            $dlist = DB::table('posts')
                ->join('users', 'posts.create_user_id', 'users.id')
                ->select('posts.title', 'posts.description', 'posts.status', 'posts.created_at', 'posts.updated_at', 'users.name')
                ->where('posts.title', $title)->get();
        } elseif (Auth::user()->type == 1) {
            $dlist = DB::table('posts')
                ->select('title', 'description', 'status', 'created_at', 'updated_at')
                ->where('title', $title)->get();
        }

        return $dlist;
    }

    /**
     * Update post.
     *
     * @param $rows
     *
     * @return
     */
    public function update($rows)
    {
        $id = $rows->id;
        $pupdate = Posts::find($id);
        $pupdate->title = $rows->title;
        $pupdate->description = $rows->description;
        $pupdate->status = $rows->status;
        $pupdate->updated_user_id = auth()->user()->id;
        $pupdate->updated_at = new DateTime('now');
        $pupdate->save();
    }

    /**
     * Delete Post.
     *
     * @param $id
     *
     * @return
     */
    public function delete($id)
    {
        $result = Posts::find($id);
        $result->deleted_user_id = auth()->user()->id;
        $result->deleted_at = now();
        $result->save();
    }

    /**
     * Get uploadCSV.
     *
     * @param
     *
     * @return
     */
    public function getUploadCSV($importData_arr)
    {
        foreach ($importData_arr as $importData) {
            $insertData = array(
                'id' => $importData[0],
                'title' => $importData[1],
                'description' => $importData[2],
                'status' => $importData[3],
                'create_user_id' => auth()->user()->id,
                'updated_user_id' => auth()->user()->id,
                'created_at' => $importData[7],
                'updated_at' => $importData[8],
            );
            $value = Posts::where('id', $insertData['id'])->get();
            if ($value->count() == 0) {
                Posts::insert($insertData);
            } elseif (!empty($insertData)) {
                Posts::where('id', $insertData['id'])->update($insertData);
            }
        }
    }
}
