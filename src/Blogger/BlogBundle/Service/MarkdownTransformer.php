<?php

namespace Blogger\BlogBundle\Service;

use Blogger\BlogBundle\Service\Second;

class MarkdownTransformer
{
    private $markdownParser;

    public function __construct($markdownParser)
    {
        $this->markdownParser = $markdownParser;
    }

    public function parse($str)
    {
        return $this->markdownParser->transform($str);
    }

}