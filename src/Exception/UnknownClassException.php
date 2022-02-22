<?php

namespace Tiptap\Exception;

class UnknownClassException extends BaseException
{
    public function __construct($node, $className)
    {
        parent::__construct('Unrecognized class \'' . implode(',', array_keys($className->names)) . '\' for <' . $node->nodeName . '/>');

        $this->node = $node;
    }
    
    public function __toString()
    {
        return get_class($this) . " {$this->message} in {$this->file}:{$this->line}\n"
                                . "{$this->getTraceAsString()}";
    }
}
