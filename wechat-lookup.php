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
// * @discribe   RuiRuiQQ-微信服务端消息获取模块
?>
<?php
require 'config.php';
if($_REQUEST[password] != $AdminPass)
    die("wrong password");
require 'database.php';

$sql = "SELECT * from wechat where response = ''";
$result = $mysqli->query($sql);
$row = mysqli_fetch_array($result);
while($row)
{
    echo $row[MsgId]."★".$row[CreateTime]."★".$row[FromUserName]."★".$row[Content];
    $row = mysqli_fetch_array($result);
    if($row)
        echo "▲";
}
$mysqli->close();
?>