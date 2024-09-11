<?php

namespace App\Services\Vimeo;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;
use GuzzleHttp\Client;

class VimeoFolder
{
    private const BASE_URL = 'https://api.vimeo.com/me/projects';

    private const PER_PAGE = 10;

    public static function getFolders(int $page): array
    {
        try {
            $response = (new Client())->get(self::BASE_URL, ['headers' => ['Authorization' => 'Bearer ' . config('vimeo.access'), 'Content-Type' => 'application/json',], 'query' => ['per_page' => self::PER_PAGE, 'page' => $page, 'sort' => 'date', 'direction' => 'desc']]);
            $response = json_decode($response->getBody()->getContents(), true);
            return static::withPaginate($response);
        } catch (\Exception) {
            return [];
        }
    }

    private static function withPaginate(array $response): array
    {
        return [
            'nextPage' => self::getNextPage($response['paging']['next']),
            'data' => self::toCollection($response['data'])
        ];
    }

    private static function toCollection(array $data): object
    {
        return collect($data)->map(function ($folder) {
            return [
                'name' => $folder['name'],
                'folder_id' => (int)Str::of($folder['uri'])->explode('/')->last(),
                'items_count' => $folder['metadata']['connections']['items']['total']
            ];
        });
    }

    public static function createFolder(array $payload): array
    {
        try {
            $response = (new Client())->post(self::BASE_URL, ['headers' => ['Authorization' => 'Bearer ' . config('vimeo.access'), 'Content-Type' => 'application/json'], 'json' => $payload]);
            $response = json_decode($response->getBody()->getContents(), true);
            return [
                'name' => $response['name'],
                'folder_id' => Str::of($response['uri'])->explode('/')->last(),
                'items_count' => $response['metadata']['connections']['items']['total']
            ];
        } catch (\Exception) {
            return [];
        }
    }

    private static function getNextPage(mixed $nextPage): null|int
    {
        if ($nextPage) {
            preg_match('/&page=(\d+)/', $nextPage, $page);
            return end($page);
        }
        return null;
    }

    public static function deleteFolder($folder_id): bool
    {
        try {
            $response = (new Client())->delete(self::BASE_URL . '/' . $folder_id, ['headers' => ['Authorization' => 'Bearer ' . config('vimeo.access'), 'Content-Type' => 'application/json']]);
            return $response->getStatusCode() === Response::HTTP_OK;
        } catch (\Exception) {
            return false;
        }
    }

    public static function updateFolder(int $folder_id, string $folder_name): bool
    {
        try {
            $response = (new Client())->patch(self::BASE_URL . '/' . $folder_id, ['headers' => ['Authorization' => 'Bearer ' . config('vimeo.access'), 'Content-Type' => 'application/json'], 'json' => ['name' => $folder_name]]);
            return $response->getStatusCode() === Response::HTTP_OK;
        } catch (\Exception) {
            return false;
        }
    }
}
