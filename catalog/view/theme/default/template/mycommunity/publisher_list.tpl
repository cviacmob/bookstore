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
<h3><?php echo $text_search_bypublisher;?></h3>


<form action="<?php echo $searchpublisher; ?>" method="post" >
 <div id="search" class="input-group">
        <input type="text" class="form-control input-lg" placeholder="<?php echo $text_type_publisher_name;?>" name="publisher_name" required id="input-name">
        <span class="input-group-btn">
            <button class="btn btn-default btn-lg" type="submit"><i class="fa fa-search"></i></button>
        </span>
 </div>
 </form>


<br>

<div class="tabbable-panel">
<div class="tabbable-line">

<div class="row">   
 <?php foreach($publishers as $publisher) {?>
<div class="product-layout col-lg-3 col-md-3 col-sm-6 col-xs-12 " style="float:left">
<div class="product-thumb transition ">
<div class="image">
<a href= "<?php echo $publisher_image.$publisher['publisher_id'];?>"><img class="img-responsive" src="<?php echo $publisher['publisher_image']; ?>"style="height:300px;width:250px;" align="left" alt="" vspace="20" hspace="20"> </a>
</div>
<div class="caption">
<h4><?php echo $publisher['publisher_name']; ?></h4>

</div>
</div>
</div>
<?php } ?>

</div>
</div>
</div>

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



<?php echo $footer; ?>  