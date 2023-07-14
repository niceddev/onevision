<?php

namespace App\Services;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;

class PostService
{
    public function toPaginator(array $data, int $page, int $perPage = 30): LengthAwarePaginator
    {
        $posts = collect($data['posts'])->map(function ($post) {
            return (object) $post;
        });

        return new LengthAwarePaginator(
            $posts->slice(($page * $perPage) - $perPage, $perPage, true),
            $posts->count(),
            $perPage,
            $page,
            ['path' => request()->url()]
        );
    }

    /**
     * @throws RequestException
     */
    public function apiParser(string $endPoint, string $method = 'get', array $data = []): PromiseInterface|Response
    {
        $httpBuilder = Http::withoutVerifying()
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Accept'       => 'application/json',
            ]);

        $httpBuilder = match ($method) {
            'post' => $httpBuilder
                ->post(config('services.external_storage.dummyjson') . $endPoint, $data),
            'put' => $httpBuilder
                ->put(config('services.external_storage.dummyjson') . $endPoint, $data),
            'delete' => $httpBuilder
                ->delete(config('services.external_storage.dummyjson') . $endPoint),
            default => $httpBuilder
                ->get(config('services.external_storage.dummyjson') . $endPoint),
        };

        return $httpBuilder->throwUnlessStatus(200);
    }

}
