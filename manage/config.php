<?php

ini_set('display_errors', 1);
$dsn = "mysql:host=mysql145.phy.lolipop.lan; dbname=LAA1126384-syutoito; charset=utf8mb4";
$username = "LAA1126384";
$password = "sitositosito111";

function h($s){
  return htmlspecialchars($s, ENT_QUOTES, 'utf-8');
}

function getOptionHtml($master_data_ay, $value,$init="")
{
	//0と空を区別するため===で判別するが、文字列と数値が混在するため
	//valueの値を文字列に統一する
	$value = (string)$value;
	$html = '';
	if(!empty($init)){
		$html .= "<option value=''>". $init ."</option>";
	}else{
		$html .= "<option value=''>--</option>";
	}
	foreach ($master_data_ay as $key => $val) {
		$key = (string)$key;
		//print $val;
		$selected = '';
		if ($value === $key) {
			$selected = ' selected';
		}
		$html .= "<option value='$key'$selected>$val</option>";
	}
	return $html;
}


//年配列
function mkYearAy(){
$year_ay = array();
$year_ay[0] = date("Y");
for($i=1;$i<10;$i++){
    $year_count = $i.' year';
    $year_ay[$i] = date("Y", strtotime($year_count));;
}
    return $year_ay;
}

//月配列
function mkMonthAy(){
	$month_ay = array();

	for($i=1;$i<13;$i++){
		$month_ay[$i] = $i;
	}

	return $month_ay;
}

//日配列
function mkDayAy(){
	$day_ay = array();

	for($i=1;$i<32;$i++){
		$day_ay[$i] = $i;
	}

	return $day_ay;
}

?>
