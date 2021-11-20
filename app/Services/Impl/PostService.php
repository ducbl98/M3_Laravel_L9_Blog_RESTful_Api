<?php


namespace App\Services\Impl;


use App\Repositories\PostRepositoryImpl;
use App\Services\PostServiceImpl;

class PostService implements PostServiceImpl
{
    protected $postRepository;

    public function __construct(PostRepositoryImpl $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function getAll()
    {
        $this->postRepository->getAll();
    }

    public function findById($id)
    {
        $post = $this->postRepository->findById($id);
        $statusCode = 200;
        if (!$post) {
            $statusCode = 404;
        }
        return [
            'post' => $post,
            'statusCode' => $statusCode,
        ];
    }

    public function create($request)
    {
        $post = $this->postRepository->create($request);
        $statusCode = 201;
        if (!$post) {
            $statusCode = 500;
        }
        return [
            'post' => $post,
            'statusCode' => $statusCode,
        ];
    }

    public function update($request, $id)
    {
        $oldPost = $this->postRepository->findById($id);

        if (!$oldPost){
            $newPost=null;
            $statusCode=404;
        }else{
            $newPost=$this->postRepository->update($request,$oldPost);
            $statusCode=200;
        }
        return [
            'post' => $newPost,
            'statusCode' => $statusCode,
        ];
    }

    public function destroy($id)
    {
        $post=$this->postRepository->findById($id);
        $statusCode=404;
        $message="Post Not Found";
        if ($post){
            $this->postRepository->destroy($id);
            $statusCode=200;
            $message='Delete Post Success !';
        }
        return [
            'message'=>$message,
            'statusCode' => $statusCode,
        ];
    }
}
