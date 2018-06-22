<div class="profile-content">
	<h2><?php echo $category->name; ?></h2>
	<form method="get" action="<?php echo base_url() . 'twitter/update_word/' . $subcategory->id; ?>">
    <input type="hidden" name="categoryID" value="<?php echo $category->id ?>">
    <div class="form-group">
      <label for="name">Word:</label>
      <input type="text" class="form-control" id="name" placeholder="Enter word" name="name" value="<?php echo $subcategory->name ?>">
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
  </form>
</div>