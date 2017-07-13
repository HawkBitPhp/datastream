<?php


namespace Hawkbit\DataStream;


final class JwtConfig
{

    const DEFAULT_SECRET = 'datastream';
    const DEFAULT_ISSUER = 'datastream';
    const DEFAULT_ALG = 'HS512';
    const DEFAULT_NOT_BEFORE = 0;
    const DEFAULT_EXPIRE_AT = 60;

    /**
     * @var string
     */
    private $issuer = self::DEFAULT_ISSUER;

    /**
     * @var string
     */
    private $secret = self::DEFAULT_SECRET;

    /**
     * @var string
     */
    private $alg = self::DEFAULT_ALG;
    /**
     * @var int
     */
    private $notBefore = self::DEFAULT_NOT_BEFORE;
    /**
     * @var int
     */
    private $expireAt = self::DEFAULT_EXPIRE_AT;

    /**
     * @return string
     */
    public function getIssuer(): string
    {
        return $this->issuer;
    }

    /**
     * @param string $issuer
     *
     * @return JwtConfig
     */
    public function setIssuer(string $issuer): JwtConfig
    {
        $this->issuer = $issuer;
        return $this;
    }

    /**
     * Extract the key, which is coming from the config file.
     *
     * Best suggestion is the key to be a binary string and
     * store it in encoded in a config file.
     *
     * Can be generated with base64_encode(openssl_random_pseudo_bytes(64));
     *
     * keep it secure! You'll need the exact key to verify the
     * token later.
     *
     * @return string
     */
    public function getSecret(): string
    {
        return base64_encode($this->secret);
    }

    /**
     * @param string $secret
     *
     * @return JwtConfig
     */
    public function setSecret(string $secret): JwtConfig
    {
        $this->secret = $secret;
        return $this;
    }

    /**
     * Algorithm used to sign the token
     *
     * @see https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40#section-3
     *
     * @return string
     */
    public function getAlg(): string
    {
        return $this->alg;
    }

    /**
     * @param string $alg
     *
     * @return JwtConfig
     */
    public function setAlg(string $alg): JwtConfig
    {
        $this->alg = $alg;
        return $this;
    }

    /**
     * @return int
     */
    public function getNotBefore(): int
    {
        return $this->getIssuedAt() + $this->notBefore;
    }

    /**
     * @param int $notBefore
     *
     * @return JwtConfig
     */
    public function setNotBefore(int $notBefore): JwtConfig
    {
        $this->notBefore = $notBefore;
        return $this;
    }

    /**
     * @return int
     */
    public function getExpireAt(): int
    {
        return $this->getIssuedAt() + $this->expireAt;
    }

    /**
     * @param int $expireAt
     *
     * @return JwtConfig
     */
    public function setExpireAt(int $expireAt): JwtConfig
    {
        $this->expireAt = $expireAt;
        return $this;
    }

    /**
     * @return int
     */
    public function getIssuedAt(): int
    {
        return time();
    }

    /**
     * @return string
     */
    public function getTokenId(): string
    {
        return base64_encode(random_bytes(32));
    }

}