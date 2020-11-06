<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VSOFT (http://vsoft.com.vn)
 * @Copyright (C) 2018 VSOFT. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Sun, 30 Sep 2018 17:03:41 GMT
 */

if ( ! defined( 'NV_IS_MOD_THUOCLOBAN' ) ) die( 'Stop!!!' );

$page_title = $module_info['custom_title'];
$key_words = $module_info['keywords'];

$ifram = $nv_Request->get_int( 'ifram', 'get', 0 );

$xtpl = new XTemplate( $op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file );
$xtpl->assign( 'LANG', $lang_module );
$xtpl->assign( 'LINK_MAIN', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' );

$xtpl->parse( 'main' );
$contents = $xtpl->text( 'main' );

include NV_ROOTDIR . '/includes/header.php';
if( $ifram )
{
    echo nv_site_theme( $contents, 0 );
}
else
{
    echo nv_site_theme( $contents );
}
include NV_ROOTDIR . '/includes/footer.php';
