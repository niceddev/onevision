<?php

namespace App\Http\Controllers;

use App\Contracts\Parser\PostInterface;
use App\DTO\PostDTO;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(PostInterface $postInterface, PostService $postService): View
    {
        $page = request()->input('page', 0);
        $posts = $postService->toPaginator(
            $postInterface->getAllPostsByUserId(auth()->user()->id),
            $page
        );
        return view('modules.post.index', compact('posts'));
    }

    public function create(): View
    {
        return view('modules.post.create');
    }

    public function store(PostInterface $postInterface, PostRequest $postRequest): RedirectResponse
    {
        $postDTO = new PostDTO(
            authorName: $postRequest->input('author_name'),
            title: $postRequest->input('title'),
            body: $postRequest->input('body'),
            userId: auth()->user()->id,
        );

        try {
            $postInterface->addNewPost($postDTO);
            $postInterface->create($postDTO);
        } catch (\Exception) {
            return redirect()->route('posts.create')->with('error', __('Ошибка на стороне внешнего сервиса!'));
        }

        return redirect()->route('posts.index')->with('success', __('Пост успешно создан!'));
    }

    public function edit(PostInterface $postInterface, Post $post): View
    {
        $post = new PostDTO(
            ...$postInterface->getPostById($post->id),
            authorName: $post->author_name,
        );
        return view('modules.post.edit', compact('post'));
    }

    public function update(PostInterface $postInterface, PostRequest $postRequest, Post $post): RedirectResponse
    {
        $postDTO = new PostDTO(
            authorName: $postRequest->input('author_name'),
            title: $postRequest->input('title'),
            body: $postRequest->input('body'),
            userId: auth()->user()->id,
        );

        try {
            $postInterface->updatePost($postDTO);
            $postInterface->update($post, $postDTO);
        } catch (\Exception) {
            return redirect()->route('posts.create')->with('error', __('Ошибка на стороне внешнего сервиса!'));
        }

        return redirect()->route('posts.index')->with('success', 'Пост изменен!');
    }

    public function destroy(PostInterface $postInterface, Post $post): RedirectResponse
    {
        try {
            $postInterface->deletePost($post->id);
            $postInterface->destroy($post->id);
        } catch (\Exception) {
            return redirect()->route('posts.index')->with('error', __('Ошибка на стороне внешнего сервиса!'));
        }

        return redirect()->route('posts.index')->with('success', __('Пост удален!'));
    }

}
