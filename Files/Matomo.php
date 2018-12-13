<?php

namespace Bla\Matomo\Files;

use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\Controller\BaseController;
use OxidEsales\Eshop\Core\ViewConfig;


class Matomo extends PiwikTracker
{
	public function __construct()
	{
		parent::__construct($this->_getMatomoSiteID(),$this->_getMatomoUrl());
	}


	/**
	 * Returns Matomo server URL.
	 *
	 * @return string
	 */
	protected function _getMatomoUrl()
	{
		if ( $this->_url === null )
		    $this->_url = ( parse_url(Registry::getConfig()->getConfigParam('blaMatomo_sUrl'),PHP_URL_HOST) ? "https://".parse_url(Registry::getConfig()->getConfigParam('blaMatomo_sUrl'),PHP_URL_HOST)."/".parse_url(Registry::getConfig()->getConfigParam('blaMatomo_sUrl'),PHP_URL_PATH)."/" : false );
		return $this->_url;
	}
	protected $_url = null;

	/**
	 * Returns Matomo Auth Token.
	 *
	 * @return string
	 */
	protected function _getMatomoToken()
	{
		if ($this->_token === null) $this->_token = ( Registry::getConfig()->getConfigParam('blaMatomo_sToken') ? Registry::getConfig()->getConfigParam('blaMatomo_sToken') : false );
		return $this->_token;
	}
	protected $_token = null;

	/**
	 * Returns Matomo site ID for tracking.
	 *
	 * @return int
	 */
	protected function _getMatomoSiteID()
	{
		if ($this->_siteid === null) $this->_siteid = ( intval(Registry::getConfig()->getConfigParam('blaMatomo_iSiteID')) ? intval(Registry::getConfig()->getConfigParam('blaMatomo_iSiteID')) : false );
		return $this->_siteid;
	}
	protected $_siteid = null;

