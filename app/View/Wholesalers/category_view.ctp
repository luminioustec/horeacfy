<div class="row">			
<div class="col-md-12">
					<!-- BEGIN SAMPLE TABLE PORTLET-->
					<?php if (empty($get_wholesaler_list)) {  ?>
					<a class="btn btn-success" href="<?php echo SITE_URL;?>wholesalers/choose_family/<?php echo $cat_id;?>">Create LIST</a>
					<?php } else { ?>
					<div class="portlet box red">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-cogs"></i> WholesalerList  
								<a class="btn btn-success" href="<?php echo SITE_URL;?>wholesalers/choose_family/<?php echo $cat_id;?>">Añadir familias</a>
							</div>
								
						</div>
						<div class="portlet-body">
							<div class="table-scrollable">
								<table class="table table-hover">
								<thead>
								<tr>
									<th>
										 #
									</th>
									<th>
										 Family
									</th>
									<th>
										 Action
									</th>
									
								</tr>
								</thead>
								<tbody>
								<?php foreach($get_wholesaler_list as $key=>$get) { ?>
								<tr>
									<td><?php echo $key+1; ?></td>
									<td><?php echo $get['families']['name']; ?></td>
									<td><?php echo $this->Html->link(
										'<i class="fa fa-edit"></i>',
										array(
											'controller' => 'wholesalers',
											'action' => 'edit_wlist',
											$get['Wholesalerlist']['id']
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
										array('controller' => 'wholesalers', 'action' => 'delete_wlist',$get['Wholesalerlist']['id']),
										array(
										'rel'                 => 'tooltip',
										'data-placement'      => 'right',
										'data-original-title' => 'delete',
										'class'               => 'btn btn-small',
										'escape'              => false,  
										'confirm' => 'Are you sure you wish to delete this category?'
									)
									); ?></td>
									
								</tr>
								<?php } ?>
								</tbody>
								</table>
							
							</div>
						</div>
					</div>
					<?php } ?>
					<!-- END SAMPLE TABLE PORTLET-->
				</div>	
</div>	