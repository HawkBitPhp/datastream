<?php


namespace Hawkbit\DataStream;


abstract class AbstractDataStream implements DataStream
{
/**
     * @var mixed
     */
    private $raw;

    /**
     * @var \Hawkbit\DataStream\Compressor|null
     */
    private $compressor;

    /**
     * @var mixed
     */
    private $data;
    /**
     * @var \Hawkbit\DataStream\JwtConfig|null
     */
    private $jwtConfig;

    /**
     * DataStream constructor.
     *
     * @param $data
     * @param \Hawkbit\DataStream\JwtConfig|null $jwtConfig
     * @param \Hawkbit\DataStream\Compressor|null $compressor
     */
    public function __construct($data, JwtConfig $jwtConfig = null,  Compressor $compressor = null)
    {
        $this->raw = $data;
        $this->compressor = $compressor ?? new DeflateCompressor();
        $this->jwtConfig = $jwtConfig ?? new JwtConfig();
        $this->data = $this->decorateData($data);
    }

    /**
     * Decorate input data to desired result
     *
     * @param $data
     *
     * @return mixed
     */
    protected function decorateData($data){
        return $data;
    }

    /**
     * @return mixed
     */
    public function getRaw()
    {
        return $this->raw;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return \Hawkbit\DataStream\Compressor|null
     */
    public function getCompressor()
    {
        return $this->compressor;
    }

    /**
     * @return \Hawkbit\DataStream\JwtConfig|null
     */
    public function getJwtConfig()
    {
        return $this->jwtConfig;
    }
}