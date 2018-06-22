<div class="profile-content">
	<h2><?php echo $category->name; ?></h2>
	<form method="get" action="<?php echo base_url() . 'twitter/create_word'; ?>">
    <input type="hidden" name="categoryID" value="<?php echo $category->id ?>">
    <div class="form-group">
      <label for="name">Word:</label>
      <input type="text" class="form-control" id="name" placeholder="Enter word" name="name">
    </div>
    <button type="submit" class="btn btn-primary">Create</button>
  </form>
</div>