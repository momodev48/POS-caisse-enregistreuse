<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
               
                <div class="panel-body">
                    <?php echo  form_open('setting/card_terminal/create') ?>
                    <?php echo form_hidden('card_terminalid', (!empty($intinfo->card_terminalid)?$intinfo->card_terminalid:null)) ?>
                        <div class="form-group row">
                            <label for="card_terminal_name" class="col-sm-4 col-form-label"><?php echo display('card_terminal_name') ?> *</label>
                            <div class="col-sm-8">
                                <input name="card_terminal_name" class="form-control" type="text" placeholder="Add <?php echo display('card_terminal_name') ?>" id="card_terminal_name" value="<?php echo (!empty($intinfo->terminal_name)?$intinfo->terminal_name:null) ?>">
                            </div>
                        </div>
  						
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('update') ?></button>
                        </div>
                    <?php echo form_close() ?>

                </div>  
            </div>
        </div>
    </div>