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
 * @copyright Copyright (c) 2021 B2W Digital - BSeller Platform. (http://www.bseller.com.br).
 *
 */

namespace SkyHub\Api\DataTransformer\Catalog\Product\Price;

use SkyHub\Api\DataTransformer\Builders;
use SkyHub\Api\DataTransformer\DataTransformerAbstract;

class Update extends DataTransformerAbstract
{
    use Builders;

    /**
     * Update constructor.
     *
     * @param float $price
     * @param float|null $promotionalPrice
     * @param array $platformPrices
     */
    public function __construct($price, $promotionalPrice = null, $platformPrices = [])
    {
        $product = [
            'price' => (float) $price
        ];

        if ($promotionalPrice) {
            $product['promotional_price'] = (float) $promotionalPrice;
        }

        if ($platformPrices) {
            foreach ($platformPrices as $specificationCode => $specificationValue) {
                $product['specifications'][] = [
                    'key' => $specificationCode,
                    'value' => $specificationValue
                ];
            }
        }

        $this->setOutputData([
            'product' => $product
        ]);

        parent::__construct();
    }
}
