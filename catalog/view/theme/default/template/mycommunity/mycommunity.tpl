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
<h3><?php echo $text_shared_books; ?></h3>
<div class="row">

<?php foreach($shared_books as $shared_book) {?>
 <div class="product-layout col-lg-4 col-md-3 col-sm-6 col-xs-12 " style="float:left" margin-left="16px">
	<div class="product-thumb transition ">
		<div class="image">
		<a href="<?php echo $shared_book['href']; ?>">	<img class="img-responsive" src="<?php echo $shared_book['image']; ?>"> </a>
		</div>
<!--<img class="img-responsive" src="<?php echo $book['image']; ?>">-->
	<div class="caption">
     <h4><a href=""><?php echo $shared_book['name']; ?></a></h4> 
		<p>by <?php echo $shared_book['author']; ?></p>
</div>
      <!--  <h4><a href=""><?php echo $shared_book['product_id']; ?></a></h4> 
	</div>

<br>

<!--<form action = "<?php echo $share_with_me.$shared_book['isbn']; ?>"  method ="post">
            
<input type="hidden" name="isbn" value="<?php echo $shared_book['isbn']; ?>">
<button type="button" class="sh"  onclick="cart.add('<?php echo $shared_book['product_id']; ?>');"><?php echo $button_share_with_me;?> </button>
</form>  -->
 <!--<button type="button" id="button-cart" data-loading-text="<?php echo $text_loading; ?>" class="sh"><?php echo $button_share_with_me;?> </button>-->
<button type="button" class="sh"  onclick="cart.add('<?php echo $shared_book['product_id']; ?>');"><?php echo $button_share_with_me;?> </button>

</div>
</div>
<?php } ?>
</div>


</div>

</div>
</div>







<script type="text/javascript"><!--
$('#button-cart').on('click', function() {
	$.ajax({
		url: 'index.php?route=checkout/cart/add',
		type: 'post',
		data: $('#product input[type=\'text\'], #product input[type=\'hidden\'], #product input[type=\'radio\']:checked, #product input[type=\'checkbox\']:checked, #product select, #product textarea'),
		dataType: 'json',
		beforeSend: function() {
			$('#button-cart').button('loading');
		},
		complete: function() {
			$('#button-cart').button('reset');
		},
		success: function(json) {
			$('.alert, .text-danger').remove();
			$('.form-group').removeClass('has-error');

			if (json['error']) {
				if (json['error']['option']) {
					for (i in json['error']['option']) {
						var element = $('#input-option' + i.replace('_', '-'));

						if (element.parent().hasClass('input-group')) {
							element.parent().after('<div class="text-danger">' + json['error']['option'][i] + '</div>');
						} else {
							element.after('<div class="text-danger">' + json['error']['option'][i] + '</div>');
						}
					}
				}

				if (json['error']['recurring']) {
					$('select[name=\'recurring_id\']').after('<div class="text-danger">' + json['error']['recurring'] + '</div>');
				}

				// Highlight any found errors
				$('.text-danger').parent().addClass('has-error');
			}

			if (json['success']) {
				$('.breadcrumb').after('<div class="alert alert-success">' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');

				$('#cart > button').html('<span id="cart-total"><i class="fa fa-shopping-cart"></i> ' + json['total'] + '</span>');

				$('html, body').animate({ scrollTop: 0 }, 'slow');

				$('#cart > ul').load('index.php?route=common/cart/info ul li');
			}
		},
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
	});
});
//--></script>

<?php echo $footer; ?> 