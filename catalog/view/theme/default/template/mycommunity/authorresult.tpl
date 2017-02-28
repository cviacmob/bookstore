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

<h3><?php echo $text_search_by_author; ?></h3>

<form action="<?php echo $searchauthor; ?>" method="post" >
 <div id="search" class="input-group">
     <!--   <input type="text"  class="form-control" placeholder="<?php echo $text_type_author_name;?>" name="text_author_mastersearch" >-->
     <input type="text"  class="form-control input-lg" placeholder="<?php echo $text_type_author_name;?>" name="filter_name" id="input-name" required >
        <span class="input-group-btn">
            <button  type="sublit" class="btn btn-default btn-lg" id="author-search">
              <i class="fa fa-search"></i>
              </button>
        </span>
        </div>
   
 </form>
<br>
<h4>எழுத்தாளர்ப்பெயர்: <?php echo $authorresult['author_name'];?></h4>


<a href= "<?php echo $author_image.$authorresult['author_id'];?>"><img class="" src="<?php echo $authorresult['author_image'];?>" style="margin-left:6px;" vspace="20" hspace="20"> </a>


<!--<img class ="img-responsive" src="<?php echo $authorresult['author_image'];?>"style="height:300px;width:250px;" align="left" alt="" vspace="20" hspace="20"><br>-->

<form action="<?php echo $add_to_liked_author.$authorresult['author_id'];?>" method="post" >

<!--<input type="hidden" name="author_id" value="<?php echo $authorresult['author_id']; ?>"> -->
<!--<h4><?php echo $authorresult['total_votes'];?></h4>-->
<!--<input class = "join" id="btn" type="submit" value="LIKE"> -->
<button type="submit"> <?php echo $authorresult['total_votes'];?> LIKES  </button>

</div>
<!-- <button type = "submit"  onclick="insert_like();" id="like_button"> LIKE </button>
<div id="totalvotes"></div> -->

</form>



</div>

</div>
</div>

<!--<script type="text/javascript">
var like = 0;
$("#myBtn").click(function(){
     like++;
    $(this).text(""+like+" like");
});

</script>

<!--<script type="text/javascript">
  function insert_like()
    {
	  $.ajax({
	    type: 'post',
	    url: 'index.php?route=mycommunity/mycommunity/addToLikedauthor&author_id=<?php echo $author_id; ?>',
	    data: {
	      post_like:"like"
	    },
	    success: function (response) {
 	      $('#totalvotes').slideDown()
	      {			
	        $('#totalvotes').html(response);
	      }
	    }
	    });
    }

</script> -->




</div>

</div>
</div>

<script type="text/javascript"><!--
$('input[name=\'filter_name\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=mycommunity/mycommunity/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['author_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'filter_name\']').val(item['label']);
	}
});
</script>


<?php echo $footer; ?> 