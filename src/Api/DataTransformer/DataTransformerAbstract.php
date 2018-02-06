<?php

namespace SkyHub\Api\DataTransformer;

/**
 * BSeller Platform | B2W - Companhia Digital
 *
 * Do not edit this file if you want to update this module for future new versions.
 *
 * @category  SkuHub
 * @package   SkuHub
 *
 * @copyright Copyright (c) 2018 B2W Digital - BSeller Platform. (http://www.bseller.com.br).
 *
 * @author    Tiago Sampaio <tiago.sampaio@e-smart.com.br>
 */
abstract class DataTransformerAbstract implements DataTransformerInterface
{
    
    /** @var array */
    protected $outputData = [];
    
    
    /**
     * DataTransformerAbstract constructor.
     */
    public function __construct()
    {
        $this->prepareOutput();
    }
    
    
    /**
     * @return $this
     */
    protected function prepareOutput()
    {
        return $this;
    }
    
    
    /**
     * @param string|array $data
     *
     * @return $this
     */
    protected function setOutputData($data)
    {
        $this->outputData = $data;
        return $this;
    }
    
    
    /**
     * @return array|mixed
     */
    public function output()
    {
        return $this->outputData;
    }
}