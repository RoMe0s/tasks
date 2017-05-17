<?php
/**
 * Created by PhpStorm.
 * User: rome0s
 * Date: 09.05.17
 * Time: 23:40
 */
?>
<div class="modal fade modal-ext" id="newuser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-full-height modal-left" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <h3 class="w-100">
                    <i class="fa fa-user"></i>
                    @lang('labels.new user')
                </h3>
            </div>
            <!--Body-->
            <div class="modal-body">
                {!! Form::open(['method' => 'POST', 'route' => 'users.store', 'class' => 'form-inline', 'ajax', 'postAjax' => 'user-added']) !!}
                <div class="md-form form-group w-100">
                    {!! Form::text('name', null, array('placeholder' => trans('labels.username'), 'class' => 'form-control w-100')) !!}
                </div>
                <div class="md-form form-group w-100">
                    {!! Form::text('email', null, array('placeholder' => trans('labels.email'), 'class' => 'form-control w-100')) !!}
                </div>
                <div class="md-form form-group w-100">
                    {!! Form::select('role', $roles->pluck('name', 'id')->toArray(), null, array('class' => 'mdb-select w-100', 'placeholder' => trans('messages.choose group'))) !!}
                </div>
                <div class="md-form form-group w-100">
                            <span class="input-group-btn w-100">
                                {!! Form::submit(trans('labels.add'), array('class' => 'btn btn-primary btn-block waves-effect waves-light')) !!}
                            </span>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
