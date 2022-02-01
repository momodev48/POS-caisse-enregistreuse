<?php echo  form_open_multipart('dashboard/web_setting/updatebanner') ?>
 <?php echo form_hidden('slid', (!empty($intinfo->slid)?$intinfo->slid:null)) ?>
                        <div class="form-group row">
                        <input name="sliderimage" type="hidden" value="<?php echo $intinfo->image;?>" />
                            <label for="ptype" class="col-sm-4 col-form-label"><?php echo display('banner_type') ?> *</label>
                            <div class="col-sm-8 customesl">
                                <?php if(empty($type)){$type = array('' => '--Select--');}
						echo form_dropdown('banner_type',$type,(!empty($intinfo->Sltypeid)?$intinfo->Sltypeid:null),'class="form-control" id="ptype" required') ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="title" class="col-sm-4 col-form-label"><?php echo display('bannersize') ?> *</label>
                            <div class="col-sm-3">
                                <input name="width" class="form-control" type="number" placeholder="<?php echo display('width') ?>" value="<?php echo (!empty($intinfo->width)?$intinfo->width:null) ?>" required>
                            </div>
                            <div class="col-sm-1">X</div>
                            <div class="col-sm-3">
                                <input name="height" class="form-control" type="number" placeholder="<?php echo display('height') ?>" value="<?php echo (!empty($intinfo->height)?$intinfo->height:null) ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="title" class="col-sm-4 col-form-label"><?php echo display('title') ?> *</label>
                            <div class="col-sm-8">
                                <input name="title" class="form-control" type="text" placeholder="<?php echo display('title') ?>" id="suppliername" value="<?php echo (!empty($intinfo->title)?$intinfo->title:null) ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="subtitle" class="col-sm-4 col-form-label"><?php echo display('subtitle') ?> *</label>
                            <div class="col-sm-8">
                                <input name="subtitle" class="form-control" type="text" placeholder="<?php echo display('subtitle') ?>" id="email" value="<?php echo (!empty($intinfo->subtitle)?$intinfo->subtitle:null) ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="mobile" class="col-sm-4 col-form-label"><?php echo display('image') ?> *</label>
                            <div class="col-sm-8">
                                <input type="file" accept="image/*" name="picture"><a class="cattooltipsimg" data-toggle="tooltip" data-placement="top" title="Use only .jpg,.jpeg,.gif and .png Images with Size: 1920X902"><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="url" class="col-sm-4 col-form-label"><?php echo display('link_url') ?> *</label>
                            <div class="col-sm-8">
                                <input name="url" class="form-control" type="text" placeholder="<?php echo display('link_url') ?>" value="<?php echo (!empty($intinfo->slink)?$intinfo->slink:null) ?>" >
                            </div>
                        </div>
                        <div class="form-group row">
                        <label for="lastname" class="col-sm-4 col-form-label"><?php echo display('status') ?> *</label>
                        <div class="col-sm-8 customesl">
                            <select name="status"  class="form-control">
                                <option value=""  selected="selected"><?php echo display('select_option') ?></option>
                                <option value="1" <?php if(!empty($intinfo)){if($intinfo->status==1){echo "Selected";}} ?>><?php echo display('active') ?></option>
                                <option value="0" <?php if(!empty($intinfo)){if($intinfo->status==0){echo "Selected";}} ?>><?php echo display('inactive') ?></option>
                              </select>
                        </div>
                    </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('update') ?></button>
                        </div>
                    <?php echo form_close() ?>