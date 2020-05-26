(function ($) {
    "use strict";

    $("#clear-polygon").click(function () {
        $("#region_map_new_form_pointX").val(null);
        $("#region_map_new_form_pointY").val(null);
        $("#region_map_new_form_polygon").val(null)
        $("#center-polygon").css('display', 'none');
        $("#active-polygon").attr("points", '');
    });

    $('#coordinate-svg-for-bird').click(function (e) {
        var pointX = e.pageX - $(this).offset().left,
            pointY = e.pageY - $(this).offset().top;

        $("#center-polygon").css('display', 'block');
        $("#center-polygon").css('top', (pointY - 38));
        $("#center-polygon").css('left', (pointX - 13));

        $("#region_bird_new_form_pointX").val(Math.round(pointX - 83));
        $("#region_bird_new_form_pointY").val(Math.round(pointY - 38));
    });

    $('#map-points').click(function (e) {
        var pointX = e.pageX - $(this).offset().left,
            pointY = e.pageY - $(this).offset().top;

        $("#center-polygon").css('display', 'block');
        $("#center-polygon").css('top', (pointY - 38));
        $("#center-polygon").css('left', (pointX - 13));

        $("#point_new_form_pointX").val(Math.round(pointX));
        $("#point_new_form_pointY").val(Math.round(pointY));
    });

    $('#coordinate-svg').click(function (e) {
        var pointX = e.pageX - $(this).offset().left,
            pointY = e.pageY - $(this).offset().top;

        if ($("#checkbox-for-free").prop('checked') === false) {
            if ($("#checkbox-for-map-point").prop('checked') === false) {
                var poligon = $("#active-polygon");
                var points = poligon.attr("points");
                var point = '';
                if (points === '') {
                    point = pointX + ',' + pointY;
                } else {
                    point = ' ' + pointX + ',' + pointY;
                }

                $("#region_map_new_form_polygon").val(points + point)
                poligon.attr("points", points + point);

            } else {
                $("#center-polygon").css('display', 'block');
                $("#center-polygon").css('top', (pointY - 38));
                $("#center-polygon").css('left', (pointX - 13));

                $("#region_map_new_form_pointX").val(Math.round(pointX - 38));
                $("#region_map_new_form_pointY").val(Math.round(pointY - 83));
            }
        }




    });

    $('.scheme-item').hover(
        function(){
            $('.scheme polygon[data-id=' + $(this).data('id') + ']').attr('id', 'hover');
        },
        function(){
            $('.scheme polygon[data-id=' + $(this).data('id') + ']').attr('id', '');
        }
    );

// Клик по названию магазина - открывается подсказка.
    $('.scheme-item').on('click', function(){
        $('.scheme-popup').hide();
        $('.scheme polygon').attr('class', '');

        var popup = $(this).find('.scheme-popup');
        $(popup).css('top', '-' + ($(popup).outerHeight(true) + 15) + 'px');
        $(popup).css('left', '-' + (($(popup).outerWidth(true) / 2) - ($(this).outerWidth(true) / 2)) + 'px');
        $('.scheme polygon[data-id=' + $(this).data('id') + ']').attr('class', 'active');
        $(popup).show();
    });

// Клик по полигону магазина - также открывается подсказка.
    $('.scheme polygon').click(function(){
        $('.scheme-popup').hide();
        $('.scheme-item[data-id=' + $(this).data('id') + ']').trigger('click');
    });

// Клик вне магазинов все закрывает.
    $("body").click(function(e) {
        if ($(e.target).closest(".scheme polygon, .scheme-item").length == 0) {
            $(".scheme-popup").hide();
            $('.scheme polygon').attr('class', '');
        }
    });

})(jQuery);