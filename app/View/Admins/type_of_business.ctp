<div class="row">
<div class="col-md-6">

<div class="portlet box purple ">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-gift"></i> Type Of Business
							</div>
						</div>
						<div class="portlet-body form">
						<?php echo $this->Form->create('TypeOfBusiness',array('class'=>'form-horizontal',array('type' => 'file'))); ?>
							<form class="form-horizontal" role="form">
								<div class="form-body">
									<div class="form-group">
										<label class="col-md-3 control-label">Type Of Business</label>
										<div class="col-md-9">
										<?php echo $this->Form->input('name', array('class'=>'form-control input-lg','label'=>false,'type'=>'text','required'=>'required')); ?>
										
										</div>
									</div>
								
									
								</div>
								<div class="form-actions right1">
									<button type="button" class="btn default">Cancel</button>
									<button type="submit" class="btn green">Submit</button>
								</div>
							</form>
						</div>
					</div>
					
					</div>
<div class="col-md-6">
					<!-- BEGIN SAMPLE TABLE PORTLET-->
					<div class="portlet box red">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-cogs"></i> Type Of Businesses
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
										 Name
									</th>
									
									<th>
										 CreatedOn
									</th>
									<th>Action</th>
								</tr>
								</thead>
								<tbody>
								<?php foreach($tob as $key=>$get) { ?>
								<tr>
									<td>
										 <?php echo $key+1; ?>
									</td>
									<td>
										 <?php echo $get['TypeOfBusiness']['name']; ?>
									</td>
									<td>
										<?php $date= $get['TypeOfBusiness']['createdOn']; 
										$newDate = date("d-m-Y", strtotime($date));
										echo $newDate;
										?>
									</td>
									
									<td>
									<?php echo $this->Html->link(
										'<i class="fa fa-edit"></i>',
										array(
											'controller' => 'admins',
											'action' => 'edit_business',
											$get['TypeOfBusiness']['id']
										),array(
											'rel'                 => 'tooltip',
											'data-placement'      => 'left',
											'data-original-title' => 'Edit',
											'class'               => 'btn btn-small',
											'escape'              => false  //NOTICE THIS LINE ***************
										)
									); ?>
									
									<?php echo $this->Html->link(
										'<i class="fa fa-trash-o"></i>',
										array('controller' => 'admins', 'action' => 'delete_business',$get['TypeOfBusiness']['id']),
										array(
										'rel'                 => 'tooltip',
										'data-placement'      => 'right',
										'data-original-title' => 'delete',
										'class'               => 'btn btn-small',
										'escape'              => false,  //NOTICE THIS LINE ***************
										'confirm' => 'Are you sure you wish to delete this category?'
									)
									); ?>
									
									</td>
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