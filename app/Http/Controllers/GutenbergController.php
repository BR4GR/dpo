<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GutenbergController extends Controller
{
    public function index()
    {
        return view('gutenberg');
    }

    public function fetchBook()
    {
        // Pick a random book ID
        $bookID = rand(1, 70000);
        $metaUrl = "https://gutendex.com/books/$bookID";
        $metaResponse = Http::get($metaUrl);

        if (!$metaResponse->ok()) {
            // Try again or return an error
            return response()->json(['error' => 'Book metadata fetch failed'], 500);
        }

        $data = $metaResponse->json();
        if (isset($data['detail'])) {
            // Not a valid book, try again (in a real scenario you might loop, but let's keep it simple)
            return response()->json(['error' => 'Invalid book data'], 500);
        }

        // Find a text/plain url
        $textUrl = null;
        foreach ($data['formats'] as $fmt => $url) {
            if (str_contains($fmt, 'text/plain') && !str_contains($fmt, 'zip')) {
                $textUrl = $url;
                break;
            }
        }

        if (!$textUrl) {
            return response()->json(['error' => 'No plain text available for this book'], 500);
        }

        // Fetch the text from Gutenberg
        $textResponse = Http::get($textUrl);
        if (!$textResponse->ok()) {
            return response()->json([
                'error' => 'Failed to fetch book text',
                'textresponse' => $textResponse
            ], 500);
        }

        $fullText = $textResponse->body();

        return response()->json([
            'title' => $data['title'],
            'authors' => $data['authors'],
            'bookID' => $bookID,
            'text' => $fullText
        ]);
    }
}
