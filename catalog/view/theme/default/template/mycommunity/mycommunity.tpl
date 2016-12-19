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
<h3>Shared Books</h3>
<div class="row">
<div class="tabbable-panel">
<div class="tabbable-line">
<ul class="nav nav-tabs ">
<li class="active"><a href="#tab_default_1" data-toggle="tab"> <?php echo $text_available_books;?> </a></li>
<li><a href="#tab_default_2" data-toggle="tab"> <?php echo $text_requested_books;?></a></li>



</ul>


<div class="tab-content">
<div class="tab-pane active" id="tab_default_1">
<div class="row">
<?php foreach($groups as $group) {?>
<div class="product-layout col-lg-3 col-md-3 col-sm-6 col-xs-12 ">
<div class="product-thumb transition ">
<h4><?php echo $group['group_name']; ?></h4>  
<div class="image">
<a href= "<?php echo $recommended_image.$group['group_id'];?>"><img class="img-responsive" src="<?php echo $group['group_image']; ?>"/> </a>
</div><br>


<form action = "<?php echo $addmember; ?>"  method ="post">
            
<input type="hidden" name="groupid" value="<?php echo $group['group_id']; ?>">
<input class="myBtn" type="submit"   value="<?php echo $button_join;?>">
</form>   
          
<!--<a href="<?php echo $join; ?>"</a><button type="button" class="join" value="join" onclick="mycommunity.join('<?php echo $mycommunity['group_id']; ?>');">JOIN</button>-->

</div>
</div>
<?php } ?>
</div> 
</div> 


<div class="tab-pane" id="tab_default_2">
<div class="row">
<?php foreach($members as $member) {?>
<div class="product-layout col-lg-3 col-md-3 col-sm-6 col-xs-12 ">

<h4><?php echo $member['group_name']; ?></h4>  
<div class="image">
 <input type = "image" img class="img-responsive" src="<?php echo $member['group_image']; ?>"/>
</div><br>


</div>
<?php } ?>
</div> 
</div>







</div>
</div>
</div>
</div>

</div>
</div>
</div>

<?php echo $footer; ?> 