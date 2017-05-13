@isset($tasks['in_progress'])
    <div class="col-md-4" id="in_progress">
        <div class="header text-center">
            <h4>In Progress</h4>
        </div>
        @foreach($tasks['in_progress'] as $key => $task)
            <div class="card-wrapper" data-task_id="{!! $task->id !!}" data-header_id="in_progress">
                <div id="sample_project_card_{!! $key !!}_in_progress" class="card-rotating effect__click">
                    <!--Front Side-->
                    <div class="face front">
                        <!-- Image-->
                        <div class="card-up noturgent">
                            <p class="timer">{!! $task->start_date !!}</p>
                            @if($user->id === $task->user_id || check_roles($user,['Accountant', 'Product Owner', 'Administrators']))
                                <p class="price">{!! $task->getPrice() !!} ₽</p>
                            @endif
                        </div>
                        <!--Avatar-->
                        <div class="avatar">
                            <img src="{!! $task->user->getImage() !!}"
                                 class="rounded-circle img-responsive">
                        </div>
                        <!--Content-->
                        <div class="card-block">
                            <h4 id="taskname">
                                {{$task->name}}
                            </h4>
                            <p id="taskclass">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                {{$task->user->name}}
                            </p>
                            <!--Triggering button-->
                            <a class="rotate-btn" data-card="sample_project_card_{!! $key !!}_in_progress">
                                <i class="fa fa-arrow-right"></i>
                                @lang('labels.learn more')
                            </a>
                            @include('task.partials.remove')
                        </div>
                    </div>
                    <!--/.Front Side-->
                    <!--Back Side-->
                    <div class="face back">
                        {{ $task->description }}
                        <hr>
                        <p>
                            {!! Form::model($task, ['method' => 'POST', 'route' => ['task.end', $task], 'ajax', 'postAjax' => 'task-end']) !!}
                            <a download="download" href="{!! $task->file !!}">
                                {{$task->getFileName()}}
                            </a>
                            |
                            <button type="submit" class="like-link">
                                @lang('labels.end task')
                            </button>
                            {!! Form::close() !!}
                        <p>
                            <!--Triggering button-->
                            <a class="rotate-btn" data-card="sample_project_card_{!! $key !!}_in_progress">
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