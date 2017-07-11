<?php


namespace Hawkbit\DataStream;


class DeflateCompressor implements Compressor
{

    const DEFAULT_LEVEL = 9;
    /**
     * @var int
     */
    private $level;

    /**
     * DeflateCompressor constructor.
     *
     * @param int $level
     */
    public function __construct(int $level = self::DEFAULT_LEVEL)
    {
        $this->level = $level;
    }

    /**
     * Compress data with a specific algorithm
     *
     * @param $data
     *
     * @return string
     */
    public function compress($data): string
    {
        return gzdeflate($data, static::DEFAULT_LEVEL);
    }

    /**
     * Uncompress data with a specific algorithm
     *
     * @param $data
     *
     * @return string
     */
    public function uncompress($data): string
    {
        return gzinflate($data);
    }
}