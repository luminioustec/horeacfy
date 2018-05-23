
 
<body>
    <div id="wrap">
        <div class="container">
            <div class="row">
				
				 <?php echo $this->Form->create('Family',array('type'=>'file')); ?>
                    <fieldset>
                        <!-- Form Name -->
                        <legend>Form Name</legend>
 
                        <!-- File Button -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="filebutton">Select File</label>
                            <div class="col-md-4">
							<?php echo $this->Form->input('file', array('class'=>'form-control input-lg','placeholder'=>'Category name','label'=>false,'type'=>'file','required'=>'required')); ?>
                               
                            </div>
                        </div>
 
                        <!-- Button -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="singlebutton">Import data</label>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary button-loading" data-loading-text="Loading...">Import</button>
                            </div>
                        </div>
 
                    </fieldset>
                </form>
 
            </div>
            
        </div>
    </div>
</body>
 
</html>