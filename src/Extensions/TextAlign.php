<?php

namespace Tiptap\Extensions;

use Tiptap\Core\Extension;
use Tiptap\Utils\InlineStyle;

class TextAlign extends Extension
{
    public static $name = 'textAlign';

    public function addOptions()
    {
        return [
            'types' => [],
            'alignments' => ['left', 'center', 'right'],
            'defaultAlignment' => 'left',
        ];
    }

    public function addGlobalAttributes()
    {
        return [
            [
              'types' => $this->options['types'],
              'attributes' => [
                'textAlign' => [
                    'default' => $this->options['defaultAlignment'],
                    'parseHTML' => function ($DOMNode, &$HTMLAttributes) {
                      $align = $DOMNode->getAttribute('align');

                      foreach ($this->options['alignments'] as $name) {
                        if ($align == $name) {
                          $DOMNode->removeAttribute('align');
                          return $name;
                        }

                        if (isset($HTMLAttributes['class']) && $HTMLAttributes['class']->hasClass($name)) {
                          $HTMLAttributes['class']->removeClass($name);
                          return $name;
                        }
                      }
    
                      $style = \Tiptap\Utils\InlineStyle::getAttribute($DOMNode, 'text-align') ?: null;
                      if ($style) {
                        $DOMNode->removeAttribute('style');
                      }
                      return $style;
                    },
                    'renderHTML' => function ($attributes) {
                        if (!isset($attributes->textAlign) || $attributes->textAlign === $this->options['defaultAlignment']) {
                            return null;
                        }

                        return ['class' => $attributes->textAlign];
                    },
                ],
              ],
            ],
        ];
    }
}
