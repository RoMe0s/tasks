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