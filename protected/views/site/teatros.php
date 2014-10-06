<!--escenarioMultimedias-->
<h3>Nuestros Teatros</h3>

<div class="col-lg-12">
    <div class="row-fluid isotope" id="isotope-container" >

        <?php foreach ($teatros as $value) : ?>

     <?php //   var_dump($value->escenarioMultimedias); ?>


        <?php endforeach;?>
        <div class="col-sm-6 col-md-6 col-lg-6 isotope-item modernism" >
            <div class="portfolio-item">
                <!--<div>Nuestros elencos</div>-->
                <div class="portfolio-thumbnail">

                    <img class="img-responsive" src="<?php echo Yii::app()->baseUrl."/images/somosteatros.jpg" ?>" alt="...">
                    <div class="mask-imagen">
                        <!--<div class="">-->
                        <p>
                        </p>
                    </div>
                </div>
            </div> <!-- / .portfolio-item -->
        </div>

    </div>
</div>
