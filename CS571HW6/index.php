<?php 
	require_once __DIR__ . '/php-graph-sdk-5.0.0/src/Facebook/autoload.php';
?> 

<html>
	<body>
		<h1>Facebook Search</h1>
		<form action="/index.php" method="get">
  			Keyword<input type="text" name="keyword">
  			<br><br>
  			Type:
  			<select name="type">
  				<option value="volvo">Users</option>
			</select>
			<br><br>
  			<input type="submit" value="Submit">
		</form> 
	</body>
</html>
<?php
	//echo $_GET["keyword"];
	$feedurl = "https://graph.facebook.com/v2.8/search?q=usc&type=place&center=34.028418,-118.283953&distance=1000&fields=id,name,picture.width(700).height(700)&access_token=EAAFgkMau1f8BAD02HfQNS9t7E6qp6Mw7WYrplAapbqZCrJ7xFSxpZAtpSahbTbXWxYCcUoohPmISw1diiDZBaaPZCQbxXgcSNLNbersPBBYMsZCmB0HhFz196psfZBKWMDXmGw1Kj7mtqrtiN2hXWW0HZBScPZBXpfkZD";
	$feed = file_get_contents($feedurl);
	$jsondecoded = json_decode($feed,true);
	$data = $jsondecoded["data"];
	for($i=0; $i < sizeof($data); $i++)
	{
		echo $data[$i]['id']."<br>";
		echo $data[$i]['name']."<br>";
	}
	//print_r ($data[0]);


?>