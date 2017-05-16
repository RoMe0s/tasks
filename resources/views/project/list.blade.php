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
