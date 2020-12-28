<!DOCTYPE html>
<html>
<title>موبووب - طراحی وبسایت | خدمات سئو</title>
<?php
include 'header.php';
?>
<section class="moshv blogm">
	<div class="margin">
        <h3>دنبال چه مطلبی هستید؟</h3>
        <div class="margin" style='width:400px'>
            <div class="inpunm">
                <img src="cache/icons/search.png">
                <input type="input" name="text" placeholder="جستجو" class="onlsea">
            </div>
        </div>
	</div>
</section>

<div class="whermi">
    <div class="margin">
        <h3>شما کجا هستید؟</h3>
        <a href=""><h1>موبووب</h1></a>
        <img src="cache/icons/left.png">
        <a href=""><h1>بلاگ</h1></a>
    </div>
</div>
    
<main>
<div class="margin">
    <nav class="leftmn">
        <div class="listtmm">
        <ul>
            <div class="tith">
                <div class="chshm" style="background:white"></div>
                <h2 class="namelis">موضوعات</h2>
            </div>
            <div class="itemstmp">
            <li>
                <a class="linkalomn" href=''>
                    <h1 class="sldour">سئو</h1>
                </a>
            </li>
            </div>
        </ul>
        </div>
        <!---
        <ul>
            <div class="tith">
                <div class="chshm" style="background:#407bff"></div>
                <h2>برترین مطالب</h2>
            </div>
            <li><a href=''><h1>علی الخصوص طراحان خلاقی و فرهنگ پیشرو</h1></a></li>
            <li><a href=''><h1>در این صورت می توان امید داشت</h1></a></li>
            <li><a href=''><h1>وزمان مورد نیاز شامل حروفچینی </h1></a></li>
            <li><a href=''><h1>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم</h1></a></li>
            <li><a href=''><h1>راهکارها و شرایط سخت تایپ به</h1></a></li>
            <li><a href=''><h1>علی الخصوص طراحان خلاقی و فرهنگ پیشرو</h1></a></li>
            <li><a href=''><h1>در این صورت می توان امید داشت</h1></a></li>
            <li><a href=''><h1>وزمان مورد نیاز شامل حروفچینی </h1></a></li>
            <li><a href=''><h1>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم</h1></a></li>
            <li><a href=''><h1>راهکارها و شرایط سخت تایپ به</h1></a></li>
        </ul>-->
    </nav>
    
    <section class="posts">
        <div class="befps">
            <div class="righmor blog">
                <img src="cache/icons/recent.png">
                <h3>آخرین مطالب</h3>
            </div>
            <div class="show-sett">
                <img src="cache/icons/grid.png" class="gridsh">
                <img src="cache/icons/list.png" class="listsh">
            </div>
        </div>
    <div class="tmpl">
        <article class="post_article">
            <a class='perma' href=""></a>
            <img class="imgthumb" src=''>
            <div class="leftarticle">
            <h1 class="tit_art"></h1>
            <div class="capt"></div>
            </div>
            <input type="button" value="بیشتر" class="bishtart">
        </article>
    </div>
</section>
</div>   
</main>
<script>

</script>  
<?php include 'footer.php'; ?>
</html>
<script>
    $(document).xone({
    want : [
        'posts','lists'
    ],
    posts: {
        'post_template':'.tmpl',
        'post_place': '.posts',
        'post':'.post_article',
        'post_order':'latest',
        'items':5,
        'link_before':'/blog/',
        'link_after':'',
        'post_link':'.perma',
        'post_image':'.imgthumb',
        'post_caption':'.capt',
        'post_title':'.tit_art'
    },
    lists: {
        'blog_left': {
            'list_template':'.leftmn',
            'list_place' : '.listtmm',
            'list_name' : '.namelis',
            'item_template' : '.itemstmp',
            'item_link' : '.linkalomn',
            'item_title' : '.sldour',
        }
    }
    })
</script>