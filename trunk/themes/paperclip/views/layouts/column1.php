<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/admin'); ?>
<?php if ($this->menu): ?>
    <p>
    <div class="top-controlls">
        <?php foreach ($this->menu as $menu) : ?>
            <?php
            $this->widget(
                'booster.widgets.TbButton',
                $menu
            );
            echo ' ';
            ?>
        <?php endforeach; ?>
    </div>
    </p>
<?php endif; ?>
    <div id="content">
        <?php echo $content; ?>
    </div><!-- content -->
<?php $this->endContent(); ?>