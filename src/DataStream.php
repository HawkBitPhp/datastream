<?php


namespace Hawkbit\DataStream;


interface DataStream
{

    const DEFAULT_INPUT = InputStream::class;
    const DEFAULT_OUTPUT = OutputStream::class;
    const MESSAGE_ESCAPE_STRING = "\0";
    const DEFAULT_SECRET = 'datastream';
    const DEFAULT_ISSUER = 'datastream';
    const DEFAULT_ALG = 'HS512';

    /**
     * DataStream constructor.
     *
     * @param $data
     * @param \Hawkbit\DataStream\Compressor|null $compressor
     */
    public function __construct($data, Compressor $compressor = null);

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