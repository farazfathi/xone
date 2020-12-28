<link rel="stylesheet" href="../cache/style.css">
<script src="../cache/jquery.js"></script>
<div class="margin">
    <div class="jusrel">
            <input class="tagsinput cat" placeholder="نام دسته">
            <input class="tagsinput url" value="" placeholder="Url">
            <ul class='tagpl cat'></ul>
    </div>
</div>

<script>
    $('.tagpl.cat').load('fun/cat-function.php',{work:'want'});
    $('.tagsinput.url').keyup(function(e) {
        var thisu = $(this).val().replaceAll(" ","_");
        $('.tagsinput.url').val(thisu);
        if(e.which==13) {
            add_category();
        }
    })
    $('.tagsinput.cat').keyup(function(e) {

        if(e.which == 13) {
            add_category();        
        }
        else {
        var tag = $(this).val();
        var tagu = tag.replaceAll(' ','_');
        $('.tagsinput.url').val(tagu);
        }
    });

    function add_category() {
        var tag = $('.tagsinput.cat').val();
        var tagu = $('.tagsinput.url').val();
        if(tagu=='') {
            var tagu = tag.replaceAll(' ','_');
        }
        if(tag=='') {
        }
        else {
            $.post('fun/cat-function.php',{category:tag,category_link:tagu,work:'add'},function (e) {
                $('.tagpl.cat').html(e);
            })
            $('.tagsinput.cat').val('');
            $('.tagsinput.url').val('');
        }
    }
</script>