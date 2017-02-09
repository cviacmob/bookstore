<?php echo $header; ?>
<div class="container">
 <ul class="breadcrumb">
   <?php foreach ($breadcrumbs as $breadcrumb) { ?>
   <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
   <?php } ?>
 </ul>

<div class="row">

<aside id="column_left"class="col-sm-3 hidden-xs">
<h3><?php echo $text_my_library; ?></h3>
<!-- <a href="<?php echo $createnewshelf; ?>"class="btn btn-default btn-lg" id="button-newshelf" >Create new Shelf</a> <br><br>
 --><div class="list-group">
<a href = "<?php echo $books_in_library; ?>" class = "list-group-item"> <?php echo $text_my_books; ?> </a>
<a href = "<?php echo $purchased_books; ?>" class = "list-group-item"> <?php echo $text_purchased; ?> </a>
<a href = "<?php echo $reviewed_books; ?>" class = "list-group-item"> <?php echo $text_reviewed; ?> </a>
<a href = "<?php echo $favorite_books; ?> " class = "list-group-item"> <?php echo $text_favourites; ?> </a>
</div>
</aside>

<div id="content"class="col-sm-9"><br><br><br>
<form action="<?php echo $searchisbn; ?>" method="post" >
    <div class="input-group col-xs-3">
    	<input type="text" class="form-control" placeholder="enter ISBN" name="text_mastersearch" required id="text_search">
        <div class="input-group-btn">
            <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
              


        </div>


    </div>


    <?php if ($invalid_isbn) { ?>
        <div>
            <?php echo $invalid_isbn ; ?>
        </div>
        <?php } ?>
 </form> 

  <div class="rect">
    <p><?php echo $text_no_result; ?></p>
    <div id="text_upload_image">
      <button type="button" id = "upload-image" data-toggle="modal" data-target="#myModal"><?php echo $text_upload_image; ?></button>
    </div>
    
  </div>
       
  <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

  <div class="modal-content">
    <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title"><?php echo $text_front_back_image; ?></h4>
    <hr>
   
     <!--  Select images to upload: -->

     <form action="<?php echo $upload_image; ?>" method="post" enctype="multipart/form-data">

    <?php echo $text_front_image; ?>
    <input type='file' name="front_image" onchange="readURL(this);" />
    <img id="blah" src="#" alt="" />
    </div>
    <div class="modal-body">
       
    
   
    <div class="back-image">
    <?php echo $text_back_image; ?>
    <input type='file' name="back_image" onchange="readURLS(this);" />
    <img id="blah1" src="#" alt="" />
    </div>
    
    </div>
    

    
     
    
    <div class="modal-footer">
    <input type="submit" value="Upload Image" name="submit">
    <!-- <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $text_close; ?></button>
     --></div>

    </form>

</div>
</div>
</div>
      
     
 
</div>
 
</div>
 
</div>

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
function readURLS(input) {
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


<!-- <script type="text/javascript">
$(document).ready(function() 
{ 
 $('form').ajaxForm(function() 
 {
  alert("Uploaded SuccessFully");
 }); 
});

function preview_image() 
{
 var total_file=document.getElementById("upload_file").files.length;
 for(var i=0;i<total_file;i++)
 {
  $('#image_preview').append("<img src='"+URL.createObjectURL(event.target.files[i])+"'><br>");
 }
}
</script>

<script type="text/javascript">
function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();


            reader.onload = function (e) {
                $('#bk-img')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(150);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
 
</script>

 <script type=" javascript">
 $(function())	{

 	$("$text_search_by_author").autocomplete( {
 		source: 'mylibrary/mylibrary/searchByAuthor'
 	}
 }


 </script>  -->   


<?php echo $footer; ?>  
 
  
  
   