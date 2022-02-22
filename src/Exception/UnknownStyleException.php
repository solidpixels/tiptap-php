<?php

namespace Tiptap\Exception;

class UnknownStyleException extends BaseException
{
    public function __construct($node, $style)
    {
        parent::__construct('Unknown style \'' . implode(',', $style) . '\' for <' . $node->nodeName . '/>');

        $this->node = $node;
    }
    
    public function __toString()
    {
        return get_class($this) . " {$this->message} in {$this->file}:{$this->line}\n"
                                . "{$this->getTraceAsString()}";
    }
}
