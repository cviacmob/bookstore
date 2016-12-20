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
<h3>Search by Author</h3>

<form action="<?php echo $searchauthor; ?>" method="post" >
 <div class="input-group col-xs-3">
        <input type="text"  class="form-control" placeholder="<?php echo $text_type_author_name;?>" name="text_author_mastersearch" >
        <div class="input-group-btn">
            <button class="btn btn-default" id="author-search" type="submit"><i class="glyphicon glyphicon-search"></i></button>
        </div>
   </div>
 </form>

<div class="image">
<a href= "<?php echo $author.$authorresult['author_id'];?>"><img class="img-responsive" src="<?php echo $authorresult['author_image'];?>" style="height:323px;width:323px;" align="left" alt="" vspace="20" hspace="20"> </a>
</div>

<!--<img class ="img-responsive" src="<?php echo $authorresult['author_image'];?>"style="height:300px;width:250px;" align="left" alt="" vspace="20" hspace="20"><br>-->
<h4><?php echo $authorresult['author_name'];?></h4>

<form action="<?php echo $add_to_liked_author;?>" method="post" >

<input type="hidden" name="author_id" value="<?php echo $authorresult['author_id']; ?>">

<button type = "submit "id = "myBtn"> LIKE </button>

</form>

</div>

</div>
</div>

<script type="text/javascript">
var like = 0;
$("#myBtn").click(function(){
     like++;
    $(this).text(""+like+" like");
});

</script>






</div>

</div>
</div>




<?php echo $footer; ?> 