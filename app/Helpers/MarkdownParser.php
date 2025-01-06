<?php

namespace App\Helpers;


use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\Table\TableExtension;
use League\CommonMark\Extension\CommonMark\Node\Block\FencedCode;
use League\CommonMark\Extension\CommonMark\Node\Block\IndentedCode;
use League\CommonMark\Extension\HeadingPermalink\HeadingPermalinkExtension;


use League\CommonMark\MarkdownConverter;
use Spatie\CommonMarkHighlighter\FencedCodeRenderer;
use Spatie\CommonMarkHighlighter\IndentedCodeRenderer;

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

        $environment = new Environment();
        $environment->addExtension(new CommonMarkCoreExtension());
        $environment->addExtension(new TableExtension());
        $environment->addExtension(new HeadingPermalinkExtension());

        $environment->addRenderer(FencedCode::class, new FencedCodeRenderer(['html', 'php', 'js', 'c', 'bash']));
        $environment->addRenderer(IndentedCode::class, new IndentedCodeRenderer(['html', 'php', 'js', 'c', 'bash']));

        $markdownConverter = new MarkdownConverter($environment);

        $markdownContent = file_get_contents($filePath);
        return $markdownConverter->convert($markdownContent);
    }
}
