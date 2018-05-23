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
					
					</div>