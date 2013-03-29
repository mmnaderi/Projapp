<?php
    ##########################
	## In The Name Of Allah ##
	##########################
	include ('config.php');
	$query = mysql_query("SELECT * FROM `info`");
	while($info = mysql_fetch_array($query)) {
	$url = $info['url'];
	$developermail=$info['developermail'];
	$developername=$info['developername'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title><?php echo($developername); ?>'s projects</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link href="admin/favicon.ico" rel="shortcut icon">
		<link href="admin/style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div class="container wrapper">
		<h1 class="page-title"><font size="5">{</font><?php echo($developername); ?>'s Projects}</h1>
		<ul class="projects">
		<?php
			}
			mysql_close($connect);
			include ('admin/../config.php');
			$counter = 1;
			$projects_query = mysql_query("SELECT * FROM `projects`");
			//////////////////////////////////////////////////////////////
			$rows = mysql_result(mysql_query("SELECT COUNT(*) FROM `projects`"), 0);
			if (!$rows) { echo($developername." doesn't has any project. :("); }
			//////////////////////////////////////////////////////////////
			while($projects = mysql_fetch_array($projects_query)) {
		?>
			<li>
				<span class="name"><?php
					echo($counter);
					$counter=$counter+1;
				?>. <?php echo($projects['name']); ?></span>
				<span class="description"><?php echo($projects['description']); ?></span>
				<div class="percent-full"><?php
				if ($projects['percent'] == 100) {
					echo('<img src="admin/images/complete.png" alt="Complete" title="Complete" />');
				}
				else {
					echo('<img src="admin/images/indevelope.png" alt="In Develope" title="In Develope" />');
				}
				?><div class="percent-text"><?php echo($projects['percent']); ?>%</div></div>
			<div class="type"><?php
				if ($projects['type'] == 'download') {
					if($projects['file'] == $url.'/projects/') {
						echo('<img src="admin/images/download.png" alt="For Download" title="For Download" />');
					}
					else {
						echo('<a href="'. $projects['file'] .'"><img src="admin/images/download.png" alt="For Download" title="For Download" /></a>');
					}
				}
				else {
					echo('<a href="mailto:'. $developermail .'"><img src="admin/images/sale.png" alt="For Sale" title="For Sale" /></a>');
				}
			?></div>
		</li>
	<?php
		}
	?>
	</ul>
	<div align="right">Powered By <a href="http://projapp.mmnaderi.ir" title="Projapp">Projapp</a></div>
	</div>
	</body>
</html>
