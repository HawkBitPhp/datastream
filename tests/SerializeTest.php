<?php

namespace Hawkbit\DataStream\Tests;

use Hawkbit\DataStream\Serializer;
use PHPUnit\Framework\TestCase;

class SerializeTest extends TestCase
{

    /**
     * Test and build default hash
     * @return \Hawkbit\DataStream\Serializer
     */
    public function testDefaultSerializer(): Serializer
    {
        $className = Serializer::DEFAULT_SERIALIZER;
        $class = new $className;

        $this->assertInstanceOf(Serializer::class, $class);

        return $class;
    }

    /**
     * @dataProvider hashData
     * @depends      testDefaultSerializer
     *
     * @param $raw
     * @param string $serialized
     * @param \Hawkbit\DataStream\Serializer $serializer
     */
    public function testSerialize($raw, string $serialized, Serializer $serializer)
    {
        $this->assertEquals($serialized, $serializer->serialize($raw));
    }

        /**
     * @dataProvider hashData
     * @depends      testDefaultSerializer
     *
     * @param $raw
     * @param string $serialized
     * @param \Hawkbit\DataStream\Serializer $serializer
     */
    public function testUnserialize($raw, string $serialized, Serializer $serializer)
    {
        $this->assertEquals($raw, $serializer->unserialize($serialized));
    }

    public function hashData()
    {

        $data = [
            'string' => 'Hello World',
            'int' => 42,
            'json' => [
                'hello' => 'world',
                'sense' => 42
            ]
        ];

        $result = [];

        foreach ($data as $k => $v)
        {
            $result[$k] = [
                $v,

                // default compression with
                json_encode($v, JSON_BIGINT_AS_STRING|JSON_UNESCAPED_UNICODE)
            ];
        }

        return $result;
    }
}
