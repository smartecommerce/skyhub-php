<?php

namespace SkyHub\Api\Service;

use SkyHub\Api\Helpers;

/**
 * Class OptionsBuilder
 *
 * @package SkyHub\Api\Service
 */
class OptionsBuilder implements OptionsBuilderInterface
{
    /**
     * @var HeadersBuilderInterface
     */
    private $headersBuilder;

    /**
     * @var array
     */
    private $options = [];

    public function __construct()
    {
        $this->headersBuilder = new HeadersBuilder();
    }

    /**
     * @inheritDoc
     */
    public function getHeadersBuilder()
    {
        return $this->headersBuilder;
    }

    /**
     * @inheritDoc
     */
    public function setTimeout($timeout)
    {
        $this->options['timeout'] = (int) $timeout;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setDebug($flag)
    {
        $this->options['debug'] = (bool) $flag;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setBody($body)
    {
        $this->options['body'] = $body;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setStream($flag)
    {
        $this->options['stream'] = (bool) $flag;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function build()
    {
        $this->options['headers'] = $this->getHeadersBuilder()->build();
        return $this->options;
    }
}