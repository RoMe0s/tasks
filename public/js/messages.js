/**
 * Created by rome0s on 08.05.17.
 */
var messages = {};
messages.show = function(type, message) {

    toastr[type](message);

};
messages.windowInit = function() {

    $('ul#toastr-list').find('li').each(function() {
       messages.show($(this).attr('data-type'), $(this).html());
    }).remove();

};