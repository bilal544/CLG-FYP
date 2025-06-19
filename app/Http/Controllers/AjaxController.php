<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function handleParaphrase(Request $request)
    {
        $MIN_WORDS = 15;
        $MAX_WORDS = 500;
        $API_BASE_URL = env('DEEPSEEK_API_URL');
        $API_KEY = env('DEEPSEEK_API_KEY');

        $validated = $request->validate([
            'text' => 'required|string'
        ]);

        $text = $validated['text'];

        $wordsArray = str_word_count($text, 1);
        $totalWords = count($wordsArray);

        if ($totalWords < $MIN_WORDS) {
            return response()->json([
                'messsage' => 'Minimum 15 words are required',
                'success' => false
            ], 400);
        }

        $first500Words = array_slice($wordsArray, 0, $MAX_WORDS);
        $summary = implode(' ', $first500Words);

        try {
            $apiResponse = Http::withHeaders([
                'Authorization' => "Bearer {$API_KEY}",
                'Content-Type' => 'application/json',
            ])->post($API_BASE_URL, [
                'model' => 'meta-llama/llama-3.3-70b-instruct:free',
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => "Summarize the following text in a concise and clear manner, highlighting the main points and removing any unnecessary details: {$summary}"
                    ]
                ],
            ]);

            if ($apiResponse->successful()) {
                $data = $apiResponse->json();
                $reply = $data['choices'][0]['message']['content'] ?? '';
                return response()->json([
                    'text' => $reply,
                    'success' => true
                ]);
            }

            return response()->json([
                'text' => '',
                'success' => false,
                'error' => $apiResponse->body()
            ], $apiResponse->status());
        } catch (\Throwable $th) {
            return response()->json([
                'text' => '',
                'success' => false,
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    public function handleEssayWriter(Request $request):JsonResponse
    {
        $MIN_WORDS = 1;
        $MAX_WORDS = 100;
        $API_BASE_URL = env('DEEPSEEK_API_URL');
        $API_KEY = env('DEEPSEEK_API_KEY');

        $validated = $request->validate([
            'text' => 'required|string',
        ]);

        $text = $validated['text'];
        $essay_length = $request->input('essay_length') ?? 'short';

        $wordsArray = str_word_count($text, 1);
        $totalWords = count($wordsArray);

        if ($totalWords < $MIN_WORDS) {
            return response()->json([
                'messsage' => 'Minimum 15 words are required',
                'success' => false
            ], 400);
        }

        $first500Words = array_slice($wordsArray, 0, $MAX_WORDS);
        $summary = implode(' ', $first500Words);

        try {
            $apiResponse = Http::withHeaders([
                'Authorization' => "Bearer {$API_KEY}",
                'Content-Type' => 'application/json',
            ])->post($API_BASE_URL, [
                'model' => 'meta-llama/llama-3.3-70b-instruct:free',
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => "Summarize the following text in a concise and clear manner, highlighting the main points and removing any unnecessary details: {$summary}"
                    ]
                ],
            ]);

            if ($apiResponse->successful()) {
                $data = $apiResponse->json();
                $reply = $data['choices'][0]['message']['content'] ?? '';
                return response()->json([
                    'text' => $reply,
                    'success' => true
                ]);
            }

            return response()->json([
                'text' => '',
                'success' => false,
                'error' => $apiResponse->body()
            ], $apiResponse->status());
        } catch (\Throwable $th) {
            return response()->json([
                'text' => '',
                'success' => false,
                'error' => $th->getMessage(),
            ], 500);
        }
    }
}
