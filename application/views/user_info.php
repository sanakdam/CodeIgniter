<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo $name ?></title>
</head>
<body>
	<img src="<?php echo $profile_image_url_https; ?>"> <br>
	Name : <?php echo $name; ?> <br>
	Username : <?php echo "@" . $screen_name; ?> <br>
	Location : <?php echo $location != ""? $location : "Not Set"; ?> <br>
	Description : <?php echo $description; ?>
</body>
</html>