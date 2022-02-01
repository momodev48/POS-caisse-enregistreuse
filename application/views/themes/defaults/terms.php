<section class="contact_area sect_pad">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                <?php $termscon=$this->db->select('*')->from('tbl_widget')->where('widgetid',13)->get()->row();?>
                 <h3 class="mb-3"><?php echo $termscon->widget_title?></h3>
                 <?php echo $termscon->widget_desc;?>
                </div>
            </div>
        </div>
    </section>