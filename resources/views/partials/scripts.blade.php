<!-- JQuery -->

<script type="text/javascript" src="{!! asset('js/jquery-3.1.1.min.js') !!}"></script>

<!-- Bootstrap tooltips -->

<script type="text/javascript" src="{!! asset('js/tether.min.js') !!}"></script>

<!-- Bootstrap core JavaScript -->

<script type="text/javascript" src="{!! asset('js/bootstrap.min.js') !!}"></script>

<!-- MDB core JavaScript -->

<script type="text/javascript" src="{!! asset('js/mdb.min.js') !!}"></script>
<!-- SCRIPTS -->

<script type="text/javascript" src="{!! asset('js/messages.js') !!}"></script>

<script>

    $('.mdb-select').material_select();

    $('.datepicker').pickadate();

    $(document).ready(function() {

        messages.windowInit();

    });

</script>

{{--ajax forms--}}

<script>

    $(document).on("submit", 'form[ajax]', function(event) {

        var $form = $(this),
            formData = new FormData($form[0]),
            $submit_button = $form.find('[type="submit"]');

        if($submit_button.html() !== undefined && $submit_button.length) {

            $submit_button.attr('disabled', 'disabled');

            var timeout = setTimeout(function() {

                $submit_button.removeAttr('disabled');

                clearTimeout(timeout);

            },1000);

        }

        $.ajax({

            url: $form.attr("action"),
            type: $form.attr("method"),
            data: formData,
            contentType: false,
            processData: false


        }).done(function(response) {

            if(response.status === "success") {

                if(response.redirect !== undefined &&
                response.redirect !== null &&
                response.redirect.length) {

                    window.location.href = response.redirect;

                }

                if(response.refresh !== undefined &&
                    response.refresh !== null &&
                    response.refresh.length) {

                    window.location.reload();

                }

            }

            if(response.message !== undefined &&
            response.message !== null &&
            response.message.length) {

                window.messages.show(response.status, response.message);

            }

            if($form.attr('postAjax') !== undefined) {

                $(document).trigger($form.attr('postAjax'), [response]);

            }

        }).fail(function(response) {

            response = response !== undefined ? response.responseJSON : {};

            var passed_errors = [];

            for(var field in response) {

                var error = response[field].constructor === Array ? response[field].pop() : response[field];

                if(passed_errors.indexOf(error) === -1) {

                    messages.show('error', error);

                    passed_errors.push(error);

                }

                $form.find('[name="' + field + '"]').addClass('invalid');

            }

            if(!passed_errors.length) {

                messages.show('error', 'Произошла ошибка, попробуйте пожалуйста позже');

            }

            passed_errors = [];

        });

        return event.preventDefault();

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

    $(document).on("focus", "input.invalid", function() {

        $(this).removeClass('invalid');

    });

    function refreshUsers(modal, id, type) {

        id = parseInt(id);

        var $input = $('div.modal#' + modal + ' input[name=users]'),
            value = $input.val(),
            array = JSON.parse(value),
            index = array.indexOf(id);

        if(type === 'add') {

            if(index < 0) {

                array.push(id);

            }

        } else {

            if(index >= 0) {

                array.splice(index, 1);

            }

        }

        console.log(array);

        $input.val(JSON.stringify(array));

    }

    function refreshUserList(modal) {

        var $input = $("div.modal#" + modal + ' input.modal-find-users'),
            query = $input.val(),
            tbody_selector = "div.modal#" + modal + " tbody.users-list";

        if(query.length) {

            $(tbody_selector + ' tr[data-selected]').hide();

        } else {

            $(tbody_selector + ' tr:not([data-empty])').hide();

            $(tbody_selector + ' tr[data-selected]').show();

        }

        if($(tbody_selector + ' tr:not([data-empty]):visible').length > 0) {

            $(tbody_selector + ' tr[data-empty]').hide();

        } else {

            $(tbody_selector + ' tr[data-empty]').show();

        }

    }

    $(document).on("project-share", function(e, response) {

       if(response.html !== undefined &&
       response.html !== null &&
       response.html.length) {

           var $modal = $('div.modal#shareproject');

           $modal.find('div.modal-content').html(response.html);

           $modal.modal();

       }

    });

    function findUsers(modal) {

        var query = $('div.modal#' + modal +' input.modal-find-users').val().toLowerCase(),
            selector = 'div.modal#' + modal + ' tbody.users-list tr:not([data-empty]):not([data-selected])';

        if(query !== undefined) {

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

        if(selected === undefined) {

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

    $(document).on("click", "div.modal#newproject tbody.users-list tr:not([data-empty]) a", function(e) {

            AddRemoveUsers('newproject', this);

    });

    $(document).on("click", "div.modal#shareproject tbody.users-list tr:not([data-empty]) a", function(e) {

        AddRemoveUsers('shareproject', this);

    });

</script>
