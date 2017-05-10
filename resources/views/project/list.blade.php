<?php
/**
 * Created by PhpStorm.
 * User: rome0s
 * Date: 07.05.17
 * Time: 22:38
 */
?>
@extends('layouts.master')

@section('content')
    <div class="container" style="margin-top: 85px;">

        <div class="animated fadeIn">

            <div class="row">

                <div class="col-md-4">

                    <!--Card Light-->

                    <div class="card" style="padding-top: 10px">

                        <!--Card image-->

                        <div class="view overlay hm-white-slight">

                            <img src="img/logo/sample_pic.jpg" class="img-fluid" alt="">

                            <p class="totalprojectbudget">120 000 ₽</p>
                            <!--Доступно тольк для Product owner и Administrator-->

                            <a href="sample_project.html">

                                <div class="mask waves-effect waves-light"></div>

                            </a>

                        </div>

                        <!--/.Card image-->

                        <!--Card content-->

                        <div class="card-block">

                            <!--share button-->

                            <a data-toggle="modal" data-target="#shareproject" class="activator"><i
                                        class="fa fa-share-alt"></i></a>

                            <!--Title-->

                            <h4 class="card-title">[project name]</h4>

                            <hr>

                            <!--Text-->

                            <p class="card-text">[project description]</p>

                            <p class="participants">[username 1], [username 2], ..., [username n] </p>

                            <a href="sample_project.html" class="black-text d-flex flex-row-reverse"><h5
                                        class="waves-effect p-2">В проект <i class="fa fa-chevron-right"></i></h5></a>

                        </div>

                        <!--/.Card content-->

                    </div>

                    <!--/.Card Light-->

                </div>

            </div>

        </div>

    </div>

@endsection

@section('buttons')
    @role('superadmin')
    <div class="fixed-btn" style="bottom: 45px; right: 24px;">

        <button type="button" class="btn-floating btn-large secondary" data-toggle="modal" data-target="#newproject">
            <i class="fa fa-plus" aria-hidden="true"></i>
        </button>

    </div>
    @endrole
@endsection
