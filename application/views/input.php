<div class="profile-content">
	<h2>Search Data</h2>
	<form method="get" action="<?php echo base_url(); ?>twitter/user_search">
		<div class="input-group">
	    	<input type="text" name="query" class="form-control" placeholder="Search" value="<?php echo isset($query)? $query : ""; ?>" required>
	    	
	    	<div class="input-group-btn">
	      		<button class="btn btn-success" type="submit">
	        		<i class="glyphicon glyphicon-search"></i>
	      		</button>
	    	</div>
	  	</div>
	</form>

	<hr>
	<div class="row" style="margin: 0 auto;">
		<h4>Result :</h4>
		<?php if(isset($result) && count($result) > 0) { ?>
			<?php foreach ($result as $data) { ?>
				<div class="content">
					<div class="col-md-10">
			            <div class="media">
			              <div class="media-left">
			                <img class="media-object" src="<?php echo $data->profile_image_url_https; ?>" alt="<?php echo $data->name; ?>">
			              </div>
			              <div class="media-body">
			                <h4 class="media-heading"><?php echo $data->name; ?></h4>
			                <i style="color: #5b9bd1;"><?php echo "@" . $data->screen_name . "<br>"; ?></i>
			                <?php echo $data->description; ?>
			              </div>
			            </div>
			        </div>
			        <div class="col-md-2">		              
			        	<div class="media-right">
			              	<form method="get" action="<?php echo base_url(); ?>twitter/user_analyze">
			              		<input type="hidden" name="username" value="<?php echo $data->screen_name; ?>">
			              		<button class="btn btn-primary">Analyze</button>
			              	</form>
			            </div>
			        </div>
				</div>
			<?php } ?>
		<?php } ?>
	</div>
</div>