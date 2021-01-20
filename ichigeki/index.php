<?php
$dsn = "mysql:host=localhost; dbname=machine_info; charset=utf8mb4";
$username = "root";
$password = "root";

try {
    $dbh = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    $msg = $e->getMessage();
}



$sql = "SELECT * FROM `machine_info`";
$stmt = $dbh->prepare($sql);
$stmt->bindParam( 1, $id, PDO::PARAM_INT );
$stmt->execute();



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
    <h1 class="machineListTit">機種一覧</h1>
    <table>
        <tr>
            <th class="type">種別</th>
            <th class="id">機種ID</th>
            <th class="name">機種名</th>
            <th class="btn_1"></th>
            <th class="btn_2"></th>
            <th class="btn_3"></th>
        </tr>
        <?php 
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $machine_name = $row['machine_name'];
                $machine_id = $row['machine_id'];
                $id = $row['id'];
                $setting_numeber = $row['setting_numeber'];
                if($row['machine_type'] == 1){
                    $machine_type = 'S';
                } else {
                    $machine_type = 'P';
                }
                echo '<tr><td class="type"><p>'.$machine_type.'</p></td>';
                echo '<td class="id"><p>'.$machine_id.'</p></td>';
                echo '<td class="name"><p>'.$machine_name.'</p></td>';
                echo '<td class="btn_1"><a href="">表示確認</a></td>';
                echo '<td class="btn_2"><a href="./machine.php?id='.$id.'">機種情報編集</a></td>';
                echo '<td class="btn_3"><a href="./analytics.php?id='.$id.'">解析情報編集</a></td></tr>';
            }
        ?>
    </table>
</section>




</main>
