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
				border: 2px solid #D4D4D4;
				margin-bottom: 20px;
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
				margin-bottom: 8px;
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
			.detailsheader a:visited,.albumresult a:visited{
  				color:blue;
			}
			.nothingfound
			{
				width:600px;
				background-color: #F3F3F3;
				margin-top:8px;
				border: 2px solid #D4D4D4;
				text-align: center;
				padding:1px;
				font-size: 15px;
				margin:0 auto;
			}
			.place
			{
				visibility: hidden;
				margin-top: -15px;
				margin-left:8px;
			}
		</style>
	</head>
	<script>
	window.onload = function() {
  		if(document.getElementById("type").value=='place')
		{
			document.getElementById('place').style.visibility = "visible";
		}	
	};
	function resetform() {
    	document.getElementById("keyword").value = "";
    	document.getElementById("type").value = "user";
    	document.getElementById("location").value = "";
    	document.getElementById("distance").value = "";
    	document.getElementById('place').style.visibility = "hidden";
	}
	function showalbums()
	{
		
		if(document.getElementById("albumresult").style.display=="none")
		{
			document.getElementById("albumresult").style.display = "block";
			document.getElementById("messageresult").style.display = "none";
		}
		else if (document.getElementById("albumresult").style.display=="block")
		{
			document.getElementById("albumresult").style.display = "none";
		}
		else
		{
			document.getElementById("albumresult").style.display = "block";
			document.getElementById("messageresult").style.display = "none";
		}
	}
	function showmessages()
	{
		if(document.getElementById("messageresult").style.display=="none")
		{
			document.getElementById("messageresult").style.display = "block";
			document.getElementById("albumresult").style.display = "none";
		}
		else if (document.getElementById("messageresult").style.display=="block")
		{
			document.getElementById("messageresult").style.display = "none";
		}
		else
		{
			document.getElementById("messageresult").style.display = "block";
			document.getElementById("albumresult").style.display = "none";
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
	function showplace(value)
	{
		if(value=='place')
		{
			document.getElementById('place').style.visibility = "visible";
		}
		else
		{
			document.getElementById('place').style.visibility = "hidden";
		}
	}
	function validinput()
	{
		if(document.getElementById('type').value == 'place')
		{
			if(!document.getElementById('location').value)
			{
				alert("Location field is empty!")
				return false;
			}
			if(!document.getElementById('distance').value)
			{
				alert("Distance field is empty!")
				return false;
			}
		}
		return true;

	}
</script>
	<body>
		<div class="header">
			<div class="title">Facebook Search</div>
			<form action='/Search.php' method='get' onsubmit="return validinput();">
				&nbsp; 
  				Keyword <input type='text' name='keyword' id='keyword' required='required' value='<?php if (isset($_GET["keyword"])){echo $_GET["keyword"]; }  ?>'>
  				<br>
  				&nbsp; Type: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  				<select name='type' id='type' style="margin-top: 1px;" onchange="showplace(this.value);">
  					<option value='user' <?php if (isset($_GET['type'])) {if (strcmp($_GET['type'], 'user')==0){echo 'selected';}} ?> >Users</option>
  					<option value='page' <?php if (isset($_GET['type'])) {if (strcmp($_GET['type'], 'page')==0){echo 'selected';}} ?>>Pages</option>
  					<option value='event' <?php if (isset($_GET['type'])) {if (strcmp($_GET['type'], 'event')==0){echo 'selected';}} ?>>Events</option>
  					<option value='group' <?php if (isset($_GET['type'])) {if (strcmp($_GET['type'], 'group')==0){echo 'selected';}} ?>>Groups</option>
  					<option value='place' <?php if (isset($_GET['type'])) {if (strcmp($_GET['type'], 'place')==0){echo 'selected';}} ?>>Places</option>
				</select>
				<br>
				&nbsp;
				<div class="place" id="place">
					Location <input type='text' name='location' id='location' value='<?php if (isset($_GET["location"])){echo $_GET["location"]; }  ?>'>
					Distance <input type='text' name='distance' id='distance' value='<?php if (isset($_GET["distance"])){echo $_GET["distance"]; }  ?>'>
				</div>
				<br>
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
		if(strcmp($_GET["type"], "place")==0)
		{
			$_GET["location"] = str_replace(" ","+",$_GET["location"]);
			$googlefeedurl = "https://maps.googleapis.com/maps/api/geocode/json?address=".$_GET["location"]."&key=AIzaSyAUh-un_GztUGhjkS43DaNbztCsf3wAMtw";
			$googlefeed = file_get_contents($googlefeedurl);
			$googlejsondecoded = json_decode($googlefeed,true);
			$lat = $googlejsondecoded["results"][0]["geometry"]['location']['lat'];
			$lng = $googlejsondecoded["results"][0]["geometry"]['location']['lng'];
			$fburl = "https://graph.facebook.com/v2.8/search?q=".$_GET["keyword"]."&type=place&center=".$lat.",".$lng."&distance=".$_GET["distance"]."&fields=id,name,picture.width(700).height(700)&access_token=".$accesstoken;
			$fbfeed = file_get_contents($fburl);
			$fbjsondecoded = json_decode($fbfeed,true);
			$data = $fbjsondecoded["data"];
			if(sizeof($data)!=0)
			{
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
					echo "<td><a href='/Search.php?id=".$data[$i]['id']."'>Details</a></td>";
					echo "</tr>";
				}
				echo "</table>";	
			}
			else
			{
				echo "<div class='nothingfound'>No Records have been found</div><br>";
			}
		}
		else if (strcmp($_GET["type"], "event")==0)
		{
			$_GET["keyword"] = str_replace(" ","%20",$_GET["keyword"]);
			$feedurl = "https://graph.facebook.com/v2.8/search?q=".$_GET["keyword"]."&type=event&fields=id,name,picture.width(700).height(700),place&access_token=".$accesstoken;
			$feed = file_get_contents($feedurl);
			$jsondecoded = json_decode($feed,true);
			$data = $jsondecoded["data"];
			if(sizeof($data)!=0)
			{
				echo "<table style='width:70%;' align='center'>
		  			<tr style='background-color:#F3F3F3;'>
        				<td>Profile Photo</td>
        				<td>Name</td>
        				<td>Place</td>
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
					echo "<td>".$data[$i]['place']['name']."</td>";
					echo "</tr>";
				}
				echo "</table>";	
			}
			else
			{
				echo "<div class='nothingfound'>No Records has been found</div><br>";
			}
		}
		else
		{
			$_GET["keyword"] = str_replace(" ","%20",$_GET["keyword"]);
			$feedurl = "https://graph.facebook.com/v2.8/search?q=".$_GET["keyword"]."&type=".$_GET["type"]."&fields=id,name,picture.width(700).height(700)&access_token=".$accesstoken;
			$feed = file_get_contents($feedurl);
			$jsondecoded = json_decode($feed,true);
			$data = $jsondecoded["data"];
			if(sizeof($data)!=0)
			{
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
					echo "<td><a href='/Search.php?id=".$data[$i]['id']."'>Details</a></td>";
					echo "</tr>";
				}
				echo "</table>";	
			}
			else
			{
				echo "<div class='nothingfound'>No Records has been found</div><br>";
			}
		}
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
				if (isset($albums[$i]['photos']['data']))
				{
					echo "<div class='borderbottom'><a onclick=\"showphotos('".str_replace(' ','-',$albums[$i]['name'])."')\" href='#'>".$albums[$i]['name']."</a><br>";
					echo "<div id='".str_replace(" ","-",$albums[$i]['name'])."' style='display:none;'>";
					for($j=0; $j < sizeof($albums[$i]['photos']['data']); $j++)
					{
						echo "<img src='".$albums[$i]['photos']['data'][$j]['picture']."' height='50' width='50'>&nbsp;&nbsp;&nbsp;";
					}
				}
				else
				{
					echo "<div class='borderbottom' style='font-size:15px;'><a>".$albums[$i]['name']."</a><br><div>";
				}
				echo "</div></div>";
			}
			echo "</div>";
		}
		else
		{
			echo "<div class='nothingfound'>No Albums has been found</div><br>";
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
		else
		{
			echo "<div class='nothingfound'>No Posts has been found</div><br>";
		}
	}
?>