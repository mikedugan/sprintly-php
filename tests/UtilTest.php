<?php namespace Dugan\Sprintly\Tests;

use Dugan\Sprintly\Util;

class UtilTest extends \PHPUnit_Framework_TestCase
{
    protected $resource;

    /**
    * @test
    */
    public function convertsCamelToSnake()
    {
        $tests = [
            'simpleTest' => 'simple_test',
            'easy' => 'easy',
            'HTML' => 'html',
            'simpleXML' => 'simple_xml',
            'PDFLoad' => 'pdf_load',
            'startMIDDLELast' => 'start_middle_last',
            'AString' => 'a_string',
            'Some4Numbers234' => 'some4_numbers234',
            'TEST123String' => 'test123_string'
        ];

        foreach($tests as $raw => $expected) {
            $this->assertEquals($expected, Util::toSnake($raw));
        }
    }
}


