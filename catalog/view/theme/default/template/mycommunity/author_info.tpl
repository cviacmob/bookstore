<?php echo $header; ?>
<div class="container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>

  <div class="row">

<aside id="column_left"class="col-sm-3 hidden-xs">

<br>
<img src="<?php echo $author_info['author_image'];?>" height="250" width ="250" />

<br>
<br>

<form action="<?php echo $add_to_liked_author;?>" method="post" >

<input type="hidden" name="author_id" value="<?php echo $authorresult['author_id']; ?>">
<div class="view-books">
<button type = "submit" class="btn btn default" id = "myBtn"> <?php echo $button_like_page;?>  </button> &nbsp&nbsp&nbsp&nbsp
<button type = "submit" class="btn btn default" id = "myBtn"> <?php echo $button_view_books;?> </button>
</div>
</form>

</aside>

<div id="content" class="col-sm-9">
<h2><?php echo $author_info['author_name'];?></h2>
<br>
<h4><?php echo $text_born;?>          :    <?php echo $author_info['author_dob'];?></h3>
<h4><?php echo $text_occupation;?>    :   <?php echo $author_info['author_occupation'];?></h3>
<h4><?php echo $text_nationality;?>   :   <?php echo $author_info['author_nationality'];?></h3>


<h3><?php echo $text_early_life;?></h3>
<h4 style="line-height: 2;"><?php echo $author_info['author_education'];?></h4>


<h3><?php echo $text_awards;?></h3>
<h4 style="line-height: 2;"><?php echo $author_info['author_awards'];?></h4>


<h3><?php echo $text_references;?></h3>

<a href="<?php echo $author_info['author_references'];?>" > <?php echo $author_info['author_references'];?> </a>

<h3><?php echo $text_links;?></h3><br>
<a href="<?php echo $author_info['author_external_links'];?>" > <?php echo $author_info['author_external_links'];?> </a>


</div>
  
</div>
</div>


<script type="text/javascript">
var like = 0;
$("#myBtn").click(function(){
     like++;
    $(this).text(""+like+" liked this page");
});

</script>



<?php echo $footer; ?> 