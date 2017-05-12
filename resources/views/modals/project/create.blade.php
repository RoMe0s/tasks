<div class="modal fade modal-ext" id="newproject" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <!--Content-->
        <div class="modal-content">
        {!! Form::model($model, ['method' => 'POST', 'route' => array('project.store', $model), 'ajax']) !!}
        <!--Header-->
            <div class="modal-header">
                <h3 class="w-100">
                    <i class="fa fa-plus"></i>
                    @lang('labels.new project')
                </h3>
            </div>
            <!--Body-->
            <div class="modal-body">
                <div class="md-form input-group">
                    {!! Form::text('name', null, ['id' => 'name', 'length' => '60']) !!}
                    <label for="name">
                        @lang('labels.name')
                    </label>
                </div>
                <div class="md-form input-group">
                    {!! Form::textarea('description', null, ['class' => 'md-textarea', 'id' => 'description', 'length' => 195]) !!}
                    <label for="description">
                        @lang('labels.description')
                    </label>
                </div>
                <div class="md-form input-group file-field">
                    <div class="btn btn-primary btn-sm">
                        <span>
                            @lang('labels.choose file')
                        </span>
                        {!! Form::file('image', null) !!}
                    </div>
                    <div class="file-path-wrapper">
                        {!! Form::text('file-path', null, ['placeholder' => trans('labels.logo'), 'class' => 'file-path validate']) !!}
                    </div>
                </div>
                <hr>
                <h5 class="w-100">
                    @lang('labels.members')
                </h5>
                @include('modals.project.partials.search')
            </div>
            <!--Footer-->
            <div class="modal-footer">
                {!! Form::submit(trans('labels.save'), ['class' => 'btn btn-success btn-sm']) !!}
                <button type="button" class="btn btn-unique btn-sm" data-dismiss="modal">
                    @lang('labels.close')
                </button>
            </div>
            {!! Form::close() !!}

        </div>
    </div>
</div>
