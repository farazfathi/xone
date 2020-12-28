<?php if(isset($_GET['install'])) {
    $servername = $_GET['server'];
    $dbusername = $_GET['dbusername'];
    $dbpass = $_GET['dbpass'];
    if($dbpass=='null') {
        $dbpass='';
    }
    $dbname = $_GET['dbname'];
    $email = $_GET['email'];
    $pass = $_GET['pass'];
    $db = new mysqli($servername,$dbusername,$dbpass,$dbname);
    if ($db -> connect_errno) {
        echo 'اطلاعات اشتباه است';
        exit();
    }
    else {
        $db->set_charset("utf8");
        $table_admin = "CREATE TABLE admins (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            email VARCHAR(50) NOT NULL,
            pass VARCHAR(30) NOT NULL,
            reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        $table_category = "CREATE TABLE category (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            category VARCHAR(50) NOT NULL,
            category_id VARCHAR(50) NOT NULL,
            category_link VARCHAR(30) NOT NULL,
            reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        $table_files = "CREATE TABLE files (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            file_url VARCHAR(200) NOT NULL,
            fileformat VARCHAR(200) NOT NULL,
            fileid VARCHAR(200) NOT NULL,
            reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        $table_tags = "CREATE TABLE tags (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            post_id VARCHAR(200) NOT NULL,
            tag_name VARCHAR(200) NOT NULL,
            tag_url VARCHAR(200) NOT NULL,
            tag_id VARCHAR(200) NOT NULL,
            reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        $table_category_posts = "CREATE TABLE category_posts (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            post_id VARCHAR(200) NOT NULL,
            cat_id VARCHAR(200) NOT NULL,
            reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        $table_posts = "CREATE TABLE posts (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            post_id VARCHAR(200) NOT NULL,
            post_url VARCHAR(200) NOT NULL,
            post_caption VARCHAR(200) NOT NULL,
            post_html VARCHAR(200) NOT NULL,
            post_title VARCHAR(200) NOT NULL,
            post_meta VARCHAR(200) NOT NULL,
            post_thumb VARCHAR(200) NOT NULL,
            post_views INT(200) NOT NULL,
            reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        $table_lists = "CREATE TABLE lists (
                    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    place_id VARCHAR(200) NOT NULL,
                    list_id VARCHAR(200) NOT NULL,
                    list_name VARCHAR(200) NOT NULL,
                    list_max int(10) NOT NULL,
                    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        $table_list_items = "CREATE TABLE list_items (
                    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    list_id VARCHAR(200) NOT NULL,
                    item_id VARCHAR(200) NOT NULL,
                    title VARCHAR(200) NOT NULL,
                    link VARCHAR(200) NOT NULL,
                    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        if($db->query($table_admin) === TRUE and $db->query($table_category) === TRUE and $db->query($table_files) === TRUE and $db->query($table_tags) === TRUE and $db->query($table_posts) === TRUE and $db->query($table_category_posts) === TRUE and $db->query($table_list_items) === TRUE and $db->query($table_lists) === TRUE) {
            $dt = "INSERT INTO admins (id,email,pass) VALUES (null,'".$_GET['email']."','".$_GET['pass']."')";
            if($db->query($dt) === TRUE) {
                $file = fopen('db.php', 'w');
                $text = '<?php $db = new mysqli("'.$servername.'","'.$_GET['dbusername'].'","'.$dbpass.'","'.$_GET['dbname'].'");$db->set_charset("utf8");?>';
                fwrite($file,$text);
                setcookie('admin_email',$_GET['email'],time()+(8600*10),'/');
                setcookie('admin_pass',$_GET['pass'],time()+(8600*10),'/');
                echo 'done';
            }
            else {
                echo 'ارور 01';
            }
        }
        else {
            echo 'نصب شده است!';
        }
    }
    exit;
}
?>
<link rel="stylesheet" href="cache/style.css">
<script src="cache/jquery.js"></script>
<div class="margin" style="width:300px">
    <div class="box" style="margin-top:20%">
        <h1>نصب زُن</h1>
        <input lang='en' type="input" placeholder="نام سرور" class="sn_x">
        <input lang='en' type="input" placeholder="نام کاربری دیتابیس" class="dbu_x">
        <input lang='en' type="input" placeholder="رمز دیتابیس" class="dbp_x">
        <input lang='en' type="input" placeholder="نام دیتابیس" class="dbn_x">
        <input lang='en' type="input" name='email' placeholder="ایمیل" class="em_x">
        <input lang='en' type="input" name="password" placeholder="پسورد" class="ps_x">
        <button class="ins_b">نصب</button>
    </div>
</div>


<script>
    $('.ins_b').click(function() {
        var sn = $('.sn_x').val();
        var dbu = $('.dbu_x').val();
        var dbp = $('.dbp_x').val();
        if(dbp==null || dbp=='') {
            var dbp = 'null';
        }
        var dbn = $('.dbn_x').val();
        var em = $('.em_x').val();
        var ps = $('.ps_x').val();
        if(sn==''||dbn==''||dbu==''||em==''||ps=='') {
            alert('تمام اطلاعات را وارد کنید')
        }
        else {
            var url = "install?install&dbname="+dbn+"&dbusername="+dbu+"&dbpass="+dbp+"&server="+sn+"&email="+em+"&pass="+ps;
            $.ajax({
                url:url,
                method:'GET',
                success:function(e) {
                    if(e=='done') {
                        window.location.replace('tools');
                    }
                    else {
                        alert(e);
                    }
                }
            })
        }
        
    })
</script>