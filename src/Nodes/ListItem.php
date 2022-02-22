<?php

namespace Tiptap\Nodes;

use Tiptap\Core\Node;
use Tiptap\Utils\HTML;

class ListItem extends Node
{
    public static $name = 'listItem';
    
    public static $ignoredAttributes = ['wfd-id', 'value'];

    public static $allowedWrappers = ['p', 'h1', 'h2', 'h3', 'h4', 'h5'];

    public function addOptions()
    {
        return [
            'HTMLAttributes' => [],
        ];
    }

    public function parseHTML()
    {
        return [
            [
                'tag' => 'li',
            ],
        ];
    }

    public function renderHTML($node, $HTMLAttributes = [])
    {
        return ['li', HTML::mergeAttributes($this->options['HTMLAttributes'], $HTMLAttributes), 0];
    }

    public static function wrapper($DOMNode, &$HTMLAttributes = [])
    {
        if (
            $DOMNode->childNodes->length === 1
            && in_array($DOMNode->childNodes[0]->nodeName, self::$allowedWrappers)
        ) {
            return null;
        }

        $data = [
            'type' => 'paragraph',
        ];

        // If listItem has textAlign, set it to wrapper
        if (isset($HTMLAttributes['class'])) {
          $textAligns = ['left', 'center', 'right'];
          foreach ($textAligns as $name) {
            if ($HTMLAttributes['class']->hasClass($name)) {
              $data['attrs'] = [
                'textAlign' => $name,
              ];
              $HTMLAttributes['class']->removeClass($name);
            }
          }
        }

        return $data;
    }
}
