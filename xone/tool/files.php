<link rel="stylesheet" href="../cache/style.css">
<script src="../cache/jquery.js"></script>
<div class="margin">
    <div class="box-files">

        <div class="top-file-box">
            <h1>فایل ها</h1>
            <input type="file" class="ezaf-add">
            <input type="button" class="clsfile">

            <div class="inpunma-fil"></div>
        </div>

        <div class="file_plc"></div>
        <div class="margin" style="width: 100px;"><input type="button" class="morresf" value="موارد بیشتر"></div>

    </div>
</div>

<x></x>

<script>

    $('.morresf').click(function() {
        var last_item = $('.file_plc li:last-child').attr('item');
        files_load(last_item);
    });


    function files_load(item) {
        $('.file_plc').load('fun/load-files.php?last_item='+item,function(a) {
            if(a=='0') {
            $('.file_plc').html('<p style="margin:20px;text-align:center">هیچ فایلی وجود ندارد</p>');
            $('.morresf').hide();
            return false;
            }
        });
    }
    $('.inpunma-fil').click(function() {$('.ezaf-add').click();});
    $('.ezaf-add').change(function(a) {
        var file_name = $('.ezaf-add').val();
        var format = file_name.substr(file_name.lastIndexOf('.') +1);
        var upload = prompt('نام فایل را وارد کنید','نام فایل');
        var file = $(this).prop('files')[0];
        var data = new FormData();
        data.append('file',file);
        data.append('name',upload);
        data.append('format',format);
        $.ajax({
          url: 'fun/upload.php',
          dataType: 'text',
          cache: false,
          processData: false,
          contentType: false,
          type: 'POST',
          data: data,
          success:function(data) {
            if(data=='ok') {
                alert('آپلود شد!');
                files_load(0);
            }
            else {
                alert(data);
            }
          }
        })
    });
    files_load(0);
    $('body').on('click','input.filedsit' , function() {
                var file_id = $(this).attr('file_id');
                var src = $(this).attr('file_src');
                $.post('fun/file.php',{step:1,file:file_id,src:src},function(dt) {
                        files_load(0);
                });
    });
    $('body').on('click','.clsfile',function() {
        $(this).parents('.files_hr').removeClass('active','editor','thumb').html('');
        $('.trumbowyg-modal-button.trumbowyg-modal-reset').click();
    });
    $('body').on('click','.filedit',function() {
                var name = prompt('نام فایل را وارد کنید','نام فایل');
                var file = $(this).attr('file_id');
                var format1 = $(this).parent().children('.filedsit').attr('file_src');
                var format = format1.substr(format1.lastIndexOf('.') +1);
                var name = name+'.'+format;
                $.post('fun/file.php',{step:2,oldname:format1,name:name,file:file} , function(dt) {
                    if(dt=='ok') {
                        files_load(0);
                    }
                });

            });
</script>