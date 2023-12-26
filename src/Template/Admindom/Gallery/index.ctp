<?= $this->element('Admin/crumbs', ['crumbs' => [0 => 'Проекти'], 'active' => 'Категорії']) ?>
    <div class="row">
        <div class="col-md-12">
            <div class="note note-info">
                <h4>Рекомендації до завантаження фотографії </h4>
                <ul>
                    <li>Для того щоб оптимізувати фотографію і <b>зменшити швидкість завантажування сайту</b>, будь
                        ласка,
                        перед тим як завантажувати фотографію на сайт стисніть її за допомогою сайту:
                        <a target="_blank" href="https://tinypng.com/"><b>https://tinypng.com/</b></a></li>
                    <?php if (!empty($minHeight) && !empty($minWight)) { ?>
                        <li>Фотографія повнинна мати розширення не менше ніж <b><?= $minWight ?>
                                x<?= $minHeight ?></b>
                        </li>
                    <?php } ?>
                    <li>Допустимий формат фотографії: <b>.png, .jpg</b></li>
                </ul>
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
                    <div class="row">
                        <div class="col-md-6">
                            <form action="/admindom/gallery/change" enctype="multipart/form-data" method="POST">
                                <fieldset>
                                    <input type="hidden" name="type" value="photo">
                                    <legend class="m-b-15">Додати фото</legend>
                                    <div class="form-group">
                                        <label for="gallery_category_id">Категорія</label>
                                        <select name="gallery_category_id" class="form-control"
                                                required
                                                id="gallery_category_id">
                                            <?php if (!empty($categories)) {
                                                foreach ($categories as $category) { ?>
                                                    <option value="<?= $category->id ?>"><?= $category->name ?></option>
                                                <?php }
                                            } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="img">Фото</label>
                                        <input type="file" required class="form-control" multiple name="img[]" id="img">
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-success m-r-5">Додати</button>
                                </fieldset>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <form action="/admindom/gallery/change" method="POST">
                                <fieldset>
                                    <input type="hidden" name="type" value="video">
                                    <div class="form-group">
                                        <label for="gallery_category_id_2">Категорія</label>
                                        <select name="gallery_category_id" class="form-control"
                                                required
                                                id="gallery_category_id_2">
                                            <?php if (!empty($categories)) {
                                                foreach ($categories as $category) { ?>
                                                    <option value="<?= $category->id ?>"><?= $category->name ?></option>
                                                <?php }
                                            } ?>
                                        </select>
                                    </div>
                                    <legend class="m-b-15">Додати відео</legend>
                                    <div class="form-group">
                                        <label for="video_href">Посилання</label>
                                        <input type="text" required class="form-control" name="video_href" id="video_href">
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-success m-r-5">Додати</button>
                                </fieldset>
                            </form>
                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-striped m-b-0">
                                    <thead>
                                    <tr>
                                        <th>Категорія:</th>
                                        <th>Фото:</th>
                                        <th>Відео:</th>
                                        <th width="1%">Дії</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if (!empty($gallery)) {
                                        foreach ($gallery as $item) { ?>
                                            <tr>
                                                <td>
                                                    <?= $item->gallery_category->name ?>
                                                </td>
                                                <td>
                                                    <img src="<?= $item->img_src ?>" style="height: 150px"
                                                         alt="">
                                                </td>
                                                <td>
                                                    <?php if (!empty($item->video_href)) { ?>
                                                        <iframe style="height: 150px"
                                                                src="<?= $item->video_href ?>" frameborder="0"
                                                                allow="autoplay; encrypted-media"
                                                                allowfullscreen></iframe>
                                                    <?php } ?>
                                                </td>
                                                <td class="with-btn" nowrap="">
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
    </div>

<?php $this->append('pageCss'); ?>
    <link href="/admin/bower_components/sweetalert/dist/sweetalert.css" rel="stylesheet">
<?php $this->end(); ?>
<?php $this->append('pageScript'); ?>
    <script src="/admin/bower_components/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript">
        function deleteCategory(id) {
            swal({
                    title: "Ви дійсно бажаєте видалити?",
                    text: "",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                    confirmButtonColor: '#ff3b30',
                    confirmButtonText: "Так",
                    cancelButtonColor: "#b6c2c9",
                    cancelButtonText: "Відмінити"
                },
                function () {
                    window.location.href = '/admindom/gallery/delete/' + id;
                });
        }
    </script>
<?php $this->end(); ?>