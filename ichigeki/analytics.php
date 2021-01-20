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

$sql = "SELECT category_name, category_id FROM `analytics_category` WHERE machine_id = ?";
$stmt = $dbh->prepare($sql);
$stmt->bindParam( 1, $id, PDO::PARAM_INT );
$stmt->execute();
$category_names = array();


$sql2 = "SELECT label_name FROM `setting_label` WHERE machine_id = ?";
$stmt2 = $dbh->prepare($sql2);
$stmt2->bindParam( 1, $id, PDO::PARAM_INT );
$stmt2->execute();
$setting_labels = array();
$setting_label = '';
while($row = $stmt2->fetch(PDO::FETCH_ASSOC)){
    $setting_labels[] = $row['label_name'];
    $setting_label .= '<div class="labelItem">設定'.$row['label_name'].'</div>';
}




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
<?php
$category_ids = array();
while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    $category_ids[$row['category_id']] = $row['category_name'];
}
foreach($category_ids as $key => $value){
    echo '<div class="cateName"><p>'.$value.'</p></div>';
    echo '<div class="analyticsBox">';
    echo '<div class="labelName flex">'.$setting_label.'</div>';
    
    $sql3 = "SELECT info_id,info_name FROM analytics_info WHERE category_id=?";
    $stmt3 = $dbh->prepare($sql3);
    $stmt3->bindParam( 1, $key, PDO::PARAM_INT );
    $stmt3->execute();
    while($row = $stmt3->fetch(PDO::FETCH_ASSOC)){
       $info_id = $row['info_id'];
       $info_name = $row['info_name'];
       echo '<div class="flex"><div class="infoName"><input type="text" name="info_name" value="'.$info_name.'"></div>';
        echo '<div class="valueList">';
        $sql4 = "SELECT setting_value,setting_label FROM analytics_value WHERE info_id=?";
        $stmt4 = $dbh->prepare($sql4);
        $stmt4->bindParam( 1, $info_id, PDO::PARAM_INT );
        $stmt4->execute();
        
        while($row = $stmt4->fetch(PDO::FETCH_ASSOC)){
            $setting_value = $row['setting_value'];
            foreach($setting_labels as $label_name){
            if($label_name == $row['setting_label']){
                echo '<div class="valueItem"><input type="text" name="setting_value" value="'.$setting_value.'"></div>';
            }

        }
        }
        echo '</div>';
        echo '</div>';
    }
    echo '</div>';
    

}
    //var_dump($category_ids);

        


?>


</section>




</main>
