<div class="portlet box purple ">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-gift"></i> Edit Categories
							</div>
						</div>
						<div class="portlet-body form">
						<?php echo $this->Form->create('Category',array('class'=>'form-horizontal',array('type' => 'file'))); ?>
							<form class="form-horizontal" role="form">
								<div class="form-body">
									<div class="form-group">
										<label class="col-md-3 control-label">Name</label>
										<div class="col-md-9">
										<?php echo $this->Form->input('name', array('class'=>'form-control input-lg','placeholder'=>'Category name','label'=>false,'type'=>'text','required'=>'required')); ?>
										
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Image</label>
										<div class="col-md-9">
										<?php echo $this->Form->input('image', array('class'=>'form-control','placeholder'=>'Category name','label'=>false,'type'=>'file','required'=>'required')); ?>
										</div>
									</div>
									
								</div>
								<div class="form-actions right1">
									<button onclick="history.go(-1);" type="button" class="btn default">Cancel</button>
									<button type="submit" class="btn green">Update</button>
								</div>
							</form>
						</div>
					</div>