<?php

namespace Hawkbit\DataStream\Tests;

use Hawkbit\DataStream\Adler32Hasher;
use Hawkbit\DataStream\Hasher;
use PHPUnit\Framework\TestCase;

class HasherTest extends TestCase
{

    /**
     * Test and build default hash
     *
     * @return \Hawkbit\DataStream\Hasher
     */
    public function testDefaultHash(): Hasher
    {
        $className = Hasher::DEFAULT_HASH;
        $class = new $className;

        $this->assertInstanceOf(Hasher::class, $class);

        return $class;
    }

    /**
     * @dataProvider hashData
     * @depends      testDefaultHash
     *
     * @param $raw
     * @param string $hashed
     * @param \Hawkbit\DataStream\Hasher $hash
     */
    public function testHashing($raw, string $hashed, Hasher $hash)
    {
        $this->assertEquals($hashed, $hash->hash($raw));
    }

    public function hashData()
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
                hash('adler32', $v)
            ];
        }

        return $result;
    }
}
