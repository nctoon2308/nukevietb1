<?php

/**
 * @Project NUKEVIET 3.0
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2010 VINADES.,JSC. All rights reserved
 * @Createdate 2-9-2010 14:43
 */

if ( ! defined( 'NV_IS_SEARCH_NEWS_ADMIN' ) ) die( 'Stop!!!' );

$page_title = $lang_module['config'];

if ( $nv_Request->isset_request( 'submit', 'post' ) )
{
    $module_config[$module_name]['searchIn'] = $nv_Request->get_string( 'searchIn', 'post', 'news' );
	
	$db->sql_query( "REPLACE INTO `" . NV_CONFIG_GLOBALTABLE . "` (`lang`, `module`, `config_name`, `config_value`) VALUES('" . NV_LANG_DATA . "', " . $db->dbescape( $module_name ) . ", " . $db->dbescape( "searchIn" ) . ", " . $db->dbescape( $module_config[$module_name]['searchIn'] ) . ")" );

    nv_del_moduleCache( $module_name );

    Header( "Location: " . NV_BASE_ADMINURL . "index.php?" . NV_NAME_VARIABLE . "=" . $module_name );
    die();
}

$xtpl = new XTemplate( "main.tpl", NV_ROOTDIR . "/themes/" . $global_config['module_theme'] . "/modules/" . $module_file );
$xtpl->assign( 'FORM_ACTION', NV_BASE_ADMINURL . "index.php?" . NV_NAME_VARIABLE . "=" . $module_name );
$xtpl->assign( 'LANG', $lang_module );

foreach ( $site_mods as $mod_name => $mod )
{
	if( $mod['module_file'] == 'news' )
	{
		$mod['module_name'] = $mod_name;
		$mod['checked'] = $mod['module_name'] == $module_config[$module_name]['searchIn'] ? " checked=\"checked\"" : "";
	
		$xtpl->assign( 'DATA', $mod );
		$xtpl->parse( 'main.mod' );
	}
}

$xtpl->parse( 'main' );
$contents = $xtpl->text( 'main' );

include ( NV_ROOTDIR . "/includes/header.php" );
echo nv_admin_theme( $contents );
include ( NV_ROOTDIR . "/includes/footer.php" );

?>