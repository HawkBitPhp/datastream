<?php


namespace Hawkbit\DataStream;


use Firebase\JWT\JWT;

interface DataStream
{

    const DEFAULT_INPUT = InputStream::class;
    const DEFAULT_OUTPUT = OutputStream::class;
    const MESSAGE_ESCAPE_STRING = "\0";

    /**
     * DataStream constructor.
     *
     * @param $data
     * @param \Hawkbit\DataStream\JwtConfig|null $jwtConfig
     * @param \Hawkbit\DataStream\Compressor|null $compressor
     */
    public function __construct($data, JwtConfig $jwtConfig = null, Compressor $compressor = null);

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


}