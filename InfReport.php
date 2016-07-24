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
// * @discribe   RuiRuiQQ反馈信息记录
?>
<?php
//屏蔽部分错误信息
error_reporting(E_ALL ^ E_DEPRECATED ^ E_NOTICE);
require 'config.php';

//连接数据库
require 'database.php';

//过滤恶意字符
$adminqqsql = str_ireplace("script","&#115;&#99;&#114;&#105;&#112;&#116;",filter_var($mysqli->real_escape_string($_REQUEST['adminqq']), FILTER_SANITIZE_SPECIAL_CHARS));
$qqsql = str_ireplace("script","&#115;&#99;&#114;&#105;&#112;&#116;",filter_var($mysqli->real_escape_string($_REQUEST['qq']), FILTER_SANITIZE_SPECIAL_CHARS));

//写入
$sql = "INSERT INTO loginfreport (qq, adminqq) VALUES ('$qqsql','$adminqqsql')";
if (!$mysqli->query($sql))
{
    $mysqli->close();
    die('Error: ' . $mysqli->error);
}
else 
    die('ok');
?>