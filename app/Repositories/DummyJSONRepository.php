<?php

namespace App\Repositories;

use App\DTO\PostDTO;
use Illuminate\Http\Client\RequestException;

class DummyJSONRepository extends PostRepository
{
    /**
     * @throws RequestException
     */
    public function getAllPostsByUserId(int $userId): array
    {
        $request = $this->postService->apiParser('/posts/user/' . $userId);
        return $request->json();
    }

    /**
     * @throws RequestException
     */
    public function getPostById(int $postId): array
    {
        $request = $this->postService->apiParser('/posts/' . $postId);
        return $request->json();
    }

    /**
     * @throws RequestException
     */
    public function addNewPost(PostDTO $postDTO): array
    {
        $request = $this->postService->apiParser('/posts/add', 'post', $postDTO->toArray());
        return $request->json();
    }

    /**
     * @throws RequestException
     */
    public function updatePost(PostDTO $postDTO): array
    {
        $request = $this->postService->apiParser('/posts/' . $postDTO->getId(), 'put', $postDTO->toArray());
        return $request->json();
    }

    /**
     * @throws RequestException
     */
    public function deletePost(int $postId): array
    {
        $request = $this->postService->apiParser('/posts/' . $postId, 'delete');
        return $request->json();
    }

}
