<?php


namespace Hawkbit\DataStream;


interface Serializer
{

    const DEFAULT_SERIALIZER = JsonSerializer::class;

    /**
     * serialize data
     * @param $data
     *
     * @return string
     */
    public function serialize($data): string;


    /**
     * Unserialize data
     *
     * @param $data
     *
     * @return mixed
     */
    public function unserialize($data);

}