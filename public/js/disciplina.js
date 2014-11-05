$(function () {
    var element = $("#head-master");
    var imageUrl = element.data("background");     

    element.css('background-image', 'url(' + imageUrl + ')');
});