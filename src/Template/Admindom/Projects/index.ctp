<?= $this->element('Admin/crumbs', ['crumbs' => [0 => 'Проекти'], 'active' => 'Редагувати проекти']) ?>
<form class="form-horizontal" action="" method="post">
    <div class="form-group">
        <label class="col-md-2 control-label">Обрати категорію</label>
        <div class="col-md-6">
            <select name="category_id" id="cat_id" class="form-control">
                <option value="0">Всі</option>
                <?php if (!empty($categories)) {
                    foreach ($categories as $category) { ?>
                        <option <?= (!empty($project) && $project->category_id === $category->id) ? 'selected' : ''; ?>
                                value="<?= $category->id ?>"><?= $category->name ?></option>
                    <?php }
                } ?>
            </select>
        </div>
        <div class="col-md-4">
            <a href="" class="btn btn-primary m-r-5 m-b-5 addProduct">Додати проект</a>
        </div>

    </div>
</form>

<div class="col-md-12">
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                   data-click="panel-expand"><i
                        class="fa fa-expand"></i></a>
            </div>
            <h4 class="panel-title">Проекти список</h4>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="products_table">
                    <thead>
                    <tr>
                        <th>Назва</th>
                        <th>Опис</th>
                        <th>Обкладинка</th>
                        <th class="no-sort">Дії</th>
                    </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>
</div>
<!--styles-->
<?php $this->append('pageCss'); ?>
<link href="/admin/js/DataTables/css/data-table.css" rel="stylesheet">
<link href="/admin/js/DataTables/css/rowReorder.dataTables.min.css" rel="stylesheet">
<link href="/admin/bower_components/sweetalert/dist/sweetalert.css" rel="stylesheet">
<link href="/admin/assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />

<?php $this->end(); ?>
<!--scripts-->
<?php $this->append('pageScript'); ?>
<!--<script src="/admin/assets/plugins/DataTables/js/jquery.dataTables.min.js"></script>-->
<script src="/admin/bower_components/sweetalert/dist/sweetalert.min.js"></script>
<script src="/old_www/js/jquery.dataTables.js"></script>
<script src="/admin/js/DataTables/js/dataTables.rowReorder.min.js"></script>
<script src="/admin/assets/plugins/gritter/js/jquery.gritter.js"></script>

<script>

    function deleteProduct(id) {
        swal({
                title: "Ви дійсно бажаєте видалити проект?",
                text: "Увага! Після видалення, проект відновити буде неможливо!!!",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
                confirmButtonColor: '#ff3b30',
                confirmButtonText: "Так",
                cancelButtonColor: "#b6c2c9",
                cancelButtonText: "Відмінити"
            },
            function () {
                window.location.href = '/admindom/projects/deleteProject/' + id;
            });
    }

    $(document).ready(function () {
        var table = {
            table: 0,
            init: function (category_id) {
                $('.addProduct').attr('href', '/admindom/projects/change?category_id='+category_id);
                this.destroy();
                this.table = $('#products_table').DataTable({
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
        // default init firs category
        table.init($('#cat_id').val());

        $(document).on('change', '#cat_id', function (e) {
            e.preventDefault();
            table.init($('#cat_id').val());
            return false;
        });

    });


</script>


<!--<script>-->
<!--    var table = {-->
<!--        table: 0,-->
<!--        init: function (wallet) {-->
<!--            this.destroy();-->
<!--            this.table = $('#transactions_table').DataTable({-->
<!--                "order": [[0, "desc"]],-->
<!--                "language": {-->
<!--                    "url": '/admindom/assets/plugins/DataTables/i18n/Ukrainian.json'-->
<!--                },-->
<!--                "columnDefs": [{-->
<!--                    "targets": 'no-sort',-->
<!--                    "orderable": false-->
<!--                }],-->
<!--                "ajax": "/admindom/transactions/getTransactionsAjax?wallet=" + wallet,-->
<!--                "columns": [-->
<!--                    {"data": "id"},-->
<!--                    {"data": "wallet_from"},-->
<!--                    {"data": "wallet_to"},-->
<!--                    {"data": "tokens"},-->
<!--                    {"data": "comment"},-->
<!--                    {"data": "transaction_hash"},-->
<!--                    {"data": "transition_hash_gft"},-->
<!--                    {-->
<!--                        "data": {-->
<!--                            _: "created.display",-->
<!--                            sort: "created.timestamp"-->
<!--                        }-->
<!--                    },-->
<!--                ],-->
<!--                "deferRender": true-->
<!--            });-->
<!--        },-->
<!--        destroy: function () {-->
<!--            if (this.table) {-->
<!--                this.table.destroy();-->
<!--                this.table = 0;-->
<!--            }-->
<!--        }-->
<!--    };-->
<!---->
<!---->
<!--    $(document).on('submit', '#showTransactionsForm', function (e) {-->
<!--        e.preventDefault();-->
<!---->
<!--        table.init($('#wallet').val());-->
<!--        return false;-->
<!---->
<!--    });-->
<!--</script>-->
<?php $this->end(); ?>
