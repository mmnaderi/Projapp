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
	$posted = array();
	foreach ( $_POST as $item_key => $item_value ) {
		$posted[$item_key] = $item_value;
	}
	$query = mysql_query("SELECT * FROM `info`");
	while($information = mysql_fetch_array($query)) {
		if (isset($posted['username']) && $posted['username'] != $information['username'] && $posted['username'] != '') {
			$updateusername = mysql_query ("UPDATE `info` SET `username`='".$posted['username']."' WHERE `id`='1'");
		}
		if (isset($posted['developer_name']) && $posted['developer_name'] != $information['developername'] && $posted['developer_name'] != '') {
			$updatename = mysql_query ("UPDATE `info` SET `developername`='".$posted['developer_name']."' WHERE `id`='1'");
		}
		if (isset($posted['developer_mail']) && $posted['developer_mail'] != $information['developermail'] && $posted['developer_mail'] != '') {
			$updatemail = mysql_query ("UPDATE `info` SET `developermail`='".$posted['developer_mail']."' WHERE `id`='1'");
		}
		if (isset($posted['password']) && $posted['password'] != '') {
			$updatepassword = mysql_query ("UPDATE `info` SET `password`='".md5($posted['password'])."' WHERE `id`='1'");
		}
		if (isset($posted['language']) && $posted['language'] != '' && $posted['language'] != $information['language'] || isset($posted['theme']) && $posted['theme'] != '' && $posted['theme'] != $information['theme']) {
			$updatelang_theme = mysql_query ("UPDATE `info` SET `language`='".$posted['language']."', `theme`='".$posted['theme']."' WHERE `id`='1'");
		}
		if (isset($updateusername) && $updateusername
		|| isset($updatename) && $updatename
		|| isset($updatemail) && $updatemail
		|| isset($updatepassword) && $updatepassword
		|| isset($updatelang_theme) && $updatelang_theme) {
			$updateinfo = true;
		}
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
		<script src="js/jquery-1.10.1.min.js"></script>
		<script src="js/scripts.js"></script>
	</head>
	<body>
		<div class="container">
			<a href="<?php echo($info['url']); ?>/admin" title="Projapp"><img src="images/logo-full.png" alt="Projapp" /></a>
			<div class="wrapper">
				<?php require('toolbar.php'); ?>
				<div class="primery">
					<h1 class="page-title"><font size="5">{</font>Settings}</h1>
					<form action="settings.php" method="POST"> 
						<?php if(isset($updateinfo) && $updateinfo == true) {?>
						<p class="success"><img src="images/complete.png" alt="Complete" />Perfect! Settings was updated.</p>
						<?php } elseif (isset($posted['request']) && $posted['request'] == 'true') {?>
						<p class="error"><img src="images/error.png" alt="Error" />Unfortunately There is an error to edit settings.</p>
						<?php } ?>
						<p class="part">Username: <input type="text" name="username" value="<?php echo($info['username']); ?>" /></p>
						<p class="part"><input name="check" type="checkbox" onclick="password_enable()"> New Password: <input id="password" type="password" name="password" disabled /></p>
						<hr color="#CCC" />
						<p class="part">Developer Name: <input type="text" name="developer_name" value="<?php echo($info['developername']); ?>" /></p>
						<p class="part">Developer E-Mail: <input type="text" name="developer_mail" value="<?php echo($info['developermail']); ?>" /></p>
						<hr color="#CCC" /><br/>
						<span class="note">please select a rtl language with rtl theme or select ltr language with ltr theme.</span>
						<p class="part">Language: 
						<select name="language">
						<?php
						foreach (glob("../languages/*.pl") as $filename) {
							$filename = str_replace("../languages/","",$filename);
							$filename = str_replace(".pl","",$filename);
							include("../languages/{$filename}.pl");
							if($filename == $info['language']) {
								echo "<option value=\"{$filename}\" selected=\"selected\">{$filename} [{$direction}]</option>";
							}
							else {
								echo "<option value=\"{$filename}\">{$filename} [{$direction}]</option>";
							}
						}
						?>
						</select>
						<span id="message"></span>
						</p>
						<p class="part">Theme: 
						<select name="theme">
						<?php
							$path = '../themes/';
							$results = scandir($path);
							foreach ($results as $result) {
								if ($result === '.' or $result === '..') continue;
								if (is_dir($path . '/' . $result)) {
									include("../themes/{$result}/info.pt");
									if($result == $info['theme']) {
										echo("<option selected=\"selected\" value=\"{$result}\">{$result} [{$theme_direction}]</option>");
									}
									else {
										echo("<option value=\"{$result}\">{$result} [{$theme_direction}]</option>");
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
			<?php require_once('footer.php'); ?>
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