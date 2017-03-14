<?php echo $header; ?>
<div class="container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>

<div class="row">

<aside id="column_left"class="col-sm-3 hidden-xs">
<h2><?php echo $text_community;?></h2>   
<div class="tabbable-panel-left">
<div class="tabbable-line">
<div class="outline">
<img src="<?php echo $group_info['group_image'];?>" height="212.5" width ="258" />
<!--<h3>Tamil Readers</h3>-->
<h3><?php echo $group_info['group_name']; ?></h3>
<!--<input type="submit" id="driver" class="btn btn-default btn-lg" value="JOIN "  />-->
</div>
<br>
<br>
<form action = "<?php echo $join_community.$group_info['group_id'];?>"  method ="post">

<?php if($group_info['status'] == 'member'){ ?>
<button id ="join" onclick="this.disabled = true" class="btn btn-primary"  ><?php echo $button_member;?> </button>
<?php }else { ?>
<button id ="join" class="btn btn-default btn-lg" style="width: 100%;" ><?php echo $button_join;?> </button>
<?php } ?>

</form>   


</div>


</aside>

 <?php if($group_info['status'] == 'member'){ ?> 
<div id="content" class="col-sm-9"><br><br><br>

<div class="tabbable-panel-right">

<div class="tabbable-line"> 

<img class="img-circle "  alt="" width="50" height="50" src="<?php echo $group_info['customer_image']; ?>" />    
&nbsp 
 <input type="text" class="text_share" data-toggle="modal" placeholder="<?php echo $text_sharesomething;?>"data-target="#myPost">
<!--<i class="fa fa-camera" aria-hidden="true"></i>--> 



&nbsp 

</div>
</div> 

<?php }else { ?>

<?php } ?>

&nbsp


<?php foreach($post_info as $post) {?>
<div class="tabbable-panel-right">
<div class="tabbable-line">  
<div class="image">
<img class="img-circle"   alt="" width="50" height="50" src="<?php echo $post['customer_image']; ?>" <h4> <?php echo $first_name; ?>   <?php echo $last_name; ?>    <i class="fa fa-caret-right"  aria-hidden="true"></i>   <?php echo $group_info['group_name']; ?> </h4>

<div class="dropdown"> <button type = "button"  data-tooltip="tooltip" title="நீக்கு" class = "deletepost " data-toggle = "dropdown" id = "dropdownMenu1">
      <i class="fa fa-ellipsis-v"  style="font-size: 1.5em;"></i>
      
   </button>
   <ul class = "dropdown-menu pull-right"  role = "menu" aria-labelledby = "dropdownMenu1">
      <li><a href=""data-toggle="modal"data-target="#deletepost">Delete post</a></li>
       
   </ul>
</div>

   <!-- Delete post -->
  
  <div class="modal fade" id="deletepost" role="dialog">
  <div class="modal-dialog"> 
  <div class="modal-content">
  <div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">&times;</button>
  <h4 class="modal-title">Delete post </h4>
  </div>
  <div class="modal-body">
  <p>Are you sure you want to delete the post?</p>
  </div>
  <div class="modal-footer">
  <form action= "<?php echo $deletepost.$post['post_id']; ?>"  method="post" >
  <input type="hidden" name="group_id" value="<?php echo $post['group_id']; ?>">
  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
  <button type="submit" class="btn btn-primary">Delete</button>
  
  </form>
  </div>
  </div>
  </div>
  </div>

  <!--Delete-->

  
</div>  
<h5><?php echo $post['message']; ?></h5>
<?php if($post['image']) { ?>
<img class="img" src="<?php echo $post['image']; ?>" height = "417" width = "576"/>
<?php  } ?>

<br>

<br>

<button type="button"  id="like_<?php echo $post['post_id']; ?>" class="like"style="color:#2091bc;"data-tool="tooltip" title="லைக் போடு" > <i class="fa fa-hand-rock-o" style="font-size: 1.5em;"aria-hidden="true"></i></button>&nbsp
<span id="likes_<?php echo $post['post_id']; ?>"style="color:#2091bc;"><?php echo $post['totalLikes']; ?></span>&nbsp
      
      
</div>
</div>

<?php } ?>

</div>    
<br>
<br>




<!-- content -->




  <!-- Post -->
  <div class="modal fade" id="myPost" role="dialog">
    <div class="modal-dialog">
    
      <!-- Post content-->
       <form action = "<?php echo $share_post.$group_info['group_id']; ?>"  method ="post" enctype="multipart/form-data">
       <div class="modal-content">
       <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        <img class="img-circle"  alt="" width="50" height="50" src="<?php echo $group_info['customer_image']; ?>"<h4> <?php echo $first_name; ?>   <?php echo $last_name; ?>    <i class="fa fa-caret-right"  aria-hidden="true"></i>   <?php echo $group_info['group_name']; ?> </h4>    
        <br>
        <br>
       <textarea class = "" rows="5" cols="75"  name="text_name" placeholder="<?php echo $text_sharesomething;?>" >  </textarea>
      
  
        <!--<i class="fa fa-camera" aria-hidden="true"></i>-->
        <input type='file' class = "upload" name="image" value="sihfj" onchange="readURL(this);">  
        <img id="blah" class ="" src="" alt="" value="sihfj" />
   
        </div>
        
           
        
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $button_cancel;?></button>
        <input type="submit" class="btn btn-primary" value="<?php echo $button_done;?>" name="submit">

        </div>
        </form>
        </div>
      
        </div>
   
</div>
</div>
</div>
</div>



<script type="text/javascript">

$(document).ready(function(){

    // like and unlike click
    $(".like, .unlike").click(function(){
        var id = this.id;   // Getting Button id
        var split_id = id.split("_");

        var text = split_id[0];
        var post_id = split_id[1];  // postid

        // Finding click type
        var type = 1;
        

        // AJAX Request
        $.ajax({
            url: 'index.php?route=mycommunity/mycommunity/addLikeCount',
            type: 'post',
            data: {post_id:post_id,type:type},
            dataType: 'json',
            success: function(data){
    
              var likes = data['likes'];
               
              $("#likes_"+post_id).text(likes).css("color","#2091bc");        // setting likes
                
             
            }
            
        });

    });

});

</script>


<script type="text/javascript">
function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result)
                        .width(150)
                        .height(200);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
</script>

<script type="text/javascript">
$(document).ready(function(){
    $('[data-tooltip="tooltip"]').tooltip();   
});
</script>

<script type="text/javascript">
$(document).ready(function(){
    $('[data-tool="tooltip"]').tooltip();   
});
</script>

<?php echo $footer; ?>