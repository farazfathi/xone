<?php
include '../../db.php';
if($_POST['step']==1) {
    if($db->query("DELETE FROM files WHERE fileid = '".$_POST['file']."'")) {
        unlink('../../..'.$_POST['src']);
        echo $_POST['file'];
    }
    exit;
}

if($_POST['step']==2) {
    $url = '/xone/cache/files/'.$_POST['name'];
    if($db->query("UPDATE files SET file_url = '".$url."' WHERE fileid = '".$_POST['file']."'")) {
        $old = '../../..'.$_POST['oldname'];
        rename($old,'../../../xone/cache/files/'.$_POST['name']);
        echo 'ok';
    }
}