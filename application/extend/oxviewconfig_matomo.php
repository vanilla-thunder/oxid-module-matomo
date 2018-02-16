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
class oxviewconfig_matomo extends oxviewconfig_matomo_parent
{
    public function matomodebug()
    {
        return ( oxRegistry::getConfig()->getConfigParam("blaMatomo_debug") && oxRegistry::getConfig()->getUser()->oxuser__oxrights->value == "malladmin" ) ? true : false ;
    }

    /**
     * Returns Matomo server URL.
     *
     * @return string
     */
    protected $_matomoUrl = null;

    public function getMatomoUrl()
    {
        if ($this->_matomoUrl === null) $this->_matomoUrl = oxRegistry::getConfig()->getConfigParam('blaMatomo_sUrl');

        return $this->_matomoUrl;
    }

    /**
     * Returns Matomo Auth Token.
     *
     * @return string
     */
    protected $_matomoToken = null;

    private function _getMatomoToken()
    {
        if ($this->_matomoToken === null) $this->_matomoToken = oxRegistry::getConfig()->getConfigParam('blaMatomo_sToken');

        return $this->_matomoToken;
    }

    /**
     * Returns Matomo page ID for tracking.
     *
     * @return int
     */
    protected $_matomoPageId = null;

    public function getMatomoPageid()
    {
        if ($this->_matomoPageId === null) $this->_matomoPageId = intval(oxRegistry::getConfig()->getConfigParam('blaMatomo_iPageid'));

        return $this->_matomoPageId;
    }

    /**
     * Returns Matomo's max number of allowed custom variables.
     *
     * @return int
     */
    protected $_matomoMaxCustVar = null;

    public function getMatomoMaxCustVar()
    {
        if ($this->_matomoMaxCustVar === null) $this->_matomoMaxCustVar = intval(oxRegistry::getConfig()->getConfigParam('blaMatomo_iMaxCustVar'));

        return $this->_matomoMaxCustVar;
    }

    /**
     * Returns the goal ID for newsletter registration.
     * The goal needs to be created manually in Matomo.
     *
     * @return int
     */
    protected $_matomoNlgoalId = null;
    public function getMatomoNlgoalid()
    {
        if ($this->_matomoNlgoalId === null) $this->_matomoNlgoalId = intval(oxRegistry::getConfig()->getConfigParam('blaMatomo_iNewsgoalid'));
        return $this->_matomoNlgoalId;
    }

    /**
     * Returns the index of the custom variable where to store newsletter tracking.
     * The index can be a number between 1 and 5 and can only be used for one value
     * for a site in Matomo. This custom variable has a page-scope.
     *
     * @return int
     */
    protected $_matomoCustomIndexNewsletter = null;
    public function getMatomoCustomIndexNewsletter()
    {
        if ($this->_matomoCustomIndexNewsletter === null) $this->_matomoCustomIndexNewsletter = intval(oxRegistry::getConfig()->getConfigParam('blaMatomo_iCustindexNewsletter'));
        return $this->_matomoCustomIndexNewsletter;
    }

    /**
     * Returns the index of the custom variable where to store the selected payment method.
     * The index can be a number between 1 and 5 and can only be used for one value
     * for a site in Matomo. This custom variable has a visit-scope.
     *
     * @return int
     */
    protected $_matomoCustomIndexPayment = null;
    public function getMatomoCustomIndexPayment()
    {
        if ($this->_matomoCustomIndexPayment === null) $this->_matomoCustomIndexPayment = intval(oxRegistry::getConfig()->getConfigParam('blaMatomo_iCustindexPayment'));
        return $this->_matomoCustomIndexPayment;
    }

    /**
     * If set to true accurately track your customers between devices and browsers.
     * This feature requires Matomo >= 2.7.0.
     *
     * @see setUserId( string )
     * @since blaMatomo 2.2.0
     * @return boolean
     */
    protected $_matomoUseUserID = null;
    public function getEnableUserID()
    {
        if ($this->_matomoUseUserID === null) $this->_matomoUseUserID = oxRegistry::getConfig()->getConfigParam('blaMatomo_blUseUserID');
        return $this->_matomoUseUserID;
    }

    /**
     * If set to true attribute a conversion to the first referrer. By default, conversion
     * is attributed to the most recent referrer.
     * This feature requires Matomo >= 1.2.0.
     *
     * @see setConversionAttributionFirstReferrer( bool )
     * @since blaMatomo 2.1.0
     * @return boolean
     */
    protected $_matomoFirstReferrerConv = null;
    public function getFirstReferrerConv()
    {
        if ($this->_matomoFirstReferrerConv === null) $this->_matomoFirstReferrerConv = oxRegistry::getConfig()->getConfigParam('blaMatomo_blFirstReferrerConv');
        return $this->_matomoFirstReferrerConv;
    }

