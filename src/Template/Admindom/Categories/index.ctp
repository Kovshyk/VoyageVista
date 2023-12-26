<?= $this->element('Admin/crumbs', ['crumbs' => [0 => 'Проекти'], 'active' => 'Категорії']) ?>
    <a href="/admindom/categories/change" class="btn btn-primary m-r-5 m-b-5 addProduct">Додати категорію</a>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                           data-click="panel-expand"><i
                                    class="fa fa-expand"></i></a>
                    </div>
                    <h4 class="panel-title">Таблиця -- редагування</h4>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped m-b-0" id="categories_table">
                            <thead>
                            <tr>
                                <th width="1%">Сортування:</th>
                                <th>Назва:</th>
                                <th>Перейти:</th>
                                <th width="1%">Дії:</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($categories)) {
                                foreach ($categories as $item) { ?>
                                    <tr>
                                        <td class="with-form-control"><?= $item->sort ?></td>
                                        <td class="with-form-control"><?= $item->name ?></td>
                                        <td class="with-form-control">
                                            <?php if (!empty($languages)) {
                                            foreach ($languages as $key => $language) {
                                                $slug = 'slug_'.$language['Locale'];
                                                $enable = 'enable_'.$language['Locale'];
                                                $loc = ($language['type'] == 'main') ? '/' : '/'.$language['Locale'].'/';
                                                if(!empty($item->$slug) && !empty($item->$enable)) {
                                                    ?>
                                                    <a href="<?= $loc.$item->$slug ?>" target="_blank" class="btn btn-sm btn-info"><?= $language['name'] ?></a>
                                            <?php }}
                                            } ?>
                                        </td>
                                        <td class="with-btn" nowrap="">
                                            <a class="btn btn-sm btn-primary width-60 m-r-2" href="/admindom/categories/change/<?= $item->id ?>">Редагувати</a>
                                            <a onclick="deleteCategory(<?= $item->id ?>)"
                                               class="btn btn-sm btn-danger width-60 m-r-2">Видалити</a>
                                        </td>
                                    </tr>
                                <?php }
                            } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $this->append('pageCss'); ?>
    <link href="/admin/bower_components/sweetalert/dist/sweetalert.css" rel="stylesheet">
    <link href="/admin/js/DataTables/css/data-table.css" rel="stylesheet">
    <link href="/admin/js/DataTables/css/rowReorder.dataTables.min.css" rel="stylesheet">
    <link href="/admin/bower_components/sweetalert/dist/sweetalert.css" rel="stylesheet">
    <link href="/admin/assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />

<?php $this->end(); ?>
<?php $this->append('pageScript'); ?>
    <script src="/admin/bower_components/sweetalert/dist/sweetalert.min.js"></script>
    <script src="/old_www/js/jquery.dataTables.js"></script>
    <script src="/admin/js/DataTables/js/dataTables.rowReorder.min.js"></script>
    <script src="/admin/assets/plugins/gritter/js/jquery.gritter.js"></script>

    <script type="text/javascript">
        function deleteCategory(id) {
            swal({
                    title: "Ви дійсно бажаєте видалити категорію?",
                    text: "Увага! При видаленні категорії, видаляються і всі проекти які входять до неї!",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                    confirmButtonColor: '#ff3b30',
                    confirmButtonText: "Так",
                    cancelButtonColor: "#b6c2c9",
                    cancelButtonText: "Відмінити"
                },
                function () {
                    window.location.href = '/admindom/categories/delete/' + id;
                });
        }


        $(document).ready(function () {
            var table = {
                table: 0,
                init: function () {
                    this.table = $('#categories_table').DataTable({
                        "order": [[0, "desc"]],
                        "columnDefs": [{
                            visible: true,
                            orderable: false,
                            targets: [1, 2, 3]
                        }],

                        ajax: {
                            url: '/admindom/projects/getProduct?category_id=' + category_id,
                            data: function (data) {
                                return data;
                            }
                        },
                        "language": {
                            "url": '/admindom/js/DataTables/i18n/Ukrainian.json'
                        },
                        "columns": [
                            {"data": "name"},
                            {"data": "short_description"},
                            {"data": "img"},
                            {"data": "action"}
                        ]
                    })
                },
                destroy: function () {
                    if (this.table) {
                        this.table.destroy();
                        this.table = 0;
                    }
                }
            };

        });

    </script>
<?php $this->end(); ?>