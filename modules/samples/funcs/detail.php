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

$array_mod_title[] = array(
    'title' => $lang_module['main'],
    'link' => nv_url_rewrite(NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' .$module_name.'&amp;'
        . NV_OP_VARIABLE . '=main',true)
);
//------------------
// Viết code vào đây

/*$sql = "SELECT * FROM `nv4_samples` WHERE id = " .$id;*/
$id = $nv_Request->get_int('id','post,get',0);
if ($id>0){
    $sql = "SELECT * FROM `nv4_samples` WHERE id = " .$id;
    $result = $db->query($sql);

    if (!$row=$result->fetch()){
       nv_redirect_location(NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' .$module_name.'&amp;'
           . NV_OP_VARIABLE . '=main');
    }
    else{
        if ($row['gender']==1)
            $row['gender'] = 'Nam';
        elseif ($row['gender']==2)
            $row['gender'] = 'Nu';
        elseif ($row['gender']==3)
            $row['gender'] = 'N/A';
        else
            $row['gender'] = 'Null';
    }
    $page_title = $row['fullname'];
    if (!empty(['image']))
        $row['image'] = NV_BASE_SITEURL.NV_UPLOADS_DIR.'/'.$module_name.'/'. $row['image'];

    $array_mod_title[] = array(
        'title' => $row['fullname'],
        'link' => nv_url_rewrite(NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' .$module_name.'&amp;'
            . NV_OP_VARIABLE . '=detail&id=' . $row['id'],true)
    );

}else{
    nv_redirect_location(NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' .$module_name.'&amp;'
        . NV_OP_VARIABLE . '=main');
}

//------------------

$contents = nv_theme_samples_detail($row);

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
