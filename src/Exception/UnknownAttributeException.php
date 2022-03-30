<?php

namespace Tiptap\Exception;

class UnknownAttributeException extends BaseException
{
    public function __construct($node, $attribute)
    {
        parent::__construct('Unknown attribute \'' . $attribute . '="' . $node->getAttribute($attribute) . '"\' for <' . $node->nodeName . '/>');

        $this->node = $node;
    }

    public function __toString()
    {
        return get_class($this) . " {$this->message} in {$this->file}:{$this->line}\n"
                                . "{$this->getTraceAsString()}";
    }
}
