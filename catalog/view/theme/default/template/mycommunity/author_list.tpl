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
<h3><?php echo $text_search_byauthor;?> </h3>

<form name="myForm" action="<?php echo $searchauthor; ?>" onsubmit="return validateForm()" method="post" >

<FORM name="TestText" > 

<div id="search" class="input-group">
<input type="text" class="form-control input-lg" onfocus="document.getElementById('show_hide').style.display='block';"  onblur="document.getElementById('show_div').style.display='none';" placeholder="<?php echo $text_type_author_name;?>" name="filter_name" id="input-name" required>
<span class="input-group-btn">
<button type="submit" class="btn btn-default btn-lg"><i class="fa fa-search"></i></button>
</span>
</div>

</form>

<br>
<br>
<?php foreach($authors as $author) {?>
<div class="product-layout col-lg-3 col-md-3 col-sm-6 col-xs-12 " style="float:left">
<div class="product-thumb transition ">
<div class="image">
<a href= "<?php echo $author_image.$author['author_id'];?>"><img class="img-responsive" src="<?php echo $author['author_image']; ?>" style="height:300px;width:250px;" align="left" alt="" vspace="20" hspace="20"> </a>
</div>

<h4><?php echo $author['author_name']; ?></h4>

</div>
</div>
<?php } ?>

</div>

</div>
</div> 

<div id="show_div">

</div>

