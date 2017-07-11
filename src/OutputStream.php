<?php


namespace Hawkbit\DataStream;


class OutputStream extends AbstractDataStream
{

    /**
     * Get converted data
     *
     * @return mixed
     */
    public function getData()
    {
        // build message
        $message = implode(DataStream::MESSAGE_ESCAPE_STRING, [
                $this->getFingerprint(),
                $this->getExpirationTime(),
                $this->getSerializer()->serialize($this->getRaw())
            ]);

        // compress message
        $compressed = $this->getCompressor()->compress($message);

        // transform binary message into hexadecimal representation
        return base64_encode($compressed);
    }

    /**
     * Get MD5 Hash fingerprint
     *
     * @return string
     */
    public function getFingerprint(): string
    {
        return $this->getHasher()->hash($this->getSerializer()->serialize($this->getRaw()));
    }

    /**
     * Get expiration for data
     *
     * @return int
     */
    public function getExpirationTime(): int
    {
        return time() + 60;
    }
}