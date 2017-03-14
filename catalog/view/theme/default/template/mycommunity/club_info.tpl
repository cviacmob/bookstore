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

<!--<div class = "btn-group">
   
   <button type = "button" class = "sharealt" data-toggle = "dropdown">
      <i class="fa fa-ellipsis-v"   style="font-size: 1.5em;"></i>
      
   </button>
   
   <ul class = "dropdown-menu" role = "menu">
      <li><a href=""data-toggle="modal"data-target="#editclub">Edit Club</a></li>
      <?php if($club_info['created_by'] ==  $customer_id ){ ?>
      <li><a href=""data-toggle="modal"data-target="#deleteclub">Delete Club</a></li>
      <?php }else { ?>
      <?php } ?>
      
   </ul>
</div>

<div class = "btn-group">
   <button type = "button" class = "community" data-toggle = "dropdown">
     <i class="fa fa-share-alt"  style="font-size: 1.5em;"></i>
   </button>
   
   <ul class = "dropdown-menu" role = "menu">
      <li><a href = "" data-toggle="modal"data-target="#myModal1" >Invite people</a></li>
      
   </ul>
   
</div> -->

<div class="dropdown">  <button type = "button" class = "editclub" data-toggle = "dropdown"  data-tooltip="tooltip" title="திருத்த">
      <i class="fa fa-ellipsis-v"   style="font-size: 1.5em;"></i>
      
   </button>
   
   <ul class = "dropdown-menu pull-right" role = "menu">
      <li><a href=""data-toggle="modal"data-target="#editclub">Edit Club</a></li>
      <?php if($club_info['created_by'] ==  $customer_id ){ ?>
      <li><a href=""data-toggle="modal"data-target="#deleteclub">Delete Club</a></li>
      <?php }else { ?>
      <?php } ?>
      
   </ul>
</div>



<div class="dropdown">  <button type = "button" class = "shareclub" data-toggle = "dropdown" data-tooltip="tool" title="பகிரு">
     <i class="fa fa-share-alt"  style="font-size: 1.5em;"></i>
   </button>
   
   <ul class = "dropdown-menu pull-right" role = "menu">
      <li><a href = "" data-toggle="modal"data-target="#myModal1" >Invite people</a></li>
      
   </ul>
</div>

</div>
</div>
<h3><?php echo $club_info['group_name']; ?>   </h3>

<!-- invite people by mail -->

 <div class="modal fade" id="myModal1" role="dialog">
 <div class="modal-dialog">
 <div class="modal-content">
 <div class="modal-header">
 <button type="button" class="close" data-dismiss="modal">&times;</button>
 <h3><?php echo $text_invite_people;?></h3>
 </div>
 <div class="modal-body">
 <form action = "<?php echo $invite_people.$club_info['group_id']; ?>" id = "searchbyemail"  method ="post">

 <label for="recipient-name" class="control-label"><?php echo $text_enter_mailid;?></label><br>
 <input type = "email" name="recipient_email" id="recipient_email" class="form-control input-lg">
 <input type="hidden" name="mail_ids" id="emails"> 
 </div>
 <div class="modal-footer">
 <button type="submit" id="searchbyemail" name="searchbyemail"  class="btn btn-primary" ><?php echo $button_send;?></button>
 <button type="button" data-dismiss="modal" class="btn"><?php echo $button_cancel;?></button>
 </div>
 </form>
 </div>
 </div>
 </div> 

<!-- Edit Club -->

  <div class="modal fade" id="editclub" role="dialog">
  <div class="modal-dialog">
  <form action= "<?php echo $editimage.$club_info['group_id']; ?>"  method="post" enctype="multipart/form-data">
  <div class="modal-content">
  <div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">&times;</button>
  <h4 class="modal-title">Edit Club Image</h4>
  </div>
  <div class="modal-body">
  <img class=" " src="#" height= "203" width="565"> 
  <input type='file' class = "upload" name="image" onchange="readURL(this);"  />
  <img id="blah2" src="" style=""/> 
  </div>
  <div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
  <input type="submit" class="btn btn-primary"  value="Done" name="submit">
  </div>
  </form>
  </div>
  </div>
  </div>

<!-- Delete club -->
  
  <div class="modal fade" id="deleteclub" role="dialog">
  <div class="modal-dialog"> 
  <div class="modal-content">
  <div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">&times;</button>
  <h4 class="modal-title">Delete Club </h4>
  </div>
  <div class="modal-body">
  <p>If you delete this Club, you can't undo it later. Are you sure of deleting this Club ? </p>
  </div>
  <div class="modal-footer">
  <form action= "<?php echo $deleteclub.$club_info['group_id']; ?>"  method="post" >
  <input type="hidden" name="created_by" value="<?php echo $club_info['created_by']; ?>">
  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
  <button type="submit" class="btn btn-primary">Done</button>
  
  </form>
  </div>
  </div>
  </div>
  </div>


 </aside>