<div id="show_hide">
<CENTER>

 <SCRIPT LANGUAGE="JavaScript" type="text/javascript"> 
 <!-- 
 function AppendCharacter ( ChrToAppend ) 
 { 
 	
   document.TestText.search.value += ChrToAppend; 
 } //end AppendCharacter 
 document.write('<table>'); 
 document.write('<TR>'); 
 document.write('<TD>'); 
 document.write('<INPUT type="button" style="font-size: 18"name="02947" value=" &#02947; " onclick=AppendCharacter("&#02947;")>'); 
 document.write('</TD>'); 
 document.write('<TD>'); 
 document.write('<INPUT type="button" style="font-size: 18"name="02949" value=" &#02949; " onclick=AppendCharacter("&#02949;")>'); 
 document.write('</TD>'); 
 document.write('<TD>'); 
 document.write('<INPUT type="button" style="font-size: 18"name="02950" value=" &#02950; " onclick=AppendCharacter("&#02950;")>'); 
 document.write('</TD>'); 
 document.write('<TD>'); 
 document.write('<INPUT type="button" style="font-size: 18"name="02951" value=" &#02951; " onclick=AppendCharacter("&#02951;")>'); 
 document.write('</TD>'); 
 document.write('<TD>'); 
 document.write('<INPUT type="button" style="font-size: 18"name="02952" value=" &#02952; " onclick=AppendCharacter("&#02952;")>'); 
 document.write('</TD>'); 
 document.write('<TD>'); 
 document.write('<INPUT type="button" style="font-size: 18"name="02953" value=" &#02953; " onclick=AppendCharacter("&#02953;")>'); 
 document.write('</TD>'); 
 document.write('<TD>'); 
 document.write('<INPUT type="button" style="font-size: 18"name="02954" value=" &#02954; " onclick=AppendCharacter("&#02954;")>'); 
 document.write('</TD>'); 
 document.write('<TD>'); 
 document.write('<INPUT type="button" style="font-size: 18"name="02958" value=" &#02958; " onclick=AppendCharacter("&#02958;")>'); 
 document.write('</TD>'); 
 document.write('<TD>'); 
 document.write('<INPUT type="button" style="font-size: 18"name="02959" value=" &#02959; " onclick=AppendCharacter("&#02959;")>'); 
 document.write('</TD>'); 
 document.write('<TD>'); 
 document.write('<INPUT type="button" style="font-size: 18"name="02960" value=" &#02960; " onclick=AppendCharacter("&#02960;")>'); 
 document.write('</TD>'); 
 document.write('<TD>'); 
 document.write('<INPUT type="button" style="font-size: 18"name="02962" value=" &#02962; " onclick=AppendCharacter("&#02962;")>'); 
 document.write('</TD>'); 
 document.write('</TR>'); 
 document.write('</TABLE>'); 
  
 document.write('<TABLE>'); 
 document.write('<TR>'); 
 document.write('<TD>'); 
 document.write('<INPUT type="button" style="font-size: 18"name="02963" value=" &#02963; " onclick=AppendCharacter("&#02963;")>'); 
 document.write('</TD>'); 
 document.write('<TD>'); 
 document.write('<INPUT type="button" style="font-size: 18"name="02964" value=" &#02964; " onclick=AppendCharacter("&#02964;")>'); 
 document.write('</TD>'); 
 document.write('<TD>'); 
 document.write('<INPUT type="button" style="font-size: 18"name="02965" value=" &#02965; " onclick=AppendCharacter("&#02965;")>'); 
 document.write('</TD>'); 
 document.write('<TD>'); 
 document.write('<INPUT type="button" style="font-size: 18"name="02969" value=" &#02969; " onclick=AppendCharacter("&#02969;")>'); 
 document.write('</TD>'); 
 document.write('<TD>'); 
 document.write('<INPUT type="button" style="font-size: 18"name="02970" value=" &#02970; " onclick=AppendCharacter("&#02970;")>'); 
 document.write('</TD>'); 
 document.write('<TD>'); 
 document.write('<INPUT type="button" style="font-size: 18"name="02972" value=" &#02972; " onclick=AppendCharacter("&#02972;")>'); 
 document.write('</TD>'); 
 document.write('<TD>'); 
 document.write('<INPUT type="button" style="font-size: 18"name="02974" value=" &#02974; " onclick=AppendCharacter("&#02974;")>'); 
 document.write('</TD>'); 
 document.write('<TD>'); 
 document.write('<INPUT type="button" style="font-size: 18"name="02975" value=" &#02975; " onclick=AppendCharacter("&#02975;")>'); 
 document.write('</TD>'); 
 document.write('<TD>'); 
 document.write('<INPUT type="button" style="font-size: 18"name="02979" value=" &#02979; " onclick=AppendCharacter("&#02979;")>'); 
 document.write('</TD>'); 
 document.write('<TD>'); 
 document.write('<INPUT type="button" style="font-size: 18"name="02980" value=" &#02980; " onclick=AppendCharacter("&#02980;")>'); 
 document.write('</TD>'); 
 document.write('<TD>'); 
 document.write('<INPUT type="button" style="font-size: 18"name="02984" value=" &#02984; " onclick=AppendCharacter("&#02984;")>'); 
 document.write('</TD>'); 
 document.write('<TD>'); 
 document.write('<INPUT type="button" style="font-size: 18"name="02985" value=" &#02985; " onclick=AppendCharacter("&#02985;")>'); 
 document.write('</TD>'); 
 document.write('</TR>'); 
 document.write('</TABLE>'); 
  
 document.write('<TABLE>'); 
 document.write('<TR>'); 
 document.write('<TD>'); 
 document.write('<INPUT type="button" style="font-size: 18"name="02986" value=" &#02986; " onclick=AppendCharacter("&#02986;")>'); 
 document.write('</TD>'); 
 document.write('<TD>'); 
 document.write('<INPUT type="button" style="font-size: 18"name="02990" value=" &#02990; " onclick=AppendCharacter("&#02990;")>'); 
 document.write('</TD>'); 
 document.write('<TD>'); 
 document.write('<INPUT type="button" style="font-size: 18"name="02991" value=" &#02991; " onclick=AppendCharacter("&#02991;")>'); 
 document.write('</TD>'); 
 document.write('<TD>'); 
 document.write('<INPUT type="button" style="font-size: 18"name="02992" value=" &#02992; " onclick=AppendCharacter("&#02992;")>'); 
 document.write('</TD>'); 
 document.write('<TD>'); 
 document.write('<INPUT type="button" style="font-size: 18"name="02993" value=" &#02993; " onclick=AppendCharacter("&#02993;")>'); 
 document.write('</TD>'); 
 document.write('<TD>'); 
 document.write('<INPUT type="button" style="font-size: 18"name="02994" value=" &#02994; " onclick=AppendCharacter("&#02994;")>'); 
 document.write('</TD>'); 
 document.write('<TD>'); 
 document.write('<INPUT type="button" style="font-size: 18"name="02995" value=" &#02995; " onclick=AppendCharacter("&#02995;")>'); 
 document.write('</TD>'); 
 document.write('<TD>'); 
 document.write('<INPUT type="button" style="font-size: 18"name="02996" value=" &#02996; " onclick=AppendCharacter("&#02996;")>'); 
 document.write('</TD>'); 
 document.write('<TD>'); 
 document.write('<INPUT type="button" style="font-size: 18"name="02997" value=" &#02997; " onclick=AppendCharacter("&#02997;")>'); 
 document.write('</TD>'); 
 document.write('<TD>'); 
 document.write('<INPUT type="button" style="font-size: 18"name="02999" value=" &#02999; " onclick=AppendCharacter("&#02999;")>'); 
 document.write('</TD>'); 
 document.write('<TD>'); 
 document.write('<INPUT type="button" style="font-size: 18"name="03000" value=" &#03000; " onclick=AppendCharacter("&#03000;")>'); 
 document.write('</TD>'); 
 document.write('<TD>'); 
 document.write('<INPUT type="button" style="font-size: 18"name="03001" value=" &#03001; " onclick=AppendCharacter("&#03001;")>'); 
 document.write('</TD>'); 
 document.write('</TR>'); 
 document.write('</TABLE>'); 
  
 document.write('<TABLE>'); 
 document.write('<TR>'); 
 document.write('<TD>'); 
 document.write('<INPUT type="button" style="font-size: 18"name="03006" value=" &#03006; " onclick=AppendCharacter("&#03006;")>'); 
 document.write('</TD>'); 
 document.write('<TD>'); 
 document.write('<INPUT type="button" style="font-size: 18"name="03007" value=" &#03007; " onclick=AppendCharacter("&#03007;")>'); 
 document.write('</TD>'); 
 document.write('<TD>'); 
 document.write('<INPUT type="button" style="font-size: 18"name="03008" value=" &#03008; " onclick=AppendCharacter("&#03008;")>'); 
 document.write('</TD>'); 
 document.write('<TD>'); 
 document.write('<INPUT type="button" style="font-size: 18"name="03009" value=" &#03009; " onclick=AppendCharacter("&#03009;")>'); 
 document.write('</TD>'); 
 document.write('<TD>'); 
 document.write('<INPUT type="button" style="font-size: 18"name="03010" value=" &#03010; " onclick=AppendCharacter("&#03010;")>'); 
 document.write('</TD>'); 
 document.write('<TD>'); 
 document.write('<INPUT type="button" style="font-size: 18"name="03014" value=" &#03014; " onclick=AppendCharacter("&#03014;")>'); 
 document.write('</TD>'); 
 document.write('<TD>'); 
 document.write('<INPUT type="button" style="font-size: 18"name="03015" value=" &#03015; " onclick=AppendCharacter("&#03015;")>'); 
 document.write('</TD>'); 
 document.write('<TD>'); 
 document.write('<INPUT type="button" style="font-size: 18"name="03016" value=" &#03016; " onclick=AppendCharacter("&#03016;")>'); 
 document.write('</TD>'); 
 document.write('<TD>'); 
 document.write('<INPUT type="button" style="font-size: 18"name="03018" value=" &#03018; " onclick=AppendCharacter("&#03018;")>'); 
 document.write('</TD>'); 
 document.write('<TD>'); 
 document.write('<INPUT type="button" style="font-size: 18"name="03019" value=" &#03019; " onclick=AppendCharacter("&#03019;")>'); 
 document.write('</TD>'); 
 document.write('<TD>'); 
 document.write('<INPUT type="button" style="font-size: 18"name="03020" value=" &#03020; " onclick=AppendCharacter("&#03020;")>'); 
 document.write('</TD>'); 
 document.write('<TD>'); 
 document.write('<INPUT type="button" style="font-size: 18"name="03021" value=" &#03021; " onclick=AppendCharacter("&#03021;")>'); 
 document.write('</TD>'); 
 document.write('</TR>'); 
 document.write('</TABLE>'); 
  
 document.write('<TABLE>'); 
 document.write('<TR>'); 
 document.write('<TD>'); 
 document.write('<INPUT type="button" name="space" value="          &#032;          " onclick=AppendCharacter("&#032;")>'); 
 document.write('</TD>'); 
 document.write('</TR>'); 
 document.write('</TABLE>'); 
  
 // --> 
 </SCRIPT> 

 <NOSCRIPT> 
 <table> 
 <tr> 
 <td> 
 <input type=text name="02946" size=2 value="&#02946;"> 
 </td> 
 <td> 
 <input type=text name="02947" size=2 value="&#02947;"> 
 </td> 
 <td> 
 <input type=text name="02949" size=2 value="&#02949;"> 
 </td> 
 <td> 
 <input type=text name="02950" size=2 value="&#02950;"> 
 </td> 
 <td> 
 <input type=text name="02951" size=2 value="&#02951;"> 
 </td> 
 <td> 
 <input type=text name="02952" size=2 value="&#02952;"> 
 </td> 
 <td> 
 <input type=text name="02953" size=2 value="&#02953;"> 
 </td> 
 <td> 
 <input type=text name="02954" size=2 value="&#02954;"> 
 </td> 
 <td> 
 <input type=text name="02958" size=2 value="&#02958;"> 
 </td> 
 <td> 
 <input type=text name="02959" size=2 value="&#02959;"> 
 </td> 
 <td> 
 <input type=text name="02960" size=2 value="&#02960;"> 
 </td> 
 <td> 
 <input type=text name="02962" size=2 value="&#02962;"> 
 </td> 
 </tr> 
 <tr> 
 <td> 
 <input type=text name="02963" size=2 value="&#02963;"> 
 </td> 
 <td> 
 <input type=text name="02964" size=2 value="&#02964;"> 
 </td> 
 <td> 
 <input type=text name="02965" size=2 value="&#02965;"> 
 </td> 
 <td> 
 <input type=text name="02969" size=2 value="&#02969;"> 
 </td> 
 <td> 
 <input type=text name="02970" size=2 value="&#02970;"> 
 </td> 
 <td> 
 <input type=text name="02972" size=2 value="&#02972;"> 
 </td> 
 <td> 
 <input type=text name="02974" size=2 value="&#02974;"> 
 </td> 
 <td> 
 <input type=text name="02975" size=2 value="&#02975;"> 
 </td> 
 <td> 
 <input type=text name="02979" size=2 value="&#02979;"> 
 </td> 
 <td> 
 <input type=text name="02980" size=2 value="&#02980;"> 
 </td> 
 <td> 
 <input type=text name="02984" size=2 value="&#02984;"> 
 </td> 
 <td> 
 <input type=text name="02985" size=2 value="&#02985;"> 
 </td> 
 </tr> 
 <tr> 
 <td> 
 <input type=text name="02986" size=2 value="&#02986;"> 
 </td> 
 <td> 
 <input type=text name="02990" size=2 value="&#02990;"> 
 </td> 
 <td> 
 <input type=text name="02991" size=2 value="&#02991;"> 
 </td> 
 <td> 
 <input type=text name="02992" size=2 value="&#02992;"> 
 </td> 
 <td> 
 <input type=text name="02993" size=2 value="&#02993;"> 
 </td> 
 <td> 
 <input type=text name="02994" size=2 value="&#02994;"> 
 </td> 
 <td> 
 <input type=text name="02995" size=2 value="&#02995;"> 
 </td> 
 <td> 
 <input type=text name="02996" size=2 value="&#02996;"> 
 </td> 
 <td> 
 <input type=text name="02997" size=2 value="&#02997;"> 
 </td> 
 <td> 
 <input type=text name="02999" size=2 value="&#02999;"> 
 </td> 
 <td> 
 <input type=text name="03000" size=2 value="&#03000;"> 
 </td> 
 <td> 
 <input type=text name="03001" size=2 value="&#03001;"> 
 </td> 
 </tr> 
 <tr> 
 <td> 
 <input type=text name="03006" size=2 value="&#03006;"> 
 </td> 
 <td> 
 <input type=text name="03007" size=2 value="&#03007;"> 
 </td> 
 <td> 
 <input type=text name="03008" size=2 value="&#03008;"> 
 </td> 
 <td> 
 <input type=text name="03009" size=2 value="&#03009;"> 
 </td> 
 <td> 
 <input type=text name="03010" size=2 value="&#03010;"> 
 </td> 
 <td> 
 <input type=text name="03014" size=2 value="&#03014;"> 
 </td> 
 <td> 
 <input type=text name="03015" size=2 value="&#03015;"> 
 </td> 
 <td> 
 <input type=text name="03016" size=2 value="&#03016;"> 
 </td> 
 <td> 
 <input type=text name="03018" size=2 value="&#03018;"> 
 </td> 
 <td> 
 <input type=text name="03019" size=2 value="&#03019;"> 
 </td> 
 <td> 
 <input type=text name="03020" size=2 value="&#03020;"> 
 </td> 
 <td> 
 <input type=text name="03021" size=2 value="&#03021;"> 
 </td> 
 </tr> 
 <tr> 
 <td> 
 <input type=text name="space" size=2 value="&#032;"> 
 </td> 
 </tr> 
 </table> 
 </NOSCRIPT> 


  </CENTER> 

</div>
  
 
 </FORM> 





<script type="text/javascript">
function validateForm() {
    var x = document.forms["myForm"]["fname"].value;
    if (x == "") {
        alert("Name must be filled out");
        return false;
    }
}
</script>

<script type="text/javascript"><!--
$('input[name=\'filter_name\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=mycommunity/mycommunity/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['author_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'filter_name\']').val(item['label']);
	}
});
</script>    


<?php echo $footer; ?>  