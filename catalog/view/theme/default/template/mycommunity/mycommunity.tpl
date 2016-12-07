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
<a href = "<?php echo $authors; ?> " button type="button" class = "list-group-item"> Authors </a></button>
<a href = "<?php echo $publishers; ?> " button type="button" class = "list-group-item"> Publishers </a></button>

</div>
</aside>

<div id="content" class="col-sm-9">
<h3>Shared Books</h3>
<div class="row">
<a href="<?php echo $addbooks; ?>"</a><button type="button" class="addbooks" value="add books"/>Shared books</button>
</div>

<!--<h3>Book Reading Club</h3>
<div class="row">
<a href="<?php echo $addbooks; ?>"</a><button type="button" class="addbooks" value="add books"/>Create Book Reading Club<i class="fa fa-plus-circle" aria-hidden="true"></i></button>
</div>

<h3>Authors & Publishers</h3>
<div class="row">
<a href="<?php echo $addbooks; ?>"</a><button type="button" class="addbooks" value="add books"/>Search for your favourite authors & publishers</button>
</div>

</div>  -->



</div>
</div>
<?php echo $footer; ?> 