<?php
include '../../db.php';


if($_POST['step']==1) {
    $sql = "INSERT INTO posts (id, post_id, post_url,post_html, post_title, post_meta, post_thumb,post_caption) VALUES (null,'".$_POST['post_id']."','".$_POST['post_url']."' , '".$_POST['html']."','".$_POST['title']."','".$_POST['meta']."','".$_POST['thumb']."','".$_POST['post_caption']."')";
    if($db->query($sql) === TRUE) {
        echo 'ok';
    }
    exit;
}
if($_POST['step']==4) {
    $sql = "UPDATE posts SET post_url = '".$_POST['post_url']."' , post_html = '".$_POST['post_html']."' , post_title = '".$_POST['title']."' , post_meta = '".$_POST['meta']."',post_caption = '".$_POST['post_caption']."' , post_thumb = '".$_POST['thumb']."' where post_id = '".$_POST['post_id']."';";
    if($db->query($sql)) {
        echo 'ok';
    }
    exit;
}





if($_POST['step']==2) {
    $random = rand(100000,999999);
    $random1 = rand(100000,999999);
    $sql = "INSERT INTO tags (id, post_id, tag_name, tag_url, tag_id) VALUES (NULL, '".$_POST['post_id']."', '".$_POST['tag']."', '".$_POST['tag_url']."', '".$random.":".$random1."')";
    if($db->query($sql) === TRUE) {
        echo 'ok';
    }
    
    exit;
}
if($_POST['step']==8) {
    $random = rand(100000,999999);
    $random1 = rand(100000,999999);
    $sql = "INSERT INTO tags (id, post_id, tag_name, tag_url, tag_id) VALUES (NULL, '".$_POST['post_id']."', '".$_POST['tag']."', '".$_POST['tag_url']."', '".$random.":".$random1."')";
    if($res = $db->query($sql)) {
        echo $random.":".$random1;
    }
    
    exit;
}
if($_POST['step']==9) {
    $sql = "DELETE FROM tags WHERE tag_id = '".$_POST['tag_id']."'";
    if($db->query($sql)) {
        echo $_POST['tag_id'];
    }
    exit;
}




if($_POST['step']==3) {
    $sql = "INSERT INTO category_posts (id, post_id, cat_id) VALUES (NULL, '".$_POST['post_id']."', '".$_POST['category_id']."');";
    if($db->query($sql) === TRUE) {
        echo 'ok';
    }
    exit;
}

if($_POST['step']==6) {
    $sql = "DELETE FROM category_posts WHERE post_id ='".$_POST['post_id']."' and cat_id = '".$_POST['category_id']."'";
    if($db->query($sql)) {
        echo 'ok';
    }
    exit;
}

if($_POST['step']==5) {
    $sql = "INSERT INTO category_posts (id,post_id,cat_id ) VALUES (null , '".$_POST['post_id']."' , '".$_POST['category_id']."')";
    if($db->query($sql)) {
        echo 'ok';
    }
    exit;
}