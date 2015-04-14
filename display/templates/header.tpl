<!DOCTYPE html>
<html>
<head>
		<meta charset="utf-8">
		<link href="static/css/style.css" rel='stylesheet' type='text/css' />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text.css'/>
		<script src="static/js/j.js"></script>
		<script src="static/js/main.js"></script>
</head>
<body>
	<div class="main">
		<div id="menu">
			<div class="container">
				<nav class="navbar navbar-default" role="navigation">
					<div class="navbar-header">
						<a class="logoClass" href="index.php">Photo Share</a>
					</div>
					~if $login`
					<div class="collapse navbar-collapse navbar1-collapse" id="navMenuList">
						<ul class="nav menu navbar-nav navbar-right">
							<li class="item-109"><a href="search.php">Search</a></li>
							<li class="item-113"><a href="createGroup.php">Create Group</a></li>
							<li class="item-114"><a class="colored try-it-btn" href="upload.php">Upload</a></li>
							<li class="item-113"><a href="logout.php">Logout</a></li>
							<li class="item-113"><a href="readme.txt" target="_blank">User Manual</a></li>
						</ul>
        			</div>
        			~/if`
        		</nav>
      		</div>
		</div>