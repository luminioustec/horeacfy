<div class="row">			
<div class="col-md-12">
					<!-- BEGIN SAMPLE TABLE PORTLET-->
					<div class="portlet box red">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-cogs"></i> All Demands
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
										 Restaurador
									</th>
									<th>
										Codigo Postal
									</th>
									<th>
										 Created On
									</th>
									<th>Action</th>
									
								</tr>
								</thead>
								<tbody>
								<?php foreach($demand_by as $key=>$get) {
									$demand_id=base64_encode($get['Demand']['id']);	
									?>
								<tr>
									<td><?php echo $key+1; ?></td>
									<td><b><?php echo $get['Family']['name']; ?></b></td>
									<td><?php echo $get['User']['Customer']['name']; ?></td>
									<td><?php echo $get['User']['Customer']['zipcode']; ?></td>
									<td><?php echo $get['User']['Customer']['createdOn']; ?></td>
									<td>
									<a href="<?= SITE_URL; ?>wholesalers/submit_offer/<?php echo $demand_id; ?>">
									<span class="label label-sm label-success">
									<?php echo 'Submit Offer'; ?></span> </a>
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