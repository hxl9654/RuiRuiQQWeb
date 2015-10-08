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
// * @discribe   RuiRuiQQ群设置
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

//连接数据库
require 'database.php';

mysql_query("set character set 'utf8'");
if($_REQUEST['action']=="set")
{
    if($_REQUEST['password'] != $AdminPass)
    {
        exit("Wrong Password");
    }
    $sql = "SELECT * FROM groupmanage WHERE gno = '$_REQUEST[gno]'  limit 1";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    if($row == "")   
    {   
        $sql = "INSERT INTO groupmanage (gno, $_REQUEST[option]) VALUES ('$_REQUEST[gno]', '$_REQUEST[value]')";
        mysql_query($sql);
        mysql_close($con);
    }
    else
    {
        $sql = "UPDATE groupmanage set $_REQUEST[option] = '$_REQUEST[value]' WHERE gno = '$_REQUEST[gno]'";
        mysql_query($sql);
        mysql_close($con);
    }
    echo "{";
    echo "\"statu\":\"success\"";
    echo "}"; 
}
else if($_REQUEST['action']=="get")
{
    $sql = "SELECT * FROM groupmanage WHERE gno = '".mysql_real_escape_string($_REQUEST[gno])."'  limit 1";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    if($row != "")   
    {
        echo "{";
        echo "\"enable\":\"".$row['enable']."\",";
        echo "\"enableWeather\":\"".$row['enableWeather']."\",";
        echo "\"enableExchangeRate\":\"".$row['enableExchangeRate']."\",";
        echo "\"enableStock\":\"".$row['enableStock']."\",";
        echo "\"enableStudy\":\"".$row['enableStudy']."\",";
        echo "\"enabletalk\":\"".$row['enabletalk']."\",";
        echo "\"enablexhj\":\"".$row['enablexhj']."\",";
        echo "\"enableemoje\":\"".$row['enableemoje']."\",";
        echo "\"enableCityInfo\":\"".$row['enableCityInfo']."\",";
        echo "\"enableWiki\":\"".$row['enableWiki']."\",";
        echo "\"enableTranslate\":\"".$row['enableTranslate']."\",";
        echo "\"gno\":\"".$row['gno']."\",";
        echo "\"statu\":\"success\"";
        echo "}";
        mysql_close($con);
    }
    else
    {
        echo "{";
        echo "\"gno\":\"".str_ireplace("script","&#115;&#99;&#114;&#105;&#112;&#116;",filter_var($_REQUEST[gno], FILTER_SANITIZE_SPECIAL_CHARS))."\",";
        echo "\"statu\":\"fail\",";
        echo "\"error\":\"nodata\"";
        echo "}";   
    }
}
else
{
    echo "{";
    echo "\"gno\":\"".str_ireplace("script","&#115;&#99;&#114;&#105;&#112;&#116;",filter_var($_REQUEST[gno], FILTER_SANITIZE_SPECIAL_CHARS))."\",";
    echo "\"statu\":\"fail\",";
    echo "\"error\":\"notsupport\"";
    echo "}"; 
}
?>
