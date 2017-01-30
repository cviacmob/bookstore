<?php echo $header; ?>
<div class="container">
 <ul class="breadcrumb">
   <?php foreach ($breadcrumbs as $breadcrumb) { ?>
   <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
   <?php } ?>
 </ul>

<div class="row">

<aside id="column_left"class="col-sm-3 hidden-xs">
<h3><?php echo $text_my_library; ?></h3>
<!-- <a href="<?php echo $createnewshelf; ?>"class="btn btn-default btn-lg" id="button-newshelf" >Create new Shelf</a> <br><br> -->
<div class="list-group">
<a href = "<?php echo $books_in_library; ?>" class = "list-group-item"> <?php echo $text_my_books; ?> </a>
<a href = "<?php echo $purchased_books; ?>" class = "list-group-item"> <?php echo $text_purchased; ?> </a>
<a href = "<?php echo $reviewed_books; ?>" class = "list-group-item"> <?php echo $text_reviewed; ?> </a>
<a href = "<?php echo $favorite_books; ?> " class = "list-group-item"> <?php echo $text_favourites; ?> </a>
</div>
</aside>

<div id="content" class="col-sm-9">
<h3><?php echo $text_purchased_books; ?></h3>
<div class="row">
<?php foreach($books as $book) {?>
<div class="product-layout col-lg-4 col-md-3 col-sm-6 col-xs-12 " style="float:left">
<div class="product-thumb transition ">
<div class="image">
<a href="<?php echo $book['href']; ?>"><img class="img-responsive" src="<?php echo $book['image']; ?>"></a>
</div>
<!--<img class="img-responsive" src="<?php echo $book['image']; ?>">-->
<div class="caption">
<h4><?php echo $book['name']; ?></h4>
<!--<p><?php echo $book['author']; ?></p>-->
</div>




<div class="btn-group btn-width">
  <button type="button" class="review-button" onclick="location.href='<?php echo $review.$book['product_id']; ?>'"><i class="fa fa-star"></i></button>
  <button type="button" class="wishlist-button" onclick="location.href='<?php echo $add_to_favorite.$book['product_id']; ?>'"><i class="fa fa-heart"></i></button>
  <!--<button type="button" class="btn btn-default btn-like" onclick="wishlist.add('<?php echo $book['product_id']; ?>');"><i class="fa fa-heart"></i></button> -->
</div>



</div>
</div>
<?php } ?>
</div>



</div>

</div>
</div>        
<?php echo $footer; ?>


