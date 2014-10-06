<!--elencoMultimedias-->
<h3>Nuestros Teatros</h3>

<div class="col-lg-12">
    <div class="contenedor-imagenes">

        <div class="row-fluid isotope" id="isotope-container" >

            <?php foreach ($elencos as $value) : ?>

                <?php // var_dump($prueba=$value->elencoMultimedias); echo"_---------------------" ?>
                <?php $logo = ElencoMultimedia::model()->logo_de_elenco($value->id) ?>
                <div class="col-sm-6 col-md-6 col-lg-6 isotope-item modernism" >
                    <div class="portfolio-item">
                        <div class="titulo-imagen"><?php echo $value->nombre ?></div>
                        <div class="portfolio-thumbnail">
                            <img class="img-responsive" src="<?php echo $logo->ubicacion ?>" alt="...">
                            <div class="mask-imagen">
                                <!--<div class="">-->
                                <p>
                                </p>
                            </div>
                        </div>
                    </div> <!-- / .portfolio-item -->
                </div>

            <?php endforeach; ?>

        </div>
    </div>
</div>
