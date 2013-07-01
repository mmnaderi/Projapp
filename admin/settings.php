<?php
	######### IN THE NAME OF ALLAH ##########
	## Project Name: Projapp               ##
	## File name:    settings.php          ##
	## Author:       Mohammad Mahdi Naderi ##
	## Project Site: projapp.mmnaderi.ir   ##
	#########################################
	ob_start();
	@session_start();
	if(isset($_SESSION['admin'])) {
	include ('../config.php');
	if (isset($_POST['developer_name']) && $_POST['developer_name'] != '' || isset($_POST['developer_mail']) && $_POST['developer_mail'] != '') {
		$updateinfo = mysql_query ("UPDATE `info` SET `username`='".$_POST['username']."', `password`='".$_POST['password']."',`developername`='".$_POST['developer_name']."', `developermail`='". $_POST['developer_mail'] ."', `theme`='". $_POST['theme'] ."', `language`='". $_POST['language'] ."' WHERE `id`='1'");
	}
	$query = mysql_query("SELECT * FROM `info`");
	while($info = mysql_fetch_array($query)) {
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>Projapp | Settings</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link href="favicon.ico" rel="shortcut icon">
		<link href="style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div class="container">
			<a href="<?php echo($info['url']); ?>/admin" title="Projapp"><img src="images/logo-full.png" alt="Projapp" /></a>
			<div class="wrapper">
				<?php require('toolbar.php'); ?>
				<div class="primery">
					<h1 class="page-title"><font size="5">{</font>Settings}</h1>
					<form action="settings.php" method="POST"> 
						<?php if(isset($updateinfo) && $updateinfo) {?>
						<p><img src="images/complete.png" alt="Complete" /><font color="green"> Perfect! Settings was updated.</font></p>
						<?php } elseif (isset($_POST['request']) && $_POST['request'] == 'true') {?>
						<p><img src="images/error.png" alt="Error" /><font color="red"> Unfortunately There is an error to edit settings.</font></p>
						<?php } ?>
						<p class="part">Username: <input type="text" name="username" value="<?php echo($info['username']); ?>" /></p>
						<p class="part">Password: <input type="password" name="password" value="<?php echo($info['password']); ?>" /></p>
						<hr color="#CCC" />
						<p class="part">Developer Name: <input type="text" name="developer_name" value="<?php echo($info['developername']); ?>" /></p>
						<p class="part">Developer E-Mail: <input type="text" name="developer_mail" value="<?php echo($info['developermail']); ?>" /></p>
						<hr color="#CCC" />
						<p class="part">Language: 
						<select name="language">
						<?php
						foreach (glob("../languages/*.pl") as $filename) {
							$filename = str_replace("languages/","",$filename);
							$filename = str_replace(".pl","",$filename);
							if($filename == 'en_US') {
								echo "<option selected=\"selected\">{$filename}</option>";
							}
							else {
								echo "<option>{$filename}</option>";
							}
						}
						?>
						</select>
						</p>
						<p class="part">Theme: 
						<select name="theme">
						<?php
							$path = '../themes/';
							$results = scandir($path);
							foreach ($results as $result) {
								if ($result === '.' or $result === '..') continue;
								if (is_dir($path . '/' . $result)) {
									if($result == $info['theme']) {
										echo("<option selected=\"selected\" value=\"{$result}\">{$result}</option>");
									}
									else {
										echo("<option value=\"{$result}\">{$result}</option>");
									}
								}
							}
						?>
						</select>
						<input type="hidden" name="request" value="true" />
						<div class="submit-project"><input type="submit" value="Edit Settings »" /></div>
					</form>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</body>
</html>
<?php
	}
	mysql_close($connect);
	}
	else {
		header('Location: login.php');
	}
	ob_end_flush();
?>