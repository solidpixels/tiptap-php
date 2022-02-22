<?php

namespace Tiptap\Extensions;

use Tiptap\Core\Extension;
use Tiptap\Utils\InlineStyle;

class TextSize extends Extension
{
    public static $name = 'textSize';

    public function addOptions()
    {
        return [
            'types' => [],
        ];
    }

    public function addGlobalAttributes()
    {
        return [
            [
              'types' => $this->options['types'],
              'attributes' => [
                'size' => [
                    'parseHTML' => function ($DOMNode, &$HTMLAttributes) {
                        if ($size = $DOMNode->getAttribute('class')) {
                          if (preg_match('/text-size-([^ ]*?)$/', $size, $matches)) {
                            $HTMLAttributes['class']->removeClass("text-size-{$matches[1]}");
                            return $matches[1];
                          }
                        }
    
                        // $style = InlineStyle::getAttribute($DOMNode, 'size') ?: null;
                        // if ($style) {
                        //   $DOMNode->removeAttribute('style');
                        //   return $style;
                        // }
                        return null;
                    },
                    'renderHTML' => function ($attributes) {
                        if (!isset($attributes->size)) {
                            return null;
                        }
    
                        return [
                            'class' => "text-size-{$attributes->size}",
                        ];
                    },
                ],
              ],
            ],
        ];
    }
}
