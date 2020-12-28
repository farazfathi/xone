<html>
<?php include 'db.php'; ?>
<link rel="stylesheet" href="cache/style.css">
<script src="cache/jquery.js"></script>

<div class="headxone">
    <div class="margin">
        <a class="headxonea" href="/xone/tools">XONE</a>
        <a href="/xone/setting" class="setbut"></a>
    </div>
</div>



<div class='margin'>
    <div class="box-files toll">
        <div class="top-file-box">
            <h1>آخرین مطالب</h1>
            <a  href="tool/new-post" class="inpunma-fil"></a>
        </div>
                <table class="lstpos">
                    <?php
                        if($data = $db->query("SELECT * FROM posts ORDER BY id desc LIMIT 6")) {
                            if($data->num_rows == 0) {
                                echo '<p style="text-align:center;margin:20px;">مطلبی وجود ندارد</p>';
                            }
                            else {
                                ?>
                                    <tr>
                                        <th><h2>عنوان</h2></th>
                                        <th><h2>بازدید</h2></th>
                                        <th><h2  style="margin:10px 0">تاریخ</h2></th>
                                    </tr>
                                <?php
                                while($row = $data->fetch_assoc()) {
                                    ?>
                                    
                                        <tr>
                                            
                                                    <th><a href="tool/edit-post?id=<?=$row['post_id']?>"><?=$row['post_title']?></a></th>
                                                    <th><h2><?=$row['post_views']?></h2></th>
                                                    <th><h2><?=$row['reg_date']?></h2></th>
                                        </tr>
                                    <?php
                                }
                            }
                        }
                    ?>
                </table>

        <div class="lassps"></div>

    </div>
</div>
</html>

<script>
    $('table.lstpos tr').click(function() {
        //alert();
        $(this).children('th').children('a').click();
    });
</script>