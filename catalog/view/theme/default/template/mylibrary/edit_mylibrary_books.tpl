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

<!--<div id="content"class="col-sm-9">
<h2>My Books on Library</h2>  
<div class="addbooks">

<a href="<?php echo $addbooks; ?>"</a><button type="button" class="addbooks" value="add books"/>Add Books<i class="fa fa-plus-circle" aria-hidden="true"></i></button>
 
 </div> -->

<div id="content"class="col-sm-9"><br>

 <div class="bookdetails">
                    <img class ="img-responsive" src="<?php echo $bookresult['image'];?>"style="height:300px;width:250px;" align="left" alt="" vspace="20" hspace="20"><br>
                    <div class="caption-full">
                        <h3 class="pull-right"></h3>
                        <h2><?php echo $bookresult['title'];?></h2>
                        <h3><span>by </span><?php echo $bookresult['author'];?></h3>
                        <h3><?php echo $text_isbn;?>:<?php echo $bookresult['isbn'];?></h3>
                        <h3><?php echo $text_publisher;?>:<?php echo $bookresult['publisher'];?></h3>
                        <h3><?php echo $bookresult['cover_type'];?>:<?php echo $bookresult['no_of_pages'];?><span>pages</span><h3><br>
<div class="col-md-offset-5">

<form action="<?php echo $update_to_library; ?>" method="post" >
<?php echo $text_your_price;?>:<br>


<div>
<?php echo $text_sell_price;?>: <input type="textbox" value="<?php echo $bookresult['sell_price'];?>" name="sell_price" vspace="50">
</div><br>

<div>
<?php echo $text_share_price;?>: <input type="textbox" value="<?php echo $bookresult['share_price'];?>" name="share_price" vspace="50">
</div><br>

<!-- <div>
Lend Price: <input type="textbox" value="<?php echo $bookresult['lend_price'];?>" name="lend_price" vspace="50">
</div><br>

<div>
Minium Bid Price: <input type="textbox" value="<?php echo $bookresult['min_bid_price'];?>" name="min_bid_price" vspace="50">
</div><br>  

<div>
Maximum Bid Price: <input type="textbox" value="<?php echo $bookresult['max_bid_price'];?>" name="max_bid_price" vspace="50">
</div><br> -->



<input type="submit" value="Save">
</div>
 
</form><br>
<!-- <div class="pull-right"><a href="<?php echo $add_to_library; ?>"class="btn btn-default btn-lg"  id="button-cart" >Add to Library</a></div> -->

</div>
                           
                        
                   
</div>

                    
</div>
 
</div>
 
</div>
 
</div>

<script type="text/javascript">
$(function () {
$("#sell").click(function () {
if ($(this).is(":checked")) {
$("#dvSell").show();
} else {
$("#dvSell").hide();
}
});
});
</script>

<script type="text/javascript">
$(function () {
$("#share").click(function () {
if ($(this).is(":checked")) {
$("#dvShare").show();
} else {
$("#dvShare").hide();
}
});
});
</script>

<script type="text/javascript">
$(function () {
$("#lend").click(function () {
if ($(this).is(":checked")) {
$("#dvLend").show();
} else {
$("#dvLend").hide();
}
});
});
</script>

<script type="text/javascript">
$(function () {
$("#bid").click(function () {
if ($(this).is(":checked")) {
$("#dvBid").show();
} else {
$("#dvBid").hide();
}
});
});
</script>
     
<?php echo $footer; ?>  





  
  
  
   
