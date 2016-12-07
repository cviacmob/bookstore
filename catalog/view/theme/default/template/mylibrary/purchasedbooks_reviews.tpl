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
<a href = "<?php echo $books_on_library; ?>" class = "list-group-item"> My Books on Library </a>
<a href = "<?php echo $purchased_books; ?>" class = "list-group-item"> Purchased Books </a>
<a href = "<?php echo $reviewed_books; ?>" class = "list-group-item"> Reviewed Books </a>
<a href = "<?php echo $wishlist; ?> " class = "list-group-item"> Favourites </a>
</div>
</aside>

<div id="content" class="col-sm-9">

<h2><?php echo $text_write; ?></h2>
<div class="bookdetails">
                    <img class ="img-responsive" src="<?php echo $product_info['image'];?>"style="height:300px;width:250px;" align="left" alt="" vspace="20" hspace="20"><br>
                    <div class="caption-full">
                        <h3 class="pull-right"></h3>
                        <h2><?php echo $product_info['name'];?></h2>
                        <?php echo $product_info['product_id'];?>
                        

                <!--         <h3><span>by </span><?php echo $bookresult['author'];?></h3>    -->
                        <h3>ISBN:<?php echo $product_info['model'];?></h3>
                <!--         <h3>Publisher:<?php echo $bookresult['publisher'];?></h3>    -->
               <!--         <h3><?php echo $bookresult['cover_type'];?>:<?php echo $bookresult['no_of_pages'];?><span>pages</span><h3><br>    -->
                    </div>

 
</div>
 <form class="form-horizontal" id="form-review" action ="<?php echo $write_review.$product_info['product_id']; ?>" method="post">
                <div id="review"></div>
                <h2><?php echo $text_write; ?></h2>
               
                <div class="form-group required">
                  <div class="col-sm-12">
                    <label class="control-label" for="input-review"><?php echo $entry_review; ?></label>
                    <textarea name="text" rows="5" id="input-review" class="form-control"></textarea>
                    <!-- <div class="help-block"><?php echo $text_note; ?></div> -->
                  </div>
                </div>
                <div class="form-group required">
                  <div class="col-sm-12">
                    <label class="control-label"><?php echo $entry_rating; ?></label>
                    &nbsp;&nbsp;&nbsp; <?php echo $entry_bad; ?>&nbsp;
                    <input type="radio" name="rating" value="1" />
                    &nbsp;
                    <input type="radio" name="rating" value="2" />
                    &nbsp;
                    <input type="radio" name="rating" value="3" />
                    &nbsp;
                    <input type="radio" name="rating" value="4" />
                    &nbsp;
                    <input type="radio" name="rating" value="5" />
                    &nbsp;<?php echo $entry_good; ?></div>
                </div>
              <!--  <?php echo $captcha; ?> -->
                <div class="buttons clearfix">
                  <div class="pull-right">
                    <input type="submit" class="btn btn-primary" value = "submit" ></button>
                  </div>
                </div>
                 
              </form>

</div>
</div>
</div>
<?php echo $footer; ?>


