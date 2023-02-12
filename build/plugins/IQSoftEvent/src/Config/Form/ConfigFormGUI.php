<?php

namespace fluxlabs\Plugins\IQSoftEvent\Config\Form;

use srag\CustomInputGUIs\IQSoftEvent\PropertyFormGUI\ConfigPropertyFormGUI;
use fluxlabs\Plugins\IQSoftEvent\Config\Repository;
use ilIQSoftEventConfigGUI;
use ilTextInputGUI;
use ilIQSoftEventPlugin;

/**
 * @author Theodor Truffer <tt@studer-raimann.ch>
 */
class ConfigFormGUI extends ConfigPropertyFormGUI
{

    const CONFIG_CLASS_NAME = Repository::class;
    const PLUGIN_CLASS_NAME = ilIQSoftEventPlugin::class;
    /**
     * @var Repository
     */
    private $repository;
    /**
     * @var ilIQSoftEventConfigGUI
     */
    protected $parent;


    public function __construct(ilIQSoftEventConfigGUI $parent, Repository $repository)
    {
        $this->repository = $repository;
        parent::__construct($parent);
    }

    protected function initCommands()
    {
        $this->addCommandButton('save', $this->parent->txt('save'));
    }

    protected function initFields()
    {
        $this->fields = [
            FormBuilder::KEY_BASE_URL => [
                parent::PROPERTY_CLASS => ilTextInputGUI::class,
                parent::PROPERTY_REQUIRED => true,
            ],
            FormBuilder::KEY_CLIENT_ID => [
                parent::PROPERTY_CLASS => ilTextInputGUI::class,
                parent::PROPERTY_REQUIRED => true,
            ],
            FormBuilder::KEY_CLIENT_SECRET => [
                parent::PROPERTY_CLASS => ilTextInputGUI::class,
                parent::PROPERTY_REQUIRED => true,
            ],
            FormBuilder::KEY_USERNAME => [
                parent::PROPERTY_CLASS => ilTextInputGUI::class,
                parent::PROPERTY_REQUIRED => true,
            ],
            FormBuilder::KEY_PASSWORD => [
                parent::PROPERTY_CLASS => ilTextInputGUI::class,
                parent::PROPERTY_REQUIRED => true,
            ],
        ];
    }

    protected function initId()
    {
        $this->setId('iqsoft_config');
    }

    protected function initTitle()
    {
        $this->setTitle($this->parent->txt('frm_title'));
    }

    protected function getValue($key)
    {
        return $this->repository->getValue($key);
    }

    protected function storeValue($key, $value)
    {
        $this->repository->setValue($key, $value);
    }

}
