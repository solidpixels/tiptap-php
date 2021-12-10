<?php

namespace Tiptap\Tests\Marks;

use Tiptap\Editor;
use Tiptap\Tests\HTMLOutput\TestCase;

class UnderlineTest extends TestCase
{
    /** @test */
    public function underline_mark_gets_rendered_correctly()
    {
        $document = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'text',
                    'text' => 'Example Text',
                    'marks' => [
                        [
                            'type' => 'underline',
                        ],
                    ],
                ],
            ],
        ];

        $html = '<u>Example Text</u>';

        $this->assertEquals($html, (new Editor)->setContent($document)->getHTML());
    }
}
