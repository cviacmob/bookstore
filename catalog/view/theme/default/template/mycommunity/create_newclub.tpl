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
<h3><?php echo $text_create_reading_club; ?></h3><br>

<form action = "<?php echo $create_club; ?>"  method ="post">

          <label for="fname"><?php echo $text_name_this_club;?></label>
          <input type="text" name="club_name" required value="" placeholder="" class="form-control input-lg" /> <br> 
          <label for="fname"><?php echo $text_description;?></label>
          <input type="text" name="club_description" required value="" placeholder="" class="form-control input-lg" /> <br>
          <label for="fname"><?php echo $text_location;?></label>
          <input type="text" name="location" value="" required placeholder="" class="form-control input-lg" /> <br>
          


 <div class="done">
 <button id = "done" type="submit" class="btn btn-default" ><?php echo $button_done;?></button>
 </div>       
 </form>

<div class="cancel">
<button type="button" class="btn btn-default" onclick="location.href='<?php echo $cancel; ?>'" ><?php echo $button_cancel;?></button>
</div>

</div>

</div>
</div>


<?php echo $footer; ?>










