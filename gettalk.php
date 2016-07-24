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
// * @discribe   RuiRuiQQ语库读取词条
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
require 'database.php';
$flag = 0;
$flag1 = 0;
$sourcesql = $mysqli->real_escape_string($_REQUEST[source]);
$sourceunsql = $_REQUEST[source];
//连接OCS缓存
if($OCSServer!="NONE")
{
    $connect = new Memcache; //声明一个新的memcached链接
    $connect->addServer($OCSServer, 11211);//添加实例地址  端口号
    
    $aim = $connect->get('SmartQQRobotTalk1_'.$sourceunsql);

    if($aim != "")
    {
        $SourceNo = $connect->get('SmartQQRobotTalk1SourceNo_'.$sourceunsql);        
        if($SourceNo == "")
        {
            $sql = "SELECT * FROM talk WHERE source = '$sourcesql' limit 1";
            $result = $mysqli->query($sql);
            $row = mysqli_fetch_array($result);
            $SourceNo = _rowget('no', $row);
            $connect->set('SmartQQRobotTalk1SourceNo_'.$sourceunsql,$SourceNo,0);
        }
        $enable = $connect->get('SmartQQRobotTalk1Enable_'.$SourceNo);
        if($enable == "")
        {
            if($row == "")
            {
                $sql = "SELECT * FROM talk WHERE source = '$sourcesql' limit 1";
                $result = $mysqli->query($sql);
                $row = mysqli_fetch_array($result);
            }
            $enable = _rowget('enable', $row);
            $connect->set('SmartQQRobotTalk1Enable_'.$SourceNo,$enable,0);
        }
        
        $str = explode(",",$aim);
        
        $enable1 = explode(",",$enable);
        for($i = 0; $i < count($enable1); $i++)
        {
            if($enable1[$i] == 1 || $enable1[$i] == 3)
                $flag = 1;
        }
        if($flag == 1)
        {
            while(1)
            {
                $index = rand(0, count($str) - 1);
                if(($enable1[$index] == 1 || $enable1[$index] == 3) && $index < count($enable1))
                    break;
            }

            $aimno = $str[$index];
        }
        else 
        {
            $mysqli->close();
            if($flag1 == 1)
                die('None3');
            else die('None4');
        }
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

//读取语录数据库
$flag = 0;
$flag1 = 0;
if($aim == "")
{
    $sql = "SELECT * FROM talk WHERE source = '$sourcesql' limit 1";
    $result = $mysqli->query($sql);
    $row = mysqli_fetch_array($result);
    if($row != "")
    {
        $aim = _rowget('aim', $row);
        $str = explode(",",$aim);
        $enable1 = explode(",",_rowget('enable', $row));
        for($i=0; $i < count($enable1); $i++)
        {
            if($enable1[$i] == 1 || $enable1[$i] == 3)
                $flag = 1;
        }
        if($flag == 1)
        {
            while(1)
            {
                $index = rand(0, count($str) - 1);
                if(($enable1[$index] == 1 || $enable1[$index] == 3) && $index < count($enable1))
                    break;
            }

            $aimno = $str[$index];
            if($OCSServer!="NONE")
            {
                $connect->set('SmartQQRobotTalk1_'.$sourceunsql,$aim,0);
            }
        }
        else 
        {
            $mysqli->close();
            if($flag1 == 1)
                die('None3');
            else die('None4');
        }
    }
    else
    {
        $mysqli->close();
        die('None1');
    }
}
//从回复数据库中读取语句
$sql = "SELECT * FROM data WHERE no = '$aimno' limit 1";
$result = $mysqli->query($sql);
$row = mysqli_fetch_array($result);
if($row != "")
{
    $response = _rowget('data', $row); 
    if($OCSServer!="NONE")
    {
        $connect->set('SmartQQRobotData1_'.$aimno,$response,0);
    }
    $mysqli->close();
    die($response);
}
else
{
    $mysqli->close();
    die('None2');
}
?>