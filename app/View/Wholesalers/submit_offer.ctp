<div class="portlet box blue">
									<div class="portlet-title">
										<div class="caption">
											<i class="fa fa-gift"></i><?php echo $full_demand['Family']['name']; ?>
										</div>
										
									</div>
									<div class="portlet-body form">
										<!-- BEGIN FORM-->
										<?php echo $this->Form->create('Offer',array('class'=>'form-horizontal')); ?>
											<div class="form-body">
												<h2 class="margin-bottom-20">Ver datos - <?php echo $full_demand['Family']['name']; ?> </h2>
												<h3 class="form-section">Información del restaurador</h3>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">Marca:</label>
															<div class="col-md-9">
																<p class="form-control-static">
																	 <?php echo $full_demand['Demand']['brand']; ?>
																</p>
															</div>
														</div>
													</div>
													<!--/span-->
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">Formato:</label>
															<div class="col-md-9">
																<p class="form-control-static">
																	 <?php echo $full_demand['Demand']['format']; ?>
																</p>
															</div>
														</div>
													</div>
													<!--/span-->
												</div>
												<!--/row-->
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">Consumo Mes:</label>
															<div class="col-md-9">
																<p class="form-control-static">
																	 <?php echo $full_demand['Demand']['quantyPerMonth']; ?>
																</p>
															</div>
														</div>
													</div>
													<!--/span-->
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">Precio objetivo:</label>
															<div class="col-md-9">
																<p class="form-control-static">
																	 <?php echo $full_demand['Demand']['targetPrice']; ?>
																</p>
															</div>
														</div>
													</div>
													<!--/span-->
												</div>
												<!--/row-->
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">Comentarios:</label>
															<div class="col-md-9">
																<p class="form-control-static">
																	  <?php echo $full_demand['Demand']['comments']; ?>
																</p>
															</div>
														</div> 
													</div>
													<!--/span-->
													
													<!--/span-->
												</div>
												<!--/row-->
												<h3 class="form-section">Mi oferta</h3>
												
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">Marca</label>
															<div class="col-md-9">
																<?php echo $this->Form->input('brand', array('class'=>'form-control','label'=>false,'type'=>'text','required'=>'required')); ?>
															</div>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">Formato</label>
															<div class="col-md-9">
																<?php echo $this->Form->input('fomat', array('class'=>'form-control','label'=>false,'type'=>'text','required'=>'required')); ?>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">Precio objetivo</label>
															<div class="col-md-9">
																<?php echo $this->Form->input('offerPrice', array('class'=>'form-control','label'=>false,'type'=>'text','required'=>'required')); ?>
															</div>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">Comentarios</label>
															<div class="col-md-9">
																<?php echo $this->Form->input('comments', array('class'=>'form-control','label'=>false,'type'=>'textarea')); ?>
															</div>
														</div>
													</div>
												</div>
												
											</div>
											<div class="form-actions">
												<div class="row">
													<div class="col-md-6">
														<div class="row">
															<div class="col-md-offset-3 col-md-9">
																<button type="submit" class="btn green"><i class="fa fa-pencil"></i>> Enviar a restaurador</button>
																<?php echo $this->Form->end(); ?>

															</div>
														</div>
													</div>
													<div class="col-md-6">
													</div>
												</div>
											</div>
										
										<!-- END FORM-->
									</div>
								</div>