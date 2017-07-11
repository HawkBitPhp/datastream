<?php


namespace Hawkbit\DataStream;


class InputStream extends AbstractDataStream implements DataStream
{

    /**
     * @var string
     */
    private $fingerPrint;

    /**
     * @var int
     */
    private $expirationTime;

    /**
     * @var mixed
     */
    private $data;

    /**
     * DataStream constructor.
     *
     * @param $data
     * @param \Hawkbit\DataStream\Serializer|null $serializer
     * @param \Hawkbit\DataStream\Hasher|null $hasher
     * @param \Hawkbit\DataStream\Compressor|null $compressor
     */
    public function __construct($data, Serializer $serializer = null, Hasher $hasher = null, Compressor $compressor = null)
    {
        parent::__construct($data, $serializer, $hasher, $compressor);
        $this->data = $this->parse();
    }


    /**
     * Get converted data
     *
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Get MD5 Hash fingerprint
     *
     * @return string
     */
    public function getFingerprint(): string
    {
        return $this->fingerPrint;
    }

    /**
     * Get expiration for data
     *
     * @return int
     */
    public function getExpirationTime(): int
    {
        return $this->expirationTime;
    }

    private function parse()
    {

        // hex data
        $stream = base64_decode($this->getRaw());

        // get binary representation
        $bin = @$this->getCompressor()->uncompress($stream);

        $data = explode(DataStream::MESSAGE_ESCAPE_STRING, $bin, 3);

        $this->fingerPrint = $data[0];
        $this->expirationTime = (int)$data[1];
        $payload = $data[2];

        if ($this->getHasher()->hash($payload) !== $this->getFingerprint())
        {
            throw new \RuntimeException('Data are not equal!');
        }

        if (time() > $this->getExpirationTime())
        {
            throw new \RuntimeException('Data transfer expired!');
        }

        // transform to json
        return $this->getSerializer()->unserialize($payload);
    }
}