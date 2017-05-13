<?php
/**
 * Created by PhpStorm.
 * User: rome0s
 * Date: 13.05.17
 * Time: 18:12
 */
?>
<div class="modal-header">
    <p class="heading lead">
        @lang('messages.load result')
    </p>

    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true" class="white-text">&times;</span>
    </button>
</div>
{!! Form::model($task, ['method' => 'POST', 'route' => ['task.close', $task], 'ajax']) !!}
<!--Body-->
<div class="modal-body">
    <div class="text-center">
        <i class="fa fa-upload fa-4x mb-1 animated rotateIn"></i>
        {!! Form::text('link', null, ['class' => 'form-control end-task-link', 'placeholder' => 'link']) !!}
        <div class="md-form file-field end-task-file" style="display: none">
            <div class="btn btn-success btn-sm">
                                <span>
                                    @lang('labels.choose file')
                                </span>
                {!! Form::input('file', 'file', null) !!}
            </div>
            <div class="file-path-wrapper">
                <input name="file-name" class="file-path validate" type="text" placeholder="@lang('texts.put file')">
            </div>
        </div>
        <div class="clearfix"></div>
        <a class="or-use-file text-info" data-message-file="@lang('texts.or use file')"
           data-message-link="@lang('texts.or use link')">
            @lang('texts.or use file')
        </a>
    </div>
</div>

<!--Footer-->
<div class="modal-footer flex-center">
    <button type="submit" class="btn btn-primary-modal">
        @lang('labels.accept')
        <i class="fa fa-check ml-1"></i>
    </button>
    <a type="button" class="btn btn-outline-secondary-modal waves-effect" data-dismiss="modal">
        @lang('labels.cancel')
    </a>
</div>
{!! Form::close() !!}
