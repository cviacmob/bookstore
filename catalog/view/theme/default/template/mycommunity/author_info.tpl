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

</aside>


<div id="content" class="col-sm-9">
<h2><?php echo $author_info['author_name'];?></h2>
<br>
<h4>Born  :    <?php echo $author_info['author_dob'];?></h3>
<h4>Occupation :   <?php echo $author_info['author_occupation'];?></h3>
<h4>Nationality :   <?php echo $author_info['author_nationality'];?></h3>

<br>
<br>
<form action="<?php echo $add_to_liked_author;?>" method="post" >

<input type="hidden" name="author_id" value="<?php echo $authorresult['author_id']; ?>">

<button type = "submit" class="btn btn default" id = "myBtn"> LIKE PAGE </button>

</form>
<br>
<br>


<h3>Early life and Education</h3>
<h4 style="line-height: 2;"><?php echo $author_info['author_education'];?></h4>


<h3>Awards</h3>
<h4 style="line-height: 2;"><?php echo $author_info['author_awards'];?></h4>


<h3>References</h3>

<a href="<?php echo $author_info['author_references'];?>" > <?php echo $author_info['author_references'];?> </a>

<h3>External Links</h3><br>
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