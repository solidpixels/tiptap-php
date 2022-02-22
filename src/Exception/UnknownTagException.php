<?php

namespace Tiptap\Exception;

class UnknownTagException extends BaseException
{
    public function __construct($node)
    {
        parent::__construct('Unknown tag <' . $node->nodeName . '/>');

        $this->node = $node;
    }
    
    public function __toString()
    {
        return get_class($this) . " {$this->message} in {$this->file}:{$this->line}\n"
                                . "{$this->getTraceAsString()}";
    }
}
