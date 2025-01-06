<?php

namespace App\Helpers;


use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\CommonMark\Node\Block\FencedCode;
use League\CommonMark\Extension\CommonMark\Renderer\Block\FencedCodeRenderer;
use League\CommonMark\Output\RenderedContent;
use League\CommonMark\Output\RenderedContentInterface;


class CustomCodeRenderer
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function render(FencedCode $node, bool $inTightList = false): RenderedContentInterface
    {
        $language = $node->getInfo() ?: 'plaintext';
        $code = htmlspecialchars($node->getLiteral(), ENT_QUOTES, 'UTF-8');

        return new RenderedContent(
            "<div class='code-box'>
                <pre><code class='language-{$language}'>{$code}</code></pre>
                <button class='copy-btn' onclick='copyCode(this)'>Copy</button>
            </div>"
        );
    }
}
