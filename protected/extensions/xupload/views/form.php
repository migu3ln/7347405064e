<!-- The file upload form used as target for the file upload widget -->
<?php if ($this->showForm) echo CHtml::beginForm($this->url, 'post', $this->htmlOptions); ?>
<?php if ($this->modal): ?>
    <div class="row">
        <div class="col-md-3 col-sm-2">
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
        <div class="col-md-6 ">
            <div class="files">
            </div>
        </div>
    </div>
<?php else: ?>
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
<?php endif; ?>

<?php if ($this->showForm) echo CHtml::endForm(); ?>
