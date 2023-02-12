<?php

namespace srag\ActiveRecordConfig\IQSoftEvent\Config;

use srag\DIC\IQSoftEvent\DICTrait;

/**
 * Class AbstractFactory
 *
 * @package srag\ActiveRecordConfig\IQSoftEvent\Config
 */
abstract class AbstractFactory
{

    use DICTrait;

    /**
     * AbstractFactory constructor
     */
    protected function __construct()
    {

    }


    /**
     * @return Config
     */
    public function newInstance() : Config
    {
        $config = new Config();

        return $config;
    }
}
