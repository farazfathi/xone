<?php 
if($_FILES['file']['error'] > 0) {
    echo 'error';
}
else {
    $random = rand(100000,999999);
    $random1 = rand(100000,999999);
    $filename = $_POST['name'].'.'.$_POST['format'];
    $url1 = 'cache/files/'.$filename;
    $url = '/xone/cache/files/'.$filename;
    include '../../db.php';
    if(move_uploaded_file($_FILES['file']['tmp_name'],'../../'.$url1)) {
        $sql = "INSERT INTO files (id,file_url,fileid,fileformat) VALUES (null,'".$url."','".$random.":".$random1."','".$_POST['format']."')";
        if($db->query($sql) === TRUE) {
            echo 'ok';
        }
    }
}