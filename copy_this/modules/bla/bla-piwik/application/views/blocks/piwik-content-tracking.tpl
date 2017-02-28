[{$smarty.block.parent}]
[{if $oViewConf->getPiwikCtSetting("enable")}]
    [{assign var="piwikdebug" value=$oViewConf->piwikdebug()}]

    <!-- Piwik content traching by bla-piwik -->
    [{capture name="piwikcontenttracking"}]
        [{foreach from=$oViewConf->getAllPiwikCtSettings() item="_setting"}]
            /* [{$_setting}] */
            [{if $oViewConf->getPiwikCtSetting($_setting)}]
                _paq.push(['trackContentImpression', '[{$_setting}]', '[{$_setting}]', 'http://www.example.com']);
                $('[{$oViewConf->getPiwikCtSetting($_setting)|replace:"'":'"'}]').on('click', function () {
                    _paq.push(['trackContentInteraction', 'click', '[{$_setting}]', '[{$_setting}]', 'http://www.example.com']);
                });
            [{/if}]
        [{/foreach}]

    [{/capture}]
    [{if $piwikdebug}]
        <pre>[{$smarty.capture.piwikcontenttracking|replace:';':';<br/>'}]</pre>
    [{/if}]
    [{oxscript add=$smarty.capture.piwikcontenttracking}]
    <!-- End Piwik content tracking -->
[{/if}]
