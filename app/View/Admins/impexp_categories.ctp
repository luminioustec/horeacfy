<div class="portlet box green">
									<div class="portlet-title">
										<div class="caption">
											<i class="fa fa-gift"></i>Export/Import
										</div>
										<div class="tools">
											<a title="" class="collapse" href="javascript:;" data-original-title="">
											</a>
											<a title="" class="config" href="#portlet-config" data-toggle="modal" data-original-title="">
											</a>
											<a title="" class="reload" href="javascript:;" data-original-title="">
											</a>
											<a title="" class="remove" href="javascript:;" data-original-title="">
											</a>
										</div>
									</div>
									<div class="portlet-body form">
										<!-- BEGIN FORM-->
										<?php echo $this->Form->create('Category',array('type'=>'file','class'=>'form-horizontal')); ?>
											<div class="form-body">
												<h3 class="form-section">Export Sample</h3>
												<p>Click the button below to export Sample CSV to mass uploading Categories</p>
												
												<div class="row">
													<div class="col-md-6">
														<div class="row">
															<div class="col-md-offset-3 col-md-9">
																<a href="<?php echo THEME_PATH;?>files/samples/categories.csv" class="btn green" type="submit">Export</a>
															</div>
														</div>
													</div>
													<div class="col-md-6">
													</div>
												</div>
											
													<!--/span-->
												</div>
												<h3 class="form-section">Import</h3>
												<p>Upload a file to import Mass Data</p>
												<!--/row-->
												
												
												<div class="form-group">
										<label class="col-md-3 control-label" for="exampleInputFile">File input</label>
										<div class="col-md-9">
										<?php echo $this->Form->input('file', array('class'=>'form-control input-lg','placeholder'=>'Category name','label'=>false,'type'=>'file','required'=>'required')); ?>
											
											<p class="help-block">
												 Upload Valid CSV, make sure it match the sample csv. 
												</p>
											</div>
										</div>
												<!--/row-->
											</div>
											<div class="form-actions">
												<div class="row">
													<div class="col-md-6">
														<div class="row">
															<div class="col-md-offset-3 col-md-9">
															
																<?php echo $this->form->end('Import',array('class'=>'btn default')); ?>
																
															</div>
														</div>
													</div>
													
												</div>
											</div>
										
										<!-- END FORM-->
									</div>
								</div>