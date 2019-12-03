<?php

namespace App\Services\Post;

use App\Contracts\Dao\Post\PostDaoInterface;
use App\Contracts\Services\Post\PostServiceInterface;
use Illuminate\Http\Request;

class PostService implements PostServiceInterface
{
    private $postDao;

    /**
     * Constructor.
     *
     * @param PostDaoInterface $postDao
     */
    public function __construct(PostDaoInterface $postDao)
    {
        $this->postDao = $postDao;
    }

    /**
     * Create Post.
     *
     * @param $data
     *
     * @return
     */
    public function addPost($data)
    {
        return $this->postDao->addPost($data);
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
        return $this->postDao->getList();
    }

    /**
     * Get Post List.
     *
     * @param $sdata
     *
     * @return $plist
     */
    public function searchPost($sdata)
    {
        return $this->postDao->searchPost($sdata);
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
        return $this->postDao->getPostDetail($title);
    }

    /**
     * Update post data.
     *
     * @param Request $request
     *
     * @return $request
     */
    public function update($rows)
    {
        return $this->postDao->update($rows);
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
        return $this->postDao->delete($id);
    }

    /**
     * Get uploadcsv.
     *
     * @param
     *
     * @return
     */
    public function getUploadCSV($importData_arr)
    {
        return $this->postDao->getUploadCSV($importData_arr);
    }
}
