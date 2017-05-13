<?php
/**
 * Created by PhpStorm.
 * User: rome0s
 * Date: 12.05.17
 * Time: 23:32
 */
?>
@extends('layouts.master')

@section('content')
    <div class="container-fluid" style="padding-top: 85px;">
        <div class="row">
            @if(!sizeof($tasks))
                <h4 class="text-center col-md-12" style="margin-top: 15px;">
                    @lang('labels.empty')
                </h4>
            @endif
        @include('project.partials.todo')
        @include('project.partials.in_progress')
        @include('project.partials.done')
        </div>
    </div>
@endsection

@section('buttons')
    <div class="fixed-btn" style="bottom: 45px; right: 45px;">
        <button class="btn-floating btn-large secondary" type="button" data-toggle="modal" data-target="#new_task">
            <i class="fa fa-plus"></i>
        </button>
    </div>
@endsection

@section('popups')

    @include('modals.task.create')

    @include('modals.task.delete')

    @include('modals.task.result')

@endsection

@section('scripts')
    @parent
    <script>
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


                $('div.card-wrapper[data-task_id="' + response.task_id + '"]').fadeOut("slow", function() {

                    var header_id = $(this).attr('data-header_id'),
                        length = $('div.card-wrapper[data-header_id="' + header_id + '"]').lenght;

                    if(!length) {

                        $('#' + header_id).fadeOut("fast");

                    }

                });

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

        </script>
@endsection