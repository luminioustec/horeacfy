
<div class="users form">
<img style="width:10%" src="<?php echo THEME_PATH;?>img/category_svg/<?php echo $cat_image['Category']['image']; ?>" alt="">
<h1>Añade las familias que quieras a la lista</h1><br/>
</div>


<div class="row margin-top-10">
<?php foreach ($families as $post): 
$family_id=base64_encode($post['Family']['id']);  
?>
<a style="text-align:left;" class="btn default btn-block" href="<?= SITE_URL; ?>customers/add_demand/<?php echo $cat_id;?>/<?php echo $family_id;?>"><?php echo $post['Family']['name']; ?> </a>
						


<?php endforeach; ?>

</div>					



