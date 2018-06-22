<div class="profile-content">
  <div class="row">
    <div class="col-md-8">
      <h2><?php echo $category->name; ?></h2>
    </div>
    <div class="col-md-4">
      <h2><a href="<?php echo base_url() . 'twitter/add_word/' . $category->id; ?>" class="btn btn-success">Add Word</a></h2>
    </div>
  </div>
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
        <?php $index = 1; ?>
    	<?php foreach ($subcategory as $data) { ?>
	      	<tr>
	        	<td><?php echo $index; ?></td>
	        	<td><?php echo $data->name; ?></td>
	        	<td><?php echo $data->date; ?></td>
            <td>
              <a href="<?php echo base_url() . 'twitter/edit_word/' . $data->id . '/' . $category->id; ?>" class="btn btn-primary">Edit Word</a>
            </td>
	      	</tr>
            <?php $index++ ?>
	    <?php } ?>
    </tbody>
  </table>
</div>