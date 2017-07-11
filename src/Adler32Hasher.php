<?php


namespace Hawkbit\DataStream;


class Adler32Hasher implements Hasher
{

    /**
     * Calculate hash of given data
     *
     * @param $data
     *
     * @return string
     */
    public function hash($data): string
    {
        return hash('adler32', $data);
    }
}