<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2020 VINADES.,JSC. All rights reserved
 * @License: Not free read more http://nukeviet.vn/vi/store/modules/nvtools/
 * @Createdate Sat, 31 Oct 2020 02:20:33 GMT
 */

if (!defined('NV_IS_FILE_ADMIN')) {
    die('Stop!!!');
}

$page_title = $lang_module['main'];
$post = [];
$error = [];

if ($nv_Request->isset_request('change_provide','post')){
    $id_provide = $post['id_provide'] = $nv_Request->get_int('id_provide','post',0);
    if ($id_provide > 0){

    }
}

$post['id'] = $nv_Request->get_int('id','post,get','0');
$post['fullname'] = $nv_Request->get_title('fullname','post','');
$post['phone'] = $nv_Request->get_title('phone','post','');
$post['email'] = $nv_Request->get_title('email','post','');
$post['gender'] = $nv_Request->get_title('gender','post','');
$post['district'] = $nv_Request->get_title('district','post','');
$post['provide'] = $nv_Request->get_title('provide','post','');
$post['active'] = $nv_Request->get_title('active','post','');
$post['addtime'] = $nv_Request->get_title('addtime','post','');
$post['updatetime'] = $nv_Request->get_title('updatetime','post','');
$post['weight'] = $nv_Request->get_title('weight','post','');
$post['submit'] = $nv_Request->get_title('submit','post');

if (!empty($post['submit'])){
    if (empty($post['fullname'])){
        $error[] = "Chưa nhập tên";
    }
    if (empty($post['phone'])){
        $error[] = "Chưa nhập sđt";
    }
    if (empty($post['email'])){
        $error[] = "Chưa nhập email";
    }
    if (empty($post['gender'])){
        $error[] = $lang_module['error_gender'];
    }



    if (empty($error)){
        if($post['id']>0) {
            //update
            $sql = "UPDATE `nv4_samples` SET `fullname`=:fullname,`email`=:email,`phone`=:phone,`gender`=:gender,`district`=:district,
                    `provide`=:provide`updatetime`=:updatetime WHERE ".$post['id'];
            $s = $db->prepare($sql);
            $s->bindValue('updatetime',0);
        }else{
           /* INSERT INTO `nv4_samples`(`id`, `fullname`, `email`, `phone`, `gender`, `district`, `provide`, `active`, `addtime`, `updatetime`, `weight`)
            VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11])
           */
            $db->sqlreset()
                ->select('COUNT(*)')
                ->from($db_config['prefix'].'_'.'samples');
            $sql2 = $db->sql();
            $total = $db->query($sql2)->fetchColumn();
            $sql = "INSERT INTO `nv4_samples`( `fullname`, `email`, `phone`, `gender`, `district`,`provide`, `active`,  `addtime`,`updatetime`, `weight`)
                    VALUES (:fullname,:email,:phone,:gender, :district,:provide,:active, :addtime,:updatetime,:weight)";
            $s = $db->prepare($sql);
            $s->bindValue('fullname',$post['fullname']);
            $s->bindValue('phone',$post['phone']);
            $s->bindValue('email',$post['email']);
            $s->bindValue('gender',$post['gender']);
            $s->bindValue('district',$post['district']);
            $s->bindValue('provide',$post['provide']);
            $s->bindValue('active',1);
            $s->bindValue('addtime',NV_CURRENTTIME);
             $s->bindValue('updatetime',0);
             $s->bindValue('weight',$total+1);
            $s->execute();
            $error[] = $lang_module['error_done'];
        }
    }
    if ($post['id']>0){
        $sql = "SELECT * FROM nv4_samples WHERE id = ".$post['id'];
        $post = $db->query($sql)->fetch();
    }
    else{

    }
}


$sql2 = "SELECT id, title FROM `nv4_vi_location_province` ORDER BY weight ASC";
$result = $db->query($sql2);
$array_province = [];
while ($province = $result->fetch()){
   /* print_r($province);
    die();*/
    $array_province[$province['id']] = $province;
}


//------------------------------
// Viết code xử lý chung vào đây
//------------------------------

$xtpl = new XTemplate('main.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('NV_LANG_VARIABLE', NV_LANG_VARIABLE);
$xtpl->assign('NV_LANG_DATA', NV_LANG_DATA);
$xtpl->assign('NV_BASE_ADMINURL', NV_BASE_ADMINURL);
$xtpl->assign('NV_NAME_VARIABLE', NV_NAME_VARIABLE);
$xtpl->assign('NV_OP_VARIABLE', NV_OP_VARIABLE);
$xtpl->assign('MODULE_NAME', $module_name);
$xtpl->assign('OP', $op);
$xtpl->assign('POST',$post);
$xtpl->assign('ERROR',implode('<br>',$error));
if (!empty($error)){
    $xtpl->parse('main.error');
}

$array_gender = [];
$array_gender[1] = "Nam";
$array_gender[2] = "Nu";
$array_gender[3] = "N/A";

foreach ($array_gender as $key => $gender){
    $xtpl->assign('GENDER',array(
        'key' => $key,
        'title' => $gender,
        "checked" => $key == $post['gender'] ? 'checked="checked"' : ''
    ));
    $xtpl->parse('main.gender');
}

    foreach ($array_province as $key => $province){
        $xtpl->assign('PROVINCE',array(
            'key' => $key,
            'title' => $province['title'],
            "selected" => $key == $post['provide'] ? 'selected="selected"' : ''
        ));
        $xtpl->parse('main.provide');
    }


//-------------------------------
// Viết code xuất ra site vào đây
//-------------------------------

$xtpl->parse('main');
$contents = $xtpl->text('main');

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
