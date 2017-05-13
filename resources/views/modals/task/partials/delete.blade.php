<?php
/**
 * Created by PhpStorm.
 * User: rome0s
 * Date: 13.05.17
 * Time: 13:29
 */
?>
{!! Form::model($model, ['method' => 'delete', 'route' => array('task.destroy', $model), 'ajax', 'postAjax' => 'task-deleted']) !!}
<!--Header-->
<div class="modal-header">
    <p class="heading lead">
        @lang('messages.are you sure that your want to delete this task')
    </p>

    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true" class="white-text">&times;</span>
    </button>
</div>

<!--Body-->
<div class="modal-body">
    <div class="text-center">
        <i class="fa fa-remove fa-4x mb-1 animated rotateIn"></i>
        <p>
            @lang('texts.price will be changed')
        </p>
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