<div id="content" class="col-sm-9">
<div id="text">
<div class="tabbable-panel">
<div class="tabbable-line">    

<img class="img-circle"  alt="" width="50" height="50" src="<?php echo $group_info['customer_image']; ?>" />    
&nbsp 
<input type="text" class="text_share" data-toggle="modal" placeholder="<?php echo $text_sharesomething;?>"data-target="#myPost">
<!--<i class="fa fa-camera" aria-hidden="true"></i>--> 

</div>

</div>  

&nbsp 





<?php foreach($post_info as $post) {?>
<div class="tabbable-panel-right">
<div class="tabbable-line">
<div class="image">
<img class="img-circle"   alt="" width="50" height="50" src="<?php echo $group_info['customer_image']; ?>" <h4> <?php echo $first_name; ?>   <?php echo $last_name; ?>    <i class="fa fa-caret-right"  aria-hidden="true"></i>   <?php echo $group_info['group_name']; ?> </h4>     
</div>
<h5><?php echo $post['message']; ?></h5>
<?php if($post['image']) { ?>
<img class="img" src="<?php echo $post['image']; ?>" height = "417" width = "576"/>
<?php  } ?>

</div>
</div>

<?php } ?>

    
</div>    
<br>
<br>

</div>


        <!-- Post -->
       <div class="modal fade" id="myPost" role="dialog">
       <div class="modal-dialog">
    
        <!-- Post content-->
        <form action = "<?php echo $club_share.$group_info['group_id']; ?>"  method ="post" enctype="multipart/form-data">
        <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <img class="img-circle"  alt="" width="50" height="50" src="<?php echo $group_info['customer_image']; ?>"<h4> <?php echo $first_name; ?>   <?php echo $last_name; ?>    <i class="fa fa-caret-right"  aria-hidden="true"></i>   <?php echo $group_info['group_name']; ?> </h4>    
        <br>
        <br>
        <textarea class = "" rows="10" cols="75" name="text_name" placeholder="<?php echo $text_sharesomething;?>" ></textarea>
        
        
      <!--  <i class="fa fa-camera" aria-hidden="true"></i>-->  

        <input type='file' class = "upload" name="image" onchange="readURL(this);"/>
        <img id="blah1" src="" alt="" />

         </div>
         
        
         <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $button_cancel;?></button>
         <input type="submit" class="btn btn-primary" value="<?php echo $button_post;?>" name="submit">
         </div>
         </form>
         </div>
      
         </div>


</div>
</div>
</div>
</div>


<script type="text/javascript">
    function validateEmail(email) {
    var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    return re.test(email);
}
(function( $ ){
     $.fn.multipleInput = function() {
          return this.each(function() {
               // list of email addresses as unordered list
               $list = $('<ul/>');
               // input
               var $input = $('<input type="email" id="email_search" class="email_search multiemail"/>').keyup(function(event) { 
                    if(event.which == 13 || event.which == 32 || event.which == 188) {                        
                         if(event.which==188){
                           var val = $(this).val().slice(0, -1);// remove space/comma from value
                         }
                         else{
                         var val = $(this).val(); // key press is space or comma                        
                         }                         
                         if(validateEmail(val)){
                         // append to list of emails with remove button
                         $list.append($('<li class="multipleInput-email"  ><span>' + val + '</span> <input type="hidden" name="emails[]" value= "'+val+'" /></li>')
                              .append($('<a href="#" class="multipleInput-close" title="Remove"><i class="glyphicon glyphicon-remove-sign"></i></a>')
                                   .click(function(e) {
                                        $(this).parent().remove();
                                        e.preventDefault();
                                   })
                              )
                         );
                         $(this).attr('placeholder', '');
                         // empty input
                         $(this).val('');
                          }
                          else{
                            alert('Please enter valid email id, Thanks!');
                          }
                    }
               });
               // container div
               var $container = $('<div class="multipleInput-container" />').click(function() {
                    $input.focus();
               });
               // insert elements into DOM
               $container.append($list).append($input).insertAfter($(this));
               return $(this).hide();
          });
     };
})( jQuery );
$('#recipient_email').multipleInput();
</script>

<script type="text/javascript">
function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah1')
                        .attr('src', e.target.result)
                        .width(150)
                        .height(200);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
</script>

<script type="text/javascript">
function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah2')
                        .attr('src', e.target.result)
                        .width(150)
                        .height(200);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
</script>


<script type="text/javascript"><!--
$('input[name=\'filter_email\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=mycommunity/mycommunity/autocomplete_name&token=<?php echo $token; ?>&filter_email=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['customer_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'filter_email\']').val(item['label']);
	}
});
</script>    

<script type="text/javascript">
$(document).ready(function(){
    $('[data-tooltip="tooltip"]').tooltip();   
});
</script>

<script type="text/javascript">
$(document).ready(function(){
    $('[data-tooltip="tool"]').tooltip();   
});
</script>


<?php echo $footer; ?> 