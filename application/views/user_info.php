<img src="<?php echo $data->profile_image_url_https; ?>"> <br>
Name : <?php echo $data->name; ?> <br>
Username : <?php echo "@" . $data->screen_name; ?> <br>
Location : <?php echo $data->location != ""? $data->location : "Not Set"; ?> <br>
Description : <?php echo $data->description; ?>