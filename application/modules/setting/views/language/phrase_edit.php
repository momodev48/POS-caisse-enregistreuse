<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd ">
            <div class="panel-heading">
                <div class="btn-group"> 
                    <a class="btn btn-success" href="<?php echo base_url("setting/language/phrase") ?>"> <i class="fa fa-plus"></i> Add Phrase</a>
                    <a class="btn btn-primary" href="<?php echo base_url("setting/language") ?>"> <i class="fa fa-list"></i>  Language List </a> 
                </div> 
            </div>

            <div class="panel-body">
                <?php echo  form_open('setting/language/addlebel') ?>
                <table class="table table-striped" id="langtab">
                    <thead> 
                        <tr>
                            <td colspan="2"> 
                                <button type="reset" class="btn btn-danger">Reset</button>
                                <button type="submit" class="btn btn-success">Save</button>
                            </td>
                            <td><?php  ?></td>
                        </tr>
                        <tr>
                            <th class="phrase-edit-list"><i class="fa fa-th-list"></i></th>
                            <th class="phrase-edit-phrase">Phrase</th>
                            <th class="phrase-edit-label">Label</th> 
                        </tr>
                    </thead>
                    <?php echo  form_hidden('language', $language) ?>
                    <tbody>
                        
                            
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2"> 
                                <button type="reset" class="btn btn-danger">Reset</button>
                                <button type="submit" class="btn btn-success">Save</button>
                            </td>
                            <td><?php  ?></td>
                        </tr>
                    </tfoot>
                    <?php echo  form_close() ?>
                </table>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>