	/**
	 * generate document title for matomo tracking based on active controller
	 * @param oxView $oView
	 * @return string
	 */
	public function getDocumentTitle(BaseController $oView = null)
	{
		if(!$oView) $oView = Registry::getConfig()->getActiveView();
		$oLang = Registry::getLang();
		$sTitle = "";
		switch ($oView->getClassKey())
		{
			case "start":
				$sTitle = $oLang->translateString("HOME");
				break;

			case "oxUBase":
				// das hier könnten aber auch CMS Seiten im Popup sein.
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

	/** generate matomo js tracking code  */
	public function getMatomoJSTracking(ViewConfig $oViewConf)
	{
		if(!$this->_getMatomoUrl() || !$this->_getMatomoSiteID()) return "";
		/** @var matomo $matomo */
		$matomo = Registry::get(Matomo::class);
		return '<!-- Matomo --><script type="text/javascript">var _paq = window._paq || '.json_encode($this->getTrackingObject($oViewConf)).
			';(function(){var d = document, g = d.createElement("script"), s = d.getElementsByTagName("script")[0];g.type = "text/javascript";g.defer = true;g.async = true;g.src = "'.$this->_getMatomoUrl().'piwik.js";s.parentNode.insertBefore(g, s);'.
			'})();</script><!-- /Matomo -->';
	}

	public function getTrackingObject(ViewConfig $oViewConf)
	{
		$oConfig = Registry::getConfig(); /** @var oxConfig $oConfig */
		$oView = $oConfig->getActiveView(); /** @var oxView $oShop */
		//$oShop = oxRegistry::getConfig()->getActiveShop(); /** @var oxShop $oShop */
		$oUser = $oConfig->getUser();

		// prepare dimensions config
		$iLanguageDim = $oConfig->getConfigParam('blaMatomo_iLanguageDimension');
		$iPaymentDim = $oConfig->getConfigParam('blaMatomo_iPaymentDimension');
		$iDeliveryMethodDim = $oConfig->getConfigParam('blaMatomo_iDeliveryMetodDimension');
		$iDeliveryAddressDim = $oConfig->getConfigParam('blaMatomo_iDeliveryAddressDimension');
		//$iMediacodeDim = $oConfig->getConfigParam('blaMatomo_iMediacodeDimension');

		// general tracking stuff
		$_paq = [
			['setTrackerUrl',$this->_getMatomoUrl()."piwik.php"],
			['setSiteId', $this->_getMatomoSiteID()],
			['enableLinkTracking'],
			['enableHeartBeatTimer'], // Accurately measure the time spent on each page
		];

		$cl = $oView->getClassKey();

		if ( $cl === "search" ) $_paq[] =  ['trackSiteSearch', $oView->getSearchParamForHtml(), false, $oView->getArticleCount()];
		else
		{
			$_paq[] = ['setDocumentTitle', htmlspecialchars_decode($this->getDocumentTitle($oView))];
			$_paq[] = ['trackPageView'];
		}

		if ( $cl === "alist" )
		{
			$_paq[] = ['setEcommerceView', false, false, htmlspecialchars_decode($oView->getTitle())];
		}
		else if ( $cl === "details" )
		{
			$oDetailsProduct = $oView->getProduct();
			$oCategory = $oDetailsProduct->getCategory();
			$_paq[] = ['setEcommerceView',
					   $oDetailsProduct->oxarticles__oxartnum->value,
					   htmlspecialchars_decode($oDetailsProduct->oxarticles__oxtitle->value),
					   htmlspecialchars_decode($oCategory->oxcategories__oxtitle->value)];
		}
		else if ( $cl === "newsletter" )
		{
			// newsletter goals
			if ( $oView->getNewsletterStatus() == "1" && $optinGoal = $oConfig->getConfigParam("blaMatomo_iNewsletterOptinGoal") ) $_paq[] = ['trackGoal', $optinGoal];
			else if ( $oView->getNewsletterStatus() == "2" && $subscribedGoal = $oConfig->getConfigParam("blaMatomo_iNewsletterSubscribedGoal") ) $_paq[] = ['trackGoal', $subscribedGoal];
			else if ( $oView->getNewsletterStatus() == "3" && $unsubscribedGoal = $oConfig->getConfigParam("blaMatomo_iNewsletterUnsubscribedGoal") ) $_paq[] = ['trackGoal', $unsubscribedGoal];
		}
		else if ( $cl === "basket" ) // hier passiert nix wichtiges
		{
		}
		else if ( $cl === "user" ) // hier passiert nix wichtiges
		{
			// Checkout Dimension: guest / register / login
		}
		else if ( $cl === "payment" ) // hier passiert nix wichtiges
		{
		}
		else if ( $cl === "order" ) // hier können wir ein paar Diemnsionen befüllen
		{
			/** @var order $oView */
			$oPayment = $oView->getPayment();
			$oShipSet = $oView->getShipSet();
			$oBasket = $oView->getBasket();

			if($iPaymentDim) $_paq[] = ['setCustomDimension', $iPaymentDim, $oPayment->oxpayments__oxdesc->value ]; // payment method
			if($iDeliveryMethodDim) $_paq[] = ['setCustomDimension', $iDeliveryMethodDim, $oShipSet->oxdeliveryset__oxtitle->value.($oBasket->getDeliveryCost() ? " ".$oBasket->getDeliveryCost()->getBruttoPrice() : "")  ]; // delivery method
			if( $iDeliveryAddressDim ) $_paq[] = ['setCustomDimension', $iDeliveryAddressDim, Registry::getLang()->translateString( (Registry::getSession()->getVariable('blshowshipaddress') === "1" ? "MATOMO_SHIPPING_ADDRESS" : "BILLING_ADDRESS") )];

		}
		else if ( $cl === "thankyou" ) // hier passiert nix wichtiges
		{
			/** @var thankyou $oView */
			/** @var oxBasket $oBasket */
			$oBasket = $oView->getBasket();

			// add products to basket
			foreach ( $oBasket->getContents() as $_index => $_basketitem )
			{
				$_article = $_basketitem->getArticle();
				$_category = $_article->getCategory();
				$_unitprice = $_basketitem->getUnitPrice();

				//$_paq[] = print_r($_basketitem,true);
				$_paq[] = ['addEcommerceItem',
						   $_article->oxarticles__oxartnum->value,
						   htmlspecialchars_decode($_basketitem->getTitle()),
						   htmlspecialchars_decode($_category->oxcategories__oxtitle->value),
						   $_unitprice->getBruttoPrice(),
						   $_basketitem->getAmount()
				];
			}

			// track ecomemrce order
			/** @var oxOrder $oOrder */
			$oOrder = $oView->getOrder();
			$_paq[] = [
				'trackEcommerceOrder',
				$oOrder->oxorder__oxordernr->value,
				doubleval($oOrder->getTotalOrderSum()),
				doubleval($oBasket->getDiscountedProductsBruttoPrice()),
				($oOrder->oxorder__oxartvatprice1->value + $oOrder->oxorder__oxartvatprice2->value),
				($oOrder->getOrderDeliveryPrice()->getBruttoPrice() + $oOrder->getOrderPaymentPrice()->getBruttoPrice() + $oOrder->getOrderWrappingPrice()->getBruttoPrice()),
				$oOrder->oxorder__oxdiscount->value
			];

		}

		// User ID, available since Matomo >= 2.7.0
		if ( /*$oConfig->getConfigParam('blaMatomo_blUseUserID') &&*/ $oUser ) $_paq[] = ['setUserId', md5($oUser->oxuser__oxusername->value)];


		if ( $iLanguageDim ) $_paq[] = ['setCustomDimension', $iLanguageDim, $oViewConf->getActLanguageAbbr() ]; // language dimensions
		//if ( $iMediacodeDim ) $_paq[] = ['setCustomDimension', $iMediacodeDim, $oViewConf->getActLanguageAbbr() ]; // language dimensions

		if ( $oConfig->getConfigParam("blaMatomo_blEnableJSErrorTrackin") ) $_paq[] = ['enableJSErrorTracking'];

		return $_paq;
	}

	public function apiTracking($what,$params)
	{
		if ( !$this->_getMatomoToken() ) return false;
		switch ( $what ) {
			case "PageView":
				$this->doTrackPageView($this->getDocumentTitle());
				break;
			case "Goal":
				call_user_func_array ( [$this, "doTrackGoal"] , $params );
				//$this->doTrackGoal($id, $revenue);
				break;
			case "Search":
				//call_user_func_array ( [$this, "doTrackSiteSearch"] , $params );
				/** @var search $oView */
				$oView = $params;
				$this->doTrackSiteSearch($oView->getSearchParamForHtml(), false, $oView->getArticleCount() );
				break;
			case "Event":
				call_user_func_array ( [$this, "doTrackEvent"] , $params );
				//$this->doTrackEvent();
				break;
			case "Order":
				call_user_func_array ( [$this, "doTrackEcommerceCartUpdate"] , $params );
				//$this->doTrackEcommerceOrder();
				break;
			case "CartUpdate":
				call_user_func_array ( [$this, "doTrackEcommerceCartUpdate"] , $params );
				//$this->doTrackEcommerceCartUpdate();
				break;
		}
	}

	public function imageTracking($params) {
		if ( !$this->_getMatomoUrl() || !$this->_getMatomoSiteID() ) return "<!-- matomo tracking error: matomo url is not configured -->";
		if ( !isset($params["track"]) ) return "<!-- matomo tracking error: params missing, please read module manual -->";

		if ( $oUser = Registry::getConfig()->getUser() ) $this->setUserId( md5($oUser->oxuser__oxusername->value) );
		$url = '';

		switch ( $params["track"] ) {
			case "PageView":
				$url = $this->getUrlTrackPageView( (isset($params["title"]) && is_string($params["title"]) ? $params["title"] : $this->getDocumentTitle() ));
				break;
			case "Goal":
				//call_user_func_array ( [$this, "doTrackGoal"] , $params );
				//$this->doTrackGoal($id, $revenue);
				break;
			case "Search":
				//call_user_func_array ( [$this, "doTrackSiteSearch"] , $params );
				/** @var search $oView */
				//$oView = $params;
				//$this->doTrackSiteSearch($oView->getSearchParamForHtml(), false, $oView->getArticleCount() );
				break;
			case "Event":
				//call_user_func_array ( [$this, "doTrackEvent"] , $params );
				//$this->doTrackEvent();
				break;
			case "Order":
				//call_user_func_array ( [$this, "doTrackEcommerceCartUpdate"] , $params );
				//$this->doTrackEcommerceOrder();
				break;
			case "CartUpdate":
				//call_user_func_array ( [$this, "doTrackEcommerceCartUpdate"] , $params );
				//$this->doTrackEcommerceCartUpdate();
				break;
		}

		return "<img width='1' height='1' src='".$url."'/>";
		//$imgsrc = $this->($oLang->translateString("ORDER")."/6. ".$oLang->translateString("MATOMO_ORDER_EMAIL") );
	}

	public function noscriptImageTracking() {
		return "<noscript>".$this->imageTracking()."</noscript>";
	}

	// geo-ip stuff
	public function getCountryByIP()
	{
		if ( !$this->_getMatomoToken() || !$this->_getMatomoUrl() ) return false;

		$requestUrl = $this->_getMatomoUrl() . '/?module=API&method=UserCountry.getLocationFromIP&ip=' . $_SERVER['REMOTE_ADDR']."&format=PHP&token_auth=" . $this->_getMatomoToken();
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $requestUrl);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 1);
		$result = curl_exec($ch);
		curl_close($ch);

		return $result;
	}
}