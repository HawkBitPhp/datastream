<?php

namespace Hawkbit\DataStream\Tests;

use Hawkbit\DataStream\DataStream;
use Hawkbit\DataStream\InputStream;
use Hawkbit\DataStream\OutputStream;
use PHPUnit\Framework\TestCase;

class DataStreamTest extends TestCase
{

    private $dto = [
        'string' => 'Hello World',
        'int' => 42,
        'object' => [
            'hello' => 'world',
            'sense' => 42
        ],
        'array' => [
            'hey',
            'yo'
        ]
    ];

    /**
     * Test and build default hash
     * @return \Hawkbit\DataStream\OutputStream
     */
    public function testDefaultOutput(): OutputStream
    {
        $className = DataStream::DEFAULT_OUTPUT;

        /** @var OutputStream $outputStream */
        $outputStream = new $className($this->dto);

        $this->assertInstanceOf(DataStream::class, $outputStream);
        $this->assertEquals($outputStream->getData(), (string)$outputStream);

        return $outputStream;
    }

    /**
     * Test and build default hash
     *
     * @depends testDefaultOutput
     *
     * @param \Hawkbit\DataStream\OutputStream $outputStream
     */
    public function testDefaultInput(OutputStream $outputStream)
    {
        $className = DataStream::DEFAULT_INPUT;

        /** @var InputStream $inputStream */
        $inputStream = new $className($outputStream->getData());

        $this->assertInstanceOf(DataStream::class, $inputStream);
        $this->assertEquals($this->dto, $inputStream->getData());
    }
}
