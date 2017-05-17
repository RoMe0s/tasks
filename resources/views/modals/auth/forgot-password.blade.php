<!--Modal: Восстановление праоля-->
<div class="modal fade" id="adminfeedback" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-notify modal-warning cascading-modal" role="document">
        <!--Content-->
        <div class="modal-content">

            <!--Header-->
            <div class="modal-header darken-3 white-text">
                <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="title">
                    <i class="fa fa-reload"></i>
                    @lang('labels.password reset')
                </h4>
            </div>
            <!--Body-->
            <div class="modal-body mb-0">
                {!! Form::open(['method' => 'POST', 'route' => 'reset', 'ajax', 'postAjax' => 'reset-password-event']) !!}
                <div class="md-form form-sm">
                    <i class="fa fa-envelope prefix"></i>
                    {!! Form::input('email', 'email', null, array('class' => 'form-control', 'id' => 'email')) !!}
                    <label for="email">@lang('labels.your email')</label>
                </div>
                <div class="text-center mt-1-half">
                    <button class="btn btn-info btn-warning mb-1">
                        @lang('labels.change password')
                        <i class="fa fa-check ml-1"></i>
                    </button>
                </div>
                <div>
                    <small class="tex-muted">
                        Пароль меняется админстратором вручную, запаситесь терпением! Хотите ускорить, напишите на
                            <a href="mailto:de@amsolutions.ru">почту</a>
                                или в
                            <a href="skype:pr_owner?chat">
                                Skype
                            </a>
                    </small>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
<!--Modal: Восттановление пароля-->
