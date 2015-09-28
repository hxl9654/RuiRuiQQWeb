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
// * @discribe   RuiRuiQQ弹幕获取
?>
<?php
require 'config.php';
$connect = new Memcache; //声明一个新的memcached链接
$connect->addServer($OCSServer, 11211);//添加实例地址  端口号
$num = $connect->get('commentnum'.$_REQUEST['qunnum']);
$i = 10;
if($num < $i)
    $i = $num;
while($i)
{
    $i -= 1;
    $index = $num - $i;
    echo $connect->get('commentno'.$_REQUEST['qunnum'].'_'.$index);
    if($i > 0)
        echo "★";
}
?>