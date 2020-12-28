<?php 
error_reporting(1);
$array = array(
    'success' => [],
    'lists' => [],
);
include '../../db.php';
$menu = explode(',',$_GET['want']);
foreach($menu as $ul) {
    if($ul=='popular' || $ul=='latest' || $ul=='category') {
        if($ul=='popular') {
            if($result = $db->query('SELECT post_title,post_url FROM posts ORDER BY post_views DESC')) {
                $datas = array(
                    'popular' => [],
                );
                while($data = $result->fetch_assoc()) {
                    $dt['title'] = $data['post_title'];
                    $dt['link'] = $data['post_url'];
                    array_push($datas['popular'],$dt);
                }
                array_push($array['lists'],$datas);
            }
        }
        if($ul=='latest') {
            if($result = $db->query('SELECT post_title,post_url FROM posts ORDER BY id DESC')) {
                $datas = array(
                    'latest' => [],
                );
                while($data = $result->fetch_assoc()) {
                    $dt['title'] = $data['post_title'];
                    $dt['link'] = $data['post_url'];
                    array_push($datas['latest'],$dt);
                }
                array_push($array['lists'],$datas);
            }
        }
        if($ul=='category') {
            if($result = $db->query('SELECT * FROM category ORDER BY id DESC')) {
                $datas = array(
                    'category' => [],
                );
                while($data = $result->fetch_assoc()) {
                    array_push($datas['category'],$data);
                }
                array_push($array['lists'],$datas);
            }
        }
    }
    else {
       // echo $ul;
        if($res = $db->query("SELECT * FROM lists WHERE list_id ='".$ul."'")) {
            $name = $res->fetch_object();
            $data = array(
                $name->list_name => [],
            );
            if($result = $db->query("SELECT title,link FROM list_items WHERE list_id = '".$ul."'")) {
                while($datas=$result->fetch_assoc()) {
                    array_push($data[$name->list_name],$datas);
                }
               // echo json_encode($data);
                array_push($array['lists'],$data);
            }
        }
    }
   

    





    
}
echo json_encode($array);