<?php
/**
 * Matomo (Piwik) Analytics for OXID eShop
 * Copyright (C) 2018  bestlife AG
 * info:  oxid@bestlife.ag
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
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
$sMetadataVersion = '1.1';

$oLang = oxRegistry::getLang();

$aModule = array(
    'id'          => 'matomo',
    'title'       => '<strong style="color:#95b900;font-size:125%;">best</strong><strong style="color:#c4ca77;font-size:125%;">life</strong> <strong>Matomo Analytics (ehemals Piwik)</strong>',
    'description' => array(
        'en' => 'Add Matomo (formerly Piwik) tracking codes to your online shop.<br/>You need a <a href="http://www.matomo.org" target="_blank">matomo</a> installation to use this module.',
        'de' => 'Fügt Matomo (ehemals Piwik) Tracking Codes in Ihren online Shops ein.<br/>Sie benötigen eine <a href="http://www.matomo.org" target="_blank">matomo</a> Installation, um dieses Modul zu nutzen.'
    ),
    'thumbnail'   => '../bestlife.png',
    'version'     => '2.3.0 2018-2-16',
    'author'      => ' bestlife AG',
    'email'       => 'oxid@bestlife.ag',
    'url'         => 'https://github.com/vanilla-thunder/oxid-module-bla-matomo',
    'extend'      => array(
        'oxviewconfig' => 'bla/matomo/application/extend/oxviewconfig_matomo'
    ),
    'blocks'      => array(
        array('template' => 'layout/base.tpl', 'block' => 'base_style', 'file' => '/application/views/blocks/matomo.tpl'),
        array('template' => 'layout/base.tpl', 'block' => 'base_js', 'file' => '/application/views/blocks/matomo-content-tracking.tpl')
    ),
    'settings'    => array(
        array('group' => 'blaMatomo_Main', 'name' => 'blaMatomo_debug', 'type' => 'bool', 'value' => TRUE),
        array('group' => 'blaMatomo_Main', 'name' => 'blaMatomo_sUrl', 'type' => 'str', 'value' => ''),
        array('group' => 'blaMatomo_Main', 'name' => 'blaMatomo_sToken', 'type' => 'str', 'value' => ''),
        array('group' => 'blaMatomo_Main', 'name' => 'blaMatomo_iPageid', 'type' => 'str', 'value' => ''),
        array('group' => 'blaMatomo_Main', 'name' => 'blaMatomo_iNewsgoalid', 'type' => 'str', 'value' => '0'),
        array('group' => 'blaMatomo_Main', 'name' => 'blaMatomo_iMaxCustVar', 'type' => 'str', 'value' => '5'),
        array('group' => 'blaMatomo_Main', 'name' => 'blaMatomo_iCustindexNewsletter', 'type' => 'str', 'value' => '0'),
        array('group' => 'blaMatomo_Main', 'name' => 'blaMatomo_iCustindexPayment', 'type' => 'str', 'value' => '0'),
        array('group' => 'blaMatomo_Main', 'name' => 'blaMatomo_blUseUserID', 'type' => 'bool', 'value' => FALSE),
        array('group' => 'blaMatomo_Main', 'name' => 'blaMatomo_blFirstReferrerConv', 'type' => 'bool', 'value' => FALSE),
        array('group' => 'blaMatomo_Main', 'name' => 'blaMatomo_blEnableJSErrorTrackin', 'type' => 'bool', 'value' => FALSE),
        array('group' => 'blaMatomo_CustomVars', 'name' => 'blaMatomo_sCustomvarNewsletter', 'type' => 'str', 'value' => $oLang->translateString('SHOP_MODULE_blaMatomo_CUSTOM_NEWSLETTER')),
        array('group' => 'blaMatomo_CustomVars', 'name' => 'blaMatomo_sCustomvarPayment', 'type' => 'str', 'value' => $oLang->translateString('SHOP_MODULE_blaMatomo_CUSTOM_PAYMENT')),
        array('group' => 'blaMatomo_CustomVars', 'name' => 'blaMatomo_sNewsletterAccount', 'type' => 'str', 'value' => $oLang->translateString('SHOP_MODULE_blaMatomo_NEWSLETTER_ACCOUNT')),
        array('group' => 'blaMatomo_CustomVars', 'name' => 'blaMatomo_sNewsletterAccountOn', 'type' => 'str', 'value' => $oLang->translateString('SHOP_MODULE_blaMatomo_NEWSLETTER_ACCOUNT_ON')),
        array('group' => 'blaMatomo_CustomVars', 'name' => 'blaMatomo_sNewsletterAccountOff', 'type' => 'str', 'value' => $oLang->translateString('SHOP_MODULE_blaMatomo_NEWSLETTER_ACCOUNT_OFF')),
        array('group' => 'blaMatomo_CustomVars', 'name' => 'blaMatomo_sNewsletterViewed', 'type' => 'str', 'value' => $oLang->translateString('SHOP_MODULE_blaMatomo_NEWSLETTER_VIEWED')),
        array('group' => 'blaMatomo_CustomVars', 'name' => 'blaMatomo_sNewsletterOrdered', 'type' => 'str', 'value' => $oLang->translateString('SHOP_MODULE_blaMatomo_NEWSLETTER_ORDERED')),
        array('group' => 'blaMatomo_CustomVars', 'name' => 'blaMatomo_sNewsletterActivated', 'type' => 'str', 'value' => $oLang->translateString('SHOP_MODULE_blaMatomo_NEWSLETTER_ACTIVATED')),
        array('group' => 'blaMatomo_CustomVars', 'name' => 'blaMatomo_sNewsletterCanceled', 'type' => 'str', 'value' => $oLang->translateString('SHOP_MODULE_blaMatomo_NEWSLETTER_CANCELED')),
        array('group' => 'blaMatomo_Params', 'name' => 'blaMatomo_aParamMapVisit', 'type' => 'aarr', 'value' => NULL),
        array('group' => 'blaMatomo_Params', 'name' => 'blaMatomo_aParamMapPage', 'type' => 'aarr', 'value' => NULL),

        array('group' => 'blaMatomo_contentTracking', 'name' => 'blaMatomo_ct_enable', 'type' => 'bool', 'value' => FALSE),

        array('group' => 'blaMatomo_contentTracking', 'name' => 'blaMatomo_ct_flexprev', 'type' => 'str', 'value' => '.flex-prev'),
        array('group' => 'blaMatomo_contentTracking', 'name' => 'blaMatomo_ct_flexnext', 'type' => 'str', 'value' => '.flex-next'),

        array('group' => 'blaMatomo_contentTracking', 'name' => 'blaMatomo_ct_zoom1', 'type' => 'str', 'value' => '#zoom1'),
        array('group' => 'blaMatomo_contentTracking', 'name' => 'blaMatomo_ct_pic1', 'type' => 'str', 'value' => '#morePics_1'),
        array('group' => 'blaMatomo_contentTracking', 'name' => 'blaMatomo_ct_pic2', 'type' => 'str', 'value' => '#morePics_2'),
        array('group' => 'blaMatomo_contentTracking', 'name' => 'blaMatomo_ct_pic3', 'type' => 'str', 'value' => '#morePics_3'),
        array('group' => 'blaMatomo_contentTracking', 'name' => 'blaMatomo_ct_pic4', 'type' => 'str', 'value' => '#morePics_4'),
        array('group' => 'blaMatomo_contentTracking', 'name' => 'blaMatomo_ct_description', 'type' => 'str', 'value' => 'a[href="#description"]'),
        array('group' => 'blaMatomo_contentTracking', 'name' => 'blaMatomo_ct_pricealarm', 'type' => 'str', 'value' => 'a[href="#pricealarm"]'),
        array('group' => 'blaMatomo_contentTracking', 'name' => 'blaMatomo_ct_tags', 'type' => 'str', 'value' => 'a[href="#tags"]'),
        array('group' => 'blaMatomo_contentTracking', 'name' => 'blaMatomo_ct_productFbComments', 'type' => 'str', 'value' => 'a[href="#productFbComments"]'),
    )
);