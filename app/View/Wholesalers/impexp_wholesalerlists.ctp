<div class="portlet box green">
									<div class="portlet-title">
										<div class="caption">
											<i class="fa fa-gift"></i>Importar CSV de ofertas
										</div>
										
									</div>
									<div class="portlet-body form">
										<!-- BEGIN FORM-->
										<?php echo $this->Form->create('Wholesalerlist',array('type'=>'file','class'=>'form-horizontal')); ?>
											<div class="form-body">
												<h3 class="form-section">Ejemplo de fichero</h3>
												<p>Clic para descargar un fichero ejemplo para subir ofertas</p>
												
												<div class="row">
													<div class="col-md-6">
														<div class="row">
															<div class="col-md-offset-3 col-md-9">
																<a href="<?php echo THEME_PATH;?>files/samples/wholesalerlist.csv" class="btn green" type="submit">Descargar</a>
															</div>
														</div>
													</div>
													<div class="col-md-6">
													</div>
												</div>
											
													<!--/span-->
											</div>
											<div class="form-body">
												<h3 class="form-section">Importar CSV</h3>
												<p>Upload a file to import Mass Data</p>
												<!--/row-->
												
												
												<div class="form-group">
										<label class="col-md-3 control-label" for="exampleInputFile"></label>
										<div class="col-md-9">
										<?php echo $this->Form->input('file', array('class'=>'form-control input-lg','placeholder'=>'Category name','label'=>false,'type'=>'file','required'=>'required')); ?>
											
											<p class="help-block">
												 Subir un CSV válido. Utilizar fichero ejemplo
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
															<button type="submit" class="btn green">Importar</button>
																<?php echo $this->form->end(); ?>
																
															</div>
														</div>
													</div>
													
												</div>
											</div>
										
										<!-- END FORM-->
									</div>
								</div>