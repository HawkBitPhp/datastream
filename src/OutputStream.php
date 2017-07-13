<?php


namespace Hawkbit\DataStream;


use Firebase\JWT\JWT;

class OutputStream extends AbstractDataStream
{

    /**
     * Convert data to jwt
     *
     * @param $data
     *
     * @return mixed
     */
    protected function decorateData($data)
    {
        // load config
        $config = $this->getJwtConfig();

        // Create the token as an array
        $payload = [
            'iat' => $config->getIssuedAt(),
            // Issued at: time when the token was generated
            'jti' => $config->getTokenId(),
            // Json Token Id: an unique identifier for the token
            'iss' => $config->getIssuer(),
            // Issuer
            'nbf' => $config->getNotBefore(),
            // Not before
            'exp' => $config->getExpireAt(),
            // Expire
            'data' => $data
        ];

        /*
         * Encode the array to a JWT string.
         * Second parameter is the key to encode the token.
         *
         * The output string can be validated at http://jwt.io/
         */
        $jwt = JWT::encode($payload,
            $config->getSecret(),
            $config->getAlg()
        );

        // compress jwt
        $compressed = $this->getCompressor()->compress($jwt);

        // transform binary message into hexadecimal representation
        return base64_encode($compressed);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getData();
    }
}