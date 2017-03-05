<?php 
	require_once __DIR__ . '/php-graph-sdk-5.0.0/src/Facebook/autoload.php';
?> 
<html>
	<head>
		<style>
			.header
			{
				background-color: #F3F3F3;
				width:500px;
				margin: 0 auto;
				font-size: 15px;
			}
			.title
			{
				font-family: "Times New Roman", Times, serif;
				font-style: italic;
				font-size: 22px;
				text-align: center;
				padding-top:3px;
				padding-bottom: 10px;
				width:470px;
				border-bottom: 1px solid #C5C5C5;
				margin: 0 auto;
				margin-bottom: 8px;
			}
			.button
			{
				margin-left:60px;
				margin-bottom: 15px;
			}
			table, th, td {
   				border: 1px solid #D8D8D8;
   				border-collapse: collapse;
			}
			.detailsheader
			{
				width:600px;
				background-color: #CCCCCC;
				margin: 0 auto;
				text-align: center;
			}
			.albumresult
			{
				display: none;
				width:598px;
				margin: 0 auto;
				border: 2px solid #CCCCCC;
			}
			.messageresult
			{
				display: none;
				width:598px;
				margin: 0 auto;
				border: 2px solid #CCCCCC;
			}
			.borderbottom{
				border-bottom: 1px solid #CCCCCC;
				padding: 1px;
			}
			a:visited{
  				color:blue;
			}
		</style>
	</head>
	<script>
	function resetform() {
    	document.getElementById("keyword").value = "";
    	document.getElementById("type").value = "user";
	}
	function showalbums()
	{
		
		if(document.getElementById("albumresult").style.display=="none")
		{
			document.getElementById("albumresult").style.display = "block";
		}
		else if (document.getElementById("albumresult").style.display=="block")
		{
			document.getElementById("albumresult").style.display = "none";
		}
		else
		{
			document.getElementById("albumresult").style.display = "block";
		}
	}
	function showmessages()
	{
		
		if(document.getElementById("messageresult").style.display=="none")
		{
			document.getElementById("messageresult").style.display = "block";
		}
		else if (document.getElementById("messageresult").style.display=="block")
		{
			document.getElementById("messageresult").style.display = "none";
		}
		else
		{
			document.getElementById("messageresult").style.display = "block";
		}
	}
	function showphotos(idname)
	{
		
		if(document.getElementById(idname).style.display=="none")
		{
			document.getElementById(idname).style.display = "block";
		}
		else if (document.getElementById(idname).style.display=="block")
		{
			document.getElementById(idname).style.display = "none";
		}
		else
		{
			document.getElementById(idname).style.display = "block";
		}
	}
</script>
	<body>
		<div class="header">
			<div class="title">Facebook Search</div>
			<form action='/index.php' method='get'>
  				&nbsp; Keyword <input type='text' name='keyword' id='keyword' value='<?php if (isset($_GET["keyword"])){echo $_GET["keyword"]; }  ?>'>
  				<br><br>
  				&nbsp; Type: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  				<select name='type' id='type' value='<?php if (isset($_GET["type"])){echo $_GET["type"]; }  ?>'>
  					<option value='user' <?php if (isset($_GET['type'])) {if (strcmp($_GET['type'], 'user')==0){echo 'selected';}} ?> >Users</option>
  					<option value='page' <?php if (isset($_GET['type'])) {if (strcmp($_GET['type'], 'page')==0){echo 'selected';}} ?>>page</option>
  					<option value='event' <?php if (isset($_GET['type'])) {if (strcmp($_GET['type'], 'event')==0){echo 'selected';}} ?>>event</option>
  					<option value='group' <?php if (isset($_GET['type'])) {if (strcmp($_GET['type'], 'group')==0){echo 'selected';}} ?>>group</option>
  					<option value='place' <?php if (isset($_GET['type'])) {if (strcmp($_GET['type'], 'place')==0){echo 'selected';}} ?>>place</option>
				</select>
				<br><br>
  				<input type='submit' value='Search' class="button">
  				<input type='button' value='Clear' onclick='resetform()'>
			</form> 
		</div>
	</body>
