/*------------------------------------------------------------------
 Project:    Paperclip
 Author:     Yevgeny S.
 URL:        http://simpleqode.com/
 https://twitter.com/YevSim
 Version:    1.1
 Created:        11/03/2014
 Last change:    14/08/2014
 -------------------------------------------------------------------*/

// Isotop Gallery 
// ==============
$(function () {
    var $container = $('#isotope-container');
    var options =
            {
                srcNode: '.isotope-item', // grid items (class, node)
                margin: '20px', // margin in pixel, default: 0px
                width: '250px', // grid item width in pixel, default: 220px
                max_width: '', // dynamic gird item width if specified, (pixel)
                resizable: true, // re-layout if window resize
                transition: 'all 0.5s ease' // support transition for CSS3, default: all 0.5s ease
            };
    $container.gridify(options);
//    $container.isotope({
//        itemSelector: '.isotope-item',
//    });
//    $('#filters a').click(function () {
//        var selector = $(this).attr('data-filter');
//        $container.isotope({filter: selector});
//        return false;
//    });
});

