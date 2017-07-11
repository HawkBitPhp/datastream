<?php


namespace Hawkbit\DataStream;


interface DataStream
{

    const DEFAULT_INPUT = InputStream::class;
    const DEFAULT_OUTPUT = OutputStream::class;
    const MESSAGE_ESCAPE_STRING = "\0";

    /**
     * DataStream constructor.
     *
     * @param $data
     * @param \Hawkbit\DataStream\Serializer|null $serializer
     * @param \Hawkbit\DataStream\Hasher|null $hasher
     * @param \Hawkbit\DataStream\Compressor|null $compressor
     */
    public function __construct($data, Serializer $serializer = null, Hasher $hasher = null, Compressor $compressor =
    null);

    /**
     * get raw data
     *
     * @return mixed
     */
    public function getRaw();

    /**
     * Get converted data
     *
     * @return mixed
     */
    public function getData();

    /**
     * Get MD5 Hash fingerprint
     *
     * @return string
     */
    public function getFingerprint(): string;

    /**
     * Get expiration for data
     *
     * @return int
     */
    public function getExpirationTime(): int;

    /**
     * @return string
     */
    public function __toString(): string;


}