<?php

namespace App\Services\Vimeo;

use Symfony\Component\HttpFoundation\Response;
use GuzzleHttp\Client;

class VimeoVideo
{
    public static function assignVideoToFolder($folderId, $videoId): bool
    {
        try {
            $response = (new Client())->request('PUT', "https://api.vimeo.com/me/projects/" . $folderId . "/videos/" . $videoId, ['headers' => ['Authorization' => 'Bearer ' . config('vimeo.access')]]);
            return $response->getStatusCode() === Response::HTTP_NO_CONTENT;
        } catch (\Exception) {
            return false;
        }
    }

    private static function payloadUploadVideo($request): array
    {
        return [
            'upload' => [
                'approach' => 'tus',
                'size' => $request->file('video')->getSize()
            ],
            'name' => $request->validated()['title'],
            'description' => $request->validated()['title'],
            'privacy' => [
                'embed' => 'whitelist',
                'view' => 'disable'
            ],
            'embed' => [
                'buttons' => [
                    'embed' => true,
                    'fullscreen' => true,
                    'like' => true,
                    'share' => true,
                    'watchlater' => true,
                    'hd' => true,
                    'scaling' => true,
                ]
            ],
            'embed_domains' => config('vimeo.embed_domains')
        ];
    }

    public static function deleteVideo(int $videoId): bool
    {
        try {
            return (new Client())->request('DELETE', "https://api.vimeo.com/videos/${videoId}", ['headers' => ['Authorization' => 'Bearer ' . config('vimeo.access')]])->getStatusCode() === Response::HTTP_NO_CONTENT;
        } catch (\Exception) {
            return false;
        }
    }

    public static function getVideo(int $videoId): array
    {
        try {
            $response = (new Client())->request('GET', "https://api.vimeo.com/videos/${videoId}", ['headers' => ['Authorization' => 'Bearer ' . config('vimeo.access'), 'Content-Type' => 'application/json']]);
            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception) {
            return [];
        }
    }

    public static function uploadVideo($request): array
    {
        try {
            $response = (new Client())->request('POST', 'https://api.vimeo.com/me/videos', ['headers' => ['Authorization' => 'Bearer ' . config('vimeo.access'), 'Content-Type' => 'application/json', 'Accept' => 'application/vnd.vimeo.*+json;version=3.4'], 'json' => self::payloadUploadVideo($request)]);
            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception) {
            return [];
        }
    }
}
