<link rel="stylesheet" href="../cache/style.css">
<link rel="stylesheet" href="fun/trumbowyg/dist/ui/trumbowyg.min.css">
<script src="../cache/jquery.js"></script>
<script src="fun/trumbowyg/dist/trumbowyg.min.js"></script>
<script src="fun/trumbowyg/dist/plugins/base64/trumbowyg.base64.min.js"></script>
<?php
include '../db.php';
$sql1 = "SELECT * FROM posts WHERE post_id = '".$_GET['id']."'";
if($result = $db->query($sql1)) {
    $obj = $result->fetch_object();
}
?>
<div class="margin">
    <div class="bix">
        <input type="input" post="<?= $obj->post_id; ?>" value="<?=$obj->post_title?>" class="title-posy" placeholder="عنوان مطلب">
        <input type="input" class="id-txt no-select" value="<?=$obj->post_url?>" placeholder="Url">
        <textarea class="captinj" placeholder="توضیح"><?=$obj->post_caption?></textarea>

        <!--
        <div class="nim-bix dt">
            <input type="number" class="year-n" placeholder="00">
            <p>/</p>
            <input type="number" class="year-n" placeholder="00">
            <p>/</p>
            <input type="number" class="year-n" placeholder="00">
        </div> -->
</div>
</div>
<div class="margin x">
<?php include 'fun/html_editor/x.html';?>

    </div>

    <div class="files_hr"></div>

    <div class="margin">
            <textarea class="meth" placeholder="کدهای متا"><?=$obj->post_meta?></textarea>
            <input class="tagsinput" placeholder="برچسب ها">
            <ul class='tagpl'>
                <?php
                $sql2 = "SELECT tag_name,tag_id FROM tags WHERE post_id = '".$obj->post_id."'";
                if($result = $db->query($sql2)) {
                    if(0<$result->num_rows) {
                        while($row = $result->fetch_assoc()) {
                            ?>
                            <li><p><?=$row['tag_name']?></p><input type="button" class="rmtg" value="" tag_id="<?=$row['tag_id']?>" id="rmvt"></li>
                            <?php
                        }
                    }
                }
                ?>
            </ul>
    </div>
    <div class="margin">
            <div class="nim-bix">
                <div class="imgth">
                    <?php
                        $sdf = "SELECT file_url FROM files WHERE fileid = '".$obj->post_thumb."'";
                        if($img = $db->query($sdf)) {
                            $dts = $img->fetch_object();
                        }
                        else {
                            echo 'sss';
                        }
                    ?>
                    <input type="file" style="display: none;" id="inpth" class="imgth">
                    <img id="imgth" file_id="<?=$obj->post_thumb?>"src="<?=$dts->file_url?>">
                    <div class="plusim"></div>
                    <p>انتخاب عکس مطلب</p>
                </div>
            </div>

            <div class="nim-bix">
                <div class="catego">
                    <h1>انتخاب موضوع</h1>
                    <?php
                        include '../db.php';
                        $data = "SELECT id,category,category_link,category_id FROM category";
                        $result = $db->query($data);
                        if($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                              ?>
                                <li>
                                    <p><?=$row['category']?></p>
                                    <input type="button" cat_id="<?=$row['category_id'];?>" class="category_check
                                    <?php
                                        $sq = "SELECT * FROM category_posts WHERE cat_id = '".$row['category_id']."' and post_id = '".$obj->post_id."';";
                                        if($res = $db->query($sq)) {
                                            if($res->num_rows > 0) {
                                                echo 'active';
                                            }
                                        }
                                    ?>
                                    ">
                                </li>
                    
                            <?php    
                            } 
                        }
                        else {
                            echo '<p style="text-align:center">موضوعی وجود ندارد</p>';
                        }
                    ?>
                </div>
            </div>
    </div>

    <div class="margin" style="width: 150px;">
        <input type="button" class="sendpost" value="ارسال پست">
    </div>

    <xx></xx>
