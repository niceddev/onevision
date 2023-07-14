<?php

namespace App\Contracts\Parser;

use App\DTO\PostDTO;
use App\Models\Post;

interface PostInterface
{
    public function create(PostDTO $postDTO): Post;
    public function update(Post $post, PostDTO $postDTO): bool;
    public function destroy(int $postId): int;

    public function getAllPostsByUserId(int $userId): array;
    public function getPostById(int $postId): array;
    public function addNewPost(PostDTO $postDTO): array;
    public function updatePost(PostDTO $postDTO): array;
    public function deletePost(int $postId): array;
}
