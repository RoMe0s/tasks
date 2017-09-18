<!-- JQuery -->

<script type="text/javascript" src="{!! asset('js/jquery-3.1.1.min.js') !!}"></script>

<!-- Bootstrap tooltips -->

<script type="text/javascript" src="{!! asset('js/tether.min.js') !!}"></script>

<!-- Bootstrap core JavaScript -->

<script type="text/javascript" src="{!! asset('js/popper.min.js') !!}"></script>

<script type="text/javascript" src="{!! asset('js/bootstrap.min.js') !!}"></script>

<!-- MDB core JavaScript -->

<script type="text/javascript" src="{!! asset('js/mdb.min.js') !!}"></script>
<!-- SCRIPTS -->

<script type="text/javascript" src="{!! asset('js/messages.js') !!}"></script>

<script type="text/javascript" src="{!! asset('js/custom_app.js') !!}"></script>

<script>

    $('.mdb-select').material_select();

    $('.datepicker').pickadate();

    $(document).ready(function() {

        messages.windowInit();

    });

</script>
