<?php
require_once ('dbconnect.php');
session_start();
if(!isset($_SESSION['pid'])){
    header("Location: ../login.php");
}
if($_SESSION['pid']<=0){
    header("Location: ../login.php");
}
function newnumber($conn){//可用中文
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $one = mysqli_real_escape_string($conn, $_POST['one']);
	$two = mysqli_real_escape_string($conn, $_POST['two']);
	$three = mysqli_real_escape_string($conn, $_POST['three']);
	$four = mysqli_real_escape_string($conn, $_POST['four']);
	$five = mysqli_real_escape_string($conn, $_POST['five']);
    $sql = "INSERT INTO `539` (`date`,`one`,`two`,`three`,`four`,`five`) values('$date','$one','$two','$three','$four','$five');";
	//不能用"+back+"
	mysqli_query($conn,$sql);
	echo("<div class='starter-template'><h1>新增成功!</h1></div>");
}
function show($conn){//顯示查詢結果
    $sql = "SELECT `date`,`one`,`two`,`three`,`four`,`five` FROM `539` ";//全部都取的話不設where
	$result = mysqli_query($conn,$sql);
	return $result;
}
function analyze($conn){//分析歷史資料
    $sql = "SELECT * FROM `539`";
	$result = mysqli_query($conn,$sql);
	$i=0;
	while($row = mysqli_fetch_row($result))
	{
		$date[$i] = $row[0];$one[$i] = $row[1];$two[$i] = $row[2];
		$three[$i] = $row[3];$four[$i]=$row[4];$five[$i]=$row[5];
        $i++;
	}
	$j=0;
	while($date[$j]>0){//把那個數字當索引 ++ 代表那個數字有幾個
	    $count[$one[$j]]++;$count[$two[$j]]++;$count[$three[$j]]++;
		$count[$four[$j]]++;$count[$five[$j]]++;$count[$six[$j]]++;
		$j++;
	}
	return $count;
}
function showposition($conn){//顯示查詢結果 符合特定位置
    $position = mysqli_real_escape_string($conn, $_POST['showposition']);
    $sql = "SELECT `SID`,`打擊狀況`,`名字`,`身高`,`體重`,`投球狀況`,`守備位置` FROM `明日之星` WHERE `守備位置`='$position'";
	$result = mysqli_query($conn,$sql);
	return $result;
}
function deletenumber($conn){//刪除player
    $del = mysqli_real_escape_string($conn, $_POST['del']);
	$sql = "DELETE FROM `539` WHERE `date`='$del'";
	mysqli_query($conn,$sql);
	echo("<div class='starter-template'><h1>刪除成功!</h1></div>");
}
function updatenumber($conn){//選出要修改的player
    $upd = mysqli_real_escape_string($conn, $_POST['upd']);
	$sql = "SELECT `date`,`one`,`two`,`three`,`four`,`five` FROM `539` WHERE `date`='$upd'";
	$result = mysqli_query($conn,$sql);
	return $result;
}
function updatenumber2($conn){//修改player
    $upd2 = mysqli_real_escape_string($conn, $_POST['upd2']);
	$upddate = mysqli_real_escape_string($conn, $_POST['upddate']);
	$updone = mysqli_real_escape_string($conn, $_POST['updone']);
	$updtwo = mysqli_real_escape_string($conn, $_POST['updtwo']);
	$updthree = mysqli_real_escape_string($conn, $_POST['updthree']);
	$updfour = mysqli_real_escape_string($conn, $_POST['updfour']);
	$updfive = mysqli_real_escape_string($conn, $_POST['updfive']);
	$sql = "UPDATE `539` SET `date`='$upddate' ,`one`='$updone',`two`='$updtwo',`three`='$updthree',`four`='$updfour',`five`='$updfive' WHERE `date`='$upd2'";
	mysqli_query($conn,$sql);
	echo("<div class='starter-template'><h1>修改成功!</h1></div>");
}
if(isset($_POST['date']) && isset($_POST['one'])){
    newnumber($conn);
}
if(isset($_POST['del'])){
    deletenumber($conn);
}
if(isset($_POST['upd2'])){
    updatenumber2($conn);
}

