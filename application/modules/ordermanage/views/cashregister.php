<div class="modal-header"><h3 class="m-0 p-0">Start Register ( <?php echo date('d M, Y H:i')?> ) </h3></div>
<div class="modal-body">
        <div class="row">
          <div class="col-sm-12 col-md-12">
            <div class="panel">
              <div class="panel-body">                
                <?php echo form_open('','method="post" name="cashopen" id="cashopenfrm"')?>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label for="bank" class="col-sm-4 col-form-label"><?php echo display('counter_no');?></label>
                    <div class="col-sm-7 customesl"> 					
					<?php echo form_dropdown('counter',$allcounter,'','class="postform resizeselect form-control" id="counter"') ?> </div>
                  </div>
                  <div class="form-group row">
                    <label for="4digit" class="col-sm-4 col-form-label"><?php echo display('total_amount');?></label>
                    <div class="col-sm-7">
                      <input type="hidden" id="maintotalamount" name="maintotalamount" value="" />
                      <input type="text" class="form-control" id="totalamount" name="totalamount" value="<?php echo $openingbalance; ?>"/>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="4digit" class="col-sm-4 col-form-label"><?php echo "Note";?></label>
                    <div class="col-sm-7">
                      <textarea id="OpeningNote" class="form-control" name="OpeningNote" cols="30" rows="3" placeholder="Opening Note"></textarea>
                    </div>
                  </div>
                  <div class="form-group text-right">
                    <div class="col-sm-11 pr-0">
                      <a href="<?php echo base_url();?>dashboard/home" class="btn btn-success w-md m-b-5"><?php echo "Dashboard";?></a>&nbsp;<button type="button" id="openclosecash" class="btn btn-success w-md m-b-5" onclick="opencashregister()"><?php echo display('add_opening_balance');?></button>
                    </div>
                  </div>
                </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    