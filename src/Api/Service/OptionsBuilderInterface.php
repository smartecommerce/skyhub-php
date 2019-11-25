<?php

namespace SkyHub\Api\Service;

/**
 * Class OptionsBuilderInterface
 *
 * @package SkyHub\Api\Service
 */
interface OptionsBuilderInterface
{
    /**
     * @param int $timeout
     *
     * @return $this
     */
    public function setTimeout($timeout);

    /**
     * @param bool $flag
     *
     * @return $this
     */
    public function setDebug($flag);

    /**
     * @param mixed $body
     *
     * @return $this
     */
    public function setBody($body);

    /**
     * @param bool $body
     *
     * @return $this
     */
    public function setStream($flag);

    /**
     * @return HeadersBuilderInterface
     */
    public function getHeadersBuilder();

    /**
     * @return array
     */
    public function build();
}