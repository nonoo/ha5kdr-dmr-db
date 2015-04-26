<?php
/**
 * Plugin Name: HA5KDR DMR database tables
 * Plugin URI: https://github.com/nonoo/ha5kdr-dmr-db
 * Description: Displays searchable DMR user or repeater database tables. Data is from http://dmr.ham-digital.net/
 * Version: 1.0
 * Author: Nonoo
 * Author URI: http://dp.nonoo.hu/
 * License: MIT
*/

include_once(dirname(__FILE__) . '/ha5kdr-dmr-db-config.inc.php');

function ha5kdr_dmr_db_users_generate() {
	$out = '<img class="ha5kdr-dmr-db-loader" id="ha5kdr-dmr-db-users-loader" src="' . plugins_url('loader.gif', __FILE__) . '" />' . "\n";
	$out .= '<form class="ha5kdr-dmr-db-search" id="ha5kdr-dmr-db-users-search">' . "\n";
	$out .= '	<input type="text" class="ha5kdr-dmr-db-search-string" id="ha5kdr-dmr-db-users-search-string" />' . "\n";
	$out .= '	<input type="submit" class="ha5kdr-dmr-db-search-button" id="ha5kdr-dmr-db-users-search-button" value="' . __('Search', 'ha5kdr-dmr-db') . '" />' . "\n";
	$out .= '</form>' . "\n";
	$out .= '<div class="ha5kdr-dmr-db-container" id="ha5kdr-dmr-db-users-container"></div>' . "\n";
	$out .= '<script type="text/javascript">' . "\n";
	$out .= '	$(document).ready(function () {' . "\n";
	$out .= '		$("#ha5kdr-dmr-db-users-container").jtable({' . "\n";
	$out .= '			paging: true,' . "\n";
	$out .= '			sorting: true,' . "\n";
	$out .= '			defaultSorting: "callsignid asc",' . "\n";
	$out .= '			actions: {' . "\n";
	$out .= '				listAction: "' . plugins_url('ha5kdr-dmr-db-users-getdata.php', __FILE__) . '",' . "\n";
	$out .= '			},' . "\n";
	$out .= '			fields: {' . "\n";
	$out .= '				callsign: { title: "' . __('Callsign', 'ha5kdr-dmr-db') . '" },' . "\n";
	$out .= '				callsignid: { title: "' . __('CallsignID', 'ha5kdr-dmr-db') . '" },' . "\n";
	$out .= '				name: { title: "' . __('Name', 'ha5kdr-dmr-db') . '" },' . "\n";
	$out .= '				country: { title: "' . __('Country', 'ha5kdr-dmr-db') . '", display: function (data) {' . "\n";
	$out .= '					return "<img title=\"" + data.record.country + "\" src=\"' . DMR_DB_FLAGS_URL . '" + data.record.country.replace(" ", "_") + ".png\" />";' . "\n";
	$out .= '				}, width: "1%", listClass: "country" }' . "\n";
	$out .= '			}' . "\n";
	$out .= '		});' . "\n";
	$out .= '		function dmr_db_users_update_showloader() {' . "\n";
	$out .= '			$("#ha5kdr-dmr-db-users-loader").fadeIn();' . "\n";
	$out .= '		}' . "\n";
	$out .= '		function dmr_db_users_update_hideloader() {' . "\n";
	$out .= '			$("#ha5kdr-dmr-db-users-loader").fadeOut();' . "\n";
	$out .= '		}' . "\n";
	$out .= '		function dmr_db_users_update() {' . "\n";
	$out .= '			dmr_db_users_update_showloader();' . "\n";
	$out .= '			$("#ha5kdr-dmr-db-users-container").jtable("load", {' . "\n";
	$out .= '				searchfor: $("#ha5kdr-dmr-db-users-search-string").val()' . "\n";
	$out .= '			}, dmr_db_users_update_hideloader);' . "\n";
	$out .= '		}' . "\n";
	$out .= '		$("#ha5kdr-dmr-db-users-search-button").click(function (e) {' . "\n";
	$out .= '			e.preventDefault();' . "\n";
	$out .= '			dmr_db_users_update();' . "\n";
	$out .= '		});' . "\n";
	$out .= '		dmr_db_users_update();' . "\n";
	$out .= '	});' . "\n";
	$out .= '</script>' . "\n";

	return $out;
}

