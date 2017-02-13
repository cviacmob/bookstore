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

<h3><?php echo $club_info['group_name']; ?>  <button type="button" class="sharealt"> <i class="fa fa-share-alt"  title="Invite People" data-toggle="modal"data-target="#myModal" style="font-size: 1.00em;"  aria-hidden="true"></i> </button></h3>


</div>

<div class="modal fade" id="myModal"  role="dialog">
      <div class="modal-dialog">
      <div class="modal-content">
      <div class="modal-header">
 
  
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3><?php echo $text_invite_people;?></h3>
  </div>
  <div class="modal-body">

   <form action = "<?php echo $search_mail.$club_info['group_id']; ?>" method ="post" onSubmit="return verifyForm(this);">

    
   <label for="recipient-name" class="control-label"><?php echo $text_enter_name;?></label><br> 
   <input type="email" name="recipient_text" id="recipient_text" class="se" ><div id="usernameMsg" style="display:none;"><span style="color:red;">Please fill in your username.</span></div>
   <input type="hidden" name="text_ids" id="texts"> <br>
   <div class="footer-button">

   <button type="submit" id="searchbyname" name="searchbyname" class="btn btn-primary" ><?php echo $button_send;?></button>
   </div>
   </form>

    <form action = "<?php echo $invite_people.$club_info['group_id']; ?>" id = "searchbyemail"  method ="post">
    <label for="recipient-name" class="control-label"><?php echo $text_enter_mailid;?></label><br>
 
 


  <input type="email" name="recipient_email" id="recipient_email" class="form-control input-lg"> 
  <input type="hidden" name="mail_ids" id="mails">
  
  </div>
  <div class="modal-footer">
  <!--  <button type="button" data-dismiss="modal" class="btn"><?php echo $button_cancel;?></button>-->
    <button type="submit" id = "searchbyemail" class="btn btn-primary" ><?php echo $button_send;?></button>


  </div>
  </form>
</div>




</div>
</aside>


<div id="content" class="col-sm-9">
<div id="text">
<div class="tabbable-panel">
<div class="tabbable-line">    

<img class="img-circle"  alt="" width="50" height="50" src="<?php echo $post['customer_image']; ?>" />    
&nbsp 
 <input type="text" class="text_share" data-toggle="modal" placeholder="<?php echo $text_sharesomething;?>"data-target="#myPost">
<!--<i class="fa fa-camera" aria-hidden="true"></i>--> 


</div>

</div>  

&nbsp 
</div>



<!--<div class="tabbable-panel-right">
<div class="tabbable-line">-->
<?php foreach($post_info as $post) {?>
<div class="tabbable-panel-right">
<div class="tabbable-line">
<div class="image">
<img class="img-circle"   alt="" width="50" height="50" src="<?php echo $post['customer_image']; ?>" <h4> <?php echo $first_name; ?>   <?php echo $last_name; ?>    <i class="fa fa-caret-right"  aria-hidden="true"></i>   <?php echo $group_info['group_name']; ?> </h4>     
</div>
<br>
<h5><?php echo $post['message']; ?></h5><br>
<?php if($post['image']) { ?>
<img class="img" src="<?php echo $post['image']; ?>" height = "417" width = "417"/>
<?php  } ?>
<br>
<br>

<!--i class="fa fa-thumbs-up" style="font-size: 2.00em;"  aria-hidden="true"><i class="fa fa-share-alt" style="margin-left: 373px; font-size: 1em;" aria-hidden="true"></i></i>
<i class="fa fa-share-alt" style="margin-left: 397px; font-size: 2.00em;" aria-hidden="true"></i>-->
<br>
<br>
</div>
</div>

<?php } ?>

    
<br>
<br>


        <!-- Post -->
       <div class="modal fade" id="myPost" role="dialog">
       <div class="modal-dialog">
    
        <!-- Post content-->
        <form action = "<?php echo $club_share.$group_info['group_id']; ?>"  method ="post" enctype="multipart/form-data">
        <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <img class="img-circle"  alt="" width="50" height="50" src="<?php echo $post['customer_image']; ?>"<h4> <?php echo $first_name; ?>   <?php echo $last_name; ?>    <i class="fa fa-caret-right"  aria-hidden="true"></i>   <?php echo $group_info['group_name']; ?> </h4>    
        <br>
        <br>
        <textarea class = "sharesomething" rows="10" cols="80" name="text_name" placeholder="<?php echo $text_sharesomething;?>" ></textarea>
        <br>
        <br>
        <div class="">
        <i class="fa fa-camera" aria-hidden="true"></i>  

        <input type='file' class = "upload" name="image" onchange="readURL(this);"/>
    
        <img id="blah1" src="#" alt="" />

         </div>


        
         <!-- <h4 class="modal-title">Modal Header</h4>-->
         </div>
         
        
         <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $button_cancel;?></button>
    <!--     <button id = "done" type="submit" name="done" class="btn btn-primary" OnClientClick="CheckValue()" ><?php echo $button_post;?></button>-->
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

$('#btnShow').click(function(){
  
$(".alert").hide().show('medium');
});

</script> 


<script type="text/javascript">

$('#btnShow-search').click(function(){
  
$(".alert").hide().show('medium');
});
</script>

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


function validateEmail(email) {
     var re = /^[A-Za-z]+$/;  
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
                         $list.append($('<li class="multipleInput-email"  ><span>' + val + '</span> <input type="hidden" name="texts[]" value= "'+val+'" /></li>')
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
                            alert('Please enter valid characters, Thanks!');
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
$('#recipient_text').multipleInput();

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




<!--<script type="text/javascript">

$('#searchbyemail').submit(function() {
    if ($.trim($("#recipient_email").val()) === "" ) {
        alert('Enter mail_id');
        return false;
    }
});
</script> -->

<script type="text/javascript">

$(document).ready(function(){
      $("#searchbyname").click( function() {
          //$.post( $("#updateunit").attr("action"), 
           // $("#updateunit :input").serializeArray(),function(info){ 
              $("#result").html('Successfully updated record!'); 
              $("#result").addClass("alert alert-success");
          //});
      });
      
  });

</script>

<?php echo $footer; ?> 