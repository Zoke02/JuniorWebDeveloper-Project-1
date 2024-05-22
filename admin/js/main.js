$(document).ready(function () {
    $('#menu-toogle').click(function () {
        $('.menu').toggle();
        $('.menu-categories').hide();
    });
});
$(document).ready(function () {
    $('#categories-toogle').click(function () {
        $('.menu-categories').toggle();
        $('.menu').hide();
    });
});
