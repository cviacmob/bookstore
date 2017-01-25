<?php echo $header; ?>
<div class="container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>

  <div class="row">

<aside id="column_left"class="col-sm-3 hidden-xs">

<h3><?php echo $publisher_info['publisher_name'];?></h3>
<img src="<?php echo $publisher_info['publisher_image'];?>" height="203" width ="240" />
<br>
<br>

<form action="<?php echo $add_to_liked_publisher;?>" method="post" >

<input type="hidden" name="publisher_id" value="<?php echo $publisherresult['publisher_id']; ?>">
<div class="view-books-pub">
<button type = "submit" class="btn btn default" id = "myBtn"> <?php echo $button_like_page;?> </button> &nbsp&nbsp&nbsp&nbsp
<button type = "submit" class="btn btn default" id = "myBtn"> <?php echo $button_view_books;?> </button>
</div>
</form>

</aside>

<div id="content" class="col-sm-9">
<br>
<h3><?php echo $text_address;?> </h3>
<h4><?php echo $publisher_info['publisher_address'];?></h4>



</div>



</div>
</div>

<?php echo $footer; ?> 