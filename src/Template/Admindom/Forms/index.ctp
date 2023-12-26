<?php $this->append('pageCss'); ?>
    <link href="/admin/bower_components/sweetalert/dist/sweetalert.css" rel="stylesheet"/>
    <link href="/old_www/css/jquery.dataTables.css" rel="stylesheet"/>
<?php $this->end(); ?>
    <ol class="breadcrumb pull-right">
        <li><a href="/admindom/">Дошка</a></li>
        <li class="active">Зворотня форма</li>
    </ol>
    <h1 class="page-header">Зворотня форма</h1>

    <div class="row">
        <!-- begin col-12 -->
        <div class="col-md-12">
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                           data-click="panel-expand"><i
                                    class="fa fa-expand"></i></a>
                    </div>
                    <h4 class="panel-title">Зворотня форма</h4>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="get_calls_table">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>Ім'я</th>
                                <th>Телефон</th>
                                <th>Повідомлення</th>
                                <th>Тип форми</th>
                                <th class="no-sort">Дата</th>
                                <th class="no-sort">Дії</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($orders)) {
                                foreach ($orders as $order) { ?>
                                    <tr <?= (!$order->viewed) ? 'class="success"' : '' ?> >
                                        <td><?= $order->id ?></td>
                                        <td class="number"><?= (!empty($order->name)) ? h($order->name) : '--' ?></td>
                                        <td class="number"><?= (!empty($order->phone)) ? h($order->phone) : '--' ?></td>
                                        <td class="question"><?= (!empty($order->message)) ? '<textarea rows="4" cols="60" disabled>' . h($order->message) . '</textarea>' : '--' ?></td>
                                        <td class="type"><?= h($order->type) ?></td>
                                        <td class="created"><?= $order->nice_created ?></td>
                                        <td>
                                            <button type="button"
                                                    class="btn-xs btn btn-danger "
                                                    onclick="removeForm('<?= $order->id ?>')">Видалити
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php }
                            } else { ?>
                                <td colspan="7" style="text-align: center">Не знайдено жодного замовлення</td>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- end panel -->
        </div>
        <!-- end col-12 -->
    </div>


<?php $this->append('pageScript'); ?>
    <script src="/old_www/js/jquery.dataTables.js"></script>
    <script src="/admin/bower_components/sweetalert/dist/sweetalert.min.js"></script>

    <script type="text/javascript">
        function removeForm(id) {
            swal({
                    title: "Ви дійсно бажаєте видалити замовлення?",
                    text: "Увага! Після видалення, замовлення відновити буде неможливо!",
                    type: "info",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true
                },
                function () {
                    window.location.href = '/admindom/forms/remove/' + id;
                });
        }
        $(document).ready(function () {
            <?php if (!empty($orders)) { ?>
            $('#get_calls_table').DataTable({
                "order": [[0, "desc"]],
                "columnDefs": [{
                    "targets": 'no-sort',
                    "orderable": false
                }]
            });
            <?php } ?>
        });

    </script>
<?php $this->end(); ?>