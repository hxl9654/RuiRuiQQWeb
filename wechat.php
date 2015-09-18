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
// * @discribe   RuiRuiQQ-微信主模块
// * 本文件使用了腾讯公司提供的样例代码
?>
<?php
error_reporting(E_ALL ^ E_DEPRECATED ^ E_NOTICE);
//define your token
define("TOKEN", "KwYUS8EvoIYMPNGL4ChzMuCAo5vLDEc9");
$wechatObj = new wechatCallbackapiTest();
$wechatObj->responseMsg();
//$wechatObj->valid();
class wechatCallbackapiTest
{
	public function responseMsg()
    {
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        libxml_disable_entity_loader(true);
        $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);       
        $time = time();
        $msgType = "text";
        $textTpl = "<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[%s]]></MsgType>
                    <Content><![CDATA[%s]]></Content>
                    <FuncFlag>0</FuncFlag>
                    </xml>"; 
        require 'config.php';
        require 'database.php';
        $fromUsername = mysql_real_escape_string($postObj->FromUserName);
        $toUsername = mysql_real_escape_string($postObj->ToUserName);
        $CreateTime = mysql_real_escape_string($postObj->CreateTime);
        $Content = mysql_real_escape_string($postObj->Content);
        $MsgId = mysql_real_escape_string($postObj->MsgId);
        
        $connect = new Memcache; //声明一个新的memcached链接
        $connect->addServer($OCSServer, 11211);//添加实例地址  端口号   
        $contentStr = $connect->get('RuiRuiWechat_'.$postObj->MsgId);
        if($contentStr != "")
        {
            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
            die($resultStr);
        }
        
        require 'database.php';    

        //$sql = "INSERT INTO wechat (ToUserName, FromUserName, CreateTime, MsgType, Content, MsgId) VALUES ('$toUsername', '$fromUsername', '$postObj->CreateTime', '$postObj->MsgType', '$postObj->Content', '$postObj->MsgId')";
        $sql = "INSERT INTO wechat (FromUserName, CreateTime, Content, MsgId) VALUES ('$fromUsername', '$CreateTime', '$Content', '$MsgId')";
        mysql_query($sql, $con);
        
        $i = 50;
        while($i > 0)
        {
            $i -= 1;
            usleep(100000);
            $contentStr = $connect->get('RuiRuiWechat_'.$postObj->MsgId);
            if($contentStr != "")
            {               
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                die($resultStr);
            }
        }
        
        
        //$contentStr = "RuiRui is testing, resived:\n".$postObj->Content;
        
    }
		
	private function checkSignature()
	{
        // you must define TOKEN by yourself
        if (!defined("TOKEN")) {
            throw new Exception('TOKEN is not defined!');
        }
        
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        		
		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
    
    public function valid()
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature()){
        	echo $echoStr;
        	exit;
        }
    }
}

?>