</html>
<?php
	$accesstoken = "EAAFgkMau1f8BAD02HfQNS9t7E6qp6Mw7WYrplAapbqZCrJ7xFSxpZAtpSahbTbXWxYCcUoohPmISw1diiDZBaaPZCQbxXgcSNLNbersPBBYMsZCmB0HhFz196psfZBKWMDXmGw1Kj7mtqrtiN2hXWW0HZBScPZBXpfkZD";
	if(isset($_GET["keyword"]))
	{
		$_GET["keyword"] = str_replace(" ","%20",$_GET["keyword"]);
		$feedurl = "https://graph.facebook.com/v2.8/search?q=".$_GET["keyword"]."&type=".$_GET["type"]."&fields=id,name,picture.width(700).height(700)&access_token=".$accesstoken;
		$feed = file_get_contents($feedurl);
		$jsondecoded = json_decode($feed,true);
		$data = $jsondecoded["data"];
		echo "<table style='width:70%;' align='center'>
		  		<tr style='background-color:#F3F3F3;'>
        			<td>Profile Photo</td>
        			<td>Name</td>
        			<td>Details</td>
      			</tr>
		";
		for($i=0; $i < sizeof($data); $i++)
		{
			echo "<tr>
					<td>
						<a href='".$data[$i]['picture']['data']['url']."'>
						 <img src='".$data[$i]['picture']['data']['url']."' height='30' width='40'>
						</a>
					</td>";
			echo "<td>".$data[$i]['name']."</td>";
			echo "<td><a href='/index.php?id=".$data[$i]['id']."'>Details</a></td>";
			echo "</tr>";
		}
		echo "</table>";	
	}

	if(isset($_GET["id"]))
	{
		$detailfeedurl = "https://graph.facebook.com/v2.8/".$_GET["id"]."?fields=id,name,picture.width(700).height(700),albums.limit(5){name,photos.limit(2){name,picture}},posts.limit(5)&access_token=".$accesstoken;
		$detailfeed = file_get_contents($detailfeedurl);
		$jsondecoded = json_decode($detailfeed,true);
		if(isset($jsondecoded["albums"]["data"]))
		{
			echo "<div class='detailsheader'><a onclick='showalbums()' href='#'>Albums</a></div><br>";
			echo "<div class='albumresult' id='albumresult'>";
			$albums = $jsondecoded["albums"]["data"];
			for($i=0; $i < sizeof($albums); $i++)
			{
				echo "<div class='borderbottom'><a onclick=\"showphotos('".str_replace(' ','-',$albums[$i]['name'])."')\" href='#'>".$albums[$i]['name']."</a><br>";
				echo "<div id='".str_replace(" ","-",$albums[$i]['name'])."' style='display:none;'>";
				for($j=0; $j < sizeof($albums[$i]['photos']['data']); $j++)
				{
					echo "<img src='".$albums[$i]['photos']['data'][$j]['picture']."' height='50' width='50'>&nbsp;&nbsp;&nbsp;";
				}
				echo "</div></div>";
			}
			echo "</div>";
		}
		if(isset($jsondecoded["posts"]["data"]))
		{
			$posts = $jsondecoded["posts"]["data"];
			echo "<div class='detailsheader'><a onclick='showmessages()' href='#'>Posts</a></div><br>";
			echo "<div class='messageresult' id='messageresult'>";
			echo "<div class='borderbottom' style='background-color:#F3F3F3;'><b>Message</b></div>";
			for($k = 0; $k < sizeof($posts); $k++)
			{
				if(isset($posts[$k]['message']))
				{
					echo "<div class='borderbottom'>".$posts[$k]['message']."</div>";
				}
			}
			echo "</div>";
		}
	}
?>