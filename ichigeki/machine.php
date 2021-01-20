<?php
$dsn = "mysql:host=localhost; dbname=machine_info; charset=utf8mb4";
$username = "root";
$password = "root";

try {
    $dbh = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    $msg = $e->getMessage();
}

//$id = 1;
$id = $_GET['id'];

$sql = "SELECT * FROM `machine_info` WHERE id = ? ORDER BY `machine_info`.`create_date` ASC";
$stmt = $dbh->prepare($sql);
$stmt->bindParam( 1, $id, PDO::PARAM_INT );
$stmt->execute();
while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    $machine_name = $row['machine_name'];
    $machine_id = $row['machine_id'];
    $setting_numeber = $row['setting_numeber'];
    $machine_type = $row['machine_type'];
}


$sql2 = "SELECT label_name FROM `setting_label` WHERE machine_id = ?";
$stmt2 = $dbh->prepare($sql2);
$stmt2->bindParam( 1, $id, PDO::PARAM_INT );
$stmt2->execute();
$label_names = array();
while($row = $stmt2->fetch(PDO::FETCH_ASSOC)){
    $label_names[] = $row['label_name'];
    $label_name = implode(",", $label_names);
}

$sql3 = "SELECT category_name, category_order FROM `analytics_category` WHERE machine_id = ? ORDER BY `analytics_category`.`category_order` ASC";
$stmt3 = $dbh->prepare($sql3);
$stmt3->bindParam( 1, $id, PDO::PARAM_INT );
$stmt3->execute();


//--------ページ設定--------//
	$ttl = "";
	$dec = "";
	$kw = "";

//-----------------------//
?>
<link rel="stylesheet" href="./style/css/local.css">
<link rel="stylesheet" href="./style/css/local-sp.css">


<main>
<section id="top">

    <div class="flex between">
    <div class="left">
        <div class="border">
        <p>機種</p>
        </div>
    </div>
    <div class="right">
        <div class="border">
            <label>
             <input type="radio" name='machine_type' value="0" <?php if($machine_type == 0) echo 'checked'; echo ''; ?>>スロット
            </label>
             <label>
             <input type="radio" name='machine_type' value="1" <?php if($machine_type == 1) echo 'checked'; echo ''; ?>>パチンコ
            </label>
        </div>
    </div>
    </div>
    <div class="flex between">
        <div class="left">
        <div class="border">
        <p>機種名</p>
        </div>
        </div>
        <div class="right">
        <div class="border">
        <input type="text" name="machine_name" value="<?php echo $machine_name; ?>">
        </div>
        </div>
    </div>
    <div class="flex between">
        <div class="left">
        <div class="border">
        <p>機種ID</p>
        </div>
        </div>
        <div class="right">
        <div class="border">
        <input type="text" name="machine_id" value="<?php echo $machine_id; ?>">
        </div>
        </div>
    </div>
    <div class="flex between">
        <div class="left">
        <div class="border">
        <p>設定数</p>
        </div>
        </div>
        <div class="right">
        <div class="border">
        <input type="text" name="setting_numeber" value="<?php echo $setting_numeber; ?>">
        </div>
        </div>
    </div>
    <div class="flex between">
        <div class="left">
        <div class="border">
        <p>設定ラベル</p>
        </div>
        </div>
        <div class="right">
        <div class="border flex">
        <input type="text" name="label_name" value="<?php echo $label_name; ?>">
        </div>
        </div>
    </div>
    <div class="flex between category">
        <div class="left">
        <div class="border">
        <p>解析カテゴリ</p>
        </div>
        </div>
        <div class="right">
            <div class=" between">
                
                <?php
                while($row = $stmt3->fetch(PDO::FETCH_ASSOC)){
                    $category_name = $row['category_name'];
                    echo '<div class="border"><input type="text" name="category_name" value="'.$category_name.'"></div>';
                }
                ?>
                
            </div>
        </div>
    </div>
</section>




</main>
