
<div class="users form">
<h1>Por el momento no hay ofertas para revisar</h1><br/>
</div>


<div class="row margin-top-10">
<?php foreach ($demands as $post): 
$d_id=base64_encode($post['Demand']['hiddenId']);
?>
						<div class="col-sm-3 text-center">
<a href="<?= SITE_URL; ?>customers/view_offers/<?php echo $d_id;?>">
      <div class="col-padding">
       		<img style="width:30%" src="<?php echo THEME_PATH;?>img/category_svg/<?php echo $post['Family']['Category']['image']; ?>" alt="">
       
							 
      </div>
	  </a>
</div>					


<?php endforeach; ?>

</div>					



