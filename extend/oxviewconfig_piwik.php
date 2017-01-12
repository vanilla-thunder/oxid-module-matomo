<?php

/**
 * ___MODULE___
 * Copyright (C) ___YEAR___  ___COMPANY___
 * info:  ___EMAIL___
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
class oxviewconfig_piwik extends oxviewconfig_piwik_parent
{
    public function piwikdebug()
    {
        return oxRegistry::getConfig()->getConfigParam("blaPiwik_debug");
    }

    /**
     * Returns Piwik server URL.
     *
     * @return string
     */
    protected $_piwikUrl = null;

    public function getPiwikUrl()
    {
        if ($this->_piwikUrl === null) $this->_piwikUrl = oxRegistry::getConfig()->getConfigParam('blaPiwik_sUrl');

        return $this->_piwikUrl;
    }

    /**
     * Returns Piwik Auth Token.
     *
     * @return string
     */
    protected $_piwikToken = null;

    private function _getPiwikToken()
    {
        if ($this->_piwikToken === null) $this->_piwikToken = oxRegistry::getConfig()->getConfigParam('blaPiwik_sToken');

        return $this->_piwikToken;
    }

    /**
     * Returns Piwik page ID for tracking.
     *
     * @return int
     */
    protected $_piwikPageId = null;

    public function getPiwikPageid()
    {
        if ($this->_piwikPageId === null) $this->_piwikPageId = intval(oxRegistry::getConfig()->getConfigParam('blaPiwik_iPageid'));

        return $this->_piwikPageId;
    }

    /**
     * Returns Piwik's max number of allowed custom variables.
     *
     * @return int
     */
    protected $_piwikMaxCustVar = null;

    public function getPiwikMaxCustVar()
    {
        if ($this->_piwikMaxCustVar === null) $this->_piwikMaxCustVar = intval(oxRegistry::getConfig()->getConfigParam('blaPiwik_iMaxCustVar'));

        return $this->_piwikMaxCustVar;
    }

    /**
     * Returns the goal ID for newsletter registration.
     * The goal needs to be created manually in Piwik.
     *
     * @return int
     */
    protected $_piwikNlgoalId = null;
    public function getPiwikNlgoalid()
    {
        if ($this->_piwikNlgoalId === null) $this->_piwikNlgoalId = intval(oxRegistry::getConfig()->getConfigParam('blaPiwik_iNewsgoalid'));
        return $this->_piwikNlgoalId;
    }

    /**
     * Returns the index of the custom variable where to store newsletter tracking.
     * The index can be a number between 1 and 5 and can only be used for one value
     * for a site in Piwik. This custom variable has a page-scope.
     *
     * @return int
     */
    protected $_piwikCustomIndexNewsletter = null;
    public function getPiwikCustomIndexNewsletter()
    {
        if ($this->_piwikCustomIndexNewsletter === null) $this->_piwikCustomIndexNewsletter = intval(oxRegistry::getConfig()->getConfigParam('blaPiwik_iCustindexNewsletter'));
        return $this->_piwikCustomIndexNewsletter;
    }

    /**
     * Returns the index of the custom variable where to store the selected payment method.
     * The index can be a number between 1 and 5 and can only be used for one value
     * for a site in Piwik. This custom variable has a visit-scope.
     *
     * @return int
     */
    protected $_piwikCustomIndexPayment = null;
    public function getPiwikCustomIndexPayment()
    {
        if ($this->_piwikCustomIndexPayment === null) $this->_piwikCustomIndexPayment = intval(oxRegistry::getConfig()->getConfigParam('blaPiwik_iCustindexPayment'));
        return $this->_piwikCustomIndexPayment;
    }

    /**
     * If set to true accurately track your customers between devices and browsers.
     * This feature requires Piwik >= 2.7.0.
     *
     * @see setUserId( string )
     * @since blaPiwik 2.2.0
     * @return boolean
     */
    protected $_piwikUseUserID = null;
    public function getEnableUserID()
    {
        if ($this->_piwikUseUserID === null) $this->_piwikUseUserID = oxRegistry::getConfig()->getConfigParam('blaPiwik_blUseUserID');
        return $this->_piwikUseUserID;
    }

    /**
     * If set to true attribute a conversion to the first referrer. By default, conversion
     * is attributed to the most recent referrer.
     * This feature requires Piwik >= 1.2.0.
     *
     * @see setConversionAttributionFirstReferrer( bool )
     * @since blaPiwik 2.1.0
     * @return boolean
     */
    protected $_piwikFirstReferrerConv = null;
    public function getFirstReferrerConv()
    {
        if ($this->_piwikFirstReferrerConv === null) $this->_piwikFirstReferrerConv = oxRegistry::getConfig()->getConfigParam('blaPiwik_blFirstReferrerConv');
        return $this->_piwikFirstReferrerConv;
    }

    /**
     * Enable JavaScript error tracking by Piwik. Piwik can track uncaught JavaScript
     * errors from the Shop frontend in it's Event Tracking.
     * This feature requires Piwik >= 2.2.0.
     *
     * @see enableJSErrorTracking( enable )
     * @since blaPiwik 2.1.0
     * @return boolean
     */
    protected $_piwikEnableJSError = null;
    public function getPiwikEnableJSError()
    {
        if ($this->_piwikEnableJSError === null) $this->_piwikEnableJSError = oxRegistry::getConfig()->getConfigParam('blaPiwik_blEnableJSErrorTrackin');
        return $this->_piwikEnableJSError;
    }

    public function getDocumentTitle(oxView $oView)
    {
        $sTitle = "";
        $oLang = oxRegistry::getLang();
        switch ($oView->getClassName())
        {
            case "start":
                $sTitle = $oLang->translateString("HOME");
                break;

            case "oxUBase":
                $sTitle = "404/URL = " . urlencode($oView->getViewDataElement("sUrl")) . "/From = " . urlencode($_SERVER['HTTP_REFERER']);
                break;

            case "alist":
            case "manufacturerlist":
                foreach($oView->getBreadCrumb() as $crumb) $sTitle .= "/{$crumb['title']}";
                break;
            case "tag":
                $sTitle = $oLang->translateString("TAGS")."/".$oView->getTitle();
                break;

            case "contact":
                $sTitle = $oLang->translateString("CONTACT");
                break;

            case "basket":
                $sTitle = $oLang->translateString("ORDER")."/".$oLang->translateString("STEPS_BASKET");
                break;

            case "user":
                $sTitle = $oLang->translateString("ORDER")."/".$oLang->translateString("STEPS_SEND");
                break;

            case "payment":
                $sTitle = $oLang->translateString("ORDER")."/".$oLang->translateString("STEPS_PAY");
                break;

            case "order":
                $sTitle = $oLang->translateString("ORDER")."/".$oLang->translateString("STEPS_ORDER");
                break;

            case "thankyou":
                $sTitle = $oLang->translateString("ORDER")."/5. ".$oLang->translateString("ORDER_COMPLETED");
                break;

            default:
                $sTitle = $oView->getTitle();
                break;
        }

        return $sTitle;
    }

    /**
     * Returns text that will get displayed in Piwik for custom variables.
     *
     * @since blaPiwik 2.0.0
     * @return string
     */
    public function getPiwikText($textIdentifier)
    {
        $cfg = oxRegistry::get('oxConfig');
        switch ($textIdentifier) {
            case 'Newsletter':
                return $cfg->getConfigParam('blaPiwik_sCustomvarNewsletter');
                break;
            case 'Payment':
                return $cfg->getConfigParam('blaPiwik_sCustomvarPayment');
                break;
            case 'NewsletterAcc':
                return $cfg->getConfigParam('blaPiwik_sNewsletterAccount');
                break;
            case 'NewsletterAccOn':
                return $cfg->getConfigParam('blaPiwik_sNewsletterAccountOn');
                break;
            case 'NewsletterAccOff':
                return $cfg->getConfigParam('blaPiwik_sNewsletterAccountOff');
                break;
            case 'Newsletter1':
                return $cfg->getConfigParam('blaPiwik_sNewsletterOrdered');
                break;
            case 'Newsletter2':
                return $cfg->getConfigParam('blaPiwik_sNewsletterActivated');
                break;
            case 'Newsletter3':
                return $cfg->getConfigParam('blaPiwik_sNewsletterCanceled');
                break;
            case 'Newsletter4':
                return $cfg->getConfigParam('blaPiwik_sNewsletterViewed');
                break;
            default:
                return 'blaPiwik_undefined';
                break;
        }
    }

    /**
     * Generate custom variable tracking from additional parameter mapping.
     * Get's the addition parameter mapping configuration from the module's settings
     * and builds the Piwik calls to track the custom variable.
     *
     * @see addPiwikParamMapVisit()
     * @see addPiwikParamMapPage()
     * @since blaPiwik 2.0.0
     * @param string $sScope the scope
     * @return string
     */
    private function _getPiwikParamMap($sScope)
    {
        $ret = '';
        $aParamMap = null;
        $cfg = oxRegistry::get('oxConfig');
        switch ($sScope) {
            case 'visit':
                $aParamMap = $cfg->getConfigParam('blaPiwik_aParamMapVisit');
                break;
            case 'page':
                $aParamMap = $cfg->getConfigParam('blaPiwik_aParamMapPage');
                break;
        }
        if (is_array($aParamMap)) {
            foreach ($aParamMap as $sParam => $sParamConf) {
                $aParamConf = explode('|', $sParamConf);
                $iCustVarIndex = intval($aParamConf[0]);
                $sCustVarName = $aParamConf[1];
                // Piwik allows a configured fixed number of custom variables per scope
                // @TODO actually this check should be done in the module's settings already
                if ($iCustVarIndex < 1 || $iCustVarIndex > $this->getPiwikMaxCustVar()) {
                    echo "<!-- // blaPiwik: invalid custom variable index '$iCustVarIndex' for scope '$sScope' -->";
                    continue;
                }
                // Piwik's maximum custom variable name length is 200, it is advised to use short names because of other browser or webserver limits
                // @TODO actually this should be done in the module's settings already
                if (strlen($sCustVarName) > 200) {
                    echo "<!-- // blaPiwik: custom variable name too long for index '$iCustVarIndex' and scope '$sScope' -->";
                    $sCustVarName = substr($sCustVarName, 0, 200);
                }
                // Get the special chars replaced parameter from URL
                $sParamValue = $cfg->getRequestParameter($sParam);
                if (!empty($sParamValue)) {
                    // Piwik's maximum custom variable value length is 200, it is advised to use short names because of other browser or webserver limits
                    $sParamValue = substr($sParamValue, 0, 200);
                    $ret .= "_paq.push(['setCustomVariable',$iCustVarIndex,'$sCustVarName','$sParamValue','$sScope']);\n";
                }
            }
        }

        return $ret;
    }

    /**
     * Returns additional configured custom variables for visit-scope.
     *
     * @since blaPiwik 2.0.0
     * @return string
     */
    public function addPiwikParamMapVisit()
    {
        return $this->_getPiwikParamMap('visit');
    }

    /**
     * Returns additional configured custom variables for page-scope.
     *
     * @since blaPiwik 2.0.0
     * @return string
     */
    public function addPiwikParamMapPage()
    {
        return $this->_getPiwikParamMap('page');
    }

    /**
     * returns visitior's ISO2 country code based on IP and GeoLocation stuff
     *
     * @return string
     */
    protected $_originCountry = null;
    public function getCountryByIP()
    {
        if ($this->_originCountry === null && $this->_getPiwikToken()) {
            $requestUrl = 'https://' . $this->getPiwikUrl() . '/?module=API&method=UserCountry.getLocationFromIP&ip=' . $_SERVER['REMOTE_ADDR'];
            $requestUrl .= "&format=PHP&token_auth=" . $this->_getPiwikToken();
            $this->_originCountry = (object)unserialize(file_get_contents($requestUrl))[0];
        }

        return $this->_originCountry->country_code;
    }
}