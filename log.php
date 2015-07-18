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
// * @discribe   SmartQQ日志记录
?>
<?php
//屏蔽部分错误信息
error_reporting(E_ALL ^ E_DEPRECATED ^ E_NOTICE);
require 'config.php';

if($_REQUEST['password'] != $AdminPass)
{
    exit("Wrong Password");
}
//连接数据库
require 'database.php';
mysql_query("set character set 'utf8'");

//事件日志
$sql = "INSERT INTO loguse (qqnum, groupno, action, p1, p2, p3, p4) VALUES ('".mysql_real_escape_string($_REQUEST[qqnum])."', '".mysql_real_escape_string($_REQUEST[qunnum])."', '".mysql_real_escape_string($_REQUEST[action])."', '".mysql_real_escape_string($_REQUEST[p1])."', '".mysql_real_escape_string($_REQUEST[p2])."', '".mysql_real_escape_string($_REQUEST[p3])."', '".mysql_real_escape_string($_REQUEST[p4])."')";
mysql_query($sql);

//按QQ号做记录
$sql = "SELECT * FROM logqqcount WHERE qqnum = '$_REQUEST[qqnum]'  limit 1";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);
if($row == "")   
{   
    $sql = "INSERT INTO logqqcount (qqnum, $_REQUEST[action]) VALUES ('$_REQUEST[qqnum]', 1)";
    mysql_query($sql);
}
else
{
    $temp = $row[$_REQUEST[action]] + 1;
    $sql = "UPDATE logqqcount set $_REQUEST[action] = $temp WHERE qqnum = '$_REQUEST[qqnum]'";
    mysql_query($sql);
}
//按群号做记录
if($_REQUEST[qunnum] != "NULL")
{
    $sql = "SELECT * FROM logquncount WHERE qunnum = '$_REQUEST[qunnum]'  limit 1";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    if($row == "")   
    {   
        $sql = "INSERT INTO logquncount (qunnum, $_REQUEST[action]) VALUES ('$_REQUEST[qunnum]', 1)";
        mysql_query($sql);
    }
    else
    {
        $temp = $row[$_REQUEST[action]] + 1;
        $sql = "UPDATE logquncount set $_REQUEST[action] = $temp WHERE qunnum = '$_REQUEST[qunnum]'";
        mysql_query($sql);
    }
}
?>