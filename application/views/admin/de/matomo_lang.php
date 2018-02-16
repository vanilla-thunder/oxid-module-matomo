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
 */

$sLangName = "Deutsch";
// -------------------------------
// RESOURCE IDENTITFIER = STRING
// -------------------------------
$css = '<style type="text/css">
.groupExp dd > h3 { display: inline-block; margin: 0 15px; border: none; }
.groupExp a.rc b {font-size:medium;color:#ff3600;}.groupExp dt input.txt {width:430px !important} .groupExp dl {display:block !important;} input.confinput {position:fixed;top:20px;right:70px;background:#008B2D;padding:10px 25px;color:white;border:1px solid black;cursor:pointer;font-size:125%;} input.confinput:hover {outline:3px solid #ff3600;} .groupExp dt textarea.txtfield {width:430px;height:150px;}</style>';
$aLang = [
    'charset'                                     => 'UTF-8',
    'SHOP_MODULE_GROUP_blaMatomo_Main'             => $css . 'Matomo Konfiguration',
    'SHOP_MODULE_blaMatomo_debug'                  => 'Debug Modus (zeigt für Shop-Admins Matomo Tracking Variablen im Template an)',
    'SHOP_MODULE_blaMatomo_sUrl'                   => '<h3>Matomo Server URL</h3><em>Hier die URL zu Ihrem Matomo Server eintragen.</em><br><b>Format:</b><i> ohne http:// bzw. https:// und ohne abschliessendem /</i><br><b>Bsp:</b> <i>matomo.domain.tld</i>',
    'SHOP_MODULE_blaMatomo_sToken'                 => '<h3>Auth Token</h3><em>Kann unter <b>Administration -> Plattform -> API</b> vom entsprechenden Benutzer kopiert werden</em>',
    'SHOP_MODULE_blaMatomo_iPageid'                => '<h3>Matomo Seiten-ID</h3><em>Tragen Sie hier die Matomo Seiten-ID ein.</em>',
    'SHOP_MODULE_blaMatomo_iNewsgoalid'            => '<h3>Newsletter Ziel-ID</h3><em>Wenn Sie in Matomo ein Ziel für eine Newsletterbestellung definiert haben, tragen Sie hier die Ziel-ID ein. Sollte dies nicht benötigt werden tragen Sie eine 0 ein.</em>',
    'SHOP_MODULE_blaMatomo_iMaxCustVar'            => '<h3>Anzahl benutzerdefinierter Variablen</h3><em>Matomo erlaubt standardmässig nur 5 benutzerdefinierte Variablen pro Scope. Dies kann in der Matomo Konfiguration erweitert werden. Ändern sie diesen Wert nur wenn sie sich sicher sind und diese Anleitung ausgeführt haben <a href="http://matomo.org/faq/how-to/faq_17931/" target="_blank">http://matomo.org/faq/how-to/faq_17931/</a>.</em>',
    'SHOP_MODULE_blaMatomo_iCustindexNewsletter'   => '<h3>Index der benutzerdefinierte Variable für das Newsletter Anmeldungstracking</h3><em>Matomo page-scope Index der <a href="http://matomo.org/docs/custom-variables/" target="_blank" title="Was ist eine benutzerdefinierte Variable">benutzerdefinierten Variable</a> zwischen 1 und 5 wo das Newsletter Anmeldungstracking gespeichert werden soll. (0 zum Deaktivieren)</em>',
    'SHOP_MODULE_blaMatomo_iCustindexPayment'      => '<h3>Index der benutzerdefinierten Variable für Zahlungsart-Tracking</h3><em>Matomo visit-scope Index der <a href="http://matomo.org/docs/custom-variables/" target="_blank" title="Was ist eine benutzerdefinierte Variable">benutzerdefinierten Variable</a> zwischen 1 und 5 wo die Zahlungsart gespeichert werden soll. (0 zum Deaktivieren)</em>',
    'SHOP_MODULE_blaMatomo_blUseUserID'            => '<h3>Eindeutige User ID zum Tracken der Kunden verwenden</h3><em>Anhaken um das erweiterte User ID Tracking zwischen Geräten und Browsern von Matomo zu verwenden. Weitere Informationen was für Auswirkungen dies hat finden sie in der Matomo Dokumentation zum Thema <a href="http://matomo.org/docs/user-id/" target="_blank">User ID</a>. Dieses Feature erforder Matomo >= 2.7.0</em>',
    'SHOP_MODULE_blaMatomo_blFirstReferrerConv'    => '<h3>Ersten Referrer einer Conversion zuordnen</h3><em>Anhaken um den ersten Referrer einer Conversion zuzuordnen. Standardmässig wird der zuletzte verwendete Referrer einer Conversion zugeordnet.</em>',
    'SHOP_MODULE_blaMatomo_blEnableJSErrorTrackin' => '<h3>Unbehandelte Frontend JavaScript-Fehler tracken</h3><em>Diese Option trackt unbehandelte JavaScript-Fehler im Shop-Frontend in Matomo\'s <a href="http://matomo.org/docs/event-tracking/" target="_blank" title="Event Tracking Dokumentation">Event Tracking</a>.<br>Achtung, dieses Feature erfordert Matomo >= 2.2.0</em>',
// Custom variable labels
    'SHOP_MODULE_GROUP_blaMatomo_CustomVars'       => 'Bezeichnungen für benutzerdefinierte Variablen',
    'SHOP_MODULE_blaMatomo_CUSTOM_NEWSLETTER'      => 'Newsletter',
    'SHOP_MODULE_blaMatomo_sCustomvarNewsletter'   => 'Text der in Matomo bei der benutzerdefinierten Varible für das Newsletter Anmeldungstracking erscheint.',
    'SHOP_MODULE_blaMatomo_CUSTOM_PAYMENT'         => 'Zahlungsart',
    'SHOP_MODULE_blaMatomo_sCustomvarPayment'      => 'Text der in Matomo bei der benutzerdefinierten Varible für das Zahlungsarttracking erscheint.',
    'SHOP_MODULE_blaMatomo_NEWSLETTER_ACCOUNT'     => 'Konto Newslettereinstellungen gesehen',
    'SHOP_MODULE_blaMatomo_sNewsletterAccount'     => 'Text der in Matomo angezeigt wird wenn ein Besucher in den Kontoeinstellungen auf der Newslettereinstellungsseite war.',
    'SHOP_MODULE_blaMatomo_NEWSLETTER_ACCOUNT_ON'  => 'Konto Newsletter aktiviert',
    'SHOP_MODULE_blaMatomo_sNewsletterAccountOn'   => 'Text der in Matomo angezeigt wird wenn ein Besucher in den Kontoeinstellungen den Newsletter aktiviert hat.',
    'SHOP_MODULE_blaMatomo_NEWSLETTER_ACCOUNT_OFF' => 'Konto Newsletter deaktiviert',
    'SHOP_MODULE_blaMatomo_sNewsletterAccountOff'  => 'Text der in Matomo angezeigt wird wenn ein Besucher in den Kontoeinstellungen den Newsletter deaktiviert hat.',
    'SHOP_MODULE_blaMatomo_NEWSLETTER_VIEWED'      => 'Angeschaut',
    'SHOP_MODULE_blaMatomo_sNewsletterViewed'      => 'Text der in Matomo angezeigt wird wenn ein Besucher auf der Newsletter Anmeldeseite war.',
    'SHOP_MODULE_blaMatomo_NEWSLETTER_ORDERED'     => 'Angemeldet',
    'SHOP_MODULE_blaMatomo_sNewsletterOrdered'     => 'Text der in Matomo angezeigt wird wenn ein Besucher das Newsletter Anmeldeformular abgeschickt hat.',
    'SHOP_MODULE_blaMatomo_NEWSLETTER_ACTIVATED'   => 'Best&auml;tigt',
    'SHOP_MODULE_blaMatomo_sNewsletterActivated'   => 'Text der in Matomo angezeigt wird wenn ein Besucher den Newsletter Double-Opt-In bestätigt hat.',
    'SHOP_MODULE_blaMatomo_NEWSLETTER_CANCELED'    => 'Gel&ouml;scht',
    'SHOP_MODULE_blaMatomo_sNewsletterCanceled'    => 'Text der in Matomo angezeigt wird wenn ein Besucher den Newsletter abbestellt hat.',
// additional mapping
    'SHOP_MODULE_GROUP_blaMatomo_Params'           => 'Zusätzliches Parametermapping',
    'SHOP_MODULE_blaMatomo_aParamMapVisit'         => '<h3>Parameter Mapping für visit-scope benutzerdefinierte Variablen</h3><em>Hierüber können pro Zeile ein URL Parameter in Matomos visit-scope <a href="http://matomo.org/docs/custom-variables/" target="_blank" title="Was ist eine benutzerdefinierte Variable">benutzerdefinierten Variablen</a> gespeichert werden. (leer lassen wenn nicht benötigt)<p><b>Konfiguration:</b> parameter => index|Bezeichnung<br><code>foo => 4|Parameter 1<br>foo2 => 5|Parameter2</code><br>Bei einem Aufruf von "http://www.shop.tld/index.php?foo=bar" wird in Matomo in die benutzerdefinierte Variable mit dem Index 4 und dem Namen "Parameter 1" der Wert "bar" gespeichert.<br><b>Achtung</b> ein visit-scope Index wird auch schon für das Zahlungsart-Tracking verwendet!</p></em>',
    'SHOP_MODULE_blaMatomo_aParamMapPage'          => '<h3>Parameter Mapping für page-scope benutzerdefinierte Variablen</h3><em>Hierüber können pro Zeile ein URL Parameter in Matomos page-scope <a href="http://matomo.org/docs/custom-variables/" target="_blank" title="Was ist eine benutzerdefinierte Variable">benutzerdefinierten Variablen</a> gespeichert werden. (leer lassen wenn nicht benötigt)<br> Funktionsweise wie beim visit-scope Parameter-Mapping.<br><b>Achtung</b> ein page-scope Index wird auch schon für das Newsletter-Tracking verwendet!</em>'
];
