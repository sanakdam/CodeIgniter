<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title; ?></title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>styles/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>styles/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<link rel="stylesheet" href="<?php echo base_url(); ?>styles/css/main.css">

	<script src="<?php echo base_url(); ?>styles/jquery.min.js"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="<?php echo base_url(); ?>styles/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
    <div class="row profile">
		<div class="col-md-3">
			<div class="profile-sidebar">
				<!-- SIDEBAR USERPIC -->
				<div class="profile-userpic">
					<img src="<?php echo $profile_image_url_https; ?>" class="img-responsive" alt="">
				</div>
				<!-- END SIDEBAR USERPIC -->
				<!-- SIDEBAR USER TITLE -->
				<div class="profile-usertitle">
					<div class="profile-usertitle-name">
						<?php echo $name; ?>
					</div>
					<div>
						<i><?php echo "@" . $screen_name; ?></i>
					</div>
					<div class="profile-usertitle-job">
						Developer
					</div>
				</div>
				<!-- END SIDEBAR USER TITLE -->
				<!-- SIDEBAR BUTTONS -->
				<!-- <div class="profile-userbuttons">
					<button type="button" class="btn btn-success btn-sm">Follow</button>
					<button type="button" class="btn btn-danger btn-sm">Message</button>
				</div> -->
				<!-- END SIDEBAR BUTTONS -->
				<!-- SIDEBAR MENU -->
				<div class="profile-usermenu">
					<ul class="nav">
						<li class="<?php echo uri_string() == "" || uri_string() == "twitter" || uri_string() == "twitter/input"? "active": ""; ?>">
							<a href="<?php echo base_url(); ?>twitter/input">
							<i class="glyphicon glyphicon-home"></i>
							Beranda </a>
						</li>
						<li class="<?php echo uri_string() == "twitter/category"? "active": ""; ?>">
							<a href="<?php echo base_url(); ?>twitter/category">
							<i class="glyphicon glyphicon-ok"></i>
							Category </a>
						</li>
						<li class="<?php echo uri_string() == "twitter/user_history"? "active": ""; ?>">
							<a href="<?php echo base_url(); ?>twitter/user_history">
							<i class="glyphicon glyphicon-flag"></i>
							History </a>
						</li>
					</ul>
				</div>
				<!-- END MENU -->
			</div>
		</div>

		<div class="col-md-9">