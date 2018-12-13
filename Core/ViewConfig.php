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
 */

class oxviewconfig_matomo extends oxviewconfig_matomo_parent
{
	public function getMatomoJSTracking() {
		return oxRegistry::get("matomo")->getMatomoJSTracking($this);
	}

	// pure php tracking
	public function matomoTrackPageView() {
		oxRegistry::get("matomo")->apiTracking("PageView");
	}
	public function matomoTrackGoal($goal) {}
	public function matomoTrackSearch() {
		oxRegistry::get("matomo")->apiTracking("Search",oxRegistry::getConfig()->getActiveView());
	}

	/**
	 * returns visitior's ISO2 country code based on IP and GeoLocation stuff
	 *
	 * @return string
	 */
	protected $_originCountry = null;
	public function getCountryByIP()
	{
		$oUtilsServer = oxRegistry::get("oxUtilsServer");
		if( $_originCountry = $oUtilsServer->getOxCookie("_originCountry") ) $this->_originCountry = $_originCountry;
		else if($result = oxRegistry::get("matomo")->getCountryByIP())
		{
			$UserCountry = (object) array_shift(unserialize($result));
			$oUtilsServer->setOxCookie("_originCountry",$UserCountry->country_code,time()+60*60*24*30);
			$this->_originCountry = $UserCountry->country_code;
		}
		else
		{
			$oUtilsServer->setOxCookie("_originCountry",false,time()+600);// in 10 min nochmal versuchen
			$this->_originCountry = false;
		}

		//var_dump($this->_originCountry);
		return $this->_originCountry;
	}


	// ----------------------------------------------------------------------------- ab hier wird aktuell nix mehr benutzt

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



    public function getAllMatomoCtSettings()
    {
        return oxDb::getDb()->GetCol('SELECT SUBSTR(oxvarname,13) FROM oxconfig WHERE oxmodule = "module:matomo" AND oxvarname LIKE "blaMatomo_ct_%"');
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