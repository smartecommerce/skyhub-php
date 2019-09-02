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
 * @author    Bruno Gemelli <bruno.gemelli@e-smart.com.br>
 */

namespace SkyHub\Api\Handler\Request\Shipment;

use SkyHub\Api\EntityInterface\Shipment\Plp;
use SkyHub\Api\Handler\Request\HandlerAbstract;
use SkyHub\Api\DataTransformer\Shipment\Plp\Group as GroupTransformer;

/**
 * Class PlpHandler
 *
 * @package SkyHub\Api\Handler\Request\Shipment
 */
class PlpHandler extends HandlerAbstract
{
    /**
     * @var int
     */
    const OFFSET_LIMIT = 25;
    
    /**
     * @var string
     */
    const TYPE_PLP_PDF = 'pdf';

    /**
     * @var string
     */
    const TYPE_PLP_JSON = 'json';

    /**
     * @var string
     */
    protected $baseUrlPath = '/shipments/b2w';

    /**
     * Retrieves a list of all PLP's in SkyHub.
     *
     * @return \SkyHub\Api\Handler\Response\HandlerInterface
     */
    public function plps()
    {
        /** @var \SkyHub\Api\Handler\Response\HandlerInterface $responseHandler */
        $responseHandler = $this->service()->get($this->baseUrlPath());

        return $responseHandler;
    }

    /**
     * Retrieves a list of all orders ready to be grouped in a PLP.
     *
     * @param int $offset
     *
     * @return \SkyHub\Api\Handler\Response\HandlerInterface
     */
    public function ordersReadyToGroup(int $offset = 1)
    {
        $query = [
            'offset' => min(max($offset, 1), self::OFFSET_LIMIT)
        ];

        /** @var \SkyHub\Api\Handler\Response\HandlerInterface $responseHandler */
        $responseHandler = $this->service()->get($this->baseUrlPath('/to_group', $query));

        return $responseHandler;
    }

    /**
     * Group multiple orders in a PLP.
     *
     * @param array $orders
     *
     * @return \SkyHub\Api\Handler\Response\HandlerInterface
     */
    public function group(array $orders)
    {
        $transformer = new GroupTransformer($orders);

        $body = $transformer->output();

        /** @var \SkyHub\Api\Handler\Response\HandlerInterface $responseHandler */
        $responseHandler = $this->service()->post($this->baseUrlPath(), $body);

        return $responseHandler;
    }

    /**
     * Get PLP file
     *
     * @param string $id
     *
     * @param string $type default json
     * @return \SkyHub\Api\Handler\Response\HandlerInterface
     */
    public function viewFile($id, string $type = self::TYPE_PLP_JSON)
    {
        $query = [
            'plp_id' => $id
        ];
        
        if ($type === self::TYPE_PLP_PDF) {
            $this->service()->setHeaders(['Accept' => 'application/pdf']);
        } else if ($type === self::TYPE_PLP_JSON) {
            $this->service()->setHeaders(['Accept' => 'application/json']);
        }

        /** @var \SkyHub\Api\Handler\Response\HandlerInterface $responseHandler */
        $responseHandler = $this->service()->get($this->baseUrlPath('/view', $query));

        return $responseHandler;
    }

    /**
     * Ungroup a PLP.
     *
     * @param string $id
     *
     * @return \SkyHub\Api\Handler\Response\HandlerInterface
     */
    public function ungroup($id)
    {
        $params = [
            'plp_id' => $id,
        ];

        /** @var \SkyHub\Api\Handler\Response\HandlerInterface $responseHandler */
        $responseHandler = $this->service()->delete($this->baseUrlPath(), $params);

        return $responseHandler;
    }

    /**
     * @return Plp
     */
    public function entityInterface()
    {
        return new Plp($this);
    }
}
