<?php 
if($_POST['work']=='edit') {
    include '../../db.php';
    $sql = "UPDATE category SET category_link='".$_POST['url']."' WHERE id=".$_POST['item']."";
    if($db->query($sql) === TRUE) {
        echo $_POST['item'];
    }
    else {
        echo 'error';
    }
    exit;
}

if($_POST['work']=='del') {
    include '../../db.php';
    $del = "DELETE FROM category WHERE id=".$_POST['item']."";
    if($db->query($del) === TRUE) {
        echo $_POST['item'];
    }
    else {
    }
    exit;
}

if($_POST['work']=='add') {
    include '../../db.php';
    $random = rand(100000,999999);
    $random1 = rand(100000,999999);
    $add = "INSERT INTO category (id,category,category_link,category_id) VALUES (null , '".$_POST['category']."' , '".$_POST['category_link']."','".$random.":".$random1."') ";
    if($db->query($add) === TRUE) {
        include_category();
    }
    else {
        echo 'error';
    }
}
else {
    include_category();
}

function include_category() {
    include '../../db.php';
    $data = "SELECT id,category,category_link FROM category";
    $result = $db->query($data);
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          ?>
            <li>
                <p><?=$row['category']?></p>
                <input value=<?=$row['category_link']?> class="url_cat">
                <input type="button" value="" id_cat="<?=$row['id']?>" class="remt" id="rmvt">
            </li>

        <?php    
        } 
    }
    else {
        echo '<p style="text-align:center">موضوعی وجود ندارد</p>';
    }
    ?>

<script>
    $('.remt').click(function() {
        var cat_id = $(this).attr('id_cat');
        var cat_id = parseInt(cat_id);
        $.post('fun/cat-function.php',{work:'del',item:cat_id},function(e) {
            $('.remt[id_cat='+e+']').parent('li').remove();
        });
    });

    $('.url_cat').keyup(function(e) {
        var thisu = $(this).val().replaceAll(" ","_");
        $(this).val(thisu);
        if(e.which==13) {
            var cat_id = $(this).parent().children('.remt').attr('id_cat');
            var cat_id = parseInt(cat_id);
            $(this).parent().css('opacity','.5');
            $.post('fun/cat-function.php',{work:'edit',item:cat_id,url:thisu},function(e) {
               // alert(e);
                $('.remt[id_cat='+cat_id+']').parent().css('opacity','1');
            });
        }
    })
</script>
    <?php
}