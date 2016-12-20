<?php echo $header; ?>
<div class="container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>

<div class="row">

<aside id="column_left"class="col-sm-3 hidden-xs">
<h3>My Community</h3>
<div class="list-group">
<a href = "<?php echo $sharedbooks; ?>" button type="button" class = "list-group-item"> <?php echo $button_sharedbooks;?> </a></button>
<a href = "<?php echo $readingclub; ?> " button type="button" class = "list-group-item"><?php echo $button_reading_club;?></a></button>
<a href = "<?php echo $authors; ?> " button type="button" class = "list-group-item"> <?php echo $button_authors;?> </a></button>
<a href = "<?php echo $publishers; ?> " button type="button" class = "list-group-item"> <?php echo $button_publishers;?> </a></button>

</div>
</aside>

<div id="content" class="col-sm-9">
<h3>Shared Books</h3>
<div class="row">
<div class="tabbable-panel">
<div class="tabbable-line">
<ul class="nav nav-tabs ">
<li class="active"><a href="#tab_default_1" data-toggle="tab"> <?php echo $text_available_books;?> </a></li>
<li><a href="#tab_default_2" data-toggle="tab"> <?php echo $text_requested_books;?></a></li>



</ul>


<div class="tab-content">
<div class="tab-pane active" id="tab_default_1">
<div class="row">
<?php foreach($shared_books as $shared_book) {?>
 <div class="product-layout col-lg-4 col-md-3 col-sm-6 col-xs-12 " style="float:left" margin-left="16px">
	<div class="product-thumb transition ">
		<div class="image">
			<img class="img-responsive" src="<?php echo $shared_book['image']; ?>">
		</div>
<!--<img class="img-responsive" src="<?php echo $book['image']; ?>">-->
	<div class="caption">
		<h4><a href=""><?php echo $shared_book['title']; ?></a></h4> 
		<p>by <a href=""><?php echo $shared_book['author']; ?></a></p>
  
	</div>

<br>

<form action = "<?php echo $share_with_me.$shared_book['isbn']; ?>"  method ="post">
            
<input type="hidden" name="isbn" value="<?php echo $shared_book['isbn']; ?>">

 <!--<button id = "myBtn" type="submit" class="sharewithme" ><?php echo $button_share_with_me;?></button>-->
<button type="submit" class="sh" ><?php echo $button_share_with_me;?> </button></a>

</form>  


</div>
</div>
<?php } ?>
</div>
</div> 





<div class="tab-pane" id="tab_default_2">
<div class="row">
<?php foreach($books as $book) {?>
<div class="product-layout col-lg-3 col-md-3 col-sm-6 col-xs-12 ">
 <div class="product-thumb transition ">
  <div class="image">
 <input type = "image" img class="img-responsive" src="<?php echo $book['image']; ?>"/>
</div><br>
	<h4><a href=""><?php echo $book['title']; ?></a></h4> 
	<p>by <a href=""><?php echo $book['author']; ?></a></p>

  <button type="submit" class="sh" ><?php echo $button_shared;?> </button></a>
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