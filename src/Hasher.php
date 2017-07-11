<?php


namespace Hawkbit\DataStream;


interface Hasher
{

    const DEFAULT_HASH = Adler32Hasher::class;

    /**
     * Calculate hash of given data
     *
     * @param $data
     *
     * @return string
     */
    public function hash($data): string;

}