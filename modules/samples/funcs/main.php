<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2020 VINADES.,JSC. All rights reserved
 * @License: Not free read more http://nukeviet.vn/vi/store/modules/nvtools/
 * @Createdate Sat, 31 Oct 2020 02:20:33 GMT
 */

if (!defined('NV_IS_MOD_SAMPLES')) {
    die('Stop!!!');
}

$page_title = $module_info['site_title'];
$key_words = $module_info['keywords'];

$array_data = [];

//------------------
// Viết code vào đây


$perpage = 5;
$page = $nv_Request->get_int('page','get',1);


$key_word = $nv_Request->get_title('keyword','get','');

$db->sqlreset()
    ->select('COUNT(*)')
    ->from($db_config['prefix'].'_'.'samples')
    ->where("fullname LIKE ".$db->quote('%'.$key_word.'%'));
$sql = $db->sql();
$total = $db->query($sql)->fetchColumn();

$db->select('*')
    ->order('weight ASC')
    ->limit($perpage)
    ->offset(($page-1)*$perpage);

$sql = $db->sql();
$result = $db->query($sql);
while ($row = $result->fetch()){
   /*$row['url_view'] = nv_url_rewrite(NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' .$module_name.'&amp;'
       . NV_OP_VARIABLE . '=detail/'.change_alias($row['fullname']).'-'.$row['id'].$global_config['rewrite_exturl'] );*/
   $row['url_view'] = nv_url_rewrite(NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' .$module_name.'&amp;'
       . NV_OP_VARIABLE . '=detail&id='.$row['id'] );
   $array_data[$row['id']] = $row;
}
$base_url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' .$module_name.'&amp;' . NV_OP_VARIABLE . '=main';
$generate_page=nv_generate_page($base_url,$total,$perpage,$page);
$page_title = $lang_module['main'];



$contents = nv_theme_samples_main($array_data,$page,$perpage,$generate_page);
include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
