<?php

namespace srag\CustomInputGUIs\IQSoftEvent\InputGUIWrapperUIInputComponent;

use ilFormPropertyGUI;
use ILIAS\Data\Factory as DataFactory;
use ilLanguage;

/**
 * Trait InputGUIWrapperConstraintTrait
 *
 * @package srag\CustomInputGUIs\IQSoftEvent\InputGUIWrapperUIInputComponent
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
trait InputGUIWrapperConstraintTrait
{

    /**
     * InputGUIWrapperConstraintTrait constructor
     *
     * @param ilFormPropertyGUI $input
     * @param DataFactory       $data_factory
     * @param ilLanguage        $lng
     */
    public function __construct(ilFormPropertyGUI $input, DataFactory $data_factory, ilLanguage $lng)
    {
        parent::__construct(function ($value) use ($input): bool {
            return $input->checkInput();
        },
            function (callable $txt, $value) use ($input): string {
                return $input->getAlert();
            },
            $data_factory,
            $lng
        );
    }
}
