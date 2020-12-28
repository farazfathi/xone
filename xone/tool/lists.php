<link rel="stylesheet" href="/xone/cache/style.css">
<script src="../cache/jquery.js"></script>
<div class='margin'>
<?php include '../db.php'; ?>
    <h1 class="tlsh287k">ابزار</h1>
    <div class="toolscl">
        <div class="divwidi">
            <h1>برترین مطالب</h1>
            <select list_name="برترین مطالب" list_id="popular">
                <option list_id="none">انتخاب مکان</option>
            </select>
        </div>
        <div class="divwidi">
            <h1>آخرین مطالب</h1>
            <select list_name="آخرین مطالب" list_id="latest">
                <option list_id="none">انتخاب مکان</option>
            </select>
        </div>

        <div class="creeetcous">
            <div class="avlsh">
                <h1>ایجاد لیست سفارشی</h1>
                <div class="logmor"></div>
            </div>

            <div class="afterfln">
                <div class="lftasdc">
                    <ul>
                        <li class="postbiarfr">
                            <h1>مطالب</h1>
                            <div class="afteracivcs">
                                <ul>
                                    <?php
                                        if($res = $db->query("SELECT * FROM posts")) {
                                            if($res->num_rows==0) {
                                                echo '<p>مطلبی وجود ندارد</p>';
                                            }
                                            else {
                                                while($row = $res->fetch_assoc()) {
                                                    ?>
                                                        <li post_url="<?=$row['post_url'];?>" post_id="<?=$row['post_id'];?>">
                                                            <p><?=$row['post_title'];?></p>
                                                            <div class="logmor"></div>
                                                        </li>

                                                    <?php
                                                }
                                            }
                                        }
                                    ?>
                                </ul>
                            </div>
                        </li>
                        <li class="postbiarfr">
                            <h1>لینک سفارشی</h1>
                            <div class="afteracivcs">
                                <input type="input" class="fdnmst" placeholder="عنوان">
                                <input type="input" class="fdnsdsdmst" placeholder="URL">
                                <input type="button" class="sbtinptuu" value="ثبت">
                            </div>
                        </li>
                    </ul>
                </div>


                <div class="rghtacd">
                    <div class="fculap">

                    </div>
                </div>



                <div id="btn" class="butmfor">
                    <input type="name" placeholder="نام لیست" class="flninoesm">
                    <input  type="button" value="اضافه کردن" class="nmezfnc">
                    <select class="inmbidm">
                        <option list_id="none">انتخاب مکان</option>
                    </select>
                </div>
            </div>

        </div>
    </div>
    <div class="box-files toll">
        <div class="top-file-box">
            <h1>مکان ها</h1>
        </div>
        <div class="listsx">
        </div>
    </div>
</div>
<script>
$('.nmezfnc').click(function() {

    var array = {
        want:'coustom',
        lists:[],
        info:[],
    };
    var list_name = $('.flninoesm').val();
    var place_name = $('.inmbidm').val();
    var place_id = $('option:contains("'+place_name+'")').attr('list_id');
    array['info'].push({
        list:list_name,
        place:place_id,
    });


    $('.fculap li').each(function() {
        var title = $(this).children('p').html();
        var url = $(this).attr('item_url');
        array['lists'].push({
            title:title,
            url:url,
        });
    });
    //alert(array['info'][0]['place']);
    if(array['lists'].length == 0 || array['info'][0]['place']=='none' || $('.flninoesm').val()=='') {
        alert('اطلاعات کامل نیست');
    }
    else {
        $.ajax({
            url: 'fun/lists_setting.php',
            data: array,
            type:'post',
            dataType:'json',
            success:function(data) {
                if(data['success'][0]['success']==false) {
                    alert(data['success'][0]['error']);
                }
                else {
                    $('.listsx').load('fun/load-lists.php?want=lists_html');
                    $('.inmbidm').prop('selectedIndex',0);
                    $('.fculap').html('');
                    $('.flninoesm').val('');
                    $('.avlsh').click();
                }
            }
        });
    }
});












$('.sbtinptuu').click(function() {
    var title = $('.fdnmst').val();
    var url = $('.fdnsdsdmst').val();
    if(title=='' || title==null || url=='' || url==null) {
        alert('لطفا همه اطلاعات را وارد کنید');
    }
    else {
        $('.fculap').append('<li item_url="'+url+'"><p>'+title+'</p><input type="button" class="nmdhzfqbd"></li>');
    }
})

$('body').on('click','.nmdhzfqbd',function () {
    $(this).parent('li').remove();
})

$('.afteracivcs li').click(function() {
    var url = $(this).attr('post_url');
    var title = $(this).children('p').html();
    $('.fculap').append('<li item_url="'+url+'"><p>'+title+'</p><input type="button" class="nmdhzfqbd"></li>');
});
$('.postbiarfr h1').click(function() {
    $(this).parent('.postbiarfr').toggleClass('active');
})

$('.listsx').load('fun/load-lists.php?want=lists_html');
$.post('fun/load-lists.php?want=lists_options',function(data) {
    $('.divwidi').each(function() {
        $(this).children('select').append(data);
    });
    $('.inmbidm').append(data);
});

$('.divwidi select').on('change',function(x){
    var item = $(this);
    var list_name = $(this).attr('list_name');
    //alert(list_name);
    var list_id = $(this).attr('list_id');
    var place_id = $('option:contains("'+$(this).val()+'")').attr('list_id');
    if(place_id=='none') {
        return false;
    }
    else {
        $.ajax({
            url : 'fun/lists_setting.php',
            type: 'POST',
            data: {list_id:list_id,place_id:place_id,list_name:list_name,want:'add'},
            dataType: 'json',
            success:function(data) {
             //   alert(data['success'][0]['success']);

                //alert(data);
            if(data['success'][0]['success']==false) {
                alert(data['success'][0]['error']);
                item.prop('selectedIndex',0);
            }
            else {
                $('.listsx').load('fun/load-lists.php?want=lists_html');
                item.prop('selectedIndex',0);

            }
        
            }});
    }
});

$('body').on('click','input.delinl',function() {
    var list_id = $(this).attr('list_id');
    var place_id = $(this).attr('place_id');
    $.ajax({
            url : 'fun/lists_setting.php',
            type: 'POST',
            data: {list_id:list_id,place_id:place_id,want:'del'},
            dataType: 'json',
            success:function(data) {
             //   alert(data['success'][0]['success']);

                //alert(data);
            if(data['success'][0]['success']==false) {
                alert(data['success'][0]['error']);
            }
            else {
                $('.listsx').load('fun/load-lists.php?want=lists_html');
            }
        
    }});
});
$('body').on('change','input.listmx',function() {
    var list_id = $(this).attr('list_id');
    var place_id = $(this).attr('place_id');
    var max = $(this).val();
    if(max>15) {
        $(this).val(15);
    }
    $.ajax({
            url : 'fun/lists_setting.php',
            type: 'POST',
            data: {list_id:list_id,place_id:place_id,list_max:max,want:'change_max'},
            dataType: 'json',
            success:function(data) {
            if(data['success'][0]['success']==false) {
                alert(data['success'][0]['error']);
            }
            else {
                return false;
            }
    }});
});


$('.avlsh').click(function() {
    $(this).parent().toggleClass('active')
});
</script>