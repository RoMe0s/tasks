<?php
/**
 * Created by PhpStorm.
 * User: rome0s
 * Date: 12.05.17
 * Time: 23:42
 */
?>
<div class="modal fade" id="new_task" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        {!! Form::open(['method' => 'POST', 'route' => 'task.store', 'ajax']) !!}
        {!! Form::hidden('project_id', $project_id) !!}
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title w-100" id="myModalLabel">
                    @lang('labels.new task')
                </h4>
            </div>
            <!--Body-->
            <div class="modal-body">
                <div class="md-form input-group">
                    {!! Form::text('name', null, ['id' => 'name','length' => 60]) !!}
                    <label for="name">
                        @lang('labels.name')
                    </label>
                </div>
                <div class="md-form input-group">
                    {!! Form::textarea('description', null, ['id' => 'description', 'class' => 'md-textarea', 'length' => 195]) !!}
                    <label for="description">
                        @lang('texts.put description')
                    </label>
                </div>
                <div class="row">
                    <div class="md-form input-group col-md-8 dropable-radio" style="padding-bottom: 2rem;">
                            <fieldset class="form-group">
                                {!! Form::input('radio', 'type[urgent]', null, ['id' => 'urgent']) !!}
                                <label for="urgent">
                                    @lang('labels.urgent')
                                </label>
                            </fieldset>
                            <fieldset class="form-group">
                                {!! Form::input('radio', 'type[current]', null, ['id' => 'current', 'checked']) !!}
                                <label for="current">
                                    @lang('labels.current')
                                </label>
                            </fieldset>
                            <fieldset class="form-group">
                                {!! Form::input('radio', 'type[not_urgent]', null, ['id' => 'not_urgent']) !!}
                                <label for="not_urgent">
                                    @lang('labels.not_urgent')
                                </label>
                            </fieldset>
                    </div>
                    <div class="md-form input-group col-md-4">
                        {!! Form::text('post', null, ['id' => 'post']) !!}
                        <label for="post">
                            @lang('labels.post')
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="md-form input-group col-md-8">
                        <span class="input-group-addon">
                            @lang('labels.price')
                        </span>
                        {!! Form::text('price', null, ['id' => 'price', 'class' => 'form-control', 'aria-label' => trans('labels.price')]) !!}
                        <span class="input-group-addon" style="margin-right: 2rem;">₽</span>
                    </div>
                    <div class="col-md-4">
                        <select class="mdb-select" name="role_id">
                            <option disabled selected>@lang('labels.group'):</option>
                            @foreach($roles as $key => $role)
                                <option value="{!! $key !!}">{!! $role !!}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="md-form file-field">
                            <div class="btn btn-primary btn-sm">
                                <span>
                                    @lang('labels.choose file')
                                </span>
                                {!! Form::input('file', 'file', null) !!}
                            </div>
                            <div class="file-path-wrapper">
                                <input name="file-name" class="file-path validate" type="text" placeholder="@lang('texts.put file')">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="md-form input-group">
                            <fieldset class="form-group">
                                {!! Form::input('checkbox', 'newsletter', null, ['id' => 'newsletter']) !!}
                                <label for="newsletter">
                                    @lang('texts.send messages')
                                </label>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
            <!--Footer-->
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">
                    @lang('labels.close')
                </button>
                <button type="submit" class="btn btn-sm btn-primary">
                    @lang('labels.add')
                </button>
            </div>
        </div>
        {!! Form::close() !!}
        <!--/.Content-->
    </div>
</div>
