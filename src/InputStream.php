<?php


namespace Hawkbit\DataStream;


use Firebase\JWT\JWT;

class InputStream extends AbstractDataStream implements DataStream
{

    /**
     * Load data from compressed jwt
     *
     * @param $data
     *
     * @return mixed
     */
    protected function decorateData($data)
    {

        // compressed jwt
        $compressed = base64_decode($data);

        // get inflated jwt
        $jwt = $this->getCompressor()->uncompress($compressed);

        // decode data
        $payload = JWT::decode($jwt, base64_encode(static::DEFAULT_SECRET), [static::DEFAULT_ALG]);

        // return payload data
        // workaround to get always assoc arrays instead of objects
        return json_decode(json_encode($payload->data), true);
    }
}