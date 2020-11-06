<?php

/**
 * @Project NUKEVIET 3.0
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @copyright 2009
 * @createdate 12/31/2009 0:51
 */

if ( ! defined( 'NV_SYSTEM' ) ) die( 'Stop!!!' );

define( 'NV_IS_MOD_SEARCH_NEWS', true );

if( ! isset( $site_mods[$module_config[$module_name]['searchIn']] ) )
{
	Header( "Location:" . NV_BASE_SITEURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA );
	die();
}

$module_data = $site_mods[$module_config[$module_name]['searchIn']]['module_data'];
$module_name_search = $module_config[$module_name]['searchIn'];

global $global_array_cat;
$global_array_cat = array();
$link_i = NV_BASE_SITEURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&amp;" . NV_NAME_VARIABLE . "=" . $module_name_search . "&amp;" . NV_OP_VARIABLE . "=Other";
$global_array_cat[0] = array( "catid" => 0, "parentid" => 0, "title" => "Other", "titlesite" => "", "alias" => "Other", "link" => $link_i, "viewcat" => "viewcat_page_new", "subcatid" => 0, "numlinks" => 3, "description" => "", "inhome" => 0, "keywords" => "" );

$sql = "SELECT catid, parentid, title, titlesite, alias, viewcat, subcatid, numlinks, description, inhome, keywords, who_view, groups_view FROM `" . NV_PREFIXLANG . "_" . $module_data . "_cat` ORDER BY `order` ASC";
$list = nv_db_cache( $sql, 'catid', $module_name_search );
foreach( $list as $l )
{
	$l['alias'] = $db->unfixdb( $l['alias'] );
	$global_array_cat[$l['catid']] = $l;
	$global_array_cat[$l['catid']]['link'] = NV_BASE_SITEURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&amp;" . NV_NAME_VARIABLE . "=" . $module_name_search . "&amp;" . NV_OP_VARIABLE . "=" . $l['alias'];
}

?>