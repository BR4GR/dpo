<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SearchController extends Controller
{
    public function apiSearch(Request $request)
    {
        $query = strtolower($request->input('query', ''));
        $viewsPath = resource_path('views');
        $results = [];

        if (empty($query)) {
            return response()->json(['results' => $results]);
        }

        // Recursively search files in views directory, excluding specific subdirectories
        $files = File::files($viewsPath);
        foreach ($files as $file) {
            $relativePath = str_replace($viewsPath . '/', '', $file->getPathname());

            // Get the content and remove Blade directives and tags
            $content = strtolower($file->getContents());
            // Remove lines starting with '@' ex. @section('content')
            $content = preg_replace('/@.*/', '', $content);
            $content = strip_tags($content); // Remove HTML tags

            if (strpos($content, $query) !== false) {

                preg_match_all('/.{0,50}' . preg_quote($query, '/') . '.{0,50}/i', $content, $matches);

                foreach ($matches[0] as $match) {
                    $results[] = [
                        'filename' => $relativePath,
                        'url' => str_replace(['.blade.php'], [''], $relativePath),
                        'friendly_name' => ucwords(str_replace(['-', '_', '.blade.php'], [' ', ' ', ''], $relativePath)),
                        'preview' => trim($match),
                    ];
                }
            }
        }

        return response()->json(['results' => $results]);
    }
}
