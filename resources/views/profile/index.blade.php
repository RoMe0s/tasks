<?php
/**
 * Created by PhpStorm.
 * User: rome0s
 * Date: 08.05.17
 * Time: 22:58
 */
?>
@extends('layouts.master')

@section('content')
    <div class="container" style="margin-top: 85px;">
        <div class="animated fadeIn">

            <!--Form with header-->
            <div class="card">
                <div class="card-block" id="profile" style="padding: 2rem;">
                    <!--Body-->
                    {!! Form::model($model, ['method' => 'POST', 'route' => 'update.profile', 'ajax', 'enctype' => 'multipart/form-data']) !!}
                        <div class="md-form ">
                            <i class="fa fa-user prefix"></i>
                            {!! Form::text('name', null, array('id' => 'name', 'class' => 'form-control')) !!}
                            <label for="name">Имя пользователя</label>
                        </div>
                        <div class="md-form ">
                            <i class="fa fa-envelope prefix"></i>
                            {!! Form::input('email', 'email', null, array('id' => 'email', 'class' => 'form-control')) !!}
                            <label for="email">Email</label>
                        </div>
                        <div class="md-form ">
                            <i class="fa fa-lock prefix"></i>
                            {!! Form::input('password', 'password', '', array('id' => 'password', 'class' => 'form-control')) !!}
                            <label for="password">Пароль</label>
                        </div>
                        <div class="md-form ">
                            <i class="fa fa-lock prefix"></i>
                            {!! Form::input('password', 'password_confirmation', '', array('id' => 'password_confirmation', 'class' => 'form-control')) !!}
                            <label for="password_confirmation">Подтверждение пароля</label>
                        </div>
                        <div class="md-form file-field">
                            <div class="btn btn-primary btn-sm waves-effect waves-light">
                                <span>
                                    @lang('labels.choose file')
                                </span>
                                {!! Form::file('image[file]') !!}
                            </div>
                            <div class="file-path-wrapper">
                                {!! Form::text('image[name]', $model->image, array('placeholder' => 'Загрузите свое фото', 'class' => 'file-path validate')) !!}
                            </div>
                        </div>
                        <br>
                        <div class="md-form" style="float:right;">
                            {!! Form::submit('Сохранить', array('class' => 'btn btn-success waves-effect waves-light')) !!}
                        </div>

                    {!! Form::close() !!}
                </div>
            </div>
            <!--/Form with header-->

        </div>
    </div>
@endsection