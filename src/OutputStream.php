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
        // build message
        $tokenId = base64_encode(random_bytes(32));
        $issuedAt = time();

        // gte $issuedAt
        $notBefore = $issuedAt;

        // Adding 60 seconds
        $expire = $notBefore + 120;

        // Retrieve the server name from config file
        $issuer = static::DEFAULT_ISSUER;

        /*
         * Create the token as an array
         */
        $payload = [
            'iat' => $issuedAt,
            // Issued at: time when the token was generated
            'jti' => $tokenId,
            // Json Token Id: an unique identifier for the token
            'iss' => $issuer,
            // Issuer
            'nbf' => $notBefore,
            // Not before
            'exp' => $expire,
            // Expire
            'data' => $data
        ];

        /*
         * Extract the key, which is coming from the config file.
         *
         * Best suggestion is the key to be a binary string and
         * store it in encoded in a config file.
         *
         * Can be generated with base64_encode(openssl_random_pseudo_bytes(64));
         *
         * keep it secure! You'll need the exact key to verify the
         * token later.
         */
        $secretKey = base64_encode(static::DEFAULT_SECRET);

        /*
         * Encode the array to a JWT string.
         * Second parameter is the key to encode the token.
         *
         * The output string can be validated at http://jwt.io/
         */
        $jwt = JWT::encode($payload, // Data to be encoded in the JWT
            $secretKey, // The signing key
            static::DEFAULT_ALG // Algorithm used to sign the token, see https://tools.ietf
        //.org/html/draft-ietf-jose-json-web-algorithms-40#section-3
        );

        var_dump($jwt);

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