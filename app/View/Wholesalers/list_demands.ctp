<div class="row">
<div class="users form">
<h1>
<img style="width:8%" src="<?php echo THEME_PATH;?>img/category_svg/<?php echo $catinfo['Category']['image']; ?>" alt="">
<?php echo $catinfo['Category']['name']; ?></h1><br/>
</div>	
								<?php foreach($list_demands as $key=>$get) { 
								$did=base64_encode($get['demands']['id']); ?>
								<div class="col-md-6">
									<div class="well">
										<address>
										Restaurador <strong><?= $get['demands']['customerId']; ?></strong><br>
										Codigo Postal <strong><?= $get['customers']['zipcode']; ?></strong><br>
										Fecha de solicitud <strong><?= date('m/d/Y', strtotime($get['customers']['createdOn'])); ?></strong><br><br><br>
										<!--abbr title="Phone">P:</abbr> (234) 145-1810 </address-->
										<address>
										<a class="btn green" href="<?= SITE_URL; ?>wholesalers/submit_offer/<?php echo $did;?>">
										Realizar oferta</a>
										</address>
									</div>
									
								</div>
							<?php } ?>
				</div>