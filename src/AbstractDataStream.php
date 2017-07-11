<?php


namespace Hawkbit\DataStream;


abstract class AbstractDataStream implements DataStream
{
/**
     * @var mixed
     */
    private $raw;

    /**
     * @var \Hawkbit\DataStream\Hasher|null
     */
    private $hasher;
    /**
     * @var \Hawkbit\DataStream\Compressor|null
     */
    private $compressor;
    /**
     * @var \Hawkbit\DataStream\Serializer|null
     */
    private $serializer;

    /**
     * DataStream constructor.
     *
     * @param $data
     * @param \Hawkbit\DataStream\Serializer|null $serializer
     * @param \Hawkbit\DataStream\Hasher|null $hasher
     * @param \Hawkbit\DataStream\Compressor|null $compressor
     */
    public function __construct($data, Serializer $serializer = null, Hasher $hasher = null, Compressor $compressor =
    null)
    {
        $this->raw = $data;
        $this->hasher = $hasher ?? new Adler32Hasher();
        $this->compressor = $compressor ?? new DeflateCompressor();
        $this->serializer = $serializer ?? new JsonSerializer();
    }

    /**
     * @return mixed
     */
    public function getRaw()
    {
        return $this->raw;
    }

    /**
     * @return \Hawkbit\DataStream\Hasher|null
     */
    public function getHasher()
    {
        return $this->hasher;
    }

    /**
     * @return \Hawkbit\DataStream\Compressor|null
     */
    public function getCompressor()
    {
        return $this->compressor;
    }

    /**
     * @return \Hawkbit\DataStream\Serializer|null
     */
    public function getSerializer()
    {
        return $this->serializer;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getData();
    }
}