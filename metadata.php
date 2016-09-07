<?php
/**
 * ###_MODULE_###
 * Copyright (C) ###_YEAR_###  ###_COMPANY_###
 * info:  ###_EMAIL_###
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
 * @author      Marat Bedoev
 * @author      Rafael Dabrowski
 * @link        http://www.bestlife.ag
 *
 * @license     GPLv3
 */
$sMetadataVersion = '1.1';

$oLang = oxRegistry::getLang();

$aModule = array(
   'id'          => 'bla-piwik',
   'title'       => '<strong style="color:#95b900;font-size:125%;">best</strong><strong style="color:#c4ca77;font-size:125%;">life</strong> <strong>Piwik Analytix</strong>',
   'description' => array(
      'en' => 'Add Piwik tracking code to track activities in your online shop. You need access to a <a href="http://www.piwik.org" target="_blank">Piwik</a> installation to use this module.<br><br><b>UPDATE INFORMATION</b><br>When you update from an earlier release (<2.0) make sure to update the module\'s settings. It is a breaking change and configuration needs to be updated!<br><b>UPDATE INFORMATION for v1.1</b><br>This release uses piwik\'s internal <i>site search</i> which is available since Piwik 1.9. This means that the former search tracking with custom variable will not be available anymore!',
      'de' => 'Fügt einen Piwik Tracking Code hinzu, um eine Webanalyse ihres Shops zu erhalten. Sie benötigen Zugriff auf eine <a href="http://www.piwik.org" target="_blank">Piwik</a> Installation, um dies verwenden zu können.<br><br><b>UPDATE HINWEIS</b><br>Sollten sie von einer früheren Version dieses Moduls updaten (<2.0), passen sie bitte die Modulein&shy;stellungen an!<br><b>UPDATE HINWEIS für v1.1</b><br>Es wird die seit Piwik 1.9 enthaltene <i>Interne Suche</i> verwendet und daher ist das Tracking über die Benutzer&shy;definierten Variablen nicht mehr verfügbar!'
   ),
   'thumbnail'   => 'bestlife.png',
   'version'     => '###_VERSON_###',
   'author'      => '###_AUTHOR_### ###_COMPANY_###',
   'email'       => '###_EMAIL_###',
   'url'         => '###_URL_###',
   'extend'      => array( 'oxviewconfig' => 'bla/bla-piwik/extend/oxviewconfig_piwik' ),
   'blocks'      => array( array( 'template' => 'layout/base.tpl', 'block' => 'base_style', 'file' => '/application/views/blocks/piwik.tpl' ) ),
   'settings'    => array(
      array( 'group' => 'blaPiwik_Main', 'name' => 'blaPiwik_sUrl', 'type' => 'str', 'value' => '' ),
      array( 'group' => 'blaPiwik_Main', 'name' => 'blaPiwik_iPageid', 'type' => 'str', 'value' => '' ),
      array( 'group' => 'blaPiwik_Main', 'name' => 'blaPiwik_iNewsgoalid', 'type' => 'str', 'value' => '0' ),
      array( 'group' => 'blaPiwik_Main', 'name' => 'blaPiwik_iMaxCustVar', 'type' => 'str', 'value' => '5' ),
      array( 'group' => 'blaPiwik_Main', 'name' => 'blaPiwik_iCustindexNewsletter', 'type' => 'str', 'value' => '0' ),
      array( 'group' => 'blaPiwik_Main', 'name' => 'blaPiwik_iCustindexPayment', 'type' => 'str', 'value' => '0' ),
      array( 'group' => 'blaPiwik_Main', 'name' => 'blaPiwik_blUseUserID', 'type' => 'bool', 'value' => 'false' ),
      array( 'group' => 'blaPiwik_Main', 'name' => 'blaPiwik_blFirstReferrerConv', 'type' => 'bool', 'value' => 'false' ),
      array( 'group' => 'blaPiwik_Main', 'name' => 'blaPiwik_blEnableJSErrorTrackin', 'type' => 'bool', 'value' => 'false' ),
      array( 'group' => 'blaPiwik_CustomVars', 'name' => 'blaPiwik_sCustomvarNewsletter', 'type' => 'str', 'value' => $oLang->translateString('SHOP_MODULE_blaPiwik_CUSTOM_NEWSLETTER') ),
      array( 'group' => 'blaPiwik_CustomVars', 'name' => 'blaPiwik_sCustomvarPayment', 'type' => 'str', 'value' => $oLang->translateString('SHOP_MODULE_blaPiwik_CUSTOM_PAYMENT') ),
      array( 'group' => 'blaPiwik_CustomVars', 'name' => 'blaPiwik_sNewsletterAccount', 'type' => 'str', 'value' => $oLang->translateString('SHOP_MODULE_blaPiwik_NEWSLETTER_ACCOUNT') ),
      array( 'group' => 'blaPiwik_CustomVars', 'name' => 'blaPiwik_sNewsletterAccountOn', 'type' => 'str', 'value' => $oLang->translateString('SHOP_MODULE_blaPiwik_NEWSLETTER_ACCOUNT_ON') ),
      array( 'group' => 'blaPiwik_CustomVars', 'name' => 'blaPiwik_sNewsletterAccountOff', 'type' => 'str', 'value' => $oLang->translateString('SHOP_MODULE_blaPiwik_NEWSLETTER_ACCOUNT_OFF') ),
      array( 'group' => 'blaPiwik_CustomVars', 'name' => 'blaPiwik_sNewsletterViewed', 'type' => 'str', 'value' => $oLang->translateString('SHOP_MODULE_blaPiwik_NEWSLETTER_VIEWED') ),
      array( 'group' => 'blaPiwik_CustomVars', 'name' => 'blaPiwik_sNewsletterOrdered', 'type' => 'str', 'value' => $oLang->translateString('SHOP_MODULE_blaPiwik_NEWSLETTER_ORDERED') ),
      array( 'group' => 'blaPiwik_CustomVars', 'name' => 'blaPiwik_sNewsletterActivated', 'type' => 'str', 'value' => $oLang->translateString('SHOP_MODULE_blaPiwik_NEWSLETTER_ACTIVATED') ),
      array( 'group' => 'blaPiwik_CustomVars', 'name' => 'blaPiwik_sNewsletterCanceled', 'type' => 'str', 'value' => $oLang->translateString('SHOP_MODULE_blaPiwik_NEWSLETTER_CANCELED') ),
      array( 'group' => 'blaPiwik_Params', 'name' => 'blaPiwik_aParamMapVisit', 'type' => 'aarr', 'value' => null ),
      array( 'group' => 'blaPiwik_Params', 'name' => 'blaPiwik_aParamMapPage', 'type' => 'aarr', 'value' => null )
   )
);