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
// * @discribe   RuiRuiQQ语库审核词条
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
//连接数据库
require 'database.php';

$mysqli->query("set character set 'utf8'");

//读取语录数据库

$sql = "SELECT * FROM talk";
$result = $mysqli->query($sql);
$flag = 0;
while($row = mysqli_fetch_array($result))
{
    
    $no = $row['no'];
    $source = $row['source'];
    $aim1 = $row['aim'];
    $aim = explode(",",$row['aim']);
    $enable = explode(",",$row['enable']);
    for($i = count($aim) - 1; $i >= 0; $i--)
    {
        if(count($enable) <= i || $enable[$i] == 0 || $enable[$i] == 3 || $enable[$i] == "")
        {
            $flag = 1;
            break;
        }       
    }    
    if($flag == 1)break;
} 
if($flag == 1)
{
    echo "no :{$no}  <br> ".
         "source: ".str_ireplace("script","&#115;&#99;&#114;&#105;&#112;&#116;",filter_var($source, FILTER_SANITIZE_SPECIAL_CHARS))." <br> ".
         "aim: {$aim1} <br> ".
         "<a href='ActionCheckDic.php?password=$_REQUEST[password]&action=deletesource&sourceno=$no&source=$source' target='_blank'>删除整句</a> <br> ".
         "<a href='ActionCheckDic.php?password=$_REQUEST[password]&action=allallow&sourceno=$no' target='_blank'>全部通过</a> <br> ".
         "--------------------------------<br>";  
    for($i = count($aim) - 1; $i >= 0; $i--)
    {
        if(count($enable) <= i || $enable[$i] == 0 || $enable[$i] == 3 || $enable[$i] == "")
        {
            $sql = "SELECT * FROM data where no = $aim[$i] limit 1";
            $result = $mysqli->query($sql);
            $row = mysqli_fetch_array($result);
            $data = str_ireplace("script","&#115;&#99;&#114;&#105;&#112;&#116;",filter_var($row['data'], FILTER_SANITIZE_SPECIAL_CHARS));
            echo "data :{$data}";
            echo "<a href='ActionCheckDic.php?password=$_REQUEST[password]&action=allow&sourceno=$no&aimno=$i' target='_blank'>通过</a>";
            echo "&nbsp;&nbsp;";
            echo "<a href='ActionCheckDic.php?password=$_REQUEST[password]&action=disallow&sourceno=$no&aimno=$i' target='_blank'>屏蔽</a>";
            echo "&nbsp;&nbsp;";
            echo "<a href='#'>修改</a> <br> ";
            $flag=1;
        }
    }
}
else echo "没有未审核的记录。";
?>