@extends('layouts.master')

@section('content')
    <div class="container" style="margin-top: 85px;">
        <div class="animated fadeIn">

            <!--Section: Team v.1-->
            <section class="section team-section">

                <!--Section heading-->
                <h1 class="section-heading">@lang('labels.user groups')</h1>
                <!--Section description-->

            @if(sizeof($roles))
                <!-- Nav tabs -->
                    <ul class="nav nav-tabs tabs-5 unique-color" role="tablist">
                        @foreach($roles as $key => $role)
                            <li class="nav-item">
                                <a class="nav-link @if($key === 0) active @endif" data-toggle="tab"
                                   href="#role_{!! $role->id !!}" role="tab">
                                    <img src="{!! $role->image !!}" alt="{!! $role->name !!}" class="rounded-circle" style="margin-bottom: 10px;">
                                    {!! $role->name !!}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
                @if(sizeof($users) && sizeof($roles))
                    <div class="tab-content">
                        @foreach($roles as $key => $role)
                            <div class="tab-pane fade in show @if($key === 0) active @endif"
                                 id="role_{!! $role->id !!}" role="tabpanel">
                                <br>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>@lang('labels.name')</th>
                                        <th>@lang('labels.email')</th>
                                        <th>@lang('labels.actions')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($users[$role->name]) && sizeof($users[$role->name]))
                                        @foreach($users[$role->name] as $_user)
                                            @include('user.partials.user', ['real_user' => $_user])
                                        @endforeach
                                    @else
                                        @include('user.partials.empty')
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        @endforeach
                    </div>
                @endif

            </section>
        </div>
    </div>
@endsection

@section('popups')
    @include('modals.user.create')

    @include('modals.user.edit')

    @include('modals.user.password')

    @include('modals.user.delete')
@endsection

@section('buttons')
    <div class="fixed-btn" style="bottom: 45px; right: 24px;">
        <button type="button" class="btn-floating btn-large secondary" style="float:right;" data-toggle="modal" data-target="#newuser">
            <i class="fa fa-plus" aria-hidden="true"></i>
        </button>
    </div>
@endsection
