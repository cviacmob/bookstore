<?php echo $header; ?>
<div class="container">
<ul class="breadcrumb">
<?php foreach ($breadcrumbs as $breadcrumb) { ?>
<li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
<?php } ?>
</ul>

<div class="row">

<aside id="column_left"class="col-sm-3 hidden-xs">

<div class="tabbable-panel-left">
<div class="tabbable-line">
<div class="outline">
<img src="<?php echo $club_info['group_image'];?>" height="203" width ="240" />
   
</div>
</div>
</div>
<h3><?php echo $club_info['group_name']; ?>   </h3>

<form action= "<?php echo $join_community.$club_info['group_id'];?>"  method="post" >
<button type="submit" class="btn btn-primary" >JOIN</button> &nbsp&nbsp&nbsp

</form>

</aside>


<div id="content" class="col-sm-9">
<h3>Accept the invitation if you wish to view this Club</h3>


</div>
</div>
</div>

<?php echo $footer; ?> 