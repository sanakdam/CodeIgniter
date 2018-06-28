<div class="profile-content">
    <h2>History</h2>
	<table class="table">
    <thead>
      	<tr>
        	<th>Id</th>
            <th>Username</th>
            <th colspan="6">Result</th>
      	</tr>
    </thead>
    <tbody>
        <?php $index = 1; ?>
    	<?php foreach ($result as $data) { ?>
	      	<tr>
	        	<td rowspan="7"><?php echo $index; ?></td>
                <td rowspan="7">@<?php echo $data->username; ?></td>
                <tr>
                    <th>Id</th>
                    <th>Category</th>
                    <th>N / Class</th>
                    <th>Prior Prob</th>
                    <th>Xi | Y</th>
                    <th>Result</th>
                </tr>
                <?php $count = 1; $bayes = json_decode($data->result); ?>
                <?php foreach ($bayes->data as $res) { ?>
                    <tr>
                        <td><?php echo $count; ?></td>
                        <td><?php echo $res->name; ?></td>
                        <td><?php echo $res->n; ?></td>
                        <td><?php echo $res->prob; ?></td>
                        <td><?php echo $res->Xi_Y; ?></td>
                        <td><?php echo $res->bayes; ?></td>
                    </tr>
                    <?php $count++; ?>
                <?php } ?>
	      	</tr>
            <?php $index++; ?>
	    <?php } ?>
    </tbody>
  </table>
</div>