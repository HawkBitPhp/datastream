<?php


namespace Hawkbit\DataStream;


interface Compressor
{

    const DEFAULT_COMPRESSION = DeflateCompressor::class;

    /**
     * Compress data with a specific algorithm
     *
     * @param $data
     *
     * @return string
     */
    public function compress($data): string;

    /**
     * Uncompress data with a specific algorithm
     *
     * @param $data
     *
     * @return string
     */
    public function uncompress($data): string;

}