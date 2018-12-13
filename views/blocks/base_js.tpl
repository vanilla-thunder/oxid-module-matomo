[{*
 * [bla] ___MODULE___
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
 *}]
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