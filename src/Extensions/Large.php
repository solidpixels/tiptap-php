<?php

namespace Tiptap\Extensions;

use Tiptap\Core\Extension;
use Tiptap\Utils\InlineStyle;

class Large extends Extension
{
    public static $name = 'large';

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
                'large' => [
                    'parseHTML' => function ($DOMNode, &$HTMLAttributes) {
                      if (isset($HTMLAttributes['class']) && $HTMLAttributes['class']->hasClass('text-large')) {
                        $HTMLAttributes['class']->removeClass('text-large');
                        return true;
                      }
                      return null;
                    },
                    'renderHTML' => function ($attributes) {
                      if (!isset($attributes->large)) {
                          return null;
                      }
                      return [
                          'class' => "text-large",
                      ];
                    },
                ],
              ],
            ],
        ];
    }
}
