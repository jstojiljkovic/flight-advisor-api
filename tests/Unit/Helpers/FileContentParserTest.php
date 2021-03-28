<?php

namespace Tests\Unit\Helpers;

use App\Helpers\FileContentParser;
use PHPUnit\Framework\TestCase;

class FileContentParserTest extends TestCase
{
    /**
     * Test if file content parser returns array
     *
     * @return void
     */
    public function test_file_content_parser()
    {
        $parsedArray = FileContentParser::toArray([ 1, 2, 3, 4, 5 ], __DIR__ . '/files/parser.txt', ',');
        
        $exceptedResult[] = [
            1 => 'This',
            2 => 'is',
            3 => 'just',
            4 => 'a',
            5 => 'test'
        ];
        
        $this->assertSame($exceptedResult, $parsedArray);
    }
}
