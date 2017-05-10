<?php
/**
 * Created by PhpStorm.
 * User: rome0s
 * Date: 10.05.17
 * Time: 23:56
 */
?>
<!--Header-->
<div class="modal-header light-blue darken-3 white-text">
    <button type="button" class="close waves-effect waves-light" data-dismiss="modal"
            aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <h4 class="title">
        <i class="fa fa-pencil"></i>
        @lang('labels.change password')
    </h4>
</div>
{!! Form::open(['method' => 'POST', 'ajax', 'postAjax' => 'user-password-changed', 'route' => array('users.updatePassword', $model->id)]) !!}
<!--Body-->
<div class="modal-body mb-0">
    <div class="md-form form-sm">
        <i class="fa fa-lock prefix"></i>
        {!! Form::input('password', 'password', null, array('class' => 'form-control', 'placeholder' => trans('labels.password'))) !!}
    </div>

    <div class="md-form form-sm">
        <i class="fa fa-lock prefix"></i>
        {!! Form::input('password', 'password_confirmation', null, array('class' => 'form-control', 'placeholder' => trans('labels.password confirmation'))) !!}
    </div>
    <div class="text-center mt-1-half">
        <button class="btn btn-info mb-2">
            @lang('labels.save')
            <i class="fa fa-save ml-1"></i>
        </button>
    </div>
</div>
{!! Form::close() !!}
