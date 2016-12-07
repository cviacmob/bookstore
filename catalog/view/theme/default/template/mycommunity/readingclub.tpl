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
<a href = "<?php echo $sharedbooks; ?>" button type="button" class = "list-group-item"> Shared Books </a></button>
<a href = "<?php echo $readingclub; ?> " button type="button" class = "list-group-item">Reading Club </a></button>
<a href = "<?php echo $sharedbooks; ?> " button type="button" class = "list-group-item"> Authors & Publishers </a></button>

</div>
</aside>

<div id="content" class="col-sm-9">
<h3>Reading Club</h3>
<div class="row">
<div class="tabbable-panel">
<div class="tabbable-line">
<ul class="nav nav-tabs ">
<li class="active"><a href="#tab_default_1" data-toggle="tab">Recommended</a></li>
<li><a href="#tab_default_2" data-toggle="tab">Member</a></li>
<li><a href="#tab_default_3" data-toggle="tab">Yours</a></li>


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
<input class="myBtn" type="submit"    value="JOIN">
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

<div class="tab-pane" id="tab_default_3">
<div class="row">
<button type="button" style="float:left" data-toggle="modal" data-target="#myModal" class="addbooks" value="add books"/>Create club<i class="fa fa-plus-circle" aria-hidden="true"></i></button></a>
<?php foreach($clubs as $club) {?>
<div class="product-layout col-lg-3 col-md-3 col-sm-6 col-xs-12 ">
<div class="product-thumb transition ">
<h4><?php echo $club['group_name']; ?></h4>
<div class="image">
<input type = "image" img class="img-responsive" src="<?php echo $club['group_image']; ?>"/>
</div>
<h4><?php echo $club['group_description']; ?></h4>
</div>
</div>
<?php } ?>
</div>
</div>   

 <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">   

   <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Create a Club</h4>
        </div>      

 <div class="modal-body">
          <form action = "<?php echo $create_club; ?>"  method ="post">
          <label for="fname">Name this club</label>
          <input type="text" name="club_name" value="" placeholder="enter club name" class="form-control input-lg" /> <br> 
          <label for="fname">Description</label>
          <input type="text" name="club_description" value="" placeholder="enter club description" class="form-control input-lg" /> <br> 



        </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
     <!--      <button type="button" class="btn btn-default" data-dismiss="modal">Done</button>-->
         <input id="done" type="submit" class="btn btn-default"  value="Done">
        </div>
</form>

 </div>

</div>
</div>






</div>

</div>

</div>

</div>





</div>

</div>
</div>

<script type="text/javascript">
$(".myBtn").on('click',function(){
    var self=$(this);
    if(self.val()=="JOIN")     {
   self.val("MEMBER");  
    }
    else {
   self.val("MEMBER");
    }
});

</script>

<?php echo $footer; ?>