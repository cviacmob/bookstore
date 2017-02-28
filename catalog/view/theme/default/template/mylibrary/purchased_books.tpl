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

<div class="tabbable-panel">
<div class="tabbable-line">
<ul class="nav nav-tabs ">
<li class="active"><a href="#tab_default_1" data-toggle="tab"> <?php echo $text_purchased_books;?> </a></li>
<li><a href="#tab_default_2" data-toggle="tab"> Requested books</a></li>



</ul>




<div class="tab-content">
<div class="tab-pane active" id="tab_default_1">
<div class="row">
<?php foreach($Purchasedbooks as $Purchasedbook) {?>
<div class="product-layout col-lg-4 col-md-3 col-sm-6 col-xs-12 " style="float:left" margin-left="16px">
<div class="product-thumb transition ">
<div class="image">
<a href="<?php echo $Purchasedbook['href']; ?>"><img class="img-responsive" src="<?php echo $Purchasedbook['image']; ?>"></a></div>
<div class="caption">
    <h4><?php echo $Purchasedbook['name']; ?></h4>
</div>
<div class="btn-group btn-width">
  <button type="button" class="review-button" onclick="location.href='<?php echo $review.$Purchasedbook['product_id']; ?>'"><i class="fa fa-star"></i></button>
  <button type="button" class="wishlist-button" onclick="location.href='<?php echo $add_to_favorite.$Purchasedbook['product_id']; ?>'"><i class="fa fa-heart"></i></button>
  
</div>

</div>
</div>
<?php } ?>
</div>
</div> 



<div class="tab-pane" id="tab_default_2">
<div class="row">
<?php foreach($Sharedbooks as $Sharedbook) {?>
<div class="product-layout col-lg-3 col-md-3 col-sm-6 col-xs-12 " >
<div class="product-thumb transition ">
<div class="image">
<a href="<?php echo $Sharedbook['href']; ?>"><img class="img-responsive" src="<?php echo $Sharedbook['image']; ?>"></a>
</div>
<div class="caption">
    <h4><?php echo $Sharedbook['name']; ?></h4>
</div>

<?php if($Sharedbook['status']=='return') { ?> 
<div class="requested">
    <button onclick="location.href='<?php echo $Sharedbook['sharedbook_return']; ?>'" style="width: 100%;">Return</button>  
</div>
<?php } elseif($Sharedbook['status']=='return_in_progress'){ ?>
    <button style="width: 100%;" onclick="this.disabled=true" >Return in Progress</button>
<?php } elseif($Sharedbook['status']=='shipment_in_progress'){ ?>
    <button style="width: 100%;" onclick="this.disabled=true" >Shipment in Progress</button>
<?php }else{ ?>
    <button style="width: 100%;" onclick="this.disabled=true" >Returned</button>
<?php } ?>    
  
</div>
</div>
<?php } ?>
</div>
</div> 

</div>

</div>
</div>

</div>
</div>
</div>
</div>

<?php echo $footer; ?>


