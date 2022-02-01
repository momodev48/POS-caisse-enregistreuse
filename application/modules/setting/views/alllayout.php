<div class="row">
                    <?php 
					$path = 'assets/img/icons/resttable/';
    				$imagedata = directory_map($path);
					foreach($imagedata as $tableimage){
					?>
                                        <div class="col-lg-2 col-xl-2">
                                            <div class="file-man-box">
                                                <div class="file-img-box">
                                                    <img src="<?php echo base_url() .$path.$tableimage; ?>" data-scr="<?php echo $path.$tableimage;?>" alt="icon" height="60" width="60">
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                       
                                    </div>