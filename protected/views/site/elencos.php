<!--elencoMultimedias-->
<h3>Nuestros Elencos</h3>
<?php // var_dump($elencos); ?>

<div class="col-lg-12">
    <div class="contenedor-imagenes">

        <div class="row-fluid isotope" id="isotope-container" >

            <?php foreach ($elencos as $value) : ?>

                <?php // var_dump($prueba=$value->elencoMultimedias); echo"_---------------------" ?>
                <?php $logo = ElencoMultimedia::model()->imagenes_de_elenco($value->id, 'LOGO') ?>
                <?php $Menu = ElencoMultimedia::model()->imagenes_de_elenco($value->id, 'IMAGEN', true) ?>
                <div class="col-sm-6 col-md-6 col-lg-6 isotope-item modernism" >
                    <div class="portfolio-item">
                        <div class="titulo-imagen"><?php echo $value->nombre ?></div>
                        <div class="logo ">
                            <img class="img-responsive" src="<?php echo $logo['ubicacion'] ?>" alt="...">

                        </div>
                        <div class="portfolio-thumbnail">
                            <img class="img-responsive" src="<?php echo $Menu['ubicacion'] ?>" alt="...">
                            <a class="link-image-responsive" href="<?php echo Yii::app()->createUrl('/site/elenco/id/' . $value->id) ?>" ></a>

                            <p>
                            </p>
                        </div>
                    </div> <!-- / .portfolio-item -->
                </div>

            <?php endforeach; ?>

        </div>
    </div>
</div>
