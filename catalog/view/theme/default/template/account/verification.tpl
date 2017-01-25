<?php echo $header; ?>
<div class="container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>

<div class="row">


   <h1><?php echo $heading_title; ?></h1>
  <p><?php echo $text_account_verified; ?></p>
  <p><a href="<?php echo $login; ?>"><?php echo $login; ?></a></p>



</div>
</div>

<?php echo $footer; ?>  