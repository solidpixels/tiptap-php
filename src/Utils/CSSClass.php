<?php

namespace Tiptap\Utils;

use Exception;

class CSSClass
{
    public $names;

    public function __construct($DOMNode)
    {
        if ($DOMNode->nodeName != '#text' && $DOMNode->getAttribute('class')) {
          $this->names = [];
          $names = explode(' ', $DOMNode->getAttribute('class'));
          foreach ($names as $className) {
            $this->names[$className] = true;
          }
        }
    }

    public function hasClass($value): bool
    {
        return $this->names && isset($this->names[$value]);
    }

    public function removeClass($value)
    {
        if ($this->names) {
          unset($this->names[$value]);
        }
    }
}
