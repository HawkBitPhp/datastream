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

        // load jwt config
        $config = $this->getJwtConfig();

        // compressed jwt
        $compressed = base64_decode($data);

        // get inflated jwt
        $jwt = $this->getCompressor()->uncompress($compressed);
        $secret = $config->getSecret();
        $alg = $config->getAlg();

        // decode data
        $payload = JWT::decode($jwt, $secret, [$alg]);

        // return payload data
        // workaround to get always assoc arrays instead of objects
        return json_decode(json_encode($payload->data), true);
    }
}