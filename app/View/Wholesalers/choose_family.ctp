
<div class="users form">
<h1>
<img style="width:10%" src="<?php echo THEME_PATH;?>img/category_svg/<?php echo $cat_image['Category']['image']; ?>" alt="">
Choose Family Type</h1><br/>
</div>

<div class="row margin-top-10">
<?php foreach ($families as $post): 
$family_id=base64_encode($post['Family']['id']);  
?>
<a class="btn default btn-block" href="<?= SITE_URL; ?>wholesalers/add_wholesaler_list/<?php echo $cat_id;?>/<?php echo $family_id;?>"><?php echo $post['Family']['name']; ?> </a>
							
<?php endforeach; ?>

</div>					



