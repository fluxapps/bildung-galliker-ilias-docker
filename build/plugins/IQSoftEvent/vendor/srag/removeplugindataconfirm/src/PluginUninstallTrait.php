<?php

namespace srag\RemovePluginDataConfirm\IQSoftEvent;

/**
 * Trait PluginUninstallTrait
 *
 * @package srag\RemovePluginDataConfirm\IQSoftEvent
 */
trait PluginUninstallTrait
{

    use BasePluginUninstallTrait;

    /**
     * @internal
     */
    protected final function afterUninstall()/* : void*/
    {

    }


    /**
     * @return bool
     *
     * @internal
     */
    protected final function beforeUninstall() : bool
    {
        return $this->pluginUninstall();
    }
}
