<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd">
            <div class="panel-heading">
                <div class="panel-title box-header itemmanage_box_header" >
                    <h4><?php echo (!empty($title)?$title:null) ?></h4>
                    <div class="col-md-2"><input type="text" name="item_list" class="form-control" placeholder="Search" id="item_list"  />
                    
                    </div>
                </div>
            </div>
            <div class="panel-body">


                <?php echo form_open_multipart("itemmanage/item_food/addgroupfood") ?>
                    
                    <?php echo form_hidden('id',$this->session->userdata('id'));?>
                     <?php echo form_hidden('ProductsID', (!empty($productinfo->ProductsID)?$productinfo->ProductsID:null)) ?>
                     <input name="bigimage" type="hidden" value="<?php echo (!empty($productinfo->bigthumb)?$productinfo->bigthumb:null) ?>" />
                     <input name="mediumimage" type="hidden" value="<?php echo (!empty($productinfo->medium_thumb)?$productinfo->medium_thumb:null) ?>" />
                     <input name="smallimage" type="hidden" value="<?php echo (!empty($productinfo->small_thumb)?$productinfo->small_thumb:null) ?>" />
                     <div class="col-lg-4">
                    <div class="form-group row">
                        <label for="category" class="col-sm-4 col-form-label">Category</label>
                        <div class="col-sm-8">
                        <select name="CategoryID" class="form-control" required="">
                            <option value="" selected="selected">Category Name</option> 
                            <?php foreach($categories as $caregory){?>
                            <option value="<?php echo $caregory->CategoryID;?>" class='bolden' <?php if($productinfo->CategoryID==$caregory->CategoryID){echo "selected";}?>><strong><?php echo $caregory->Name;?></strong></option>
                            	<?php if(!empty($caregory->sub)){
								foreach($caregory->sub as $subcat){?>
                                <option value="<?php echo $subcat->CategoryID;?>" <?php if($productinfo->CategoryID==$subcat->CategoryID){echo "selected";}?>>&nbsp;&nbsp;&nbsp;&mdash;<?php echo $subcat->Name;?></option>
                            <?php } } } ?>
                        </select>
                         
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="foodname" class="col-sm-4 col-form-label">Food Name *</label>
                        <div class="col-sm-8">
                            <input name="foodname" class="form-control" type="text" placeholder="Food Name" id="foodname"  value="<?php echo (!empty($productinfo->ProductName)?$productinfo->ProductName:null) ?>">
                        </div>
                    </div>
					<div class="form-group row">
                        <label for="component" class="col-sm-4 col-form-label">Component </label>
                        <div class="col-sm-8">
                            <input name="component" class="form-control" data-role="tagsinput" type="text" placeholder="Add Component" id="category_subtitle"  value="<?php echo (!empty($productinfo->component)?$productinfo->component:null) ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="itemnotes" class="col-sm-4 col-form-label">Notes </label>
                        <div class="col-sm-8">
                            <input name="itemnotes" class="form-control" type="text" placeholder="Add notes" id="itemnotes"  value="<?php echo (!empty($productinfo->itemnotes)?$productinfo->itemnotes:null) ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="itemnotes" class="col-sm-4 col-form-label">Description </label>
                        <div class="col-sm-8">
                            <input name="descrip" class="form-control" type="text" placeholder="Add Description" id="descrip"  value="<?php echo (!empty($productinfo->descrip)?$productinfo->descrip:null) ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="firstname" class="col-sm-4 col-form-label">Image </label>
                        <div class="col-sm-8">
                        <input type="file" accept="image/*" name="picture" onchange="loadFile(event)"><a class="cattooltipsimg" data-toggle="tooltip" data-placement="top" title="Use only .jpg,.jpeg,.gif and .png Images"><i class="fa fa-question-circle" aria-hidden="true"></i></a> 
                                <small id="fileHelp" class="text-muted"><img src="<?php echo base_url(!empty($productinfo->ProductImage)?$productinfo->ProductImage:'assets/img/icons/default.jpg'); ?>" id="output" class="img-thumbnail add_cat_img_item"/>
