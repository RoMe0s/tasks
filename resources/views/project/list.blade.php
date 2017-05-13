<?php
/**
 * Created by PhpStorm.
 * User: rome0s
 * Date: 07.05.17
 * Time: 22:38
 */
?>
@extends('layouts.master')

@section('content')
    <div class="container" style="margin-top: 85px;">
        <div class="animated fadeIn">
            <div class="row">
                @if(!sizeof($projects))
                    <h4 class="text-center col-md-12" style="margin-top: 15px;">
                        @lang('labels.empty')
                    </h4>
                @endif
                @foreach($projects as $project)
                    <div class="col-md-4" style="margin-top: 10px">
                        <div class="card">
                            <div class="view overlay hm-white-slight" style="max-height: 233px;">
                                <img src="{!! $project->getImage() !!}" class="img-fluid" alt="{!! $project->name !!}">
                                @if(check_roles($user, ['Administrators', 'Product Owner']))
                                    <p class="totalprojectbudget">
                                        {!! $project->getPrice() !!}
                                        ₽
                                    </p>
                            @endif
                                <a href="{!! route('project.show', $project) !!}" title="{{$project->name}}">
                                    <div class="mask waves-effect waves-light"></div>
                                </a>
                            </div>
                            <div class="card-block">
                                @can('project.users')
                                    {!! Form::model($project, ['method' => 'POST', 'route' => array('project.share', $project->id), 'ajax', 'postAjax' => 'project-share']) !!}
                                    <button type="submit" class="btn btn-link activator shareproject">
                                        <i class="fa fa-share-alt"></i>
                                    </button>
                                    {!! Form::close() !!}
                                @endcan
                                <h4 class="card-title">
                                    {{ $project->name }}
                                </h4>
                                <hr>
                                <p class="card-text">
                                    {{ $project->description }}
                                </p>
                                <p class="participants">
                                    {!! $project->users->implode('name', ', ') !!}
                                </p>
                                <a href="{!! route('project.show', $project) !!}" title="{{$project->name}}"
                                   class="black-text d-flex flex-row-reverse">
                                    <h5 class="waves-effect p-2">
                                        @lang('front_labels.to project')
                                        <i class="fa fa-chevron-right"></i>
                                    </h5>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('buttons')
    @can('project.write')
        <div class="fixed-btn" style="bottom: 45px; right: 24px;">
            {!! Form::open(['method' => 'GET', 'route' => 'project.load.create', 'ajax', 'postAjax' => 'project-loaded-create']) !!}
            <button type="submit" class="btn-floating btn-large secondary" data-target="newproject">
                <i class="fa fa-plus" aria-hidden="true"></i>
            </button>
            {!! Form::close() !!}
        </div>
    @endcan
@endsection

@section('popups')

    @can('project.write')

        @include('modals.project.create')

    @endcan

    @can('project.users')

        @include('modals.project.share')

    @endcan

@endsection

@section('styles')
    @parent
    <style>
        tbody.users-list tr:not([data-selected]):not([data-empty]) {

            display: none;

        }
    </style>
@endsection

@section('scripts')
    @parent
    <script>
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

            console.log(array);

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

    </script>
@endsection
