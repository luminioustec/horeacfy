<div class="row">
<div class="col-md-12">

<div class="portlet box purple ">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-gift"></i> 
								Edit listas
								
							</div>
						</div>
						<div class="portlet-body form">
						<?php echo $this->Form->create('Wholesalerlist',array('class'=>'form-horizontal',array('type' => 'file'))); ?>
							<form class="form-horizontal" role="form">
								<div class="form-body">
									<div class="form-group">
										<label class="col-md-3 control-label">Brand</label>
										<div class="col-md-9">
										<?php echo $this->Form->input('brand', array('class'=>'form-control input-lg','label'=>false,'type'=>'text')); ?>
										
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Comments</label>
										<div class="col-md-9">
										<?php echo $this->Form->input('comments', array('class'=>'form-control input-lg','label'=>false,'type'=>'textarea')); ?>
										
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
					</div>