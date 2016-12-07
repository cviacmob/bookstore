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
<a href = " " class = "list-group-item"> My Books on Library </a>
<a href = " " class = "list-group-item"> Purchased Books </a>
<a href = " " class = "list-group-item"> Reviewed Books </a>
<a href = " " class = "list-group-item"> Favourites </a>
</div>
</aside>

<div id="content"class="col-sm-9"><br><br><br><br><br><br>

<form action="<?php echo $searchisbn; ?>" method="post" >
 <div class="input-group col-xs-3">
        <input type="text" class="form-control" placeholder="enter ISBN" name="text_mastersearch" id="text_search">
        <div class="input-group-btn">
            <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
        </div>
    </div>
    </form>
 
</div>
 
</div>
 
</div>
     
<?php echo $footer; ?>  





<form action="<?php echo $searchisbn; ?>" method="post" >
  
  
  
   