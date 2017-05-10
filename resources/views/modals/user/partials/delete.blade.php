<?php
/**
 * Created by PhpStorm.
 * User: rome0s
 * Date: 11.05.17
 * Time: 0:22
 */
?>
<!--Header-->
{!! Form::open(['method' => 'delete', 'route' => array('users.destroy', $model->id), 'ajax', 'postAjax' => 'user-deleted']) !!}
<div class="modal-header">
    <p class="heading lead">
        @lang('texts.are your sure that you want to delete user')
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
            @lang('texts.you can not restore the user after uninstallation')
        </p>
    </div>
</div>

<!--Footer-->
<div class="modal-footer flex-center">
    <button type="submit" class="btn btn-primary-modal">
        @lang('labels.apply')
        <i class="fa fa-check ml-1"></i>
    </button>
    <a type="button" class="btn btn-outline-secondary-modal waves-effect" data-dismiss="modal">
        @lang('labels.cancel')
    </a>
</div>
{!! Form::close() !!}

