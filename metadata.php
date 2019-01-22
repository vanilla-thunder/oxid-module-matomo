<?php
/**
 * [bla] matomo
 * Copyright (C) 2018  bestlife AG
 * info:  oxid@bestlife.ag
 *
 * This program is free software;
 * you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation;
 * either version 3 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
 * without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License along with this program; if not, see <http://www.gnu.org/licenses/>
 *
 * @author      bestlife AG <oxid@bestlife.ag>
 * @author      Klaus Weidenbach
 * @author      Rafael Dabrowski
 * @author      Marat Bedoev
 * @link        http://www.bestlife.ag
 *
 * @license     GPLv3
 *
 * changelog:
 *
 * --- 2018-12-12 :: version 2.5
 * + updated to OXID eShop version 6.x
 *
 * --- 2018-11-30 :: versiob 2.4
 * + kleines refactoring
 * + fehlende Lang Dateien hinzugefügt
 * + halbwegs brauchbare Dokumentation
 * + Image Tracker Generator
 * + Piwik PHP SDK
 *
 * --- 2018-02-16 :: version 2.3
 * + piwik in matomo umbenannt
 * + kurzes timeout für standorterkennung, damit es keine Probleme gibt, wenn matomo server unerreichbar ist.
 *
 * --- 2016-10-23 :: version 2.2.3
 * + Standorterkennung über IP
 *
 * --- 2016-09-07 :: version 2.2.2
 * + fehlendes pushPageView ergänzt
 * + newsletter goal: fehlende ] hinzugefügt
 *
 */
$sMetadataVersion = '2.0';

$oLang = \OxidEsales\Eshop\Core\Registry::getLang();

