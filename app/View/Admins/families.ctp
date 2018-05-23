<style>
.pagination .current,
.pagination .disabled {
    float: left;
    padding: 0 14px;

    color: #999;
    cursor: default;
    line-height: 34px;
    text-decoration: none;

    border: 1px solid #DDD;
    border-left-width: 0;
}
</style>

<div class="row">
<div class="col-md-12">

<div class="portlet box purple ">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-gift"></i> Add Families
							</div>
						</div>
						<div class="portlet-body form">
						<?php echo $this->Form->create('Family',array('class'=>'form-horizontal')); ?>
							<form class="form-horizontal" role="form">
								<div class="form-body">
									<div class="form-group">
										<label class="col-md-3 control-label">Family Name</label>
										<div class="col-md-9">
										<?php echo $this->Form->input('name', array('class'=>'form-control input-lg','placeholder'=>'Family name','label'=>false,'type'=>'text','required'=>'required')); ?>
										
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Choose Category</label>
										<div class="col-md-9">
											<?php echo $this->Form->input('categoryId', array('class'=>'form-control','empty'=>'Select category','label'=>false,'required'=>'required','type'=>'select','options'=>$cats)); ?>
										</div>
									</div>
									<?php echo $this->Form->input('visible', array('value'=>'1','type'=>'hidden')); ?>
								</div>
								<div class="form-actions right1">
									<button type="button" class="btn default">Cancel</button>
									<button type="submit" class="btn green">Submit</button>
								</div>
							</form>
						</div>
					</div>
					
					</div>
					
					</div>
	<div class="row">				
	<div class="col-md-12">
					<!-- BEGIN SAMPLE TABLE PORTLET-->
					<div class="portlet box red">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-cogs"></i>Families
							</div>
							
						</div>
						<div class="portlet-body">
							<div class="table-scrollable">
								<table class="table table-striped table-bordered table-hover" id="sample_2">
								<thead>
								<tr>
									
									<th>
										 Name
									</th>
									<th>
										 Category
									</th>
									<th>
										 Status
									</th>
									<th>Action</th>
								</tr>
								</thead>
								<tbody>
								<?php foreach($families as $key=>$get) { ?>
								<tr class="odd gradeX">
									
									<td>
										 <?php echo $get['Family']['name']; ?>
									</td>
									<td>
										<?php echo $get['Category']['name']; ?>
									</td>
									<td>
									<?php if($get['Family']['visible']=='0'){ ?>
										<span class="label label-sm label-danger">
									<?php echo 'Invisible'; }else{?> </span>
									<span class="label label-sm label-success">
									<?php echo 'Visible'; }?> </span>
									</td>
									<td>
									<?php echo $this->Html->link(
										'<i class="fa fa-edit"></i>',
										array(
											'controller' => 'customers',
											'action' => 'edit_family',
											$get['Family']['id']
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
										array('controller' => 'customers', 'action' => 'delete_family',$get['Family']['id']),
										array(
										'rel'                 => 'tooltip',
										'data-placement'      => 'right',
										'data-original-title' => 'delete',
										'class'               => 'btn btn-small',
										'escape'              => false,  //NOTICE THIS LINE ***************
										'confirm' => 'Are you sure you wish to delete this Family?'
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