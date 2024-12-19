<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GiphyService
{
    public static function generarGifUrl($query)
    {
        $apiKey = env('GIPHY_API_KEY');

        try {
            $response = Http::get("https://api.giphy.com/v1/gifs/search", [
                'api_key' => $apiKey,
                'q' => $query,
                'limit' => 1,
                'rating' => 'g',
            ]);

            if ($response->successful() && isset($response['data']) && count($response['data']) > 0) {
                return $response['data'][0]['images']['original']['url'] ?? '';
            }

            return '';
        } catch (\Exception $e) {
            return '';
        }
    }
}
