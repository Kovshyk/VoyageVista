<?= $this->element('Admin/crumbs', ['crumbs' => [0 => 'Проекти'], 'active' => 'Редагувати ціни']) ?>

    <div class="modal fade" id="editModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Редагувати ціну</h4>
                </div>
                <div class="modal-body">
                    <form action="/admindom/projects/prices" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id">
                        <div class="form-group">
                            <label class=" control-label">Тип поїздки</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class=" control-label">Ціна $</label>
                            <input type="number" name="price_uk" class="form-control">
                        </div>
                        <br>
                        <div class="form-group">
                            <label class="control-label">Змінити:</label>
                            <input type="file" name="icon" value="">
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-sm btn-success">Зберегти</button>
                            <button type="button" class="btn btn-sm btn-white" data-dismiss="modal">Скасувати</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <form class="form-horizontal" action="/admindom/projects/prices" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="col-md-3 control-label">Тип туру</label>
                    <div class="col-md-9">
                        <input type="text" name="name" required class="form-control" placeholder="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Ціна</label>
                    <div class="col-md-9">
                        <input type="number" name="price_uk" required class="form-control" placeholder="">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-9 col-md-offset-3">
                        <button type="submit" class="btn btn-sm btn-success">Зберегти</button>
                    </div>
                </div>
            </form>
        </div>


    </div>

    <div class="col-md-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                       data-click="panel-expand"><i
                            class="fa fa-expand"></i></a>
                </div>
                <h4 class="panel-title">Таблиця
                    --
                    редагування</h4>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="price_table">
                        <thead>
                        <tr>
                            <th>Тип туру</th>
                            <th>Ціна </th>
                            <th class="no-sort">Дії</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($prices)) {
                            foreach ($prices as $k => $price) { ?>
                                <tr data-id="<?= $price->id ?>">
                                    <td class="js_name"><?=$price->name?></td>
                                    <td class="price_uk"><?=$price->price_uk?></td>
                                                                              <td class="with-btn-group">
                                        <div class="btn-group m-r-5 m-b-5">
                                            <a href="javascript:;" data-toggle="dropdown"
                                               class="btn btn-default dropdown-toggle width-30 no-caret"
                                               aria-expanded="false">Дії <span class="caret"></span></a>
                                            <ul class="dropdown-menu pull-right">
                                                <li>
                                                    <a href="" data-toggle="modal"
                                                       data-b_type="<?= $price->b_type ?>"
                                                       data-target="#editModal"
                                                    >Редагувати</a>
                                                </li>
                                                <li>
                                                    <a
                                                        data-title="Ви дійсно хочете видалити ?"
                                                        data-text="У Вас не буде можливості відновити!"
                                                        class="delete"
                                                        href="/admindom/projects/deletePrice/<?= $price->id ?>">Видалити</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php }
                        } else { ?>
<!--                            <td colspan="2" style="text-align: center">Не знайдено жодного замовлення</td>-->
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<!---->
<?php $this->append('pageCss'); ?>
    <link href="/admin/assets/plugins/DataTables/css/data-table.css" rel="stylesheet">
    <link href="/admin/bower_components/sweetalert/dist/sweetalert.css" rel="stylesheet">
    <style>
        .btn-file {
            position: relative;
            overflow: hidden;
        }

        .btn-file input[type=file] {
            position: absolute;
            top: 0;
            right: 0;
            min-width: 100%;
            min-height: 100%;
            font-size: 100px;
            text-align: right;
            filter: alpha(opacity=0);
            opacity: 0;
            outline: none;
            background: white;
            cursor: inherit;
            display: block;
        }
    </style>
<?php $this->end(); ?>


<?php $this->append('pageScript'); ?>
    <script src="/old_www/js/jquery.dataTables.js"></script>
    <script src="/admin/bower_components/sweetalert/dist/sweetalert.min.js"></script>

    <script>
        $(document).ready(function () {

            $('#editModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var tr = button.closest('tr');
                var modal = $(this);

                modal.find('input[name="id"]').val(tr.data('id'));
                modal.find('input[name="name"]').val(tr.find('.js_name').text());
                modal.find('input[name="price_uk"]').val(tr.find('.price_uk').text());
                modal.find('input[value="'+button.data('b_type')+'"]').prop('checked', true);
                modal.find('.cover_prew').attr('src', tr.find('.js_img').attr('src'));
            });

            $(document).on('click', '.delete', function (e) {
                e.preventDefault();
                var button = $(this);
                swal({
                        title: button.data('title'),
                        text: button.data('text'),
                        type: "warning",
                        showCancelButton: true,
                        cancelButtonText: "Ні",
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "Так",
                        closeOnConfirm: true
                    },
                    function (isConfirm) {
                        if (isConfirm) {
                            window.location.href = button.attr('href');
                        }
                    });
            });

            $('#price_table').DataTable({
                "order": [[0, "asc"]],
                columnDefs: [
                    {
                        visible: true,
                        orderable: false,
                        targets: [2]
                    }
                ],
                "language": {
                    "url": '/admin/assets/js/DataTables/i18n/Ukrainian.json'
                },
            });


        });

    </script>


<?php $this->end(); ?>