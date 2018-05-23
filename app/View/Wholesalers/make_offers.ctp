

<?php if(empty($allcats)){  ?>
<div class="users form">
<h1>Solicitudes de restauradores</h1>
<h2>No hay solicitudes de restauradores para ofertar</h2><br/>
</div>
<?php } else { ?>
<div class="users form">
<h1>Solicitudes de restauradores</h1>
</div>
<div class="row margin-top-10">
<?php foreach ($allcats as $post): 
$cat_id=base64_encode($post['categories']['id']);  
?>
				<div class="col-sm-3 text-center">
<a href="<?= SITE_URL; ?>wholesalers/list_demands/<?php echo $cat_id;?>">
      <div class="col-padding">
       		<img style="width:30%" src="<?php echo THEME_PATH;?>img/category_svg/<?php echo $post['categories']['image']; ?>" alt="">
        <p><?php echo $post['categories']['name']; ?></p>
        <p><?php echo $post[0]['demandsCount']; ?></p>
      </div>
	  </a>
</div>			


<?php endforeach; ?>

</div>	

<?php  } ?>				



		



