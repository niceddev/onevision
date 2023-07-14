<?php

namespace App\Repositories;

use App\Contracts\Parser\PostInterface;
use App\DTO\PostDTO;
use App\Models\Post;
use App\Services\PostService;

abstract class PostRepository implements PostInterface
{
    public function __construct(protected PostService $postService)
    {
    }

    public function create(PostDTO $postDTO): Post
    {
        return Post::create([
            'author_name' => $postDTO->getAuthorName(),
        ]);
    }

    public function update(Post $post, PostDTO $postDTO): bool
    {
        return $post->update([
            'author_name' => (object)$postDTO->author_name,
        ]);
    }

    public function destroy(int $postId): int
    {
        return Post::destroy($postId);
    }

}
