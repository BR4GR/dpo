<?php

namespace App\Helpers;


use League\CommonMark\CommonMarkConverter;

class MarkdownParser
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function parse($filePath)
    {
        if (!file_exists($filePath)) {
            return '';
        }

        $markdownContent = file_get_contents($filePath);
        $converter = new CommonMarkConverter([
            'html_input' => 'escape', // Prevent HTML injection
            'allow_unsafe_links' => false,
        ]);

        return $converter->convert($markdownContent);
    }
}
