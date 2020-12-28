<?php
error_reporting(0);
include 'db.php';
$array = array(
    'items' => [],
    'function' =>[],
    'posts' => [],
    'lists' => [],
);
foreach($_POST['want'] as $x) {
    if($x=='posts') {
        array_push($array['items'],'posts');
        if($_POST['posts']['post_order']=='latest') {
            $order = 'id';
        }
        if($post = $db->query("SELECT * FROM posts ORDER BY '".$order."' LIMIT ".$_POST['posts']['items']."") ) {

            array_push($array['function'],array('success'=>true));
                    while($data = $post->fetch_assoc()) {
                        $post_views = $data['post_views']+1; 
                       // echo $post_views.'  '.$data['post_id'].'         '; 
                        if($db->query("UPDATE posts SET post_views = '".$post_views."' WHERE post_id = '".$data['post_id']."' ")) {
                            if($res = $db->query("SELECT * FROM files WHERE fileid = '".$data['post_thumb']."'")) {
                                $image = $res->fetch_object();
                                $image = $image->file_url;
                            }
                            //echo json_encode( $data );
                            //array_replace_keys($data,array('post_thumb' => $image));
                            $data['post_thumb'] = $image;
                            array_push($array['posts'],$data);
                        }
                         /*
                        $post_data = array(
                            'post_id' => $data['post_id'],
                            'post_url' => $data['post_url'],
                            'post_html' => $data['post_html'],
                            'post_title' => $data['post_title'],
                            'post_thumb' => $image,
                            'post_caption' => $data['post_caption']
                        );
                        array_push($array['posts'],$post_data);
                        */
                    }  
        }
    }

    if($x=='lists') {
        foreach($_POST['lists'] as $list) {
            
        }
    }
}
echo json_encode($array);