<?php
/**
 * Created by PhpStorm.
 * User: rome0s
 * Date: 12.05.17
 * Time: 21:22
 */
?>
<div class="modal-header">
    <h3 class="w-100">
        <i class="fa fa-user"></i>
        @lang('labels.members')
    </h3>
</div>
{!! Form::open(['method' => 'POST', 'route' => array('project.share.store', $model->id), 'ajax']) !!}
<div class="modal-body">
    @include('modals.project.partials.search')
</div>
<div class="modal-footer">
    {!! Form::submit(trans('labels.save'), ['class' => 'btn btn-success btn-sm']) !!}
    <button type="button" class="btn btn-unique btn-sm" data-dismiss="modal">
        @lang('labels.close')
    </button>
</div>
{!! Form::close() !!}
