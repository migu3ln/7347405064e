
<h3>GELERIA</h3>

<div class="wrapper">

    <ul id="sb-slider" class="sb-slider">
        <li>
            <a href="http://www.flickr.com/photos/strupler/2969141180" target="_blank"><img src="images/1.jpg" alt="image1"/></a>
            <div class="sb-description">
                <h3>Creative Lifesaver</h3>
            </div>
        </li>
        <li>
            <a href="http://www.flickr.com/photos/strupler/2968268187" target="_blank"><iframe src="http://www.youtube.com/embed/XGSy3_Czz8k">
                </iframe></a>
           
        </li>
        <li>
            <a href="http://www.flickr.com/photos/strupler/2968114825" target="_blank"><img src="images/3.jpg" alt="image1"/></a>
            <div class="sb-description">
                <h3>Brave Astronaut</h3>
            </div>
        </li>
        <li>
            <a href="http://www.flickr.com/photos/strupler/2968122059" target="_blank"><img src="images/4.jpg" alt="image1"/></a>
            <div class="sb-description">
                <h3>Affectionate Decision Maker</h3>
            </div>
        </li>
        <li>
            <a href="http://www.flickr.com/photos/strupler/2969119944" target="_blank"><img src="images/5.jpg" alt="image1"/></a>
            <div class="sb-description">
                <h3>Faithful Investor</h3>
            </div>
        </li>
        <li>
            <a href="http://www.flickr.com/photos/strupler/2968126177" target="_blank"><img src="images/6.jpg" alt="image1"/></a>
            <div class="sb-description">
                <h3>Groundbreaking Artist</h3>
            </div>
        </li>
        <li>
            <a href="http://www.flickr.com/photos/strupler/2968945158" target="_blank"><img src="images/7.jpg" alt="image1"/></a>
            <div class="sb-description">
                <h3>Selfless Philantropist</h3>
            </div>
        </li>
    </ul>

    <div id="shadow" class="shadow"></div>

    <div id="nav-arrows" class="nav-arrows">
        <a href="#">Next</a>
        <a href="#">Previous</a>
    </div>

</div><!-- /wrapper -->


<script type="text/javascript">
    $(function() {

        var Page = (function() {

            var $navArrows = $('#nav-arrows').hide(),
                    $shadow = $('#shadow').hide(),
                    slicebox = $('#sb-slider').slicebox({
                onReady: function() {

                    $navArrows.show();
                    $shadow.show();

                },
                orientation: 'r',
                cuboidsRandom: true,
                disperseFactor: 30
            }),
                    init = function() {

                        initEvents();

                    },
                    initEvents = function() {

                        // add navigation events
                        $navArrows.children(':first').on('click', function() {

                            slicebox.next();
                            return false;

                        });

                        $navArrows.children(':last').on('click', function() {

                            slicebox.previous();
                            return false;

                        });

                    };

            return {init: init};

        })();

        Page.init();

    });
</script>