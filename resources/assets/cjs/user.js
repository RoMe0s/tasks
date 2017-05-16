/**
 * Created by rome0s on 15.05.17.
 */
$(document).ready(function() {

    $(document).on("click", "[data-user_settings] a", function(e) {

        var type = $(this).attr("data-type"),
            $td = $(this).closest("[data-user_settings]"),
            id = $td.attr("data-id"),
            modal_id = $(this).attr('data-modal_id');

        $.ajax({
            url: "/users/load-popup",
            type: 'GET',
            data: {
                id: id,
                type: type
            }
        }).done(function(response) {

            if(response.html !== undefined &&
                response.html !== null &&
                response.html.length) {

                var $modal = $('div.modal#' + modal_id);

                $modal.find('div.modal-content').html(response.html);

                $modal.modal();

            }

        });

        return e.preventDefault();

    });

});

$(document).on('user-updated', function(e, response) {

    if(response.html !== undefined &&
        response.html !== null &&
        response.html.length &&
        response.id !== undefined) {

        var $row = $('div.tab-pane').find('table').find('td[data-user_settings][data-id="' + response.id + '"]').closest('tr');

        if($row.length) {

            $row.replaceWith($(response.html));

            $(document).find('div.modal#userdetails').modal('hide');

        }

    }

});

$(document).on('user-password-changed', function(e, response) {

    if(response.id !== undefined &&
        response.id !== null) {

        $('div.tab-pane').find('table').find('td[data-user_settings][data-id="' + response.id + '"]').closest('tr').removeClass('bg-warning');

        $(document).find('div.modal#changepassword').modal('hide');

    }

});

$(document).on('user-deleted', function(e, response) {

    if(response.html !== undefined &&
        response.html !== null &&
        response.html.length &&
        response.user_id !== undefined) {

        var $row = $('div.tab-pane').find('table').find('td[data-user_settings][data-id="' + response.user_id + '"]').closest('tr'),
            $tbody = $row.closest('tbody');

        $row.remove();

        if(!$tbody.find('tr').length) {

            $tbody.html(response.html);

        }

        $(document).find('div.modal#submitremove').modal('hide');

    }

});

$(document).on("reset-password-event", function() {

    $('form[postAjax="reset-password-event"]').find('input[name="email"]').val('');

});

$(document).on("user-added", function(event, response) {

    if(response.html !== undefined &&
        response.html !== null &&
        response.html.length) {

        var $tbody = $('div.tab-pane#role_' + response.id).find('tbody');
        $tbody.find('tr.empty-list').remove();
        $tbody.append(response.html);

        $('div.modal#newuser').modal('hide');

    }

});