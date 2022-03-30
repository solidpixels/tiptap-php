<?php

    namespace Tiptap\Utils;

    use Exception;

    class CSSInlineStyle
    {
        public $styles = [];

        public function __construct($DOMNode)
        {
            $styles = InlineStyle::get($DOMNode);
            if ($styles) {
              $this->styles = $styles;
            }
        }

        public function hasStyles(): bool
        {
            return count($this->styles) > 0;
        }

        public function hasStyle($value): bool
        {
            return isset($this->styles[$value]);
        }

        public function getStyle($value)
        {
            return isset($this->styles[$value]) ? $this->styles[$value] : null;
        }

        public function removeStyle($value)
        {
            if ($this->styles) {
              unset($this->styles[$value]);
            }
        }
    }
