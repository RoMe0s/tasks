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

</script>