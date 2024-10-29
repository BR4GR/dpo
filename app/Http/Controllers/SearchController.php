<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = strtolower($request->input('query', ''));
        $viewsPath = resource_path('views');
        $excludedDirectories = ['components', 'layouts'];
        $results = [];
        var_dump($viewsPath);

        if (empty($query)) {
            return view('search.results', ['query' => $query, 'results' => $results]);
        }

        // Recursively search files in views directory, excluding specific subdirectories
        $files = File::allFiles($viewsPath);
        foreach ($files as $file) {
            $relativePath = str_replace($viewsPath . '/', '', $file->getPathname());
            $excluded = false;

            // Exclude files in specified directories
            foreach ($excludedDirectories as $excludedDirectory) {
                if (strpos($relativePath, $excludedDirectory . '/') === 0) {
                    $excluded = true;
                    break;
                }
            }

            if ($excluded || $file->getExtension() !== 'blade.php') {
                continue;
            }

            // Search content in the view file
            $content = strtolower($file->getContents());
            if (strpos($content, $query) !== false) {
                $results[] = [
                    'filename' => $relativePath,
                    'url' => $this->convertPathToRoute($relativePath),
                ];
            }
        }

        return view('search.results', ['query' => $query, 'results' => $results]);
    }

    private function convertPathToRoute($path)
    {
        // Convert the Blade file path to a route URL, assuming conventional routes
        $route = str_replace(['.blade.php', '/'], ['', '.'], $path);
        return url($route);
    }
}
