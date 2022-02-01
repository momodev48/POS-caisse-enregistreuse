<?php if ($this->session->flashdata('message')) { ?>
<script>
 setTimeout(function () {
        toastr.options = {
            closeButton: true,
            progressBar: true,
            showMethod: 'slideDown',
            timeOut: 4000
                   
        };
        toastr.success('<?php echo $this->session->flashdata('message') ?>', 'Success');

    }, 1300);
</script>

<?php } ?>
<?php if ($this->session->flashdata('exception')) { ?>
<script>
 setTimeout(function () {
        toastr.options = {
            closeButton: true,
            progressBar: true,
            showMethod: 'slideDown',
            timeOut: 4000
                  
        };
        toastr.error('<?php echo $this->session->flashdata('exception') ?>', 'Something Wrong');

    }, 1300);
</script>

<?php } ?>
<?php if (validation_errors()) { ?>

<div class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <?php echo validation_errors() ?>
</div>
<?php } ?>