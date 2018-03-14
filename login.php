<?php
//require 'hunt/php/session_start.php';
//require 'hunt/php/dbconnect.php';
//header("Content-Type: text/html; charset=utf-8");
require_once ('php/dbconnect.php');
session_start();
if(isset($_SESSION['pid']))
    header("Location: php/539.php");
if((isset($_POST['user']))&&(isset($_POST['password']))){
    $acc=mysqli_real_escape_string($conn,$_POST['user']);
    $pwd=mysqli_real_escape_string($conn,$_POST['password']);
    $sql="SELECT * FROM `account` WHERE `user`='".$acc."' AND `password`='".$pwd."'";
    //$result=mysqli_query($sql,$conn);
    $result=mysqli_query($conn,$sql);
    $rowcount=mysqli_num_rows($result);
    if($rowcount==0||$rowcount>1)
        echo "<p align=center><font color=red>帳號密碼錯誤...</font><p>";
    else{
        $rows=mysqli_fetch_array($result);
        $_SESSION['pid']=$rows['UID'];//因資料庫那的欄位為PID
        /*$sql1="SELECT * FROM `played_state` WHERE `pid` =".$_SESSION['pid'];
        $sql2="SELECT * FROM `playing_state` WHERE `pid` =".$_SESSION['pid'];
        $result1=mysqli_query($conn,$sql1);
        $rows1=mysqli_fetch_array($result1);
        $result2=mysqli_query($conn,$sql2);
        $rows2=mysqli_fetch_array($result2);*/
	//	echo $rows1['pid'];
        /*if((!isset($rows1['pid']))&&(!isset($rows2['pid']))){
            //echo "已新增";
            $sql3="INSERT INTO `played_state` (`pid`,`unit`) VALUES (".$_SESSION['pid'].",'010000')";
            $sql4="INSERT INTO `playing_state` (`pid`,`unit`) VALUES (".$_SESSION['pid'].",'010000')";
            mysqli_query($conn,$sql3);
            mysqli_query($conn,$sql4);
        }*/
		
        header("Location: php/539.php");
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<script type="text/javascript" src="jQuery/jquery-2.1.4.min.js"></script>
<!--<script src="js/database_ajax.js"></script>
<script src="js/logv1.js"></script>-->
<!--<script src="hunt/js/login.js"></script>-->
<meta charset="UTF-8">
<script type="text/javascript">

</script>
<style type="text/css">
#form{
    position:absolute;
    top:30%;
    left:40%;
}
#background{
    position:absolute;
    width:100%;
    height:100%;
	overflow-x:hidden;
	overflow-y:hidden;
}
#text{
    font-size:20px;
    font-weight:bolder;
    text-align:center;
}
#login{
    position:absolute;
    left:38%;
}
caption{
    position:relative;
    left:2%;
}
body{
    margin:0 0 0 0;
}
</style>

</head>
<body>
<img id="background" scrolling="no" src="img/lottery1.jpg" width="1155" height="650">
<div id="form">
<form id="form1" method="post">
<table id="table1">
<caption id="text">登入</caption>

<tr>
<td id="text">帳號</td>
<td><input type="text" id="user" name="user"/></td>
</tr>

<tr>
<td id="text">密碼</td>
<td><input type="password" id="password" name="password"/></td>
</tr>
<tr>
<td id="login"><input id="text" type="submit" value="login"/></td>
</tr>
</table>
</form>
</div>


</body>
</html>
