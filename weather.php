<?php
//解决变量未定义报错
function _rowget($str,$row)
{
    $val = !empty($row[$str]) ? $row[$str] : null;
    return $val;
}
set_time_limit(0);
require 'config.php';
require 'database.php';

$private_key = WeatherAPIKey;
$appid = WeatherAPIID;
$appid_six = substr($appid, 0, 6);
$areaid = '';

$flag = 0;
if($OCSServer != "NONE")
{
    $connect = new Memcache; //声明一个新的memcached链接
    $connect->addServer($OCSServer, 11211);//添加实例地址  端口号
    
    $areaid = $connect->get('SmartQQRobotWeatherCityID_' . $_REQUEST[city]);
}
else
    $flag = 1;
if($areaid == '')
{
    $sql = "SELECT * FROM weathercityid WHERE city = '".mysql_real_escape_string($_REQUEST[city])."' limit 1";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    $areaid = _rowget('id', $row);
    if($flag == 0)
        $connect->set('SmartQQRobotWeatherCityID_' . $_REQUEST[city],$areaid,0);
}

$date = date("YmdHi");
$URLBase = "http://open.weather.com.cn/data/?areaid=" . $areaid . "&type=" . $_REQUEST[type] . "_v&date=" . $date . "&appid=";

$public_key = $URLBase.$appid;
$key = base64_encode(hash_hmac('sha1', $public_key, $private_key,TRUE));
 
$URL = $URLBase . $appid_six . "&key=" . urlencode($key);

$result = file_get_contents($URL);
echo $result;
?>
