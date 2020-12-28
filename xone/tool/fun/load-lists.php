<?php
    include '../../db.php';
    $curl = curl_init('http://localhost/options');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: application/json'));
    if($result = curl_exec($curl)) {
        $data = json_decode($result,true);
        
        if($_GET['want']=='lists_html') {
            foreach($data['lists'] as $list) {
            ?>   
                <div class="listxon">
                    <h1><?=$list['name']?></h1>
                    <h2><?=$list['caption']?></h2>
                    <div class="listitems" list_id="<?=$list['id']?>">
                    <ul>
                    <?php
                        if($res = $db->query("SELECT * FROM lists WHERE place_id = '".$list['id']."'")) {
                            if($res->num_rows == 0) {
                                echo '<p class="ipchbs">لیستی وجود ندارد</p>';
                            }
                            else {
                                while($data = $res->fetch_assoc()) {
                                    ?>
                                        <li>
                                            <h1><?=$data['list_name']?></h1>
                                            <input type="number" value="<?=$data['list_max']?>" class="listmx" list_id="<?=$data['list_id']?>" place_id="<?=$data['place_id']?>">
                                            <input type="button" class="delinl" list_id="<?=$data['list_id']?>" place_id="<?=$data['place_id']?>">
                                        </li>
                                    <?php
                                }
                            }
                        }
                    ?>
                     </ul>
                    </div>
                </div>

            <?php
            }
        }

        if($_GET['want']=='lists_options') {
            foreach($data['lists'] as $list) {
            ?>   
                    <option list_id="<?=$list['id']?>"><?=$list['name']?></option>
            <?php
            }
        }

    }
    else {
    echo 'fucl';
    }
?>