<?php

namespace Tiptap\Marks;

use Tiptap\Core\Mark;
use Tiptap\Utils\HTML;

class Link extends Mark
{
    public static $name = 'link';

    public static $ignoredAttributes = ['data-saferedirecturl', 'data-mt-detrack-inspected', 'title', 'word-break', 'name'];

    public function addOptions()
    {
        return [
            'HTMLAttributes' => [
                'target' => '_blank',
                'rel' => 'noopener noreferrer nofollow',
            ],
        ];
    }

    public function parseHTML()
    {
        return [
            [
                'tag' => 'a[href]',
            ],
        ];
    }

    public function addAttributes()
    {
        return [
            '_' => [
                'parseHTML' => function ($DOMNode, &$HTMLAttributes) {
                  if (isset($HTMLAttributes['class'])) {
                    $HTMLAttributes['class']->removeClass('l');
                    $HTMLAttributes['class']->removeClass('link');
                  }

                  $DOMNode->removeAttributeNS(null, 'xmlns:a');

                  return null;
                },
                'renderHTML' => function ($attributes) {
                    return null;
                },
            ],
            'href' => [],
            'target' => [],
            'rel' => [],
        ];
    }

    public function renderHTML($mark, $HTMLAttributes = [])
    {
        return [
            'a',
            HTML::mergeAttributes($this->options['HTMLAttributes'], $HTMLAttributes),
            0,
        ];
    }
}
