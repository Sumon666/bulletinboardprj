<?php

namespace App\Contracts\Dao\Post;

use Illuminate\Http\Request;

interface PostDaoInterface
{
    //for new post
    public function addPost($data);
    //for show postlist
    public function getList();
    //for show postlist with search data
    public function searchPost($sdata);
    //for postDetail
    public function getPostDetail($title);
    //for post update
    public function update($rows);
    //for post delete
    public function delete($id);
    //for UploadCSV
    public function getUploadCSV($importData_arr);

}
