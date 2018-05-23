<div class="row">			
<div class="col-md-12">
					<!-- BEGIN SAMPLE TABLE PORTLET-->
					<div class="portlet box red">
					<?php if(empty($demands)){  ?>
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-cogs"></i> No hay ofertas para revisar
							</div>
							
						</div>
						<?php } else { ?>
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-cogs"></i>Todas las listas
							</div>
							
						</div>
						<div class="portlet-body">
							<div class="table-scrollable">
							
								<table class="table table-striped table-bordered table-hover" id="sample_2">
								<thead>
								<tr>
									<th>
										 #
									</th>
									<th>
										 ID
									</th>
									<th>
										 Categoría
									</th>
									<th>
										 Familia
									</th>
									<th>Cantidad
									</th>
									<th>
										 Precio
									</th>
									<th>
										 Marca
									</th>
									<th>
										 Formato
									</th>
									<th>
										 Comentarios
									</th>
									<!--th>
										 Borrado
									</th-->
									<th>Action</th>
									
								</tr>
								</thead>
								<tbody>
								<?php 
								foreach($demands as $key=>$get) { ?>
								<tr>
									<td><?php echo $key+1; ?></td>
									<td><?php echo $get['Demand']['id']; ?></td>
									<td><img style="width:100%" src="<?php echo THEME_PATH;?>img/category_svg/<?php echo $get['Family']['Category']['image']; ?>" alt="">
									<b><?php echo $get['Family']['Category']['name']; ?></b></td>
									<td><?php echo $get['Family']['name']; ?></td>
									<td><?php echo $get['Demand']['quantyPerMonth']; ?></td>
									<td><?php echo $get['Demand']['targetPrice'];
									?></td>
									<td><?php echo $get['Demand']['brand']; ?></td>
									<td><?php echo $get['Demand']['format']; ?></td>
									<td><?php echo $get['Demand']['comments']; ?></td>
									<!--td><?php if($get['Demand']['borrado']==0){echo 'Invisiible';}else{ echo 'Visible';} ?></td-->
									<td><?php if($get['Demand']['sentTo']==null) { 
											$demand_id=base64_encode($get['Demand']['id']); 
										  $family_id=base64_encode($get['Family']['id']);
									?>
									<a href="<?= SITE_URL; ?>customers/share_demand/<?php echo $demand_id;?>/<?php echo $family_id;?>">
									<span class="label label-sm label-success">
									<?php echo 'Compartir con distribuidores'; ?></span> </a>	
									<?php } else { ?>
									<span class="label label-sm label-info">
									<?php echo 'Ya ha sido compartida con distribuidores'; ?></span>
									<?php } ?>
									</td>
									
									
									<!--td>
									<?php echo $this->Html->link(
										'<i class="fa fa-edit"></i>',
										array(
											'controller' => 'customers',
											'action' => 'edit_category',
											$get['TypeOfFormat']['id']
										),array(
											'rel'                 => 'tooltip',
											'data-placement'      => 'left',
											'data-original-title' => 'Edit',
											'class'               => 'btn btn-small',
											'escape'              => false  
										)
									); ?>
									
									<?php echo $this->Html->link(
										'<i class="fa fa-trash-o"></i>',
										array('controller' => 'customers', 'action' => 'delete_categories',$get['TypeOfFormat']['id']),
										array(
										'rel'                 => 'tooltip',
										'data-placement'      => 'right',
										'data-original-title' => 'delete',
										'class'               => 'btn btn-small',
										'escape'              => false,  
										'confirm' => 'Are you sure you wish to delete this category?'
									)
									); ?>
									
									</td-->
								</tr>
								<?php } ?>
								</tbody>
								</table>
							</div>
						</div>
						<?php } ?>
					</div>
					<!-- END SAMPLE TABLE PORTLET-->
				</div>	
</div>	