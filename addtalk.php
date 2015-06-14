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
// * @discribe   SmartQQ语库添加词条
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

if($_REQUEST['password'] != $AdminPass)
{
    exit("Wrong Password");
}

if($OCSServer!="NONE")
{
    $connect = new Memcache; //声明一个新的memcached链接
    $connect->addServer($OCSServer, 11211);//添加实例地址  端口号
}
//连接数据库
require 'database.php';

mysql_query("set character set 'utf8'");

//写入回复语句并获取编号
$sql = "SELECT * FROM data WHERE data = '$_REQUEST[aim]' ";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);
if($row == "")
{
    $sql = "INSERT INTO data (data) VALUES ('$_REQUEST[aim]')";
    if (!mysql_query($sql, $con))
    {
        mysql_close($con);
        die('Error: ' . mysql_error());
    }
    $sql = "SELECT * FROM data WHERE data = '$_REQUEST[aim]' ";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);   
}
$aimno = _rowget('no', $row);
if($OCSServer!="NONE")
    $connect->set('SmartQQRobotData1_'.$aimno,$_REQUEST[aim],0);
//寻找是否存在原语句
$sql = "SELECT * FROM talk WHERE source = '$_REQUEST[source]' ";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);
if($row != "")
{
    $aim = _rowget('aim', $row);
    $no = _rowget('no', $row);
    
    $str = explode(",",$aim);
    for($i = 0; $i<count($str);$i ++)
    {
        if($str[$i] == $aimno)
        {
            mysql_close($con);
            die('Already');
        }
    }
    //向数据库添加数据
    $sql = "update talk set aim = '$aim,$aimno' where no = $no";
    if($OCSServer!="NONE")
        $connect->set('SmartQQRobotTalk1_'.$_REQUEST[source],$aim.','.$aimno,0);
    
    if (!mysql_query($sql, $con))
    {
        mysql_close($con);
        die('Error: ' . mysql_error());
    }
}
else
{
    $sql = "INSERT INTO talk (source, aim) VALUES ('$_REQUEST[source]', '$aimno')";
    if($OCSServer!="NONE")
        $connect->set('SmartQQRobotTalk1_'.$_REQUEST[source],$aimno,0);
    if (!mysql_query($sql, $con))
    {
        mysql_close($con);
        die('Error: ' . mysql_error());
    }
}
$sql = "INSERT INTO log (source, aim, qqnum) VALUES ('$_REQUEST[source]', '$_REQUEST[aim]', '$_REQUEST[qqnum]')";
if (!mysql_query($sql, $con))
{
    mysql_close($con);
    die('Error: ' . mysql_error());
}

mysql_close($con);
die('Success');

?>