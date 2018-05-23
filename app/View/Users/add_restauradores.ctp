
<div class="main">
      <div class="container">
        <ul class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li><a href="javascript:;">Pages</a></li>
            <li class="active">Create restauradores account</li>
        </ul>
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">

          <!-- BEGIN CONTENT -->
          <div class="col-md-12 col-sm-9">
            <h1>Create an account</h1>
            <div class="content-form-page">
              <div class="row">
                <div class="col-md-7 col-sm-7">
                  <?php echo $this->Form->create('User',array('class'=>'form-horizontal'));?>
                    <fieldset>
                      <legend>Your personal details</legend>
                      <div class="form-group">
                        <label for="firstname" class="col-lg-4 control-label">VAT</label>
                        <div class="col-lg-8">
						  <?php echo $this->Form->input('vat',array('class'=>'form-control','div'=>false,'label'=>false)); ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="email" class="col-lg-4 control-label">Email <span class="require">*</span></label>
                        <div class="col-lg-8">
                           <?php echo $this->Form->input('username',array('class'=>'form-control','div'=>false,'label'=>false)); ?>
                        </div>
                      </div>
                    </fieldset>
                    <fieldset>
                      <div class="form-group">
                        <label for="password" class="col-lg-4 control-label">Password <span class="require">*</span></label>
                        <div class="col-lg-8">
                          <?php echo $this->Form->input('password',array('class'=>'form-control','div'=>false,'label'=>false,'type'=>'password')); ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="confirm-password" class="col-lg-4 control-label">Name<span class="require">*</span></label>
                        <div class="col-lg-8">
                         <?php echo $this->Form->input('name',array('class'=>'form-control','div'=>false,'label'=>false)); ?>
                        </div>
                      </div>
                    </fieldset>
					<fieldset>
                      <div class="form-group">
                        <label for="password" class="col-lg-4 control-label">Type Of Business <span class="require">*</span></label>
                        <div class="col-lg-8">
                          <?php echo $this->Form->input('typeOfbusiness',array('class'=>'form-control','div'=>false,'label'=>false,'typw'=>'Select','empty'=>'Select','options'=>$tob)); ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="confirm-password" class="col-lg-4 control-label">Contact Name<span class="require">*</span></label>
                        <div class="col-lg-8">
                         <?php echo $this->Form->input('contactName',array('class'=>'form-control','div'=>false,'label'=>false)); ?>
                        </div>
                      </div>
                    </fieldset>
					<fieldset>
                      <div class="form-group">
                        <label for="password" class="col-lg-4 control-label">Contact Email <span class="require">*</span></label>
                        <div class="col-lg-8">
                          <?php echo $this->Form->input('contactEmail',array('class'=>'form-control','div'=>false,'label'=>false)); ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="confirm-password" class="col-lg-4 control-label">Contact Mobile<span class="require">*</span></label>
                        <div class="col-lg-8">
                         <?php echo $this->Form->input('contactMobile',array('class'=>'form-control','div'=>false,'label'=>false)); ?>
                        </div>
                      </div>
                    </fieldset>
					<fieldset>
                      <div class="form-group">
                        <label for="password" class="col-lg-4 control-label">Address <span class="require">*</span></label>
                        <div class="col-lg-8">
                          <?php echo $this->Form->input('address',array('class'=>'form-control','div'=>false,'label'=>false)); ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="confirm-password" class="col-lg-4 control-label">City<span class="require">*</span></label>
                        <div class="col-lg-8">
                         <?php echo $this->Form->input('city',array('class'=>'form-control','div'=>false,'label'=>false)); ?>
                        </div>
                      </div>
                    </fieldset>
					<fieldset>
                      <div class="form-group">
                        <label for="password" class="col-lg-4 control-label">Zipcode <span class="require">*</span></label>
                        <div class="col-lg-8">
                          <?php echo $this->Form->input('zipcode',array('class'=>'form-control','div'=>false,'label'=>false)); ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="confirm-password" class="col-lg-4 control-label">Province<span class="require">*</span></label>
                        <div class="col-lg-8">
                         <?php echo $this->Form->input('province',array('class'=>'form-control','div'=>false,'label'=>false)); ?>
                        </div>
                      </div>
                    </fieldset>
					<fieldset>

                      <div class="form-group">
                        <label for="password" class="col-lg-4 control-label">Country <span class="require">*</span></label>
                        <div class="col-lg-8">
                          <?php echo $this->Form->input('country',array('class'=>'form-control','div'=>false,'label'=>false)); ?>
                        </div>
                      </div>
                    </fieldset>
					  <?php echo $this->Form->input('role',array('type'=>'hidden','value'=>'customer')); ?>
                    <div class="row">
                      <div class="col-lg-8 col-md-offset-4 padding-left-0 padding-top-20">                        
                        <button type="submit" class="btn btn-primary">Crear cuenta</button>
                        <button type="button" class="btn btn-default">Cancelar</button>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="col-md-4 col-sm-4 pull-right">
                  <div class="form-info">
                    <h2><em>Important</em> Information</h2>
                    <p>Lorem ipsum dolor ut sit ame dolore  adipiscing elit, sed sit nonumy nibh sed euismod ut laoreet dolore magna aliquarm erat sit volutpat. Nostrud exerci tation ullamcorper suscipit lobortis nisl aliquip  commodo quat.</p>

                    <p>Duis autem vel eum iriure at dolor vulputate velit esse vel molestie at dolore.</p>

                    <button type="button" class="btn btn-default">More details</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->
      </div>
    </div>