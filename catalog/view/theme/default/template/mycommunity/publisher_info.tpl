<?php echo $header; ?>
<div class="container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>

  <div class="row">

<aside id="column_left"class="col-sm-3 hidden-xs">

<h3><?php echo $publisher_info['publisher_name'];?></h3>
<img src="<?php echo $publisher_info['publisher_image'];?>" height="203" width ="240" />
<br>
<h3>Address </h3>
<h4><?php echo $publisher_info['publisher_address'];?></h4>

</aside>











  
</div>
</div>





<?php echo $footer; ?> 