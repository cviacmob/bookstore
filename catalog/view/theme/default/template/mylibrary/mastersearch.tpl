<?php echo $header; ?>
<div class="container">
 <ul class="breadcrumb">
   <?php foreach ($breadcrumbs as $breadcrumb) { ?>
   <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
   <?php } ?>
 </ul>

<div class="row">

<aside id="column_left"class="col-sm-3 hidden-xs">
<h3>My Library</h3>
<a href="<?php echo $createnewshelf; ?>"class="btn btn-default btn-lg" id="button-newshelf" >Create new Shelf</a> <br><br>
<div class="list-group">
<a href = "<?php echo $books_in_library; ?>" class = "list-group-item"> My Books </a>
<a href = "<?php echo $purchased_books; ?>" button type = "button" class = "list-group-item"> Purchased </a> </button>
<a href = "<?php echo $reviewed_books; ?> " class = "list-group-item"> Reviewed </a>
<a href = "<?php echo $favorite_books; ?>" class = "list-group-item"> Favourites </a>
</div>
</aside>

<!--<div id="content"class="col-sm-9">
<h2>My Books on Library</h2>  
<div class="addbooks">

<a href="<?php echo $addbooks; ?>"</a><button type="button" class="addbooks" value="add books"/>Add Books<i class="fa fa-plus-circle" aria-hidden="true"></i></button>
 
 </div> -->

<div id="content"class="col-sm-9"><br><br><br><br><br><br>

<form action="<?php echo $searchisbn; ?>" method="post" >
 <div class="input-group col-xs-3">
        <input type="text" class="form-control" placeholder="enter ISBN" name="text_mastersearch" id="text_search">
        <div class="input-group-btn">
            <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
        </div>
   </div>
 </form>

 

 <div class="bookdetails">
                    <img class ="img-responsive" src="<?php echo $bookresult['image'];?>"style="height:300px;width:250px;" align="left" alt="" vspace="20" hspace="20"><br>
                    <div class="caption-full">
                        <h3 class="pull-right"></h3>
                        <h2><?php echo $bookresult['title'];?></h2>
                        <h3><span>by </span><?php echo $bookresult['author'];?></h3>
                        <h3>ISBN:<?php echo $bookresult['isbn'];?></h3>
                        <h3>Publisher:<?php echo $bookresult['publisher'];?></h3>
                        <h3><?php echo $bookresult['cover_type'];?>:<?php echo $bookresult['no_of_pages'];?><span>pages</span><h3><br>
<div class="col-md-offset-5">

<form action="<?php echo $add_to_library; ?>" method="post" >
Options :<br>

<input type="checkbox" id="sell" onclick="ShowHideDiv(this)">Sell<br>
<div id="dvSell" style="display: none">
Price: <input type="textbox"  name="sell_price" id="txtPassportNumber" value="" vspace="50">
</div>

<input type="checkbox" id="share" onclick="ShowHideDiv(this)" >Share<br>
<div id="dvShare" style="display: none">
Price: <input type="textbox"  name="share_price" id="txtPassportNumber" value="" >
</div>

<!-- <input type="checkbox" id="lend" onclick="ShowHideDiv(this)" name="vehicle" value="Bike">Lend<br>
<div id="dvLend" style="display: none">
Price: <input type="textbox"  name="lend_price" id="txtPassportNumber" value="" >
</div>

<input type="checkbox" id="bid" onclick="ShowHideDiv(this)" name="vehicle" value="Car">Bid <br>
<div id="dvBid" style="display: none">
Min.Price: <input type="textbox"  name="min_bid_price" id="bidprice" value="" ><br><br>
Max.Price: <input type="textbox"  name="max_bid_price" id="bidprice" value="" >
</div> -->

<input type="submit" value="Add to Library">
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





  
  
  
   
