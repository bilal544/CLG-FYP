<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class AjaxController extends Controller
{
    public $API_BASE_URL;
    public $API_KEY;

    public function __construct()
    {
        $this->API_BASE_URL = config('constants.API_BASE_URL');
        $this->API_KEY = config('constants.API_AUTH_KEY');
    }

    public function handleParaphrase(Request $request): JsonResponse
    {
        $MIN_WORDS = 15;
        $MAX_WORDS = 500;

        $rules = [
            'text' => 'required|string'
        ];

        $validated = $this->handleValidation($request, $rules);

        $text = $validated['text'];

        $wordsArray = str_word_count($text, 1);
        $totalWords = count($wordsArray);

        if ($totalWords < $MIN_WORDS) {
            return response()->json([
                'messsage' => 'Minimum 15 words are required',
                'success' => false
            ], 422);
        }

        $first500Words = array_slice($wordsArray, 0, $MAX_WORDS);
        $summary = implode(' ', $first500Words);

        try {
            $apiResponse = Http::withHeaders([
                'Authorization' => "Bearer {$this->API_KEY}",
                'Content-Type' => 'application/json',
            ])->post($this->API_BASE_URL, [
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
                ], $apiResponse->status());
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

    public function handleValidation(Request $request, array $rules): array|JsonResponse
    {
        $validated = Validator::make($request->all(), $rules);

        if ($validated->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validated->errors(),
            ], 200);
        }

        return $validated->validated();
    }


    public function handleWriteEssay(Request $request): JsonResponse
    {
        $MAX_INPUT_WORDS = 100;
        $lengthSettings = [
            'short' => '2-3 paragraphs',
            'medium' => '4-5 paragraphs',
            'long' => '6+ paragraphs'
        ];

        try {
            $validated = $request->validate([
                'text' => 'required|string',
                'essay_length' => 'nullable|in:short,medium,long',
            ]);

            $selectedLength = $validated['essay_length'] ?? 'medium';
            $essayType = $validated['essay_type'] ?? 'expository';
            $tone = $validated['tone'] ?? 'academic';
            $inputText = $validated['text'];

            // Trim input to max words
            $words = str_word_count($inputText, 1);
            $trimmedText = implode(' ', array_slice($words, 0, $MAX_INPUT_WORDS));

            // Build essay prompt
            $prompt = "Write a {$selectedLength} {$essayType} essay in {$tone} tone. ";
            $prompt .= "Length: {$lengthSettings[$selectedLength]}. ";
            $prompt .= "Use this as key content: {$trimmedText}\n\n";
            $prompt .= "Include:\n- Clear thesis statement\n- Well-structured paragraphs\n- Smooth transitions\n- Proper conclusion";

            // Generate essay
            $response = Http::withHeaders([
                'Authorization' => "Bearer {$this->API_KEY}",
                'Content-Type' => 'application/json'
            ])->post($this->API_BASE_URL, [
                'model' => 'meta-llama/llama-3-70b-instruct',
                'messages' => [['role' => 'user', 'content' => $prompt]],
                'temperature' => 0.7,
                'max_tokens' => 2000
            ]);

            info($response);

            if ($response->failed()) {
                throw new \Exception("Failed to generate essay", 500);
            }

            $essay = $response->json()['choices'][0]['message']['content'];

            return response()->json([
                'success' => true,
                'essay' => $essay,
                'word_count' => str_word_count($essay),
                'prompt_used' => $prompt // For debugging
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid input',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'error' => $e->getTraceAsString() // Remove in production
            ], 500);
        }
    }

    public function handleWriteStory(Request $request): JsonResponse
    {
        $MAX_INPUT_WORDS = 100;
        $lengthSettings = [
            'short' => '2-3 paragraphs',
            'medium' => '4-5 paragraphs',
            'long' => '6+ paragraphs'
        ];

        try {
            $validated = $request->validate([
                'text' => 'required|string',
                'essay_length' => 'nullable|in:short,medium,long',
            ]);

            $selectedLength = $validated['essay_length'] ?? 'medium';
            $inputText = $validated['text'];

            // Trim input to max words
            $words = str_word_count($inputText, 1);
            $trimmedText = implode(' ', array_slice($words, 0, $MAX_INPUT_WORDS));

            // Build essay prompt
            $prompt = "Write a {$selectedLength} story ";
            $prompt .= "Length: {$lengthSettings[$selectedLength]}. ";
            $prompt .= "Use this as key content: {$trimmedText}\n\n";
            $prompt .= "Include:\n- Clear thesis statement\n- Well-structured paragraphs\n- Smooth transitions\n- Proper conclusion";

            // Generate essay
            $response = Http::withHeaders([
                'Authorization' => "Bearer {$this->API_KEY}",
                'Content-Type' => 'application/json'
            ])->post($this->API_BASE_URL, [
                'model' => 'meta-llama/llama-3-70b-instruct',
                'messages' => [['role' => 'user', 'content' => $prompt]],
                'temperature' => 0.7,
                'max_tokens' => 2000
            ]);

            info($response);

            if ($response->failed()) {
                throw new \Exception("Failed to generate essay", 500);
            }

            $essay = $response->json()['choices'][0]['message']['content'];

            return response()->json([
                'success' => true,
                'story' => $essay,
                'word_count' => str_word_count($essay),
                'prompt_used' => $prompt // For debugging
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid input',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'error' => $e->getTraceAsString() // Remove in production
            ], 500);
        }
    }
}
