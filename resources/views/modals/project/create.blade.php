
<!-- Modal new project -->

<div class="modal fade modal-ext" id="newproject" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">

    <div class="modal-dialog  modal-lg" role="document">

        <!--Content-->

        <div class="modal-content">

            <!--Header-->

            <div class="modal-header">

                <h3 class="w-100"><i class="fa fa-plus"></i> Новый проект</h3>

            </div>

            <!--Body-->

            <div class="modal-body">

                <div class="md-form input-group">

                    <input id="projectname" type="text" length="60">

                    <label for="projectname">Название проекта</label>

                </div>

                <div class="md-form input-group">

                    <textarea id="projectdescription" class="md-textarea" length="195"></textarea>

                    <label for="projectdescription">Описание</label>

                </div>

                <div class="md-form input-group file-field">

                    <div class="btn btn-primary btn-sm">

                        <span>Выбрать файл</span>

                        <input type="file">

                    </div>

                    <div class="file-path-wrapper">

                        <input class="file-path validate" type="text" placeholder="Лого проекта">

                    </div>

                </div>

                <hr>

                <h5 class="w-100">Участники проекта</h5>

                <div class="md-form input-group">

                    <input type="email" class="form-control" placeholder="email">

                    <span class="input-group-btn">

                            <button class="btn btn-primary btn-sm waves-effect waves-light"
                                    type="button">+ Добавить</button>

                        </span>

                </div>


                <div class="table-responsive">

                    <table class="table">

                        <thead>

                        <tr>

                            <th></th>

                            <th>Имя пользователя</th>

                            <th>Email</th>

                            <th></th>

                        </tr>

                        </thead>

                        <tbody>

                        <tr>

                            <td class="text-center"><i class="fa fa-user"></i></td>

                            <td>[username]</td>

                            <td>someemail@somedomain.lol</td>

                            <td>

                                <a class="teal-text"><i class="fa fa-pencil-square-o"></i></a>

                                <a class="red-text"><i class="fa fa-times"></i></a>

                            </td>

                        </tr>

                        <tr>

                            <td class="text-center"><i class="fa fa-user"></i></td>

                            <td>[username]</td>

                            <td>someemail@somedomain.lol</td>

                            <td>

                                <a class="teal-text"><i class="fa fa-pencil-square-o"></i></a>

                                <a class="red-text"><i class="fa fa-times"></i></a>

                            </td>

                        </tr>

                        <tr>

                            <td class="text-center"><i class="fa fa-user"></i></td>

                            <td>[username]</td>

                            <td>someemail@somedomain.lol</td>

                            <td>

                                <a class="teal-text"><i class="fa fa-pencil-square-o"></i></a>

                                <a class="red-text"><i class="fa fa-times"></i></a>

                            </td>

                        </tr>


                        </tbody>

                    </table>

                </div>

            </div>

            <!--Footer-->

            <div class="modal-footer">

                <button type="button" class="btn btn-success btn-sm">Сохранить</button>

                <button type="button" class="btn btn-unique btn-sm" data-dismiss="modal">Закрыть</button>

            </div>

        </div>

        <!--/.Content-->

    </div>

</div>