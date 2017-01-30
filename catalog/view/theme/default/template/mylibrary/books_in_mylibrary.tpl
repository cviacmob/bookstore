<?php echo $header; ?>
<div class="container">
 <ul class="breadcrumb">
   <?php foreach ($breadcrumbs as $breadcrumb) { ?>
   <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
   <?php } ?>
 </ul>

<div class="row">

<aside id="column_left" class="col-sm-3 hidden-xs">
<h3><?php echo $text_my_library; ?></h3>
<!-- <a href="<?php echo $createnewshelf; ?>"class="btn btn-default btn-lg" id="button-newshelf" >Create new Shelf</a> <br><br>-->
<div class="list-group"> 
<a href = "<?php echo $books_in_library; ?>" class = "list-group-item"> <?php echo $text_my_books; ?> </a>
<a href = "<?php echo $purchased_books; ?>" class = "list-group-item"> <?php echo $text_purchased; ?> </a>
<a href = "<?php echo $reviewed_books; ?>" class = "list-group-item"> <?php echo $text_reviewed; ?> </a>
<a href = "<?php echo $favorite_books; ?> " class = "list-group-item"> <?php echo $text_favourites; ?> </a>
</div>
</aside>

<div id="content" class="col-sm-9">
<h3><?php echo $text_my_books_in_library; ?></h3>
<?php if ($upload_success) { ?>
<div>
	<p><?php echo $upload_success; ?></p>
</div>
<?php } ?>
<div class="row">
<a href="<?php echo $addbooks; ?>" style="float:left"><button type="button" class="addbooks" value="add books"/><?php echo $text_add_books; ?></button></a>



<?php foreach($books as $book) {?>
 <div class="product-layout col-lg-4 col-md-3 col-sm-6 col-xs-12 " style="float:left" margin-left="16px">
	<div class="product-thumb transition ">
		<div class="image">
			<img class="img-responsive" src="<?php echo $book['image']; ?>">
		</div>
<!--<img class="img-responsive" src="<?php echo $book['image']; ?>">-->
	<div class="caption">
		<h4><a href=""><?php echo $book['title']; ?></a></h4> 
		<p>by <a href=""><?php echo $book['author']; ?></a></p>
	</div>


	<div class="">
		<button class="edit" data-toggle="tooltip" title="edit"onclick="location.href='<?php echo $edit_mylibrary_books.$book['isbn']; ?>'"><i class="fa fa-edit"></i><!--  <span class="hidden-xs hidden-sm hidden-md"> </span> --></button>
		<button class="mylibdelete-button" data-toggle="tooltip" title="delete" onclick="location.href='<?php echo $delete_mylibrary_books.$book['isbn']; ?>'"><i class="fa fa-trash"></i></button>

	</div>



	</div>
 </div>
<?php } ?>
</div>



</div>

</div>
</div>        
<?php echo $footer; ?>


