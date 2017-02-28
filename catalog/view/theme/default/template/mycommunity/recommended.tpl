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
<img src="<?php echo $group_info['group_image'];?>" height="203" width ="240" />
<!--<h3>Tamil Readers</h3>-->
<h3><?php echo $group_info['group_name']; ?></h3>
<!--<input type="submit" id="driver" class="btn btn-default btn-lg" value="JOIN "  />-->

<form action = "<?php echo $join_community.$group_info['group_id'];?>"  method ="post">

<?php if($group_info['status'] == 'member'){ ?>
<button id ="join" onclick="this.disabled = true" class="btn btn-default btn-lg" ><?php echo $button_member;?> </button>
<?php }else { ?>
<button id ="join" class="btn btn-default btn-lg" ><?php echo $button_join;?> </button>
<?php } ?>

</form>   


</div>
</div>
</aside>



<div id="content" class="col-sm-9"><br><br><br>

 <?php if($group_info['status'] == 'member'){ ?> 


<div class="tabbable-panel-right">

<div class="tabbable-line"> 

<img class="img-circle"  alt="" width="50" height="50" src="<?php echo $post['customer_image']; ?>" />    
&nbsp 
 <input type="text" class="text_share" data-toggle="modal" placeholder="<?php echo $text_sharesomething;?>"data-target="#myPost">
<!--<i class="fa fa-camera" aria-hidden="true"></i>--> 



&nbsp 

</div>
</div> 

<?php }else { ?>

<?php } ?>

&nbsp

<?php if($group_info['status'] == 'member'){ ?> 

<div class="tabbable-panel-right">
<div class="tabbable-line">
    <?php foreach($post_info as $post) {?>
<img class="img-circle"   alt="" width="50" height="50" src="<?php echo $post['customer_image']; ?>" />   
<div class = "head">
<h4><?php echo $first_name; ?>   <?php echo $last_name; ?>    <i class="fa fa-caret-right"  aria-hidden="true"></i>   <?php echo $group_info['group_name']; ?></h4>
</div>
<br>
<h4><?php echo $post['message']; ?></h4><br>
<?php if($post['image']) { ?>
<img class="img" src="<?php echo $post['image']; ?>" height = "417" width = "417"/>
<?php  } ?>

<br>
<br>

<!--<form action="<?php echo $add_to_my_post.$post['group_id'].$post['post_id'];?>" method="post" >

<button type="submit"> <?php echo $post['total_votes'];?> LIKES  </button>

</form>
<i class="fa fa-thumbs-up" style="font-size: 2.00em;"  aria-hidden="true"><!--<i class="fa fa-share-alt" style="margin-left: 373px; font-size: 1em;" aria-hidden="true"></i>--></i>
<!--<i class="fa fa-share-alt" style="margin-left: 397px; font-size: 2.00em;" aria-hidden="true"></i>-->
<br>
<br>
</form>

<?php } ?>



<?php }else { ?>

<?php } ?>

</div>    
<br>
<br>

</div>


<!-- content -->




  <!-- Post -->
  <div class="modal fade" id="myPost" role="dialog">
    <div class="modal-dialog">
    
      <!-- Post content-->
       <form action = "<?php echo $share_post.$group_info['group_id']; ?>"  method ="post" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <img class="img-circle"  alt="" width="50" height="50" src="<?php echo $post['customer_image']; ?>" />   
         <div class = "head">
        <h4><?php echo $first_name; ?>   <?php echo $last_name; ?>    <i class="fa fa-caret-right"  aria-hidden="true"></i>   <?php echo $group_info['group_name']; ?></h4>
        <br>
       <textarea class = "sharesomething" rows="10" cols="80" name="text_name" placeholder="<?php echo $text_sharesomething;?>" >  </textarea>
        

        <br>
        <br>
        <div class="">
        <i class="fa fa-camera" aria-hidden="true"></i> 

        
    
        <input type='file' class = "upload" name="image" onchange="readURL(this);"  />
        
        <img id="blah" src="#" alt="" />
  

 
         </div>

        </div>
        <!-- <h4 class="modal-title">Modal Header</h4>-->
        </div>
        
           
        
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $button_cancel;?></button>
     <!--<button type="button" class="btn btn-default" data-dismiss="modal">Done</button>-->
     <!--<button id = "done" type="submit" class="btn btn-primary" ><?php echo $button_done;?></button>-->

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
$().ready = function() {
    $('#text').hide();
    
    $("#driver").click(function() {
        $('#text').toggle();
    });

}();
</script>

<!--<script type="text/javascript">
$("#myBtn").on('click',function(){
    var self=$(this);
    if(self.val()=="JOIN GROUP")     {
   self.val("உறுப்பினர்");  
    }
   
});

</script>

<script type="text/javascript">

$(document).ready(function(e){
  $('#driver').click(function(){
  $(this).text("உறுப்பினர்");
  });
});

</script>-->

<script type="text/javascript">
        $("#join").click(function () {
            $(this).text("உறுப்பினர்");
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

<?php echo $footer; ?>