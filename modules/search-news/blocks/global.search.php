<?php

/**
 * @Project NUKEVIET 3.0
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2010 VINADES., JSC. All rights reserved
 * @Createdate 3/9/2010 23:25
 */

if ( ! defined( 'NV_MAINFILE' ) ) die( 'Stop!!!' );

if ( ! nv_function_exists( 'nv_news_search' ) )
{
    function nv_news_search( $block_config )
    {
        global $module_info, $site_mods, $db, $module_config, $nv_Request;
		
        $module = $block_config['module'];
		
		$data = $site_mods[$module_config[$module]['searchIn']]['module_data'];
		$module_name_search = $module_config[$module]['searchIn'];
		
        $file = $site_mods[$module]['module_file'];		
		
		include( NV_ROOTDIR . "/modules/" . $file . "/language/" . NV_LANG_DATA . ".php" );
		
		if ( file_exists( NV_ROOTDIR . "/themes/" . $module_info['template'] . "/modules/" . $file . "/block.tpl" ) )
		{
			$block_theme = $module_info['template'];
		}
		else
		{
			$block_theme = "default";
		}
		$xtpl = new XTemplate( "block.tpl", NV_ROOTDIR . "/themes/" . $block_theme . "/modules/" . $file );
		$xtpl->assign( 'LANG', $lang_module );
		$xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL );
		$xtpl->assign( 'NV_LANG_VARIABLE', NV_LANG_VARIABLE );
		$xtpl->assign( 'NV_LANG_DATA', NV_LANG_DATA );
		$xtpl->assign( 'NV_NAME_VARIABLE', NV_NAME_VARIABLE );
		$xtpl->assign( 'MODULE_NAME', $module );
		
		// Lay thong tin
		$search_catid = $nv_Request->get_int( 'catid', 'get', 0 );
		$search_topicid = $nv_Request->get_int( 'topicid', 'get', 0 );
		
		// Chuyen muc
		$sql = "SELECT `catid`, `title`, `lev`, `numsubcat` FROM `" . NV_PREFIXLANG . "_" . $data . "_cat` ORDER BY `order` ASC";
		$list = nv_db_cache( $sql, 'catid', $module_name_search );
		
		foreach( $list as $row )
		{
			$xtitle_i = "";
			if ( $row['lev'] > 0 )
			{
				for ( $i = 1; $i <= $row['lev']; $i ++ )
				{
					$xtitle_i .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				}
			}
			
			$row['selected'] = ( $search_catid == $row['catid'] ) ? " selected=\"selected\"" : "";
			$row['xtitle'] = $xtitle_i;
			
			$xtpl->assign( 'CATID', $row );
			$xtpl->parse( 'main.catid' );
		}
		
		// Dong su kien
		$sql = "SELECT `topicid`, `title` FROM `" . NV_PREFIXLANG . "_" . $data . "_topics` ORDER BY `weight` ASC";
		$list = nv_db_cache( $sql, 'topicid', $module_name_search );
		
		foreach( $list  as $row )
		{
			$row['selected'] = ( $search_topicid == $row['topicid'] ) ? " selected=\"selected\"" : "";
		
			$xtpl->assign( 'TOPICID', $row );
			$xtpl->parse( 'main.topicid' );
		}
		
		// Tu khoa
		$key = filter_text_input( 'q', 'get', '', 1, 255 );
		$xtpl->assign( 'KEY', $key ? $key : $lang_module['search_enter'] );
		
		$xtpl->parse( 'main' );
		return $xtpl->text( 'main' );
    }
}

if ( defined( 'NV_SYSTEM' ) )
{
	$content = nv_news_search( $block_config );
}

?>