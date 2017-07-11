<?php


namespace Hawkbit\DataStream;


class JsonSerializer implements Serializer
{

    /**
     * serialize data
     *
     * @param $data
     *
     * @return string
     */
    public function serialize($data): string
    {
        return json_encode($data, JSON_BIGINT_AS_STRING | JSON_UNESCAPED_UNICODE);
    }

    /**
     * Unserialize data
     *
     * @param $data
     *
     * @return mixed
     */
    public function unserialize($data)
    {
        return json_decode($data, true, 512, JSON_BIGINT_AS_STRING | JSON_UNESCAPED_UNICODE);
}
}