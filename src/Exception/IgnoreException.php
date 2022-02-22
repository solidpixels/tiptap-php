<?php

namespace Tiptap\Exception;

class IgnoreException extends BaseException
{
    public $reason = 'unknown';

    public function __construct($node, $reason)
    {
        parent::__construct('<' . $node->nodeName . '/> is ignored because ' . $reason);

        $this->reason = $reason;
        $this->node = $node;
    }
    
    public function __toString()
    {
        return get_class($this) . " {$this->message} in {$this->file}:{$this->line}\n"
                                . "{$this->getTraceAsString()}";
    }
}
