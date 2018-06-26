<div class="profile-content">
    <div class="row">
        <div class="col-md-8">
            <h2>User Timeline</h2>
        </div>
        <div class="col-md-4">
            <h2><a href="<?php echo base_url() . 'twitter/user_analyze_proccess/' . $username; ?>" class="btn btn-success">Proccess</a></h2>
        </div>
    </div>
	<table class="table">
    <thead>
      	<tr>
        	<th>Id</th>
            <th>Since Id</th>
        	<th>Text</th>
      	</tr>
    </thead>
    <tbody>
        <?php $index = 1; ?>
    	<?php foreach ($result as $data) { ?>
	      	<tr>
	        	<td><?php echo $index; ?></td>
                <td><?php echo $data->id; ?></td>
	        	<td><?php echo $data->text; ?></td>
	      	</tr>
            <?php $index++; ?>
	    <?php } ?>
    </tbody>
  </table>
</div>