$aModule = [
    'id'          => 'matomo',
    'title'       => '<strong style="color:#95b900;font-size:125%;">best</strong><strong style="color:#c4ca77;font-size:125%;">life</strong> <strong>Matomo Tracking (ehemals Piwik)</strong>',
    'description' => [
        'en' => 'Add Matomo (formerly Piwik) tracking codes to your online shop.<br/>You need a <a href="http://www.matomo.org" target="_blank">matomo</a> installation to use this module.',
        'de' => 'Fügt Matomo (ehemals Piwik) Tracking Codes in Ihren online Shops ein.<br/>Sie benötigen eine <a href="http://www.matomo.org" target="_blank">matomo</a> Installation, um dieses Modul zu nutzen.'
    ],
    'thumbnail'   => '../bestlife.png',
    'version'     => '2.5.0 (2018-12-12)',
    'author'      => 'Klaus Weidenbach, Rafael Dabrowski, Marat Bedoev, bestlife AG',
    'email'       => 'oxid@bestlife.ag',
    'url'         => 'https://github.com/vanilla-thunder/oxid-module-matomo',
    'extend'      => [
        \OxidEsales\Eshop\Core\ViewConfig::class => Bla\Matomo\Application\Core\ViewConfig::class,
        \OxidEsales\Eshop\Core\UtilsView::class => Bla\Matomo\Application\Core\UtilsView::class
    ],
    'controllers' => [
        'matomo'  => Bla\Matomo\Application\Files\Matomo::class
    ],
    'events'       => [
        'onActivate'   => 'Bla\Matomo\Application\Core\Events::onActivate',
        'onDeactivate' => 'Bla\Matomo\Application\Core\Events::onDeactivate',
    ],
    'blocks'      => [
        ['template' => 'layout/base.tpl', 'block' => 'base_js', 'file' => '/application/views/blocks/base_js.tpl'],
        ['template' => 'layout/base.tpl', 'block' => 'head_meta_robots', 'file' => '/application/views/blocks/head_meta_robots.tpl'],
        ['template' => 'email/html/header.tpl', 'block' => 'email_html_header_tracking', 'file' => '/application/views/blocks/email_html_header_tracking.tpl'],
    ],
    'settings'    => [
        ['group' => 'blaMatomo_Main', 'name' => 'blaMatomo_sUrl', 'type' => 'str', 'value' => ''],
        ['group' => 'blaMatomo_Main', 'name' => 'blaMatomo_sToken', 'type' => 'str', 'value' => ''],
        ['group' => 'blaMatomo_Main', 'name' => 'blaMatomo_iSiteID', 'type' => 'str', 'value' => ''],
		//['group' => 'blaMatomo_Main', 'name' => 'blaMatomo_blUseUserID', 'type' => 'bool', 'value' => true],
		['group' => 'blaMatomo_Main', 'name' => 'blaMatomo_blEnableJSErrorTrackin', 'type' => 'bool', 'value' => true],
		['group' => 'blaMatomo_Main', 'name' => 'blaMatomo_blFirstReferrerConv', 'type' => 'bool', 'value' => false],
		// Benutzerdefinierte Dimensionen
		['group' => 'blaMatomo_CustomDimensions', 'name' => 'blaMatomo_iLanguageDimension', 'type' => 'str', 'value' => '1'],
		['group' => 'blaMatomo_CustomDimensions', 'name' => 'blaMatomo_iPaymentDimension', 'type' => 'str', 'value' => '2'],
		['group' => 'blaMatomo_CustomDimensions', 'name' => 'blaMatomo_iDeliveryMetodDimension', 'type' => 'str', 'value' => '3'],
		['group' => 'blaMatomo_CustomDimensions', 'name' => 'blaMatomo_iDeliveryAddressDimension', 'type' => 'str', 'value' => '4'],
		//['group' => 'blaMatomo_CustomDimensions', 'name' => 'blaMatomo_iMediacodeDimension', 'type' => 'str', 'value' => '5'],

		['group' => 'blaMatomo_Goals', 'name' => 'blaMatomo_iNewsletterOptinGoal', 'type' => 'str', 'value' => '1'],
		['group' => 'blaMatomo_Goals', 'name' => 'blaMatomo_iNewsletterSubscribedGoal', 'type' => 'str', 'value' => '2'],
		['group' => 'blaMatomo_Goals', 'name' => 'blaMatomo_iNewsletterUnsubscribedGoal', 'type' => 'str', 'value' => '3'],

		/*
        ['group' => 'blaMatomo_CustomVars', 'name' => 'blaMatomo_iMaxCustVar', 'type' => 'str', 'value' => '5'],
        ['group' => 'blaMatomo_CustomVars', 'name' => 'blaMatomo_iCustindexNewsletter', 'type' => 'str', 'value' => '0'],
        ['group' => 'blaMatomo_CustomVars', 'name' => 'blaMatomo_iCustindexPayment', 'type' => 'str', 'value' => '0'],
		*/

/*
        ['group' => 'blaMatomo_CustomVars', 'name' => 'blaMatomo_sCustomvarNewsletter', 'type' => 'str', 'value' => $oLang->translateString('SHOP_MODULE_blaMatomo_CUSTOM_NEWSLETTER')],
        ['group' => 'blaMatomo_CustomVars', 'name' => 'blaMatomo_sCustomvarPayment', 'type' => 'str', 'value' => $oLang->translateString('SHOP_MODULE_blaMatomo_CUSTOM_PAYMENT')],
        ['group' => 'blaMatomo_CustomVars', 'name' => 'blaMatomo_sNewsletterAccount', 'type' => 'str', 'value' => $oLang->translateString('SHOP_MODULE_blaMatomo_NEWSLETTER_ACCOUNT')],
        ['group' => 'blaMatomo_CustomVars', 'name' => 'blaMatomo_sNewsletterAccountOn', 'type' => 'str', 'value' => $oLang->translateString('SHOP_MODULE_blaMatomo_NEWSLETTER_ACCOUNT_ON')],
        ['group' => 'blaMatomo_CustomVars', 'name' => 'blaMatomo_sNewsletterAccountOff', 'type' => 'str', 'value' => $oLang->translateString('SHOP_MODULE_blaMatomo_NEWSLETTER_ACCOUNT_OFF')],
        ['group' => 'blaMatomo_CustomVars', 'name' => 'blaMatomo_sNewsletterViewed', 'type' => 'str', 'value' => $oLang->translateString('SHOP_MODULE_blaMatomo_NEWSLETTER_VIEWED')],
        ['group' => 'blaMatomo_CustomVars', 'name' => 'blaMatomo_sNewsletterOrdered', 'type' => 'str', 'value' => $oLang->translateString('SHOP_MODULE_blaMatomo_NEWSLETTER_ORDERED')],
        ['group' => 'blaMatomo_CustomVars', 'name' => 'blaMatomo_sNewsletterActivated', 'type' => 'str', 'value' => $oLang->translateString('SHOP_MODULE_blaMatomo_NEWSLETTER_ACTIVATED')],
        ['group' => 'blaMatomo_CustomVars', 'name' => 'blaMatomo_sNewsletterCanceled', 'type' => 'str', 'value' => $oLang->translateString('SHOP_MODULE_blaMatomo_NEWSLETTER_CANCELED')],
        ['group' => 'blaMatomo_Params', 'name' => 'blaMatomo_aParamMapVisit', 'type' => 'aarr', 'value' => null],
        ['group' => 'blaMatomo_Params', 'name' => 'blaMatomo_aParamMapPage', 'type' => 'aarr', 'value' => null],
*/
        /* content tracking */
/*
        ['group' => 'blaMatomo_contentTracking', 'name' => 'blaMatomo_ct_enable', 'type' => 'bool', 'value' => false],

        ['group' => 'blaMatomo_contentTracking', 'name' => 'blaMatomo_ct_flexprev', 'type' => 'str', 'value' => '.flex-prev'],
        ['group' => 'blaMatomo_contentTracking', 'name' => 'blaMatomo_ct_flexnext', 'type' => 'str', 'value' => '.flex-next'],

        ['group' => 'blaMatomo_contentTracking', 'name' => 'blaMatomo_ct_zoom1', 'type' => 'str', 'value' => '#zoom1'],
        ['group' => 'blaMatomo_contentTracking', 'name' => 'blaMatomo_ct_pic1', 'type' => 'str', 'value' => '#morePics_1'],
        ['group' => 'blaMatomo_contentTracking', 'name' => 'blaMatomo_ct_pic2', 'type' => 'str', 'value' => '#morePics_2'],
        ['group' => 'blaMatomo_contentTracking', 'name' => 'blaMatomo_ct_pic3', 'type' => 'str', 'value' => '#morePics_3'],
        ['group' => 'blaMatomo_contentTracking', 'name' => 'blaMatomo_ct_pic4', 'type' => 'str', 'value' => '#morePics_4'],
        ['group' => 'blaMatomo_contentTracking', 'name' => 'blaMatomo_ct_description', 'type' => 'str', 'value' => 'a[href="#description"]'],
        ['group' => 'blaMatomo_contentTracking', 'name' => 'blaMatomo_ct_pricealarm', 'type' => 'str', 'value' => 'a[href="#pricealarm"]'],
        ['group' => 'blaMatomo_contentTracking', 'name' => 'blaMatomo_ct_tags', 'type' => 'str', 'value' => 'a[href="#tags"]'],
        ['group' => 'blaMatomo_contentTracking', 'name' => 'blaMatomo_ct_productFbComments', 'type' => 'str', 'value' => 'a[href="#productFbComments"]'],
*/
    ]
];