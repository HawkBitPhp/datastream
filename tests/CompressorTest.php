<?php

namespace Hawkbit\DataStream\Tests;


use Hawkbit\DataStream\Compressor;
use Hawkbit\DataStream\DeflateCompressor;
use PHPUnit\Framework\TestCase;

class CompressorTest extends TestCase
{

    /**
     * Test and create default compressor
     *
     * @return Compressor
     */
    public function testDefaultCompressor(): Compressor
    {
        $className = Compressor::DEFAULT_COMPRESSION;
        $class = new $className;

        $this->assertInstanceOf(Compressor::class, $class);

        return $class;
    }

    /**
     * @dataProvider compressionData
     * @depends      testDefaultCompressor
     *
     * @param $uncompressed
     * @param $compressed
     * @param \Hawkbit\DataStream\Compressor $compressor
     */
    public function testCompress($uncompressed, $compressed, Compressor $compressor)
    {
        $this->assertEquals($compressed, $compressor->compress($uncompressed));
    }

    /**
     * @dataProvider compressionData
     * @depends      testDefaultCompressor
     *
     * @param $uncompressed
     * @param $compressed
     * @param \Hawkbit\DataStream\Compressor $compressor
     */
    public function testUncompress($uncompressed, $compressed, Compressor $compressor)
    {
        $this->assertEquals($uncompressed, $compressor->uncompress($compressed));
    }

    public function compressionData()
    {

        $data = [
            'string' => 'Hello World',
            'int' => 42,
            'json' => json_encode([
                'hello' => 'world',
                'sense' => 42
            ])
        ];

        $result = [];

        foreach ($data as $k => $v)
        {
            $result[$k] = [
                $v,

                // default compression with
                gzdeflate($v, DeflateCompressor::DEFAULT_LEVEL)
            ];
        }

        return $result;
    }
}
