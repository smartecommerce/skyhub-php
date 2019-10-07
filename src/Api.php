<?php
/**
 * B2W Digital - Companhia Digital
 *
 * Do not edit this file if you want to update this SDK for future new versions.
 * For support please contact the e-mail bellow:
 *
 * sdk@e-smart.com.br
 *
 * @category  SkyHub
 * @package   SkyHub
 *
 * @copyright Copyright (c) 2018 B2W Digital - BSeller Platform. (http://www.bseller.com.br).
 *
 * @author    Tiago Sampaio <tiago.sampaio@e-smart.com.br>
 * @author    Bruno Gemelli <bruno.gemelli@e-smart.com.br>
 */

namespace SkyHub;

use SkyHub\Api\Handler\Request\Getters as RequestHandlerGetters;
use SkyHub\Api\EntityInterface\Getters as EntityInterfaceGetters;
use SkyHub\Api\Service\ServiceAbstract;
use SkyHub\Api\Service\ServiceInterface;
use SkyHub\Api\Service\ServiceJson;

class Api implements ApiInterface
{
    use RequestHandlerGetters, EntityInterfaceGetters;

    /**
     * @var string
     */
    const HEADER_USER_EMAIL = 'X-User-Email';

    /**
     * @var string
     */
    const HEADER_API_KEY = 'X-Api-Key';

    /**
     * @var string
     */
    const HEADER_ACCOUNT_MANAGER_KEY = 'X-Accountmanager-Key';

    /**
     * @var ServiceAbstract
     */
    private $service = null;

    /**
     * @inheritdoc
     */
    public function __construct(
        string $email,
        string $apiKey,
        string $xAccountKey = null,
        string $baseUri = null,
        ServiceInterface $apiService = null
    ) {
        /**
         * If you need support in the future from SkyHub please don't change this code.
         */
        if (empty($xAccountKey)) {
            $xAccountKey = '0I5dT7IC1h';
        }

        $headers = [
            self::HEADER_USER_EMAIL          => $email,
            self::HEADER_API_KEY             => $apiKey,
            self::HEADER_ACCOUNT_MANAGER_KEY => $xAccountKey,
        ];

        $this->initService($baseUri, $apiService);
        $this->initHeaders($headers);
    }

    /**
     * Reset the authorization information and use the same instance of the API object to use different accounts.
     *
     * @param string $email
     * @param string $apiKey
     *
     * @return $this
     */
    public function setAuthentication($email, $apiKey)
    {
        $headers = [
            self::HEADER_USER_EMAIL => $email,
            self::HEADER_API_KEY    => $apiKey,
        ];

        $this->initHeaders($headers);

        return $this;
    }

    /**
     * Gets a single connection instance.
     *
     * @return ServiceAbstract
     */
    public function service()
    {
        return $this->service;
    }

    /**
     * @param array $headers
     *
     * @return $this
     */
    private function initHeaders(array $headers = [])
    {
        $this->service()->getOptionsBuilder()
            ->getHeadersBuilder()
            ->addHeaders($headers);

        return $this;
    }

    /**
     * @param null                  $baseUri
     * @param ServiceInterface|null $apiService
     *
     * @return $this
     */
    private function initService($baseUri = null, ServiceInterface $apiService = null)
    {
        if (empty($apiService)) {
            $apiService = new ServiceJson($baseUri);
        }

        $this->service = $apiService;

        return $this;
    }
}
