@extends('layouts.master')

@section('content')
    <div class="container" style="margin-top: 185px;">
        <!--Form without header-->
        <div class=" flex-center flex-column animated fadeIn">
            <div class="card-block">
            {!! Form::open(['method' => 'POST', 'route' => 'login', 'ajax']) !!}
            {!! csrf_field() !!}
            {!! Form::hidden('remember', true) !!}
            <!--Body-->
                <div class="md-form">
                    <i class="fa fa-envelope prefix"></i>
                    {!! Form::input('email', 'email', null, array('id' => 'email', 'class' => 'form-control', 'required' => true)) !!}
                    <label for="email">Ваш email</label>
                </div>

                <div class="md-form">
                    <i class="fa fa-lock prefix"></i>
                    {!! Form::input('password', 'password', null, array('id' => 'pass', 'class' => 'form-control', 'required' => true)) !!}
                    <label for="pass">Ваш пароль</label>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-unique">
                        Войти
                    </button>
                </div>
                <div class="text-center">
                    <button type="button" class="btn-flat btn-sm waves-effect" data-toggle="modal"
                            data-target="#adminfeedback">
                        Забыли пароль?
                    </button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <!--/Form without header-->

    @include('modals.auth.forgot-password')
@endsection
