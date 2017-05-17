<div class="col-md-4" id="done">
    <div class="header text-center">
        <h4>Done</h4>
    </div>
    @isset($tasks['done'])
        @foreach($tasks['done'] as $key => $task)
            <div class="card-wrapper" data-task_id="{!! $task->id !!}" data-header_id="done">
                <div id="sample_project_card_{!! $key !!}_done" class="card-rotating effect__click">
                    <!--Front Side-->
                    <div class="face front">
                        <!-- Image-->
                        <div class="card-up normal">
                            <p class="timer">{!! $task->end_date !!}</p>
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
                            <h4 id="taskname">{{$task->name}}</h4>
                            <p id="taskclass">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                {!! $task->user->name !!}
                            </p>
                            <!--Triggering button-->
                            <a class="rotate-btn" data-card="sample_project_card_{!! $key !!}_done">
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
                            <a download="download" href="{!! $task->file !!}">
                                {{$task->getFileName()}}
                            </a>
                            |
                            <a {!! $task->getResult() !!}>
                                @lang('labels.result')
                            </a>
                        <p>
                            <!--Triggering button-->
                            <a class="rotate-btn" data-card="sample_project_card_{!! $key !!}_done">
                                <i class="fa fa-arrow-left"></i>
                                @lang('labels.back')
                            </a>
                    </div>
                    <!--/.Back Side-->
                </div>
            </div>
        @endforeach
        @else
            <h5 class="text-center">
                @lang('labels.empty')
            </h5>
        @endisset
        <!--/.Rotating card-->
</div>