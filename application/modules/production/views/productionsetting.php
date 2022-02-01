
<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
               
                <div class="panel-body">
                    <fieldset class="border p-2">
                       <legend  class="w-auto"><?php echo $title; ?></legend>
                    </fieldset>
					<div class="row bg-brown">
                             <div class="col-sm-12 kitchen-tab" id="option">
                             					<p  class="productionset_rightg">
                     <strong class="productionset_color">NOTE***:</strong> A restaurant should have a fixed recipe for a particular food
For making your work easy. This application has an auto production system which describes like this :<br />
If you have a sufficient amount of ingredients in your restaurant stock then it will automatically upgrade the amount of production for every sale.
Let me explain to you how:
Suppose, set a recipe for fried rice and a bbq chicken in your system once in the module Recipe Management>Add production with the ingredients, serving unit, variant, and price. Now you have got an order of 3 fried rice and 2 bbq chicken. You do not need to make this production again and again. Just select the food and make the order done from POS. The system will make the dish ready and it will automatically update the in-stock and out-stock quantity in the REPORT (Production-wise) and the ingredients will be reduced from the REPORT (Kitchen-wise). 
                 </p>
                                                <input id="chkbox-1760" type="checkbox" class="individual" name="productionsetting" value="productionsetting" <?php if($possetting->productionsetting==1){ echo "checked";}?>>
                                                <label for="chkbox-1760" class="productionsets_color">
                                                    <span class="radio-shape">
                                                        <i class="fa fa-check"></i>
                                                    </span>
                                                   <?php echo display('select_auto') ?>
                                                </label>
                                               
                            </div>
                        </div>
                </div> 
            </div>
        </div>
    </div>

<script src="<?php echo base_url('application/modules/production/assets/js/production.js'); ?>" type="text/javascript"></script>