?>
<!DOCTYPE html>
<html>
    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
	<link rel="icon" href="../img/icon1.jpg">
	<title>lottery</title>
	<!-- Bootstrap core CSS -->
	<link href="../bootstrap-3.3.6-dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	<link href="../css/ie10-viewport-bug-workaround.css" rel="stylesheet">
	<!-- Custom styles for this template -->
	<link href="../css/starter-template.css" rel="stylesheet">
	<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
	<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
	<script src="../js/ie-emulation-modes-warning.js"></script>
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<script type="text/javascript" src="../jQuery/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="../jQuery/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="../jQuery/jquery-ui-1.11.4/jquery-ui.min.js"></script>
	<script type="text/javascript" src="../jQuery/jquery-ui-touch-punch-master/jquery.ui.touch-punch.min.js"></script><!--要在ui後-->
	<script type="text/javascript" src="../greensock-js/src/minified/TweenMax.min.js"></script>
	
	<script type="text/javascript" src="../js/public.js"></script>
	<!--<script type="text/javascript" src="../js/Scout.js"></script>-->
    <style>
	body{
	margin : 0px 0px 0px 0px; /*去掉周圍的白色*/
	height:100%;width:100%;
	}
	#Title{
	    position:absolute;
		top:-5%;left:25%;
		font-size: 75pt;
		font-family: "Bookman Old Style";
	}
	.bg{
	z-index:0;
	top:0;
	left:0;
	}
	#div{
		position:absolute;
		overflow-y:hidden;
		overflow-x:hidden;
	}
	.bottomback{height:100%;Width:100%;z-index:-10}

	body{
		cursor:url("../img/cursor01.jpg");
	}
	input[type="text"] {
	    width:50px;
	}
	#pitch,#swing{
	    width:200px;
		heigth:40px;
	}
	#show,#del,#upd,#upd2,#pro539{
	    display:none;
	}
	.bdvoice{
	    position:float;
		float:right;
		top:20%;
	}
	.num{
	    font-size:30px;
	}
	</style>
	</head>
    <!--<body onload="show()">-->
	<!--<body id="body" onresize="screenResize()">-->
	<body id="body" >
	<nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="539.php">539</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="539.php">539</a></li>
            <li><a href="649.php">大樂透</a></li>
            <li><a href="">威力彩</a></li>
			<li><a href="">大福彩</a></li>
            <li><a href="">Readme</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">
	    <div class="bdvoice"><img width="40px" height="auto" src="../img/voice.png" onclick="changeMusic()"></img></div>
      <div class="starter-template">
	    <div class="row" > 
			<?php 
				if(isset($_POST['show'])){
				echo "<div class='col-md-12 col-md-offset-1'>
				<table class='table-bordered'>
				<tr><th class='col-md-3'>期別</th><th class='col-md-1'>壹</th><th class='col-md-1'>貳</th><th class='col-md-1'>参</th>
				<th class='col-md-1'>肆</th><th class='col-md-1'>伍</th><th class='col-md-1'>刪除</th><th class='col-md-1'>修改</th></tr><br/>";
					$result = show($conn);
					while($row = mysqli_fetch_row($result))
					{
						$date = $row[0];$one = $row[1];$two = $row[2];
						$three = $row[3];$four=$row[4];$five=$row[5];
						echo "<tr><td>$date</td><td>$one</td>
						<td>$two</td><td>$three</td><td>$four</td><td>$five</td>
						<td><form method='post' action='539.php'>
						<input type='text' id='del' name='del' value='$date'/>
						<input type='submit' value='刪除'/>
						</form></td>
						<td><form method='post' action='539.php'>
						<input type='text' id='upd' name='upd' value='$date'/>
						<input type='submit' value='修改'/>
						</form></td></tr><br/>";
					}
					echo "</table></div>";
				}
				if(isset($_POST['showposition'])){
				echo "<div class='col-md-12 col-md-offset-1'>
				<table class='table-bordered'>
				<tr><th class='col-md-3'>打擊狀況</th><th class='col-md-1'>名字</th><th class='col-md-1'>身高</th><th class='col-md-1'>體重</th>
				<th class='col-md-3'>投球狀況</th><th class='col-md-1'>守備位置</th><th class='col-md-1'>刪除</th><th class='col-md-1'>修改</th></tr><br/>";
					$result = showposition($conn);
					while($row = mysqli_fetch_row($result))
					{
					    $id = $row[0];$b = $row[1];$n = $row[2];
						$h = $row[3];$w=$row[4];$s=$row[5];$p=$row[6];
						echo "<tr><td>$b</td><td>$n</td>
						<td>$h</td><td>$w</td><td>$s</td><td>$p</td>
						<td><form method='post' action='Scout.php'>
						<input type='text' id='del' name='del' value='$date'/>
						<input type='submit' value='刪除'/>
						</form></td>
						<td><form method='post' action='Scout.php'>
						<input type='text' id='upd' name='upd' value='$date'/>
						<input type='submit' value='修改'/>
						</form></td></tr><br/>";
					}
					echo "</table></div>";
				}
			?>
		<?php
		if(isset($_POST['upd'])){
		echo "<div class='col-md-12 col-md-offset-1'>
		<table class='table-bordered'>
		    <tr><th class='col-md-3'>期別</th><th class='col-md-1'>壹</th><th class='col-md-1'>貳</th><th class='col-md-1'>参</th>
				<th class='col-md-1'>肆</th><th class='col-md-1'>伍</th><th class='col-md-1'>修改</th></tr><br/>";
			$result = updatenumber($conn);
			while($row = mysqli_fetch_row($result))
			{
				$date = $row[0];$one = $row[1];$two = $row[2];
				$three = $row[3];$four=$row[4];$five=$row[5];
				echo "<tr><td><form method='post' action='539.php'>
				<input type='text' id='upddate' name='upddate' value='$date'></td>
				<td><input type='text' id='updone' name='updone' value='$one'></td>
				<td><input type='text' id='updtwo' name='updtwo' value='$two'></td>
				<td><input type='text' id='updthree' name='updthree' value='$three'></td>
				<td><input type='text' id='updfour' name='updfour' value='$four'></td>
				<td><input type='text' id='updfive' name='updfive' value='$five'></td>
				<td><input type='text' id='upd2' name='upd2' value='$date'/>
				<input type='submit' value='修改'/>
				</form></td></tr><br/>";
			}
			echo "</table></div>";
		}
		?>
		<?php
		if(isset($_POST['pro539'])){  
        echo "<div class='col-md-6 col-md-offset-1'><br/><h1>今彩539號碼:</h1>";
			mt_srand((float)microtime()*1000000);/*產生隨機數種子*/
			$lottery=array();/*宣告陣列*/
			for($i=1;$i<=39;$i++)
			{
				$lottery[]=$i;/*將所有的數字寫入陣列*/
			}
			$ro=array_rand($lottery,5);/*使用array_rand函式從$lottery陣列隨機抓出5個數字*/
			for($j=0;$j<=4;$j++)
			{
				/*if($j==6)
				{
					echo '特別號：';
				}*/
				echo "<span class='num'>";
				echo $lottery[$ro[$j]].',';/*再用for迴圈將亂數抓出的數字印出*/
			    echo "</span>";
			}
		echo "</div>";
		}
		//if(isset($_POST['show'])){
		echo "<div class='col-md-12 col-md-offset-1'>
		<table class='table-bordered'>
		<tr><th class='col-md-1'>1</th><th class='col-md-1'>2</th><th class='col-md-1'>3</th><th class='col-md-1'>4</th>
		<th class='col-md-1'>5</th><th class='col-md-1'>6</th><th class='col-md-1'>7</th><th class='col-md-1'>8</th>
		<th class='col-md-1'>9</th><th class='col-md-1'>10</th><th class='col-md-1'>11</th><th class='col-md-1'>12</th></tr><br/>";
			$c = analyze($conn);
			echo "<tr><td>$c[1]</td><td>$c[2]</td><td>$c[3]</td><td>$c[4]</td><td>$c[5]</td>
				<td>$c[6]</td><td>$c[7]</td><td>$c[8]</td><td>$c[9]</td><td>$c[10]</td><td>$c[11]</td><td>$c[12]</td></tr><br/>";
			echo "</table></div>";
		//}
				//if(isset($_POST['show'])){
		echo "<div class='col-md-12 col-md-offset-1'>
		<table class='table-bordered'>
		<tr><th class='col-md-1'>13</th><th class='col-md-1'>14</th><th class='col-md-1'>15</th><th class='col-md-1'>16</th>
		<th class='col-md-1'>17</th><th class='col-md-1'>18</th><th class='col-md-1'>19</th><th class='col-md-1'>20</th>
		<th class='col-md-1'>21</th><th class='col-md-1'>22</th><th class='col-md-1'>23</th><th class='col-md-1'>24</th></tr><br/>";
			//$c = analyze($conn);
			echo "<tr><td>$c[13]</td><td>$c[14]</td><td>$c[15]</td><td>$c[16]</td><td>$c[17]</td>
				<td>$c[18]</td><td>$c[19]</td><td>$c[20]</td><td>$c[21]</td><td>$c[22]</td><td>$c[23]</td><td>$c[24]</td></tr><br/>";
			echo "</table></div>";
		//}
				//if(isset($_POST['show'])){
		echo "<div class='col-md-12 col-md-offset-1'>
		<table class='table-bordered'>
		<tr><th class='col-md-1'>25</th><th class='col-md-1'>26</th><th class='col-md-1'>27</th><th class='col-md-1'>28</th>
		<th class='col-md-1'>29</th><th class='col-md-1'>30</th><th class='col-md-1'>31</th><th class='col-md-1'>32</th>
		<th class='col-md-1'>33</th><th class='col-md-1'>34</th><th class='col-md-1'>35</th><th class='col-md-1'>36</th></tr><br/>";
			//$c = analyze($conn);
			echo "<tr><td>$c[25]</td><td>$c[26]</td><td>$c[27]</td><td>$c[28]</td><td>$c[29]</td>
				<td>$c[30]</td><td>$c[31]</td><td>$c[32]</td><td>$c[33]</td><td>$c[34]</td><td>$c[35]</td><td>$c[36]</td></tr><br/>";
			echo "</table></div>";
		//}
				//if(isset($_POST['show'])){
		echo "<div class='col-md-12 col-md-offset-1'>
		<table class='table-bordered'>
		<tr><th class='col-md-1'>37</th><th class='col-md-1'>38</th><th class='col-md-1'>39</th><th class='col-md-1'>X</th>
		<th class='col-md-1'>X</th><th class='col-md-1'>X</th><th class='col-md-1'>X</th><th class='col-md-1'>X</th>
		<th class='col-md-1'>X</th><th class='col-md-1'>X</th><th class='col-md-1'>X</th><th class='col-md-1'>X</th></tr><br/>";
			//$c = analyze($conn);
			echo "<tr><td>$c[37]</td><td>$c[38]</td><td>$c[39]</td></tr><br/>";
			echo "</table></div>";
		//}
		?>
		</div>
		<br/>
        <p class="lead" id="player">新增一期號碼</p>
		<div class="add">
			<form method="post" action="539.php">
			    <!--<span>日期:<input type="date" id="date" name="date"/></span>-->
				<span>期別:<input type="text" id="date" name="date"/></span>
				<span>壹:<input type="text" id="one" name="one"/></span>
				<span>貳:<input type="text" id="two" name="two"/></span>
				<span>参:<input type="text" id="three" name="three"/></span>
				<span>肆:<input type="text" id="four" name="four"/></span>
				<span>伍:<input type="text" id="five" name="five"/></span>
				<input type="submit" value="新增"/>
			</form>
		</div>
		<p class="lead" id="player">隨機產生一組號碼</p>
		<div class="sel">
			<form method="post" action="539.php">
			    <input type="text" id="pro539" name="pro539" value="1"/>
				<input type="submit" value="產生"/>
			</form>
			<br/>
		</div>
		<p class="lead" id="player">查詢號碼</p>
		<div class="sel">
			<form method="post" action="539.php">
			    <input type="text" id="show" name="show" value="1"/>
				<input type="submit" value="全部查詢"/>
			</form>
			<br/>
			<!--<form method="post" action="539.php">
			    <input type="text" id="showdate1" name="showdate1" />&nbsp;
				<input type="text" id="showdate2" name="showdate2" />&nbsp;
				<input type="submit" value="依日期範圍查詢"/>
			</form>-->
		</div>
      </div>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>-->
    <script src="../bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../js/ie10-viewport-bug-workaround.js"></script>
	<!--<p id="Title">棒壘球教練系統</p>-->
	<!--<img id="homebutton" src="../img/button/homebutton.png" onclick="goHome()" height="65" width="65">-->
	<!--<img id="bg" class="bg" src="img/background01.jpg" >-->
    </div>
	</body>
</html>