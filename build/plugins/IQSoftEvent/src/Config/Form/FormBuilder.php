<?php

namespace fluxlabs\Plugins\IQSoftEvent\Config\Form;

use fluxlabs\Plugins\IQSoftEvent\Config\ConfigCtrl;
use fluxlabs\Plugins\IQSoftEvent\Utils\IQSoftEventTrait;
use ilIQSoftEventPlugin;
use srag\CustomInputGUIs\IQSoftEvent\FormBuilder\AbstractFormBuilder;
use ilTextInputGUI;
use ilPasswordInputGUI;

/**
 * Class FormBuilder
 *
 * @package fluxlabs\Plugins\IQSoftEvent\Config\Form
 *
 * @author fluxlabs AG <support@fluxlabs.ch>
 * @author studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
class FormBuilder extends AbstractFormBuilder
{

    use IQSoftEventTrait;

    const PLUGIN_CLASS_NAME = ilIQSoftEventPlugin::class;
    const KEY_BASE_URL = 'base_url';
    const KEY_CLIENT_ID = 'client_id';
    const KEY_CLIENT_SECRET = 'client_secret';
    const KEY_USERNAME = 'username';
    const KEY_PASSWORD = 'password';
    const KEY_TOKEN = 'token';

    /**
     * @inheritDoc
     *
     * @param ConfigCtrl $parent
     */
    public function __construct(ConfigCtrl $parent)
    {
        parent::__construct($parent);
    }


    /**
     * @inheritDoc
     */
    protected function getButtons() : array
    {
        $buttons = [
            ConfigCtrl::CMD_UPDATE_CONFIGURE => self::plugin()->translate("save", ConfigCtrl::LANG_MODULE)
        ];

        return $buttons;
    }


    /**
     * @inheritDoc
     */
    protected function getData() : array
    {
        $data = [
            self::KEY_BASE_URL => self::iQSoftEvent()->config()->getValue(self::KEY_BASE_URL)
        ];

        return $data;
    }


    /**
     * @inheritDoc
     */
    protected function getFields() : array
    {

    }


    /**
     * @inheritDoc
     */
    protected function getTitle() : string
    {
        return self::plugin()->translate("configuration", ConfigCtrl::LANG_MODULE);
    }


    /**
     * @inheritDoc
     */
    protected function storeData(array $data) /*: void*/
    {
        self::iQSoftEvent()->config()->setValue(self::KEY_BASE_URL, strval($data[self::KEY_BASE_URL]));
    }
}
