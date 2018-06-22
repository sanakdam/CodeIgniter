<div class="profile-content">
	<h2>Category Data</h2>
	<table class="table">
    <thead>
      	<tr>
        	<th>Id</th>
        	<th>Name</th>
        	<th>Date</th>
        	<th>Action</th>
      	</tr>
    </thead>
    <tbody>
    	<?php foreach ($result as $data) { ?>
	      	<tr>
	        	<td><?php echo $data->id; ?></td>
	        	<td><?php echo $data->name; ?></td>
	        	<td><?php echo $data->date; ?></td>
	        	<td>
	        		<a href="<?php echo base_url() . 'twitter/show_words/' . $data->id; ?>" class="btn btn-primary">Words</a>
	        	</td>
	      	</tr>
	    <?php } ?>
    </tbody>
  </table>
</div>