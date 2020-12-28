<?php
    include '../../db.php';
    $array = array (
        'success' => [],
    );
    if($_POST['want']=='add') {
        if($res = $db->query("SELECT * FROM lists where place_id = '".$_POST['place_id']."' and list_id = '".$_POST['list_id']."'")) {
            if($res->num_rows == 0) {
                if($db->query("INSERT INTO lists (id,place_id,list_id,list_name,list_max) VALUES (null,'".$_POST['place_id']."','".$_POST['list_id']."','".$_POST['list_name']."',10)")) {
                    array_push($array['success'],array('success' => true, 'error' => false));
                }
                else {
                    array_push($array['success'],array('success' => false, 'error' => 'مشکل در دیتابیس'));
                }
            }
            else {
                array_push($array['success'],array('success' => false, 'error' => 'این لیست در این مکان قبلا ثبت شده است.'));
            }
        }
    }

    if($_POST['want']=='del') {
            if($db->query("DELETE FROM lists WHERE place_id = '".$_POST['place_id']."' and list_id = '".$_POST['list_id']."'")) {
                    $res = $db->query("SELECT * FROM list_items WHERE list_id = '".$_POST['list_id']."'");
                    if($res->num_rows == 0 ) {
                        array_push($array['success'],array('success' => true, 'error' => false));
                    }
                    else {
                        if($res = $db->query("DELETE FROM list_items WHERE list_id = '".$_POST['list_id']."'")) {
                            array_push($array['success'],array('success' => true, 'error' => false));  
                        }
                    }
            }
            else {
                array_push($array['success'],array('success' => false, 'error' => 'مشکل در دیتابیس'));
            }       
    }

    if($_POST['want']=="change_max") {
        if($db->query("UPDATE lists SET list_max = '".$_POST['list_max']."' WHERE place_id = '".$_POST['place_id']."' and list_id = '".$_POST['list_id']."'")) {
            array_push($array['success'],array('success' => true, 'error' => false));
        }
        else {
            array_push($array['success'],array('success' => false, 'error' => 'مشکل در دیتابیس'));
        }
    }



    if($_POST['want']=="coustom") {
        $list_id = rand(100000,999999).':'.rand(100000,999999);
        if($db->query("INSERT INTO lists (id,list_id,place_id,list_max,list_name) VALUES (null,'".$list_id."','".$_POST['info'][0]['place']."',10,'".$_POST['info'][0]['list']."')")) {
            foreach($_POST['lists'] as $list) {
                $item_id = rand(100000,999999).':'.rand(100000,999999);
                $db->query("INSERT INTO list_items (id,list_id,item_id,title,link) VALUES (null,'".$list_id."','".$item_id."','".$list['title']."','".$list['url']."')");
            }
            array_push($array['success'],array('success' => true, 'error' => false));
        }
        else {
            array_push($array['success'],array('success' => false, 'error' => 'مشکل در دیتابیس'));
        }
    }
    echo json_encode($array);
?>