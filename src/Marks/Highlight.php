<?php

namespace Tiptap\Marks;

use Tiptap\Core\Mark;
use Tiptap\Utils\HTML;
use Tiptap\Utils\InlineStyle;

class Highlight extends Mark
{
    public static $name = 'highlight';

    public static $ignoredAttributes = ['style', 'class'];

    public function addOptions()
    {
        return [
            'HTMLAttributes' => [
              'class' => 'text-highlight',
            ],
        ];
    }

    public function parseHTML()
    {
        return [
          [
              'tag' => 'mark',
          ],
          [
              'tag' => 'span[class="text-highlight"]',
          ],
        ];
    }

    public function addAttributes()
    {
        return [
            '_' => [
                'parseHTML' => function ($DOMNode, &$HTMLAttributes) {
                  if (isset($HTMLAttributes['class'])) {
                    $HTMLAttributes['class']->removeClass('text-highlight');
                  }
                  return null;
                },
                'renderHTML' => function ($attributes) {
                    return null;
                },
            ],
            'color' => [
                'parseHTML' => function ($DOMNode) {
                    if ($color = $DOMNode->getAttribute('data-color')) {
                        return $color;
                    }

                    return InlineStyle::getAttribute($DOMNode, 'background-color') ?: null;
                },
                'renderHTML' => function ($attributes) {
                    if (!isset($attributes->color)) {
                        return null;
                    }

                    return [
                        'data-color' => $attributes->color,
                        'style' => "background-color:{$attributes->color}",
                    ];
                },
            ],
        ];
    }

    public function renderHTML($mark, $HTMLAttributes = [])
    {
        return [
            'span',
            HTML::mergeAttributes($this->options['HTMLAttributes'], $HTMLAttributes),
            0,
        ];
    }
}
