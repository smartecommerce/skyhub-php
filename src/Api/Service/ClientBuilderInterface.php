<?php

namespace SkyHub\Api\Service;

/**
 * Class ClientBuilderInterface
 *
 * @package SkyHub\Api\Service
 */
interface ClientBuilderInterface
{
    /**
     * @param string $baseUri
     * @param array  $defaults
     *
     * @return \GuzzleHttp\Client
     */
    public function build($baseUri = null, array $defaults = []);
}
