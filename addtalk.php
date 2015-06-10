<!--
 *   This program is free software: you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation, either version 3 of the License, or
 *   (at your option) any later version.
 *
 *   This program is distributed in the hope that it will be useful,
 *   but WITHOUT ANY WARRANTY; without even the implied warranty of
 *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *   GNU General Public License for more details.
 *
 *   You should have received a copy of the GNU General Public License
 *   along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @author     Xianglong He
 * @copyright  Copyright (c) 2015 Xianglong He. (http://tec.hxlxz.com)
 * @license    http://www.gnu.org/licenses/     GPL v3
 * @version    1.0
 * @discribe   SmartQQ语库添加词条
-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>In Progress...</title>
</head>

<body>
<?php
//解决变量未定义报错
function _rowget($str,$row)
{
    $val = !empty($row[$str]) ? $row[$str] : null;
    return $val;
}
//屏蔽部分错误信息
error_reporting(E_ALL ^ E_DEPRECATED ^ E_NOTICE);

//连接数据库
require 'database.php';

if($_REQUEST['password'] != $AdminPass)
{
    mysql_close($con);
    exit("Wrong Password");
}

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

    if (!mysql_query($sql, $con))
    {
        mysql_close($con);
        die('Error: ' . mysql_error());
    }
}
else
{
    $sql = "INSERT INTO talk (source, aim) VALUES ('$_REQUEST[source]', '$aimno')";
    if (!mysql_query($sql, $con))
    {
        mysql_close($con);
        die('Error: ' . mysql_error());
    }
}
mysql_close($con);
die('Success');

?>