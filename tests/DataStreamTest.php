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

        /** @var OutputStream $dataStream */
        $dataStream = new $className($this->dto);

        $this->assertInstanceOf(DataStream::class, $dataStream);
        $this->assertEquals(hash('adler32', $dataStream->getSerializer()->serialize($dataStream->getRaw())), $dataStream->getFingerprint());

        $this->assertGreaterThan(time(), $dataStream->getExpirationTime());

        return $dataStream;
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
        $this->assertGreaterThan(time(), $inputStream->getExpirationTime());
        $this->assertEquals($outputStream->getFingerprint(), $inputStream->getFingerprint());
    }
}