<script>
    $('#trumbowyg-demo').html('<?=$obj->post_html;?>');
    $('body').on('click','.trumbowyg-insertImage-button',function() {
        $('.files_hr').load('files.php');
        $('.files_hr').addClass('active');
        $('.files_hr').addClass('editor');
        $(this).removeClass('thumb');
    });
    $('.files_hr.editor').click(function() {
        $(this).removeClass('active');
        $(this).removeClass('editor');
        $(this).removeClass('thumb');
        $('.files_hr').html('');
        $('.trumbowyg-modal-button[type=reset]').click();
    })
    $('body').on('click','.files_hr.editor a',function() {
        var url = $(this).attr('href');
        $('.trumbowyg-modal-box form input[name=url]').val(url);
        $('.trumbowyg-modal-box form button[type=submit]').click();
        $('.files_hr').html('');
        $('.files_hr').removeClass('active');
        $('.files_hr').removeClass('editor');
        $('.files_hr').removeClass('thumb');
        return false;
    });
$('.id-txt').click(function() {
    $(this).removeClass('no-select');
})
$('.title-posy').keyup(function() {
    var title = $(this).val();
    var url = title.replaceAll(' ','-');
    $('.id-txt.no-select').val(url);
});
    $('.sendpost').click(function() {
        var post_id = $('.title-posy').attr('post');
        var title = $('.title-posy').val();
        var url = $('.id-txt').val();
        var post_html = $('#trumbowyg-demo').html(); 
        var meta = $('.meth').val();
        var thumb = $('#imgth').attr('file_id');
        var cap = $('.captinj').val();
        $.post('fun/post.php',{post_html:post_html,post_caption:cap,post_id:post_id,title:title,post_url:url,meta:meta,thumb:thumb,step:4},function(data) {
            $('xx').html(data);
            alert(data);
            if(data=='ok') {
        
           }
        });
    });


    $('.id-txt').keyup(function() {
    var id=$(this).val();
    var newval = id.replaceAll(' ','-').replaceAll('/','-').replaceAll(';','-').replaceAll(':','-').replaceAll('"','-').replaceAll("'",'-').replaceAll('.','-').replaceAll(',','-').replaceAll("|",'-');
    $(this).val(newval)
});
    $('.category_check').click(function() {
        var cat_id = $(this).attr('cat_id');
        if($(this).attr('class') == 'category_check active') {
            $(this).removeClass('active');
            $.post('fun/post.php',{step:6,category_id:cat_id,post_id:'<?= $obj->post_id; ?>'},function(dt) {
            })
        }
        else {
            $(this).addClass('active');
            $.post('fun/post.php',{step:5,category_id:cat_id,post_id:'<?= $obj->post_id; ?>'},function(dt) {
            })
        }
    })
    $('.editor').trumbowyg();
    $('.tagsinput').keyup(function(e) {
        if(e.which == 13) {
            var tag = $(this).val();
            var tag_url = tag.replaceAll(' ','-');
            $.post('fun/post.php',{step:8,tag:tag,post_id:'<?= $obj->post_id; ?>',tag_url:tag_url},function(dt) {
                $('.tagpl').append('<li><p>'+tag+'</p><input type="button" value="" class="rmtg" tag_id="'+dt+'" id="rmvt"></li>');
            })
            $(this).val('');
        }
    });

    $('body').on('click','#rmvt',function() {
        var tag_id = $(this).attr('tag_id');
        $.post('fun/post.php',{step:9,tag_id:tag_id},function(dt) {
            })
            $(this).parent().remove();

    });

    $('img#imgth').click(function() {
        $('.files_hr').load('files.php');
        $('.files_hr').addClass('active');
        $('.files_hr').addClass('thumb');
        $(this).removeClass('editor');
    });
    $('body').on('click','.files_hr.thumb a',function() {
        var url = $(this).attr('href');
        var file = $(this).attr('file_id');
        $('.files_hr').html('');
        $('.files_hr').removeClass('active');
        $('.files_hr').removeClass('thumb');
        $('.files_hr').removeClass('editor');
        $('#imgth').attr({'src':url,'file_id':file});
        return false;
    });
</script>