<div class="row">			
<div class="col-md-12">
					<!-- BEGIN SAMPLE TABLE PORTLET-->
					<div class="portlet box red">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-cogs"></i>Listas creadas
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
										 Category
									</th>
									<th>
										 Family
									</th>
									<th>
										 Brand
									</th>
									<th>
										 Comments
									</th>
									<!--th>
										 Actions
									</th-->
								</tr>
								</thead>
								<tbody>
								<?php foreach($lists as $key=>$get) { ?>
								<tr>
									<td><?php echo $key+1; ?></td>
									<td><img style="width:10%" src="<?php echo THEME_PATH;?>img/category_svg/<?php echo $get['Family']['Category']['image']; ?>" alt="">
									<?php echo $get['Family']['Category']['name']; ?></td>
									<td><?php echo $get['Family']['name']; ?></td>
									<td><?php echo $get['Wholesalerlist']['brand']; ?></td>
									<td><?php echo $get['Wholesalerlist']['comments']; ?></td>
									
									
									
									<!--td>
									<?php echo $this->Html->link(
										'<i class="fa fa-edit"></i>',
										array(
											'controller' => 'customers',
											'action' => 'edit_category',
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
										array('controller' => 'customers', 'action' => 'delete_categories',$get['Wholesalerlist']['id']),
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
					</div>
					<!-- END SAMPLE TABLE PORTLET-->
				</div>	
</div>	