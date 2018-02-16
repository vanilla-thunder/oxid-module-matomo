[{$smarty.block.parent}]
[{if $oViewConf->getMatomoCtSetting("enable")}]
    [{assign var="matomodebug" value=$oViewConf->matomodebug()}]

    <!-- Matomo content traching by bla-matomo -->
    [{capture name="matomocontenttracking"}]
        [{foreach from=$oViewConf->getAllMatomoCtSettings() item="_setting"}]
            /* [{$_setting}] */
            [{if $oViewConf->getMatomoCtSetting($_setting)}]
                _paq.push(['trackContentImpression', '[{$_setting}]', '[{$_setting}]', 'http://www.example.com']);
                $('[{$oViewConf->getMatomoCtSetting($_setting)|replace:"'":'"'}]').on('click', function () {
                    _paq.push(['trackContentInteraction', 'click', '[{$_setting}]', '[{$_setting}]', 'http://www.example.com']);
                });
            [{/if}]
        [{/foreach}]

    [{/capture}]
    [{if $matomodebug}]
        <pre>[{$smarty.capture.matomocontenttracking|replace:';':';<br/>'}]</pre>
    [{/if}]
    [{oxscript add=$smarty.capture.matomocontenttracking}]
    <!-- End Matomo content tracking -->
[{/if}]
