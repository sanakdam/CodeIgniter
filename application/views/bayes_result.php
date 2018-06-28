<div class="profile-content">
    <div class="row">
        <div class="col-md-8">
            <h2>@<?php echo $username; ?></h2>
        </div>
        <div class="col-md-4">
            <h2>N : <?php echo $result["n"]; ?></h2>
        </div>
    </div>
	<table class="table">
    <thead>
      	<tr>
        	<th>Id</th>
            <th>Category</th>
            <th>N / Class</th>
        	<th>Prior Prob</th>
            <th>Xi | Y</th>
            <th>Result</th>
      	</tr>
    </thead>
    <tbody>
        <?php $index = 1; ?>
    	<?php foreach ($result["data"] as $data) { ?>
	      	<tr>
	        	<td><?php echo $index; ?></td>
                <td><?php echo $data["name"]; ?></td>
                <td><?php echo $data["n"]; ?></td>
	        	<td><?php echo $data["prob"]; ?></td>
                <td><?php echo $data["Xi_Y"]; ?></td>
                <td><?php echo $data["bayes"]; ?></td>
	      	</tr>
            <?php $index++; ?>
	    <?php } ?>
    </tbody>
  </table>
</div>