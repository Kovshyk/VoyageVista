<?php
function niceName($name, $language)
{
    if ($language['type'] == 'main') {
        return $name;
    } else {
        return "_translations[{$language['Locale']}][{$name}]";
    }
}

function niceValue($name, $language, $category)
{
    if ($language['type'] == 'main') {
        return $category->$name;
    } else {
        return (!empty($category->_translations[$language['Locale']]->$name)) ? $category->_translations[$language['Locale']]->$name : '';
    }
}

?>
<?= $this->element('Admin/crumbs', ['crumbs' => [0 => 'Галарея'], 'active' => 'Категорії']) ?>
    <div class="row">
        <div class="col-md-12">
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
                            <table class="table table-striped m-b-0">
                                <thead>
                                <tr>
                                    <th width="1%">Сортування:</th>
                                    <th>Назва:</th>
                                    <?php if (!empty($languages)) {
                                        foreach ($languages as $key => $language) {
                                            if ($language['type'] !== 'main') { ?>
                                                <th>Назва (<?= $language['name'] ?>):</th>
                                            <?php }
                                        }} ?>
                                    <th width="1%">Дії</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="active">
                                    <td class="">
                                    </td>
                                    <td class="with-form-control">
                                        <form id="addService" method="post" action="/admindom/galleryCategories/change">
                                            <input type="text" name="name" required class="form-control" value="">
                                        </form>
                                    </td>
                                    <?php if (!empty($languages)) {
                                        foreach ($languages as $key => $language) {
                                            if($language['type'] !== 'main') { ?>
                                                <td class="with-form-control">
                                                    <input form="addService" type="text" name="<?= niceName('name', $language) ?>" class="form-control">
                                                </td>

                                            <?php }
                                        }} ?>
                                    <td class="with-btn">
                                        <button type="submit" form="addService"
                                                class="btn btn-sm btn-primary width-60 m-r-2">Додати
                                        </button>
                                    </td>
                                </tr>
                                <?php if (!empty($categories)) {
                                    foreach ($categories as $item) { ?>
                                        <tr>
                                            <td class="with-form-control">
                                                <input type="text" form="editPlace_<?= $item->id ?>" name="sort"
                                                       class="form-control"
                                                       value="<?= $item->sort ?>">
                                            </td>
                                            <td class="with-form-control">
                                                <form id="editPlace_<?= $item->id ?>" method="post"
                                                      action="/admindom/galleryCategories/change">
                                                    <input type="hidden" name="id" class="form-control"
                                                           value="<?= $item->id ?>">
                                                    <input type="text" name="name" required class="form-control"
                                                           value="<?= $item->name ?>">
                                                </form>
                                            </td>
                                            <?php if (!empty($languages)) {
                                                foreach ($languages as $key => $language) {
                                                    if($language['type'] !== 'main') { ?>
                                                        <td class="with-form-control">
                                                            <input type="text" name="<?= niceName('name', $language) ?>" form="editPlace_<?= $item->id ?>" class="form-control"
                                                                   value="<?= (!empty($item) ? niceValue('name', $language, $item) : '') ?>">
                                                        </td>
                                                    <?php }
                                                }} ?>
                                            <td class="with-btn" nowrap="">
                                                <button type="submit" form="editPlace_<?= $item->id ?>"
                                                        class="btn btn-sm btn-primary width-60 m-r-2">Змінити
                                                </button>
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
    </div>

<?php $this->append('pageCss'); ?>
    <link href="/admin/bower_components/sweetalert/dist/sweetalert.css" rel="stylesheet">
<?php $this->end(); ?>
<?php $this->append('pageScript'); ?>
    <script src="/admin/bower_components/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript">
        function deleteCategory(id) {
            swal({
                    title: "Ви дійсно бажаєте видалити категорію?",
                    text: "Увага! При видаленні категорії, видаляються і всі елементи галареї що входять до неї!",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                    confirmButtonColor: '#ff3b30',
                    confirmButtonText: "Так",
                    cancelButtonColor: "#b6c2c9",
                    cancelButtonText: "Відмінити"
                },
                function () {
                    window.location.href = '/admindom/galleryCategories/delete/' + id;
                });
        }
    </script>
<?php $this->end(); ?>