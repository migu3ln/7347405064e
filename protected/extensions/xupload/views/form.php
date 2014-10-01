<!-- The file upload form used as target for the file upload widget -->
<?php if ($this->showForm) echo CHtml::beginForm($this->url, 'post', $this->htmlOptions); ?>
<div class="form-group">
    <!--<label class="col-sm-3 control-label required" for="Logo"> </label>-->
    <div class="col-sm-2 col-sm-offset-2">
        <!-- The fileinput-button span is used to style the file input field as button -->
        <span class="btn btn-mini  btn-default fileinput-button">
            <i class="icon-plus icon-white"></i>
            <span><?php echo $this->t('1#Add files|0#Choose file', $this->multiple); ?></span>
            <?php
            if ($this->hasModel()) :
                echo CHtml::activeFileField($this->model, $this->attribute, $htmlOptions) . "\n";
            else :
                echo CHtml::fileField($name, $this->value, $htmlOptions) . "\n";
            endif;
            ?>
        </span>
    </div>
    <div class="col-sm-8">

        <?php if ($this->multiple) : ?>
            <table class="table">
                <tbody class="files" data-toggle="modal-gallery" data-target="#modal-gallery"></tbody>
            </table>
        <?php else: ?>
            <div class="row">
                <div class="col-sm-6 col-md-4 files">
                </div>
            </div>
        <?php endif; ?>

    </div>

</div>
<!--<div class=" fileupload-buttonbar">
    <div class="span7">
         The fileinput-button span is used to style the file input field as button 
        <span class="btn btn-mini  btn-default fileinput-button">
            <i class="icon-plus icon-white"></i>
            <span><?php // echo $this->t('1#Add files|0#Choose file', $this->multiple);     ?></span>
<?php
if ($this->hasModel()) :
//                echo CHtml::activeFileField($this->model, $this->attribute, $htmlOptions) . "\n";
else :
//                echo CHtml::fileField($name, $this->value, $htmlOptions) . "\n";
endif;
?>
        </span>
<?php // if ($this->multiple) { ?>
                        <button type="submit" class=" btn-mini btn btn-primary start">
                                <i class="icon-upload icon-white"></i>
                                <span>Start upload</span>
                        </button>
                        <button type="reset" class="btn-mini btn btn-warning cancel">
                                <i class="icon-ban-circle icon-white"></i>
                                <span>Cancel upload</span>
                        </button>
                        <button type="button" class="  btn btn-danger delete">
                                <i class="icon-trash icon-white"></i>
                                <span>Delete</span>
                        </button>
                        <input type="checkbox" class="toggle">
<?php // } ?>
    </div>
    <div class="span5">
         The global progress bar 
        <div class="progress progress-success progress-striped active fade">
            <div class="bar" style="width:0%;"></div>
        </div>
    </div>
</div>-->
<!-- The loading indicator is shown during image processing -->
<div class="fileupload-loading">

</div>
<!-- The table listing the files available for upload/download -->
<!--<select class='hidden' name='archivos[]' multiple>-->


<!--</select>-->
<?php if ($this->showForm) echo CHtml::endForm(); ?>
