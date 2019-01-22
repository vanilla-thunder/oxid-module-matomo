<?php
/**
 * Created by PhpStorm.
 * User: ggenute
 * Date: 21/01/2019
 * Time: 10:43
 */

namespace Bla\Matomo\Application\Core;

use OxidEsales\Eshop\Core\Registry;

class Events
{
    /**
     * Creates needed field.
     */


    public static function onActivate()
    {
        self::clearCache();
    }
    /**
     * Removes field on deactivation.
     */
    public static function onDeactivate()
    {
        self::clearCache();
    }

    /**
     * Empty cache
     */
    private static function clearCache()
    {
        /** @var \OxidEsales\Eshop\Core\UtilsView $oUtilsView */
        $oUtilsView = Registry::get('oxUtilsView');
        $sSmartyDir = $oUtilsView->getSmartyDir();

        if ($sSmartyDir && is_readable($sSmartyDir)) {
            foreach (glob($sSmartyDir . '*') as $sFile) {
                if (!is_dir($sFile)) {
                    @unlink($sFile);
                }
            }
        }

        // Initialise Smarty
        $oUtilsView->getSmarty(true);
    }
}