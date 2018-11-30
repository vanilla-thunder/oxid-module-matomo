[{* newsletter goals *}]
[{if $oView->getClassName() == "account_newsletter" }][{* Viewed account newsletter settings page *}]

    das haben wir schon
    [{if $oView->getSubscriptionStatus() == 0}]
        _paq.push(['setCustomVariable', [{$matomo_CustomIndexNewsletter}], "[{ $oViewConf->getMatomoText('Newsletter') }]", "[{ $oViewConf->getMatomoText('NewsletterAcc') }]", "page"]);
    [{elseif $oView->getSubscriptionStatus() == 1}]
        [{* enabled newsletter in account settings *}]
        _paq.push(['setCustomVariable', [{$matomo_CustomIndexNewsletter}], "[{ $oViewConf->getMatomoText('Newsletter') }]", "[{ $oViewConf->getMatomoText('NewsletterAccOn') }]", "page"]);
    [{elseif $oView->getSubscriptionStatus() == -1}]
        [{* disabled newsletter in account settings *}]
        _paq.push(['setCustomVariable', [{$matomo_CustomIndexNewsletter}], "[{ $oViewConf->getMatomoText('Newsletter') }]", "[{ $oViewConf->getMatomoText('NewsletterAccOff') }]", "page"]);
    [{/if}]

[{elseif $oView->getClassName() == "newsletter"}][{* Newsletter subscription page *}]


    [{* Custom Variable: Payment method tracking if configured *}]
[{elseif $oView->getClassName() == "order" && $oViewConf->getMatomoCustomIndexPayment() > 0}]
    [{assign var="payment" value=$oView->getPayment() }]
    _paq.push(['setCustomVariable',[{$oViewConf->getMatomoCustomIndexPayment()}], '[{ $oViewConf->getMatomoText('Payment') }]', '[{ $payment->oxpayments__oxdesc->value }]', 'visit']);

    [{* Ecommerce conversion thank you page *}]
[{elseif $oView->getClassName() == "thankyou"}]
    [{foreach key=basketindex from=$basket->getContents() item=item name=basketContents}]
        [{assign var=product value=$item->getArticle()}]
        [{assign var=itemprice value=$item->getUnitPrice()}]
        [{assign var=category value=$product->getCategory()}]
        _paq.push(['addEcommerceItem', '[{$product->oxarticles__oxartnum->value}]', '[{$item->getTitle()|htmlspecialchars_decode}]', '[{$category->oxcategories__oxtitle->value|htmlspecialchars_decode}]',[{$itemprice->getBruttoPrice()}],[{$item->getAmount()}] ]);
    [{/foreach}]

    [{assign var=oprice value=$order->getOrderTsProtectionPrice()}]
    [{assign var=delPrice value = $order->getOrderDeliveryPrice()}]
    [{assign var=payPrice value = $order->getOrderPaymentPrice()}]
    [{assign var=wrapPrice value = $order->getOrderWrappingPrice()}]
    _paq.push(['trackEcommerceOrder',
    '[{$order->oxorder__oxordernr->value}]',
    [{$order->getTotalOrderSum()}],
    [{$basket->getDiscountedProductsBruttoPrice()}],
    ([{$order->oxorder__oxartvatprice1->value}]+[{$order->oxorder__oxartvatprice2->value}]),
    ([{$delPrice->getBruttoPrice()}]+[{$payPrice->getBruttoPrice()}]+[{$wrapPrice->getBruttoPrice()}]),
    [{$order->oxorder__oxdiscount->value}]
    ]);
[{/if}]




[{* Ecommerce add item to basket and Ecommerce view basket *}]
[{if $oxcmp_basket->isNewItemAdded() || $oView->getClassName() == "basket" }]
    [{foreach key=basketindex from=$oxcmp_basket->getContents() item=item name=basketContents}]
        [{assign var="product" value=$item->getArticle()}]
        [{assign var=itemprice value=$item->getUnitPrice()}]
        [{assign var=category value=$product->getCategory()}]
        _paq.push(['addEcommerceItem',
        '[{$product->oxarticles__oxartnum->value}]',
        '[{$item->getTitle()|htmlspecialchars_decode}]',
        '[{$category->oxcategories__oxtitle->value|htmlspecialchars_decode}]',
        [{$itemprice->getBruttoPrice()}],
        [{$item->getAmount()}]
        ]);
    [{/foreach}]
    _paq.push(['trackEcommerceCartUpdate',[{$oxcmp_basket->getBruttoSum()}]   ]);
[{/if}]



[{* JavaScript Error Tracking, available since Matomo >= 2.2.0 *}]
[{if $oViewConf->getMatomoEnableJSError()}]
    _paq.push(['enableJSErrorTracking']);
[{/if}]