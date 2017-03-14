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
<div class="tabbable-panel-left">
<div class="tabbable-line">
<div class="outline">
<img src="<?php echo $author_info['author_image'];?>" height="203" width ="240" />

<br>
<br>

<button type="button"  data-tooltip="tooltip" title="லைக் போடு" id="like_<?php echo $author_info['author_id']; ?>" class="like" style="color:#2091bc;"> <i class="fa fa-hand-rock-o" style="font-size: 1.5em;"aria-hidden="true"></i></button>&nbsp
<span id="likes_<?php echo $author_info['author_id']; ?>" style="color:#2091bc;"> <?php echo $author_info['totalLikes']; ?></span>&nbsp&nbsp&nbsp

 <button type = "button" class="eye" data-tooltip="tool" title="<?php echo $author_info['author_name']; ?> புத்தகத்தை பாரு ">
   <i class="fa fa-eye" style="font-size: 1.5em;" aria-hidden="true"></i>
   </button>

</div>
</div>
<!--<button type = "submit" class="btn btn default" id = "myBtn"> <?php echo $button_like_page;?>  </button>
<button type = "submit" class="btn btn default" id = "myBtn"> <?php echo $button_view_books;?> </button>-->



</aside>

<div id="content" class="col-sm-9"><br>
<div class="tabbable-panel">
<div class="tabbable-line"> 
<h2><?php echo $author_info['author_name'];?></h2>
<br>
<h4><?php echo $text_born;?>          :   <?php echo $author_info['author_dob'];?></h3>
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
  
</div>
</div>
</div>

<script type="text/javascript">

$(document).ready(function(){

    // like  click
    $(".like").click(function(){
        var id = this.id;   // Getting Button id
        var split_id = id.split("_");

        var text = split_id[0];
        var author_id = split_id[1];  // postid

        // AJAX Request
        $.ajax({
            url: 'index.php?route=mycommunity/mycommunity/author_addLikeCount',
            type: 'post',
            data: {author_id:author_id},
            dataType: 'json',
            success: function(data){
    
              var likes = data['likes'];
              
              $("#likes_"+author_id).text(likes).css("color","#2091bc");        // setting likes
              
             
            }
            
        });

    });

});

</script>

<script type="text/javascript">
$(document).ready(function(){
    $('[data-tooltip="tooltip"]').tooltip();   
});
</script>

<script type="text/javascript">
$(document).ready(function(){
    $('[data-tooltip="tool"]').tooltip();   
});
</script>



<?php echo $footer; ?> 