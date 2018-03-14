<?php
//$host = 'https://dbadmin.systemdynamics.tw';
$host = 'localhost';//ajax傳表單到server是外地，在server上的php時使用DB時是本地
//$host = 'server1.prod.lionfree.net';
//host因為檔案在server上，用localhost就行了
$user = 'u2928506';
$pass = 'rogerhsieh0515';
$db = 'u2928506_lottery';
$conn = mysqli_connect($host, $user, $pass, $db) or die('Error with MySQL connection'); //跟MyMSQL連線並登入
mysqli_query($conn,"SET NAMES utf8"); //選擇編碼
//mysqli_connect(host,username,password,dbname,port,socket);
//mysqli_query(connection,query,resultmode);

?>
