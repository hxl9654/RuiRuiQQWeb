<?php
// *   This program is free software: you can redistribute it and/or modify
// *   it under the terms of the GNU General Public License as published by
// *   the Free Software Foundation, either version 3 of the License, or
// *   (at your option) any later version.
// *
// *   This program is distributed in the hope that it will be useful,
// *   but WITHOUT ANY WARRANTY; without even the implied warranty of
// *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// *   GNU General Public License for more details.
// *
// *   You should have received a copy of the GNU General Public License
// *   along with this program.  If not, see <http://www.gnu.org/licenses/>.
// *
// * @author     Xianglong He
// * @copyright  Copyright (c) 2015 Xianglong He. (http://tec.hxlxz.com)
// * @license    http://www.gnu.org/licenses/     GPL v3
// * @version    1.0
// * @discribe   天气信息获取
?>
<?php
error_reporting(E_ALL ^ E_DEPRECATED ^ E_NOTICE);
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
    $sql = "SELECT * FROM weathercityid WHERE city = '".$mysqli->real_escape_string($_REQUEST[city])."' limit 1";
    $result = $mysqli->query($sql);
    $row = mysqli_fetch_array($result);
    $areaid = _rowget('id', $row);
    if($areaid == '')
    {
        die("NoCity");
    }
    if($flag == 0)
        $connect->set('SmartQQRobotWeatherCityID_' . $_REQUEST[city], $areaid, 0);
}

$date = date("YmdHi");
$URLBase = "http://open.weather.com.cn/data/?areaid=" . $areaid . "&type=" . $_REQUEST[type] . "_v&date=" . $date . "&appid=";

$public_key = $URLBase.$appid;
$key = base64_encode(hash_hmac('sha1', $public_key, $private_key,TRUE));
 
$URL = $URLBase . $appid_six . "&key=" . urlencode($key);

$result = file_get_contents($URL);
echo $result;
?>
