<?php

namespace Tiptap\Exception;

class UnknownAttributeException extends BaseException
{
    public function __construct($node)
    {
        parent::__construct('Unknown attribute \'' . $node->attributes->item(0)->nodeName . '="' . $node->attributes->item(0)->nodeValue . '"\' for <' . $node->nodeName . '/>');

        $this->node = $node;
    }
    
    public function __toString()
    {
        return get_class($this) . " {$this->message} in {$this->file}:{$this->line}\n"
                                . "{$this->getTraceAsString()}";
    }
}
