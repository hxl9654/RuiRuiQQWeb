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
// * @discribe   SmartQQ语库审核词条-执行命令
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
//连接OCS缓存
if($OCSServer!="NONE")
{
    $connect = new Memcache; //声明一个新的memcached链接
    $connect->addServer($OCSServer, 11211);//添加实例地址  端口号
}
//连接数据库
require 'database.php';

mysql_query("set character set 'utf8'");
if($_REQUEST['action']=="allow")
{
    $sql = "SELECT * FROM talk where no = $_REQUEST[sourceno] ";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    $enable = explode(",",$row['enable']);
    $enable[$_REQUEST['aimno']]=1;
    $aim = explode(",",$row['aim']);
    
    if($enable[0] < 0 || $enable[0] > 10)
        $enable[0] = 0;
    $enablestr = $enable[0];
    for($i=1; $i < count($aim); $i++)
    {
        if($enable[$i] < 0 || $enable[$i] > 10)
            $enable[$i] = 0;
        $enablestr = $enablestr.",".$enable[$i];
    }
    $sql = "update talk set enable = '$enablestr' where no = $_REQUEST[sourceno]";
    if($OCSServer!="NONE")
        $connect->set('SmartQQRobotTalk1Enable_'.$_REQUEST[sourceno],$enablestr,0);
    
    if (!mysql_query($sql, $con))
    {
        mysql_close($con);
        die('Error: ' . mysql_error());
    }
}
else if($_REQUEST['action']=="disallow")
{
    $sql = "SELECT * FROM talk where no = $_REQUEST[sourceno] ";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    $enable = explode(",",$row['enable']);
    $enable[$_REQUEST['aimno']]=2;    
    $aim = explode(",",$row['aim']);
    
    if($enable[0] < 0 || $enable[0] > 10)
        $enable[0] = 0;
    $enablestr = $enable[0];
    for($i=1; $i < count($aim); $i++)
    {
        if($enable[$i] < 0 || $enable[$i] > 10)
            $enable[$i] = 0;
        $enablestr = $enablestr.",".$enable[$i];
    }
    
    $sql = "update talk set enable = '$enablestr' where no = $_REQUEST[sourceno]";
    if($OCSServer!="NONE")
        $connect->set('SmartQQRobotTalk1Enable_'.$_REQUEST[sourceno],$enablestr,0);
    
    if (!mysql_query($sql, $con))
    {
        mysql_close($con);
        die('Error: ' . mysql_error());
    }
}
else if($_REQUEST['action']=="deletesource")
{
    $sql = "DELETE FROM talk WHERE no = $_REQUEST[sourceno]";
    $result = mysql_query($sql);
    if($OCSServer!="NONE")
        $connect->delete('SmartQQRobotTalk1_'.$_REQUEST[sourceno]);
}
else if($_REQUEST['action']=="allallow")
{
    $sql = "SELECT * FROM talk where no = $_REQUEST[sourceno] ";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    $enable = explode(",",$row['enable']);
    $aim = explode(",",$row['aim']);
    
    if($enable[0] != 2)
        $enablestr = 1;
    for($i=1; $i < count($aim); $i++)
    {
        if($i >= count($aim) || $enable[$i] == 0)
            $enable[$i] = 1;
        $enablestr = $enablestr.",".$enable[$i];
    }
    $sql = "update talk set enable = '$enablestr' where no = $_REQUEST[sourceno]";
    if($OCSServer!="NONE")
        $connect->set('SmartQQRobotTalk1Enable_'.$_REQUEST[sourceno],$enablestr,0);
    
    if (!mysql_query($sql, $con))
    {
        mysql_close($con);
        die('Error: ' . mysql_error());
    }
}
else if($_REQUEST['action']=="change")
{
    
}
else die("error");
echo "<script> window.close(); </script>";
?>