<?php

namespace Tiptap\HTML\Marks;

class Link extends Mark
{
    public function parseHTML()
    {
        return $this->DOMNode->nodeName === 'a';
    }

    public function data()
    {
        $data = [
            'type' => 'link',
        ];

        $attrs = [];

        if ($target = $this->DOMNode->getAttribute('target')) {
            $attrs['target'] = $target;
        }

        if ($rel = $this->DOMNode->getAttribute('rel')) {
            $attrs['rel'] = $rel;
        }

        $attrs['href'] = $this->DOMNode->getAttribute('href');

        $data['attrs'] = $attrs;

        return $data;
    }
}