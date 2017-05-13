@extends('layouts.master')

@section('content')
    <div class="container" style="margin-top: 85px;">
        <div class="animated fadeIn">

            <!--Section: Team v.1-->
            <section class="section team-section">

                <!--Section heading-->
                <h1 class="section-heading">@lang('labels.user groups')</h1>
                <!--Section description-->

            @if(sizeof($roles))
                <!-- Nav tabs -->
                    <ul class="nav nav-tabs tabs-5 unique-color" role="tablist">
                        @foreach($roles as $key => $role)
                            <li class="nav-item">
                                <a class="nav-link @if($key === 0) active @endif" data-toggle="tab"
                                   href="#role_{!! $role->id !!}" role="tab">
                                    <img src="{!! $role->image !!}" alt="{!! $role->name !!}" class="rounded-circle"
                                         style="margin-bottom: 10px;">
                                    {!! $role->name !!}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
                @if(sizeof($users) && sizeof($roles))
                    <div class="tab-content">
                        @foreach($roles as $key => $role)
                            <div class="tab-pane fade in show @if($key === 0) active @endif"
                                 id="role_{!! $role->id !!}" role="tabpanel">
                                <br>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>@lang('labels.name')</th>
                                        <th>@lang('labels.email')</th>
                                        <th>@lang('labels.acrions')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($users[$role->name]) && sizeof($users[$role->name]))
                                        @foreach($users[$role->name] as $_user)
                                            @include('user.partials.user', ['real_user' => $_user])
                                        @endforeach
                                    @else
                                        @include('user.partials.empty')
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        @endforeach
                    </div>
                @endif

            </section>
        </div>
    </div>
@endsection

@section('popups')
    @include('modals.user.create')

    @include('modals.user.edit')

    @include('modals.user.password')

    @include('modals.user.delete')
@endsection

@section('buttons')
    <div class="fixed-btn" style="bottom: 45px; right: 24px;">
        <button type="button" class="btn-floating btn-large secondary" style="float:right;" data-toggle="modal" data-target="#newuser">
            <i class="fa fa-plus" aria-hidden="true"></i>
        </button>
    </div>
@endsection

@section('scripts')
    @parent
    <script>
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
    </script>
@endsection