    /**
     * Enable JavaScript error tracking by Matomo. Matomo can track uncaught JavaScript
     * errors from the Shop frontend in it's Event Tracking.
     * This feature requires Matomo >= 2.2.0.
     *
     * @see enableJSErrorTracking( enable )
     * @since blaMatomo 2.1.0
     * @return boolean
     */
    protected $_matomoEnableJSError = null;
    public function getMatomoEnableJSError()
    {
        if ($this->_matomoEnableJSError === null) $this->_matomoEnableJSError = oxRegistry::getConfig()->getConfigParam('blaMatomo_blEnableJSErrorTrackin');
        return $this->_matomoEnableJSError;
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
     * Returns text that will get displayed in Matomo for custom variables.
     *
     * @since blaMatomo 2.0.0
     * @return string
     */
    public function getMatomoText($textIdentifier)
    {
        $cfg = oxRegistry::get('oxConfig');
        switch ($textIdentifier) {
            case 'Newsletter':
                return $cfg->getConfigParam('blaMatomo_sCustomvarNewsletter');
                break;
            case 'Payment':
                return $cfg->getConfigParam('blaMatomo_sCustomvarPayment');
                break;
            case 'NewsletterAcc':
                return $cfg->getConfigParam('blaMatomo_sNewsletterAccount');
                break;
            case 'NewsletterAccOn':
                return $cfg->getConfigParam('blaMatomo_sNewsletterAccountOn');
                break;
            case 'NewsletterAccOff':
                return $cfg->getConfigParam('blaMatomo_sNewsletterAccountOff');
                break;
            case 'Newsletter1':
                return $cfg->getConfigParam('blaMatomo_sNewsletterOrdered');
                break;
            case 'Newsletter2':
                return $cfg->getConfigParam('blaMatomo_sNewsletterActivated');
                break;
            case 'Newsletter3':
                return $cfg->getConfigParam('blaMatomo_sNewsletterCanceled');
                break;
            case 'Newsletter4':
                return $cfg->getConfigParam('blaMatomo_sNewsletterViewed');
                break;
            default:
                return 'blaMatomo_undefined';
                break;
        }
    }

    /**
     * Generate custom variable tracking from additional parameter mapping.
     * Get's the addition parameter mapping configuration from the module's settings
     * and builds the Matomo calls to track the custom variable.
     *
     * @see addMatomoParamMapVisit()
     * @see addMatomoParamMapPage()
     * @since blaMatomo 2.0.0
     * @param string $sScope the scope
     * @return string
     */
    private function _getMatomoParamMap($sScope)
    {
        $ret = '';
        $aParamMap = null;
        $cfg = oxRegistry::get('oxConfig');
        switch ($sScope) {
            case 'visit':
                $aParamMap = $cfg->getConfigParam('blaMatomo_aParamMapVisit');
                break;
            case 'page':
                $aParamMap = $cfg->getConfigParam('blaMatomo_aParamMapPage');
                break;
        }
        if (is_array($aParamMap)) {
            foreach ($aParamMap as $sParam => $sParamConf) {
                $aParamConf = explode('|', $sParamConf);
                $iCustVarIndex = intval($aParamConf[0]);
                $sCustVarName = $aParamConf[1];
                // Matomo allows a configured fixed number of custom variables per scope
                // @TODO actually this check should be done in the module's settings already
                if ($iCustVarIndex < 1 || $iCustVarIndex > $this->getMatomoMaxCustVar()) {
                    echo "<!-- // blaMatomo: invalid custom variable index '$iCustVarIndex' for scope '$sScope' -->";
                    continue;
                }
                // Matomo's maximum custom variable name length is 200, it is advised to use short names because of other browser or webserver limits
                // @TODO actually this should be done in the module's settings already
                if (strlen($sCustVarName) > 200) {
                    echo "<!-- // blaMatomo: custom variable name too long for index '$iCustVarIndex' and scope '$sScope' -->";
                    $sCustVarName = substr($sCustVarName, 0, 200);
                }
                // Get the special chars replaced parameter from URL
                $sParamValue = $cfg->getRequestParameter($sParam);
                if (!empty($sParamValue)) {
                    // Matomo's maximum custom variable value length is 200, it is advised to use short names because of other browser or webserver limits
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
     * @since blaMatomo 2.0.0
     * @return string
     */
    public function addMatomoParamMapVisit()
    {
        return $this->_getMatomoParamMap('visit');
    }

    /**
     * Returns additional configured custom variables for page-scope.
     *
     * @since blaMatomo 2.0.0
     * @return string
     */
    public function addMatomoParamMapPage()
    {
        return $this->_getMatomoParamMap('page');
    }

    /**
     * returns visitior's ISO2 country code based on IP and GeoLocation stuff
     *
     * @return string
     */
    protected $_originCountry = null;
    public function getCountryByIP()
    {
        if ($this->_originCountry === null && $this->_getMatomoToken()) 
        {
            $oUtilsServer = oxRegistry::get("oxUtilsServer");
            
            if( $_originCountry = $oUtilsServer->getOxCookie("_originCountry") ) $this->_originCountry = $_originCountry;
            else
            {
                $requestUrl = 'https://' . $this->getMatomoUrl() . '/?module=API&method=UserCountry.getLocationFromIP&ip=' . $_SERVER['REMOTE_ADDR']."&format=PHP&token_auth=" . $this->_getMatomoToken();
                
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $requestUrl);
                curl_setopt($ch, CURLOPT_HEADER, false);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1); 
                curl_setopt($ch, CURLOPT_TIMEOUT, 1);
                $result = curl_exec($ch);
                curl_close($ch);
                
                if($result)
                {
                    $UserCountry = (object) array_shift(unserialize($result));
                    $oUtilsServer->setOxCookie("_originCountry",$UserCountry->country_code,time()+60*60*24*30);
                    $this->_originCountry = $UserCountry->country_code;
                }
                else 
                {
                    $oUtilsServer->setOxCookie("_originCountry","xxx",time()+600);// in 10 min nochmal versuchen
                    $this->_originCountry = "xxx";
                }
            }
        }

        return $this->_originCountry;
    }

    public function getAllMatomoCtSettings()
    {
        return oxDb::getDb()->GetCol('SELECT SUBSTR(oxvarname,13) FROM oxconfig WHERE oxmodule = "module:bla-matomo" AND oxvarname LIKE "blaMatomo_ct_%"');
    }
    /**
     * returns settings for matomo content tracking
     *
     * @param $var
     * @return mixed
     */
    public function getMatomoCtSetting($var)
    {
        return oxRegistry::getConfig()->getConfigParam("blaMatomo_ct_{$var}");
    }
}