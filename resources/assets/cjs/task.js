/**
 * Created by rome0s on 15.05.17.
 */
$(document).ready(function() {

    $(document).on("click", "a.removetask[data-id]", function(e) {

        var id = $(this).attr("data-id");

        $.ajax({
            url: "/task/load-delete",
            type: 'GET',
            data: {
                id: id
            }
        }).done(function(response) {

            if(response.html !== undefined &&
                response.html !== null &&
                response.html.length) {

                var $modal = $('div.modal#submitremove');

                $modal.find('div.modal-content').html(response.html);

                $modal.modal();

            }

        });

        return e.preventDefault();

    });

});

$("div.dropable-radio").on('click', "input[type=radio]", function(e) {

    var $block = $(this).closest('div.dropable-radio');

    $block.find('input[type=radio]').prop('checked', false);

    $(this).prop('checked', true);

});

$(document).on("task-deleted", function(e, response) {

    if(response.task_id !== undefined &&
        response.task_id !== null) {


        $('div.card-wrapper[data-task_id="' + response.task_id + '"]').fadeOut("slow");

        $('div.modal#submitremove').modal('hide');

    }

});

$(document).on('task-end', function(e, response) {

    var $modal = $('div.modal#taskresult');

    if(response.html !== undefined &&
        response.html !== null &&
        response.html.length) {

        $modal.find('div.modal-content').html(response.html);

        $modal.modal();

    }

});

$(document).on('click', 'a.or-use-file', function() {

    var $file = $('div.end-task-file'),
        $link = $('input.end-task-link');

    if($file.is(':visible')) {

        $file.hide();

        $file.find('input').val('');

        $link.show();

        $(this).html($(this).attr('data-message-file'));

    } else {

        $link.val('').hide();

        $file.show();

        $(this).html($(this).attr('data-message-link'));

    }

});

$(document).on("beforeTaskCreate", function(event, real_event) {

    $('div.modal#new_task').modal('hide');

});

$(document).on("afterTaskCreate", function(event, response) {

    console.log(response);

    if(response.status !== 'success') {

        $('div.modal#new_task').modal();

    }

});