function ha5kdr_dmr_db_repeaters_generate() {
	$out = '<img class="ha5kdr-dmr-db-loader" id="ha5kdr-dmr-db-repeaters-loader" src="' . plugins_url('loader.gif', __FILE__) . '" />' . "\n";
	$out .= '<form class="ha5kdr-dmr-db-search" id="ha5kdr-dmr-db-repeaters-search">' . "\n";
	$out .= '	<input type="text" class="ha5kdr-dmr-db-search-string" id="ha5kdr-dmr-db-repeaters-search-string" />' . "\n";
	$out .= '	<input type="submit" class="ha5kdr-dmr-db-search-button" id="ha5kdr-dmr-db-repeaters-search-button" value="' . __('Search', 'ha5kdr-dmr-db') . '" />' . "\n";
	$out .= '</form>' . "\n";
	$out .= '<div class="ha5kdr-dmr-db-container" id="ha5kdr-dmr-db-repeaters-container"></div>' . "\n";
	$out .= '<script type="text/javascript">' . "\n";
	$out .= '	$(document).ready(function () {' . "\n";
	$out .= '		$("#ha5kdr-dmr-db-repeaters-container").jtable({' . "\n";
	$out .= '			paging: true,' . "\n";
	$out .= '			sorting: true,' . "\n";
	$out .= '			defaultSorting: "callsignid asc",' . "\n";
	$out .= '			actions: {' . "\n";
	$out .= '				listAction: "' . plugins_url('ha5kdr-dmr-db-repeaters-getdata.php', __FILE__) . '",' . "\n";
	$out .= '			},' . "\n";
	$out .= '			fields: {' . "\n";
	$out .= '				callsign: { title: "' . __('Callsign', 'ha5kdr-dmr-db') . '" },' . "\n";
	$out .= '				callsignid: { title: "' . __('CallsignID', 'ha5kdr-dmr-db') . '" },' . "\n";
	$out .= '				qrg: { title: "' . __('QRG', 'ha5kdr-dmr-db') . '" },' . "\n";
	$out .= '				shift: { title: "' . __('Shift', 'ha5kdr-dmr-db') . '", width: "5%" },' . "\n";
	$out .= '				cc: { title: "' . __('Color Code', 'ha5kdr-dmr-db') . '", width: "5%" },' . "\n";
	$out .= '				mix: { title: "' . __('Mixed', 'ha5kdr-dmr-db') . '", width: "5%" },' . "\n";
	$out .= '				ctcss: { title: "' . __('CTCSS', 'ha5kdr-dmr-db') . '", width: "5%" },' . "\n";
	$out .= '				net: { title: "' . __('Net', 'ha5kdr-dmr-db') . '" },' . "\n";
	$out .= '				city: { title: "' . __('City', 'ha5kdr-dmr-db') . '" },' . "\n";
	$out .= '				county: { title: "' . __('County', 'ha5kdr-dmr-db') . '", visibility: "hidden" },' . "\n";
	$out .= '				country: { title: "' . __('Country', 'ha5kdr-dmr-db') . '", display: function (data) {' . "\n";
	$out .= '					return "<img title=\"" + data.record.country + "\" src=\"' . DMR_DB_FLAGS_URL . '" + data.record.country.replace(" ", "_") + ".png\" />";' . "\n";
	$out .= '				}, width: "1%", listClass: "country" },' . "\n";
	$out .= '				lat: { title: "' . __('Latitude', 'ha5kdr-dmr-db') . '", visibility: "hidden" },' . "\n";
	$out .= '				lon: { title: "' . __('Longitude', 'ha5kdr-dmr-db') . '", visibility: "hidden" },' . "\n";
	$out .= '			}' . "\n";
	$out .= '		});' . "\n";
	$out .= '		function dmr_db_repeaters_update_showloader() {' . "\n";
	$out .= '			$("#ha5kdr-dmr-db-repeaters-loader").fadeIn();' . "\n";
	$out .= '		}' . "\n";
	$out .= '		function dmr_db_repeaters_update_hideloader() {' . "\n";
	$out .= '			$("#ha5kdr-dmr-db-repeaters-loader").fadeOut();' . "\n";
	$out .= '		}' . "\n";
	$out .= '		function dmr_db_repeaters_update() {' . "\n";
	$out .= '			dmr_db_repeaters_update_showloader();' . "\n";
	$out .= '			$("#ha5kdr-dmr-db-repeaters-container").jtable("load", {' . "\n";
	$out .= '				searchfor: $("#ha5kdr-dmr-db-repeaters-search-string").val()' . "\n";
	$out .= '			}, dmr_db_repeaters_update_hideloader);' . "\n";
	$out .= '		}' . "\n";
	$out .= '		$("#ha5kdr-dmr-db-repeaters-search-button").click(function (e) {' . "\n";
	$out .= '			e.preventDefault();' . "\n";
	$out .= '			dmr_db_repeaters_update();' . "\n";
	$out .= '		});' . "\n";
	$out .= '		dmr_db_repeaters_update();' . "\n";
	$out .= '	});' . "\n";
	$out .= '</script>' . "\n";

	return $out;
}

function ha5kdr_dmr_db_filter($content) {
    $startpos = strpos($content, '<ha5kdr-dmr-db-users');
    if ($startpos === false)
		return $content;

    for ($j=0; ($startpos = strpos($content, '<ha5kdr-dmr-db-users', $j)) !== false;) {
		$endpos = strpos($content, '>', $startpos);
		$block = substr($content, $startpos, $endpos - $startpos + 1);

		$out = ha5kdr_dmr_db_users_generate();

		$content = str_replace($block, $out, $content);
		$j = $endpos;
    }

    for ($j=0; ($startpos = strpos($content, '<ha5kdr-dmr-db-repeaters', $j)) !== false;) {
		$endpos = strpos($content, '>', $startpos);
		$block = substr($content, $startpos, $endpos - $startpos + 1);

		$out = ha5kdr_dmr_db_repeaters_generate();

		$content = str_replace($block, $out, $content);
		$j = $endpos;
    }

    return $content;
}
load_plugin_textdomain('ha5kdr-dmr-db', false, basename(dirname(__FILE__)) . '/languages');
add_filter('the_content', 'ha5kdr_dmr_db_filter');
add_filter('the_content_rss', 'ha5kdr_dmr_db_filter');
add_filter('the_excerpt', 'ha5kdr_dmr_db_filter');
add_filter('the_excerpt_rss', 'ha5kdr_dmr_db_filter');

function ha5kdr_dmr_db_jscss() {
	echo '<link rel="stylesheet" type="text/css" media="screen" href="' . plugins_url('jtable-theme/jtable_basic.css', __FILE__) . '" />';
	echo '<link rel="stylesheet" type="text/css" media="screen" href="' . plugins_url('ha5kdr-dmr-db.css', __FILE__) . '" />';
}
add_action('wp_head', 'ha5kdr_dmr_db_jscss');
?>
