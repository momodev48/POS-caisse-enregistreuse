<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!-- Add Product Report Start -->
<div id="add0" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <strong><?php echo display('supplier_add');?></strong>
            </div>
            <div class="modal-body">
           
<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
               
                <div class="panel-body">

                    <?php echo  form_open('itemmanage/item_food/supplieradd') ?>
                    <?php echo form_hidden('supid', (!empty($intinfo->supid)?$intinfo->supid:null)) ?>
                        <div class="form-group row">
                            <label for="suppliername" class="col-sm-4 col-form-label"><?php echo display('supplier_name') ?> *</label>
                            <div class="col-sm-8">
                                <input name="suppliername" class="form-control" type="text" placeholder="Add <?php echo display('supplier_name') ?>" id="suppliername" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label"><?php echo display('email') ?> </label>
                            <div class="col-sm-8">
                                <input name="email" class="form-control" type="text" placeholder="Add <?php echo display('email') ?>" id="email" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="mobile" class="col-sm-4 col-form-label"><?php echo display('mobile') ?> *</label>
                            <div class="col-sm-8">
                                <input name="mobile" class="form-control" type="text" placeholder="Add <?php echo display('mobile') ?>" id="mobile" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-sm-4 col-form-label"><?php echo display('address') ?> *</label>
                            <div class="col-sm-8">
                          <textarea name="address" class="form-control" cols="50" rows="3" placeholder="Add <?php echo display('address') ?>" id="address" ></textarea>
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <button type="reset" class="btn btn-primary w-md m-b-5"><?php echo display('reset') ?></button>
                            <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('Ad') ?></button>
                        </div>
                    <?php echo form_close() ?>

                </div>  
            </div>
        </div>
    </div>
             
    
   
    </div>
     
            </div>
            <div class="modal-footer">

            </div>

        </div>

    </div>

<div class="row">
            <div class="col-sm-12">
                <div class="column">
           
                    <button class="btn btn-success md-trigger m-b-5 m-r-2" data-target="#add0" data-toggle="modal" >
                    <i class="ti-plus"></i><span> <?php echo display('supplier_add') ?></span></button>
                    <!-- the overlay element -->
                    <div class="md-overlay"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <!-- Multiple panels with drag & drop -->
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('csv_file_informaion')?></h4>
                        </div>
                    </div>
                    <div class="panel-body">
                       <a href="<?php echo base_url('assets/data/csv/product_csv_sample.csv') ?>" class="btn btn-primary pull-right"><i class="fa fa-download"></i> 
                        <?php echo display('download_sample_file')?>
                       </a>
                            <span class="text-warning">The first line in downloaded csv file should remain as it is. Please do not change the order of columns.</span><br>The correct column order is <span class="text-info">(supplier_id, category_id, product_name, price, supplier_price, unit, product_model, product_details, image_thumb, brand_id, variants, type, best_sale, onsale, onsale_price, invoice_details, image_large_details,review, description, tag, specification, status separated by vertical bar)</span> &amp; you must follow this.<br>Please make sure the csv file is UTF-8 encoded and not saved with byte order mark (BOM).<p>The images should be uploaded in <strong>For thumb image: <?php echo base_url('my-assets/image/product/thumb')?></strong> And for details image: <strong><?php echo base_url('my-assets/image/product')?></strong> folder.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('import_product_csv') ?></h4>
                        </div>
                    </div>
                     <?php echo form_open_multipart('Cproduct/uploadCsv',array('class' => 'form-vertical', 'id' => 'validate','name' => 'insert_product'))?>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="form-group row">
                                    <label for="upload_csv_file" class="col-sm-3 col-form-label"><?php echo display('upload_csv_file') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-7">
                                        <input class="form-control" name="upload_csv_file" type="file" id="upload_csv_file" placeholder="<?php echo display('upload_csv_file') ?>" required>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="submit" id="add-product" class="btn btn-primary btn-large" name="add-product" value="<?php echo display('submit') ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php echo form_close()?>
                </div>
            </div>
        </div>




