<?php echo $header; ?>
<div class="container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>

<div class="row">

<aside id="column_left"class="col-sm-3 hidden-xs">
<h3><?php echo $text_mycommunity; ?></h3>
<div class="list-group">
<a href = "<?php echo $sharedbooks; ?>" button type="button" class = "list-group-item"> <?php echo $button_sharedbooks;?> </a></button>
<a href = "<?php echo $readingclub; ?> " button type="button" class = "list-group-item"><?php echo $button_reading_club;?></a></button>
<a href = "<?php echo $authors; ?> " button type="button" class = "list-group-item"> <?php echo $button_authors;?> </a></button>
<a href = "<?php echo $publishers; ?> " button type="button" class = "list-group-item"> <?php echo $button_publishers;?> </a></button>

</div>
</aside>


<div id="content" class="col-sm-9">
<h3><?php echo $text_search_by_publisher; ?></h3>

<form action="<?php echo $searchpublisher; ?>" method="post" >
<div id="search" class="input-group">
        <input type="text"  class="form-control input-lg" placeholder="<?php echo $text_type_publisher_name;?>" name="publisher_name" required id="input-name">
       <span class="input-group-btn">
            <button class="btn btn-default btn-lg" id="publisher-search" type="submit"><i class="fa fa-search"></i></button>
       </span>
        </div>
  
 </form>
<br>
<div class="tabbable-panel">
<div class="tabbable-line">  

<h4><?php echo $publisherresult['publisher_name'];?></h4>
<div class="row"> 

<a href= "<?php echo $publisher.$publisherresult['publisher_id'];?>"><img class="" src="<?php echo $publisherresult['publisher_image'];?>" style="margin-left: 10px;"> </a>
<br>
<br>



<div class="">
<button type="button"  id="like_<?php echo $publisherresult['publisher_id']; ?>" class="like" style="color:#2091bc;" data-tooltip="tooltip" title="லைக் போடு"> <i class="fa fa-hand-rock-o" style="font-size: 1.5em;"aria-hidden="true"></i></button>&nbsp
<span id="likes_<?php echo $publisherresult['publisher_id']; ?>"style="color:#2091bc;">
	<?php echo $publisherresult['totalLikes']; ?></span>&nbsp
</div>

</div>
</div>
</div>

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

<script type="text/javascript"><!--
$('input[name=\'publisher_name\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=mycommunity/mycommunity/autocomplete_pub&token=<?php echo $token; ?>&publisher_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['publisher_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'publisher_name\']').val(item['label']);
	}
});
</script>



<script type="text/javascript">

$(document).ready(function(){

    // like  click
    $(".like").click(function(){
        var id = this.id;   // Getting Button id
        var split_id = id.split("_");

        var text = split_id[0];
        var publisher_id = split_id[1];  // postid

        // AJAX Request
        $.ajax({
            url: 'index.php?route=mycommunity/mycommunity/publisher_addLikeCount',
            type: 'post',
            data: {publisher_id:publisher_id},
            dataType: 'json',
            success: function(data){
    
              var likes = data['likes'];
              
              $("#likes_"+publisher_id).text(likes).css("color","#2091bc");        // setting likes
              
             
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

<?php echo $footer; ?> 