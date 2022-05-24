<?php

namespace Tiptap\Extensions;

use Tiptap\Core\Extension;
use Tiptap\Utils\InlineStyle;

class ListType extends Extension
{
    public static $name = 'listType';

    public function addOptions()
    {
        return [
            'types' => ['bulletList', 'orderedList'],
            'listTypes' => ['lower-roman', 'upper-roman', 'lower-greek', 'lower-alpha, lower-latin', 'upper-alpha, upper-latin', 'georgian', 'disc', 'circle', 'square', 'decimal'],
        ];
    }

    public function addGlobalAttributes()
    {
      return [
          [
            'types' => $this->options['types'],
            'attributes' => [
              'listType' => [
                  'parseHTML' => function ($DOMNode, &$HTMLAttributes) {
                    $style = isset($HTMLAttributes['style']) ? $HTMLAttributes['style']->getStyle('list-style-type') : null;

                    if ($style && in_array($style, $this->options['listTypes'])) {
                      $HTMLAttributes['style']->removeStyle('list-style-type');
                      return $style;
                    }
                    return null;
                  },
                  'renderHTML' => function ($attributes) {
                      if (!isset($attributes->listType)) {
                          return null;
                      }

                      return [
                        'style' => "list-style-type:{$attributes->listType}"
                      ];
                  },
              ],
            ],
          ],
      ];
    }
}