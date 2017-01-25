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
<a href = "<?php echo $purchased_books; ?>" class = "list-group-item"> Purchased  </a>
<a href = "<?php echo $reviewed_books; ?>" class = "list-group-item"> Reviewed  </a>
<a href = "<?php echo $favorite_books; ?> " class = "list-group-item"> Favourites </a>
</div>
</aside>

<div id="content" class="col-sm-9">

<h2>Your Review</h2>
<div class="bookdetails">
                    <img class ="img-responsive" src="<?php echo $product_info['image'];?>"style="height:300px;width:250px;" align="left" alt="" vspace="20" hspace="20"><br>
                    <div class="caption-full">
                        <h3 class="pull-right"></h3>
                        <h2><?php echo $product_info['name'];?></h2>
                        

                <!--         <h3><span>by </span><?php echo $bookresult['author'];?></h3>    -->
                        <h3>ISBN:<?php echo $product_info['model'];?></h3>
                <!--         <h3>Publisher:<?php echo $bookresult['publisher'];?></h3>    -->
               <!--         <h3><?php echo $bookresult['cover_type'];?>:<?php echo $bookresult['no_of_pages'];?><span>pages</span><h3><br>    -->
                    </div>

 
</div>

<form class="form-horizontal" id="form-review">
   <div class="form-group required">
        <div class="col-sm-12">
            <label ><?php echo $entry_review; ?></label>
             <textarea name="text" rows="5" id="input-review" class="form-control"><?php echo $yourReview['text']; ?></textarea>
         
          <label >Your Rating:</label>         
          <?php if ($review_status) { ?>
          <div class="rating">
            
              <?php for ($i = 1; $i <= 5; $i++) { ?>
              <?php if ($yourReview['rating'] < $i) { ?>
              <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
              <?php } else { ?>
              <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
              <?php } ?>
              <?php } ?>
              
          </div>
          <?php } ?>
                   
        </div>
  </div>
</form>
</div>

<!-- <div id = "your_review" class="col-sm-offset-3"><h3>Your Review:<?php echo $yourReview['text']; ?></h3></div> -->
</div>
</div>
<?php echo $footer; ?>


