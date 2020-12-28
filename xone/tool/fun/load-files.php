<?php 
include '../../db.php';
if($_GET['last_item']==0) {
    $last = 9999999999;
}
else {
    $last = $_GET['last_item'];
}
$sql = "SELECT id,file_url,reg_date,fileid FROM files WHERE id < '".$last."' ORDER BY id DESC LIMIT 10";
$sql2 = "SELECT file_url,reg_date,fileid FROM files";
$res=$db->query($sql);
if($res->num_rows > 0) {
?>
<div class="files_l" items="<?php echo $db->query($sql2)->num_rows; ?>">
<?php
    while($row = $res->fetch_assoc()) {
        ?>
            <li item="<?=$row['id']?>" date="<?=$row['reg_date']?>">
                <a file_id="<?=$row['fileid']?>" href="<?=$row['file_url']?>"></a>
                <div class="items_file"></div>
                <div class="optfil">
                    <input type='button' file_id="<?=$row['fileid']?>" class="filedit">
                    <input type='button' file_id="<?=$row['fileid']?>" file_src="<?=$row['file_url']?>" class="filedsit">
                </div>
            </li>
        <?php
    }
}
else {
    echo 0;
    exit;
}

?>
</div>
<script>
            $('.files_l').children('li').each(function() {
            var string = $(this).children('a').attr('href');
            var format = string.substr(string.lastIndexOf('.') + 1);
            var name = string.substr(string.lastIndexOf('/') + 1);
            var fullname = name.substr(0,6)+'....'+format;
            var date = $(this).attr('date').replaceAll('-','/').substr(0,10);
            var file_id = $(this).children('a').attr('file_id');
            if(format=='jpg' || format=='jpeg' || format=='png' || format=='PNG' || format=='JPG' || format=='JPEG') {
                $(this).children('.items_file').append('<img src="'+string+'" class="imgfl"><p>'+fullname+'</p><h3>Format: '+format+'</h3><h3>Date: '+date+'</h3><h3>File ID: '+file_id+'</h3>');
            }
            else {
                $(this).children('.items_file').append('<img src="../cache/icon/file.png" class="imgfl file"><p>'+fullname+'</p><h3>Format: '+format+'</h3><h3>Date: '+date+'</h3><h3>File ID: '+file_id+'</h3>');
            }
            });

</script>