</small><input name="big" type="hidden" value="" id="bigurl" />
<input type="hidden" name="old_image" value="<?php echo (!empty($productinfo->ProductImage)?$productinfo->ProductImage:null) ?>">
                        </div>
                    </div>
                    </div>
                    <div class="col-lg-4">
                    <div class="form-group row">
                        <label for="vat" class="col-sm-5 col-form-label">Vat <a class="cattooltips" data-toggle="tooltip" data-placement="top" title="Vat Are always Caltulate percent like: 5 means 5%;"><i class="fa fa-question-circle" aria-hidden="true"></i></a></label>
                        <div class="col-sm-7">
                            <input name="vat" class="form-control" type="text" placeholder="0%" id="vat"  value="<?php echo (!empty($productinfo->productvat)?$productinfo->productvat:'') ?>">
                            </div>
                    </div>
                    <div class="form-group row">
                        <label for="firstname" class="col-sm-5 col-form-label"><?php echo display('is_offer')?> <a class="cattooltips" data-toggle="tooltip" data-placement="top" title="If use Food Special Offer then check it and fill necessary field"><i class="fa fa-question-circle" aria-hidden="true"></i></a></label>
                        <div class="col-sm-2">
                                    <div class="checkbox checkbox-success">
                                    <input type="checkbox" name="isoffer" value="1" <?php if(!empty($productinfo))if($productinfo->offerIsavailable==1){echo "checked";}?> id="isoffer">
                                        <label for="isoffer"></label>
                                    </div>
                        </div>
                        <label for="special" class="col-sm-3 col-form-label"><?php echo display('is_special')?></label>
                        <div class="col-sm-2">
                                    <div class="checkbox checkbox-success">
                                    <input type="checkbox" name="special" value="1" <?php if(!empty($productinfo))if($productinfo->special==1){echo "checked";}?> id="special">
                                        <label for="special"></label>
                                    </div>
                        </div>
                    </div>
                    <div id="offeractive" class="<?php if(!empty($productinfo)){if($productinfo->offerIsavailable==1){echo "";} else{ echo "showhide";}}else{echo "showhide";}?>">
                    <div class="form-group row">
                        <label for="offerate" class="col-sm-5 col-form-label">Offer Rate <a class="cattooltips" data-toggle="tooltip" data-placement="top" title="Offer Rate Must be a number. It a Percentange Like: if 5% then put 5"><i class="fa fa-question-circle" aria-hidden="true"></i></a></label>
                        <div class="col-sm-7">
                            <input name="offerate" class="form-control" type="text"  placeholder="0" id="offerate"  value="<?php echo (!empty($productinfo->OffersRate)?$productinfo->OffersRate:'') ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="offerstartdate" class="col-sm-5 col-form-label">Offer Start Date </label>
                        <div class="col-sm-7">
                            <input name="offerstartdate" class="form-control datepicker" type="text"  placeholder="Offer Date" id="offerstartdate"  value="<?php echo (!empty($productinfo->offerstartdate)?$productinfo->offerstartdate:null) ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="offerendate" class="col-sm-5 col-form-label">Offer End Date </label>
                        <div class="col-sm-7">
                            <input name="offerendate" class="form-control datepicker" type="text"  placeholder="Offer Date" id="offerendate"  value="<?php echo (!empty($productinfo->offerendate)?$productinfo->offerendate:null) ?>">
                        </div>
                    </div>
                    
                    </div>
                    <div class="form-group row">
                        <label for="vat" class="col-sm-5 col-form-label"><?php echo display('cookedtime');?></label>
                        <div class="col-sm-7">
                            <input name="cookedtime" type="text" class="form-control timepicker3" id="cookedtime" placeholder="00:00" autocomplete="off" value="<?php echo (!empty($productinfo->cookedtime)?$productinfo->cookedtime:null) ?>" />
                            </div>
                    </div>
                    <div class="form-group row">
                    <?php if(!empty($todaymenu)){?>
                        <label for="menutype" class="col-sm-5 col-form-label"><?php echo display('menu_type');?></label>
                        <div class="col-sm-7">
                        <?php 
						$searcharray=explode(',',$productinfo->menutype);
						$m=0;
						foreach($todaymenu as $tmenu){
							$m++;
							 $key = array_search($tmenu->menutypeid, $searcharray);
							?>
                        <div class="col-sm-4">
                                    <div class="checkbox checkbox-success">
                                    <input type="checkbox" name="menutype[]" value="<?php echo $tmenu->menutypeid;?>" <?php if(!empty($productinfo))if($searcharray[$key]==$tmenu->menutypeid){echo "checked";}?> id="<?php echo $m;?>">
                                        <label for="<?php echo $m;?>"><?php echo $tmenu->menutype;?></label>
                                        <input name="mytmenu_<?php echo $tmenu->menutypeid;?>" type="hidden" value="<?php echo $tmenu->menutypeid;?>" />
                                    </div>
                        </div>
                        <?php } } ?>
                        </div>
                    </div>
                     <?php if(!empty($taxitems)){
                        $tx=0;
                        foreach ($taxitems as $taxitem) {
                           $field_name = 'tax'.$tx; 
                        ?>
                          <div class="form-group row">
                        <label for="vat" class="col-sm-5 col-form-label"><?php echo $taxitem['tax_name'];?></label>
                        <div class="col-sm-7">
                            
                            <input name="<?php echo $field_name;?>" type="text" class="form-control" id="<?php echo $field_name;?>" placeholder="<?php echo $taxitem['tax_name'];?>" autocomplete="off" value="<?php echo (!empty($productinfo->$field_name)?$productinfo->$field_name:null) ?>" />
                            </div>
                    </div>
                        <?php
                        $tx++;
                        }
                    }
                    ?>
                    <div class="form-group row">
                        <label for="lastname" class="col-sm-5 col-form-label">Status</label>
                        <div class="col-sm-7">
                            <select name="status"  class="form-control">
                                <option value=""  selected="selected">Select Option</option>
                                <option value="1" <?php  if(!empty($productinfo)){if($productinfo->ProductsIsActive==1){echo "Selected";}} else{echo "Selected";} ?>>Active</option>
                                <option value="0" <?php if($productinfo->ProductsIsActive==0){echo "Selected";} ?>>Inactive</option>
                              </select>
                        </div>
                    </div>
                    
                   
                    <div class="form-group text-right">
                        <button type="reset" class="btn btn-primary w-md m-b-5">Reset</button>
                        <button type="submit" class="btn btn-success w-md m-b-5">Save</button>
                    </div>
                    </div>
                    <div class="col-lg-4">
                     <table id="mytble" class="table table-striped table-bordered table-hover">
                     		<thead>
                                 <tr id="0">
                                    <th>Name</th>
                                    <th>Varient</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Action</th>
                                  </tr>
                            </thead>
                            <tbody id="mygroupitem">
                            	<?php $allpvid='';
								if(!empty($groupsitem)){
									$i=0;
									
									foreach($groupsitem as $items){
										$i++;
										$allpvid.=$items->varientid.$items->items.",";
										$inteminfo=$this->fooditem_model->findBygroupId($items->items);
									?>
                                		<tr id="test<?php echo $i;?>">
                                        <td><input name="itemidvid" class="itemidvid" type="hidden" value="<?php echo $inteminfo->variantid.$inteminfo->menuid ?>"><input name="itemid[]" id="itemid" type="hidden" value="<?php echo $inteminfo->ProductsID; ?>"><?php echo $inteminfo->ProductName; ?></td>
                                        <td><input name="varientid[]" id="varientid" type="hidden" value="<?php echo $inteminfo->variantid;?>"><?php echo $inteminfo->variantName; ?></td>
                                        <td><input name="myprice" class="myprice" type="hidden" id="pr<?php echo $inteminfo->variantid.$inteminfo->menuid ?>" value="<?php echo $inteminfo->price; ?>"><?php echo $inteminfo->price; ?></td>
                                        <td  class="itemmanage_box_w_100"><button onclick="decrese(<?php echo $i;?>,<?php echo $inteminfo->price; ?>,<?php echo $inteminfo->variantid.$inteminfo->menuid ?>)" class="reduced items-count" type="button"><i class="fa fa-minus"></i></button><input type="text" class="itemmanage_box_w_25" name="qty[]" id="sst<?php echo $i;?>" maxlength="12" value="<?php echo (!empty($items->item_qty)?$items->item_qty:null) ?>" class="input-text qty" readonly="readonly"><button onclick="increse(<?php echo $i;?>,<?php echo $inteminfo->price; ?>,<?php echo $inteminfo->variantid.$inteminfo->menuid ?>)" class="increase items-count" type="button"><i class="fa fa-plus"></i></button></td>
                                        <td><a onClick="rem_values(<?php echo $i;?>)" class="itemmanage_box_w">Remove</a></td>
                                        </tr>
                                <?php } } 
								$allpvid=trim($allpvid,',');
								?>
                            </tbody>
                     </table>
                     <input name="allid" type="hidden" id="allid" value="<?php echo $allpvid;?>"/>
                     <div class="form-group row">
                        <label for="foodname" class="col-sm-4 col-form-label">Price *</label>
                        <div class="col-sm-8">
                            <input name="price" class="form-control" type="text" placeholder="price" id="price"  value="<?php echo (!empty($productinfo->price)?$productinfo->price:null) ?>">
                        </div>
                    </div>
                    </div>
                <?php echo form_close() ?>

            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('application/modules/itemmanage/assets/js/addgroupitem_script.js'); ?>" type="text/javascript"></script>