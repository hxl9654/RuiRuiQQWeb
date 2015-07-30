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
// * @discribe   RuiRuiQQ语库添加请求审核
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

$sql = "SELECT * FROM pendingtalk WHERE statu = 0 limit 1";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);
if($row == "")   
{   
    die('没有待审核的词条');
}
else
{
    $no = $row['no'];
    $source = $row['source'];
    $aim = $row['aim'];
    $qqnum = $row['qqnum'];
    $qunnum = $row['qunnum'];
    
    $sql = "UPDATE pendingtalk set statu = 1 WHERE no = '$no'";
    mysql_query($sql);
    
    echo "no :$no  <br> ".
         "source: $source <br> ".
         "aim: $aim <br> ".
         "<a href='/addtalk.php?password=$AdminPass&source=$source&aim=$aim&qqnum=$qqnum&qunnum=$qunnum&superstudy=false' target='_blank'>通过</a>  ";
}
?>