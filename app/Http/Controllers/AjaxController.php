<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function handleParaphrase(Request $request)
    {
        $API_BASE_URL = env('DEEPSEEK_API_URL');
        $API_KEY = env('DEEPSEEK_API_KEY');

        $validated = $request->validate([
            'text' => 'required|string'
        ]);

        $text = $validated['text'];

        try {
            $apiResponse = Http::withHeaders([
                'Authorization' => "Bearer {$API_KEY}",
                'Content-Type' => 'application/json',
            ])->post($API_BASE_URL, [
                'model' => 'meta-llama/llama-3.3-70b-instruct:free',
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => "paraphrase this text: {$text}"
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
