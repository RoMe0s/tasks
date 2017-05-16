/**
 * Created by rome0s on 15.05.17.
 */
function refreshUsers(modal, id, type) {

    id = parseInt(id);

    var $input = $('div.modal#' + modal + ' input[name=users]'),
        value = $input.val(),
        array = JSON.parse(value),
        index = array.indexOf(id);

    if (type === 'add') {

        if (index < 0) {

            array.push(id);

        }

    } else {

        if (index >= 0) {

            array.splice(index, 1);

        }

    }

    $input.val(JSON.stringify(array));

}

function refreshUserList(modal) {

    var $input = $("div.modal#" + modal + ' input.modal-find-users'),
        query = $input.val(),
        tbody_selector = "div.modal#" + modal + " tbody.users-list";

    if (query.length) {

        $(tbody_selector + ' tr[data-selected]').hide();

    } else {

        $(tbody_selector + ' tr:not([data-empty])').hide();

        $(tbody_selector + ' tr[data-selected]').show();

    }

    if ($(tbody_selector + ' tr:not([data-empty]):visible').length > 0) {

        $(tbody_selector + ' tr[data-empty]').hide();

    } else {

        $(tbody_selector + ' tr[data-empty]').show();

    }

}

$(document).on("project-share", function (e, response) {

    if (response.html !== undefined &&
        response.html !== null &&
        response.html.length) {

        var $modal = $('div.modal#shareproject');

        $modal.find('div.modal-content').html(response.html);

        $modal.modal();

    }

});

function findUsers(modal) {

    var query = $('div.modal#' + modal + ' input.modal-find-users').val().toLowerCase(),
        selector = 'div.modal#' + modal + ' tbody.users-list tr:not([data-empty]):not([data-selected])';

    if (query !== undefined) {

        $(selector).hide();

        if (query.length) {

            $(selector).filter(function (index, element) {

                var email = $(element).attr('data-email').toLowerCase(),
                    name = $(element).attr('data-name').toLowerCase(),
                    roles = $(element).attr('data-role').toLowerCase();

                return email.indexOf(query) >= 0 || name.indexOf(query) >= 0 || roles.indexOf(query) >= 0;

            }).show();

        }

        refreshUserList(modal);

    }

}

function AddRemoveUsers(modal, element) {

    var $row = $(element).closest('tr'),
        selected = $row.attr('data-selected'),
        id = $(element).attr('data-id');

    if (selected === undefined) {

        $row.attr('data-selected', 'selected');

        $(element).removeClass('btn-primary').addClass('btn-danger').html('-');

        refreshUsers(modal, id, 'add');

    } else {

        $row.removeAttr('data-selected');

        $(element).removeClass('btn-danger').addClass('btn-primary').html('+');

        refreshUsers(modal, id, 'remove');

    }

    refreshUserList(modal);

}

$(document).on("click", "div.modal#newproject tbody.users-list tr:not([data-empty]) a", function (e) {

    AddRemoveUsers('newproject', this);

});

$(document).on("click", "div.modal#shareproject tbody.users-list tr:not([data-empty]) a", function (e) {

    AddRemoveUsers('shareproject', this);

});

$(document).on("project-loaded-create", function(e, response) {

    if(response.html !== undefined &&
        response.html !== null &&
        response.html.length) {

        var $modal = $('div.modal#newproject');

        $modal.find('div.modal-content').html(response.html);

        $modal.modal();

    }

});