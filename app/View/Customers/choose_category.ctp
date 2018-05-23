
<div class="users form">
<h1>Select Category</h1><br/>
</div>


 <div class="row grid-divider">
<?php foreach ($allcats as $post): 
$cat_id=base64_encode($post['Category']['id']);  
?>
<div class="col-sm-3 text-center">
<a href="<?= SITE_URL; ?>customers/choose_family/<?php echo $cat_id;?>">
      <div class="col-padding">
       		<img style="width:30%" src="<?php echo THEME_PATH;?>img/category_svg/<?php echo $post['Category']['image']; ?>" alt="">
        <p><?php echo $post['Category']['name']; ?></p>
      </div>
	  </a>
</div>
	<?php endforeach; ?>

</div>					



