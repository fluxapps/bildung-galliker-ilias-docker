<?php

namespace srag\DIC\IQSoftEvent\DIC;

use ILIAS\DI\Container;
use srag\DIC\IQSoftEvent\Database\DatabaseDetector;
use srag\DIC\IQSoftEvent\Database\DatabaseInterface;

/**
 * Class AbstractDIC
 *
 * @package srag\DIC\IQSoftEvent\DIC
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
abstract class AbstractDIC implements DICInterface
{

    /**
     * @var Container
     */
    protected $dic;


    /**
     * @inheritDoc
     */
    public function __construct(Container &$dic)
    {
        $this->dic = &$dic;
    }


    /**
     * @inheritDoc
     */
    public function database() : DatabaseInterface
    {
        return DatabaseDetector::getInstance($this->databaseCore());
    }
}
