@isset($tasks['todo'])
    <div class="col-md-4" id="todo">
        <div class="header text-center">
            <h4>TODO</h4>
        </div>
        @foreach($tasks['todo'] as $key => $task)
            <div class="card-wrapper" data-task_id="{!! $task->id !!}" data-header_id="todo">
                <div id="sample_project_card_{!! $key !!}_todo" class="card-rotating effect__click">
                    <!--Front Side-->
                    <div class="face front">
                        <!-- Image-->
                        <div class="card-up urgent">
                            <p class="price">{!! $task->getPrice() !!} ₽</p>
                        </div>
                        <!--Avatar-->
                        <div class="avatar">
                            <img src="{!! asset('images/logo/pending.png') !!}"
                                 class="rounded-circle img-responsive">
                        </div>
                        <!--Content-->
                        <div class="card-block">
                            <h4 id="taskname">
                                {{$task->name}}
                            </h4>
                            <p id="taskclass">
                                {{$task->post}}
                            </p>
                            <!--Triggering button-->
                            <a class="rotate-btn" data-card="sample_project_card_{!! $key !!}_todo">
                                <i class="fa fa-arrow-right"></i>
                                @lang('labels.learn more')
                            </a>
                            @include('task.partials.remove')
                        </div>
                    </div>
                    <!--/.Front Side-->
                    <!--Back Side-->
                    <div class="face back">
                        {{$task->description}}
                        <hr>
                        <p>
                            {!! Form::model($task, ['method' => 'POST', 'route' => ['task.take', $task], 'ajax', 'id' => 'take_task_' . $task->id]) !!}
                            <a download="download" href="{!! $task->file !!}">
                                {{$task->getFileName()}}
                            </a>
                            |
                            <button type="submit" class="like-link">
                                @lang('labels.take task')
                            </button>
                            {!! Form::close() !!}
                        </p>
                        <!--Triggering button-->
                        <a class="rotate-btn" data-card="sample_project_card_{!! $key !!}_todo">
                            <i class="fa fa-arrow-left"></i>
                            @lang('labels.back')
                        </a>
                    </div>
                    <!--/.Back Side-->
                </div>
            </div>
    @endforeach
    <!--/.Rotating card-->
    </div>
@endisset