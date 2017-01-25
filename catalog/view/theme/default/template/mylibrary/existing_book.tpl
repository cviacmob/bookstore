<?php echo $header; ?>
<div class="container">
 <ul class="breadcrumb">
   <?php foreach ($breadcrumbs as $breadcrumb) { ?>
   <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
   <?php } ?>
 </ul>

<div class="row">

<aside id="column_left"class="col-sm-3 hidden-xs">
<h3><?php echo $heading_title; ?></h3>
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
                    <h3><?php echo $text_exist_book;?></h3>
                    <img class ="img-responsive" src="<?php echo $existing_book['image'];?>"style="height:300px;width:250px;" align="left" alt="" vspace="20" hspace="20"><br>
                    <div class="caption-full">
                        <h3 class="pull-right"></h3>
                        <h2><?php echo $existing_book['title'];?></h2>
                        <h3><span>by </span><?php echo $existing_book['author'];?></h3>
                        <h3><?php echo $text_isbn;?>:<?php echo $existing_book['isbn'];?></h3>
                        <h3><?php echo $text_publisher;?>:<?php echo $existing_book['publisher'];?></h3>
                        <h3><?php echo $existing_book['cover_type'];?>:<?php echo $existing_book['no_of_pages'];?><span>pages</span><h3><br>

                        
                   
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





  
  
  
   
