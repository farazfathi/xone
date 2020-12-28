<link rel="stylesheet" href="/xone/cache/style.css">
<link rel="stylesheet" href="fun/trumbowyg/dist/ui/trumbowyg.min.css">
<script src="../cache/jquery.js"></script>
<script src="fun/trumbowyg/dist/trumbowyg.min.js"></script>
<script src="fun/trumbowyg/dist/plugins/base64/trumbowyg.base64.min.js"></script>

<div class="margin">
    <div class="bix">
        <input type="input" post="<?=rand(100000,999999)?>:<?=rand(100000,999999)?>" class="title-posy" placeholder="عنوان مطلب">
           <input type="input" class="id-txt no-select" placeholder="Url">
           <textarea class="captinj" placeholder="توضیح"></textarea>
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
            <textarea class="meth" placeholder="کدهای متا"></textarea>
            <input class="tagsinput" placeholder="برچسب ها">
            <ul class='tagpl'></ul>
    </div>
    <div class="margin">
            <div class="nim-bix">
                <div class="imgth">
                    <input type="file" style="display: none;" id="inpth" class="imgth">
                    <img id="imgth" src="">
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
                                    <input type="button" cat_id="<?=$row['category_id'];?>" class="category_check">
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

<script>
    $('body').on('click','.trumbowyg-insertImage-button',function() {
       // alert('s')
        $('.files_hr').load('files.php');
        $('.files_hr').addClass('active','editor');
        $(this).removeClass('thumb');
        $('.trumbowyg-modal.trumbowyg-fixed-top.active').addClass('hide')
    });
    function hide_files() {
        $('.files_hr').removeClass('active','editor','thumb');
        $('.files_hr').html('');
    }
    $('body').on('click','.files_hr.editor .files_l li .items_file',function() {
        $('.trumbowyg-modal.trumbowyg-fixed-top').attr('style','display:none');
        var url = $(this).parent('li').children('a').attr('href');
        alert(url);
        $('.trumbowyg-modal-box form input[name=url]').val(url);
        $('.trumbowyg-modal-button.trumbowyg-modal-submit').click();
        hide_files();
        $('.trumbowyg-modal.trumbowyg-fixed-top.active').removeClass('hide')
        return false;
    });
$('.id-txt').keyup(function() {
    var id=$(this).val();
    var newval = id.replaceAll(' ','-').replaceAll('/','-').replaceAll(';','-').replaceAll(':','-').replaceAll('"','-').replaceAll("'",'-').replaceAll('.','-').replaceAll(',','-').replaceAll("|",'-');
    $(this).val(newval)
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
        var caption = $('.captinj').val();
        if(thumb=='' || url=='' || post_html=='' || title=='') {
            alert('لطفا همه اطلاعات را پر کنید');
            exit;
        }
        $.post('fun/post.php',{html:post_html,post_caption:caption,post_id:post_id,title:title,post_url:url,meta:meta,thumb:thumb,step:1},function(data) {
            if(data=='ok') {
                $('.tagpl li').each(function() {
                    var tag = $(this).children('p').html();
                    var tag_url = tag.replaceAll(' ','-');
                    $.post('fun/post.php',{step:2,tag:tag,tag_url:tag_url,post_id:post_id},function (data) {
                        alert(data)
                    })
                });
                $('.catego li').each(function() {
                    if($(this).children('input').attr('class')=='category_check active') {
                        var cat_id =  $(this).children('input').attr('cat_id');
                        $.post('fun/post.php',{step:3,category_id:cat_id,post_id:post_id},function(data) {
                            alert(data);
                        });
                    }
                });
            }
        });
        window.location.replace('/xone/tool/edit-post?id='+post_id);
    });

    $('.category_check').click(function() {
        if($(this).attr('class') == 'category_check active') {
            $(this).removeClass('active');
        }
        else {
            $(this).addClass('active');
        }
    })
    //$('.editor').trumbowyg();
    $('.tagsinput').keyup(function(e) {
        if(e.which == 13) {
            var tag = $(this).val();
            $('.tagpl').append('<li><p>'+tag+'</p><input type="button" value="" id="rmvt"></li>');
            $(this).val('');
            $('#rmvt').click(function() {
                $(this).parent().remove();
            });
        }
    });

    $('img#imgth').click(function() {
        $('.files_hr').load('files.php');
        $('.files_hr').addClass('active');
        $('.files_hr').addClass('thumb');
        $(this).removeClass('editor');
    });
    $('body').on('click','.files_hr.thumb .files_l li',function() {
        
        var url = $(this).children('a').attr('href');
        var file_id = $(this).children('a').attr('file_id');
        $('.files_hr').html('');
        $('.files_hr').removeClass('active');
        $('.files_hr').removeClass('thumb');
        $('.files_hr').removeClass('editor');
        $('#imgth').attr({'src':url,'file_id':file_id});
        return false;
    });
</script>