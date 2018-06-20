<div class="profile-content">
	<h2>Overview</h2>
   	<img src="<?php echo $profile_image_url_https; ?>"> <br>
	Name : <?php echo $name; ?> <br>
	Username : <?php echo "@" . $screen_name; ?> <br>
	Location : <?php echo $location != ""? $location : "Not Set"; ?> <br>
	Description : <?php echo $description; ?>
</div>