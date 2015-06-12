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
// * @discribe   SmartQQ语库读取词条
?>
<?php
//解决变量未定义报错
function _rowget($str,$row)
{
    $val = !empty($row[$str]) ? $row[$str] : null;
    return $val;
}
//屏蔽部分错误信息
error_reporting(E_ALL ^ E_DEPRECATED ^ E_NOTICE);

require 'config.php';

//连接OCS缓存
if($OCSServer!="NONE")
{
    $connect = new Memcache; //声明一个新的memcached链接
    $connect->addServer($OCSServer, 11211);//添加实例地址  端口号
    
    $aim = $connect->get('SmartQQRobotTalk1_'.$_REQUEST[source]);   
    if($aim != "")
    {
        $str = explode(",",$aim);
        $aimno = $str[rand(0,count($str)-1)];
    }
    if($aimno != "")
    {
        $result = $connect->get('SmartQQRobotData1_'.$aimno);
        if($result != "")
        {
            die($result);
        }
    }
}
//连接数据库
require 'database.php';

mysql_query("set character set 'utf8'");

//读取语录数据库
if($aim == "")
{
    $sql = "SELECT * FROM talk WHERE source = '$_REQUEST[source]' ";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    if($row != "")
    {
        $aim = _rowget('aim', $row);
        $str = explode(",",$aim);
        $aimno = $str[rand(0,count($str)-1)];
        if($OCSServer!="NONE")
            $connect->set('SmartQQRobotTalk1_'.$_REQUEST[source],$aim,0);
    }
    else
    {
        mysql_close($con);
        die('None1');
    }
}
$str = explode(",",$aim);
$aimno = $str[rand(0,count($str)-1)];
if($OCSServer!="NONE")
    $result =$connect->get('SmartQQRobotData1_'.$aimno);
if($result != "")
{
    mysql_close($con);
    die($result);
}
//从回复数据库中读取语句
$sql = "SELECT * FROM data WHERE no = '$aimno' ";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);
if($row != "")
{
    $response = _rowget('data', $row); 
    if($OCSServer!="NONE")
        $connect->set('SmartQQRobotData1_'.$aimno,$response,0);
    mysql_close($con);
    die($response);
}
else
{
    mysql_close($con);
    die('None2');
}
?>