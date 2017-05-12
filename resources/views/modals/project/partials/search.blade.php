<?php
/**
 * Created by PhpStorm.
 * User: rome0s
 * Date: 12.05.17
 * Time: 21:42
 */
?>
<div class="md-form input-group">
    {!! Form::text('email', null, ['class' => 'form-control modal-find-users', 'placeholder' => trans('labels.email'), 'autocomplete' => 'off', 'onkeyup' => !isset($isset_users) ? 'findUsers("newproject")' : 'findUsers("shareproject")']) !!}
</div>
@php($isset_users = isset($isset_users) ? $isset_users : [])
<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th>@lang('labels.name')</th>
            <th>@lang('labels.email')</th>
            <th>@lang('labels.role')</th>
            <th></th>
        </tr>
        </thead>
        <tbody class="users-list">
        {!! Form::hidden('users', json_encode($isset_users)) !!}
        @foreach($users as $user)
            <tr data-email="{!! $user->email !!}"
                data-name="{!! $user->name !!}"
                data-role="{!! $user->roles->implode('name', ', ') !!}"
                @if(in_array($user->id,$isset_users)) data-selected @endif
            >
                <td>
                    {!! $user->name !!}
                </td>
                <td>
                    {!! $user->email !!}
                </td>
                <td>
                    {!! $user->roles->implode('name', ', ') !!}
                </td>
                <td>
                    <a class="btn @if(in_array($user->id,$isset_users)) btn-danger @else btn-primary @endif btn-sm waves-effect waves-light" data-id="{!! $user->id !!}">
                        @if(in_array($user->id,$isset_users)) - @else + @endif
                    </a>
                </td>
            </tr>
        @endforeach
        <tr data-empty @if(sizeof($isset_users)) style="display: none" @endif>
            <td colspan="4">
                <h5 class="text-center">
                    @lang('labels.empty')
                </h5>
            </td>
        </tr>
        </tbody>
    </table>
</div>
