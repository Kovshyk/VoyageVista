<?= $this->Element('Admin/loader') ?>

<?= $this->element('Admin/crumbs', ['crumbs' => [0 => 'Проекти'],
    'active' => (empty($project)) ? 'Додати до проектів' : 'Редагування:' . $project->name]) ?>
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
        return h($category->$name);
    } else {
        return (!empty($category->_translations[$language['Locale']]->$name)) ? h($category->_translations[$language['Locale']]->$name) : '';
    }
}
?>
<style>
    .select2.select2-container .selection .select2-selection.select2-selection--multiple {
        height: auto!important;
        min-height: 34px!important;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <form class="form-horizontal" id="addProjectForm" action="/admindom/projects/change<?= !empty($project) ? '/'.$project->id : '' ?>"
              method="post" enctype="multipart/form-data">
        </form>
        <div class="row">
            <div class="col-md-3" >
                <div class="form-group">
                    <label>Тип</label>
                    <select name="category_id" form="addProjectForm" class="form-control">
                        <?php if (!empty($categories)) {
                            foreach ($categories as $category) { ?>
                                <option
                                    <?= (!empty($project) && $project->category_id === $category->id) ? 'selected' : ''; ?>
                                    <?= (!empty($this->request->query['category_id']) && $this->request->query['category_id'] == $category->id) ? 'selected' : ''; ?>
                                        value="<?= $category->id ?>"><?= $category->name ?></option>
                            <?php }
                        } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Оберіть тип туру</label>
                    <select name="prices[]" multiple form="addProjectForm" class="form-control select2">
                        <?php
                        if(!empty($prices)) {
                            $price_lang='price_'.$this->lang;

                            $prices_ids = (!empty($project) && !empty($project->prices)) ? json_decode($project->prices, true) : [];
                            foreach ( $prices as $price ) {
                                $price_is=$price->$price_lang !=0 ? $price->$price_lang : $price->price_uk;
                                ?>
                                <option value="<?= $price->id ?>" <?= (in_array($price->id, $prices_ids)) ? 'selected' : '' ?>
                                ><?= $price->name ?> <?= $price_is ?> $ </option>
                            <?php }} ?>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Категорії</label>
                    <select name="categories[]" multiple form="addProjectForm" class="form-control select2">
                        <?php if (!empty($categories)) {
                            foreach ($categories as $category) { ?>
                                <option
                                    <?= (!empty($category_ids) && in_array($category->id, $category_ids)) ? 'selected' : '' ?>
                                    <?= (!empty($this->request->query['category_id']) && $this->request->query['category_id'] == $category->id) ? 'selected' : ''; ?>
                                        value="<?= $category->id ?>"><?= $category->name ?></option>
                            <?php }
                        } ?>
                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>Тривалість подорожі</label>
                    <input type="number" name="area" form="addProjectForm"
                           value="<?= (!empty($project) ? $project->area : '') ?>" required
                           class="form-control" placeholder="">
                </div>
            </div>


        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <ul class="nav nav-tabs">
                        <?php if (!empty($languages)) {
                            foreach ($languages as $key => $language) { ?>
                                <li class="<?= (!$key) ? 'active' : '' ?>">
                                    <a href="#seo_<?= $language['Locale'] ?>" data-toggle="tab"><?= $language['name'] ?></a>
                                </li>
                            <?php }
                        } ?>
                    </ul>
                    <div class="tab-content">
                        <?php if (!empty($languages)) {
                            foreach ($languages as $key => $language) { ?>
                                <div class="tab-pane <?= (!$key) ? 'active' : '' ?>"  id="seo_<?= $language['Locale'] ?>">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Назва (<b><?= $language['name'] ?></b>)</label>
                                                <?= $this->Element('Admin/Pages/lang_buttons', ['but_ident' => 'name', 'but_current_language' => $language['Locale']]) ?>
                                                <input type="text" name="<?= niceName('name', $language) ?>" value="<?= (!empty($project) ? niceValue('name', $language, $project) : '') ?>"
                                                       <?= ($language['Locale'] == 'uk') ? 'required' : '' ?> form="addProjectForm"
                                                       class="form-control name<?= '_'.$language['Locale'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Короткий опис (<b><?= $language['name'] ?></b>)</label>
                                                <?= $this->Element('Admin/Pages/lang_buttons', ['but_ident' => 'short_description', 'but_current_language' => $language['Locale']]) ?>
                                                <input type="text" name="<?= niceName('short_description', $language) ?>"
                                                       value="<?= (!empty($project) ? niceValue('short_description', $language, $project) : '') ?>"
                                                    <?= ($language['Locale'] == 'uk') ? 'required' : '' ?> form="addProjectForm"
                                                       class="form-control short_description<?= '_'.$language['Locale'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Seo Title (<b><?= $language['name'] ?></b>)</label>
                                                <?= $this->Element('Admin/Pages/lang_buttons', ['but_ident' => 'seo_title', 'but_current_language' => $language['Locale']]) ?>
                                                <input type="text" form="addProjectForm"
                                                       value="<?= (!empty($project)) ? niceValue('seo_title', $language, $project) : '' ?>"
                                                       name="<?= niceName('seo_title', $language) ?>"
                                                       class="form-control seo_field seo_title<?= '_'.$language['Locale'] ?>">
                                                <small class="f-s-12 text-grey-darker seo_symb">0</small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Seo Description (<b><?= $language['name'] ?></b>)</label>
                                                <?= $this->Element('Admin/Pages/lang_buttons', ['but_ident' => 'seo_description', 'but_current_language' => $language['Locale']]) ?>
                                                <textarea class="form-control seo_field seo_description<?= '_'.$language['Locale'] ?>"
                                                          name="<?= niceName('seo_description', $language) ?>" id="" form="addProjectForm"
                                                          rows="3"><?= (!empty($project)) ? niceValue('seo_description', $language, $project) : '' ?></textarea>
                                                <small class="f-s-12 text-grey-darker seo_symb">0</small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Опис туру (<b><?= $language['name'] ?></b>)</label>
                                                <?= $this->Element('Admin/Pages/lang_buttons', ['but_ident' => 'complet', 'but_current_language' => $language['Locale']]) ?>
                                                <textarea class="ckeditor seo_field complet<?= '_'.$language['Locale'] ?>" form="addProjectForm"
                                                          id="complet<?= '_'.$language['Locale'] ?>"
                                                          name="<?= niceName('complet', $language) ?>"><?= (!empty($project)) ? niceValue('complet', $language, $project) : '' ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Інформація (<b><?= $language['name'] ?></b>)</label>
                                                <?= $this->Element('Admin/Pages/lang_buttons', ['but_ident' => 'construct', 'but_current_language' => $language['Locale']]) ?>
                                                <textarea class="ckeditor seo_field construct<?= '_'.$language['Locale'] ?>" form="addProjectForm"
                                                          id="construct<?= '_'.$language['Locale'] ?>"
                                                          name="<?= niceName('construct', $language) ?>"><?= (!empty($project)) ? niceValue('construct', $language, $project) : '' ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php }
                        } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="form-group addImages col-lg-12 <?= (!empty($work_p)) ? 'm-t-20' : '' ?>">
                    <div class="col-md-12">
                        <div class="dz-clickable uploadArea" id="DropZone">
                            <div class="dz-default dz-message placeholder">
                                <i class="iconPhoto"></i>
                                <span class="placeholderText"> Завантажити фотографії</span>
                                <div class="progress progress-striped active">
                                    <div class="progress-bar progress-bar-success">завантаження..</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-122 addedImages" <?= empty($project) ? 'style="display: none"' : '' ?>>
                        <div class="well">
                            <div class="width-full title">
                                <span id="notActive">Додані фотографії:</span>
                                <a id="doPreview" href="/" data-lightbox="image-1" style="display: none">Переглянути
                                    |</a>
                                <span id="doDelete" style="display: none">Видалити</span>
                            </div>
                            <ul class="wellContent row" id="sortable">
                                <?php
                                if (!empty($project) && !empty($project->photos)) {
                                    foreach ($project->photos as $key => $tmp_image): ?>
                                        <li class="imageConvert" data-id='<?= $tmp_image->id ?>'
                                            data-sort="<?= $tmp_image->sort ?>"
                                            data-img_original="<?= $tmp_image->img_src . '?' . time() ?>">
                                            <div
                                                    class="imageBox ui-state-default <?= ($key == 0) ? 'cover' : '' ?>">
                                                <?= ($key == 0) ? '<div class="overlay"><span>Обкладинка</span></div>' : '' ?>
                                                <img style="max-height: 130px"
                                                     src="<?= $tmp_image->img_medium . '?' . time() ?>"
                                                     class="image"
                                                     alt="">
                                            </div>
                                        </li>
                                    <?php endforeach;
                                } ?>

                            </ul>
                            <template id="imgBoxTemplate">
                                <li class="imageConvert" data-sort="1">
                                    <div class="imageBox ui-state-default">
                                        <img style="max-height: 130px" src="/img/myWorks/Preview4edd044.png"
                                             class="image"
                                             alt="">
                                    </div>
                                </li>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
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
                <div class="note note-info">
                    <h4>Редактор</h4>
                    <ul>
                        <li>Ознайомитися з базовим функціоналом візуального редактора,
                            можна перейшовши за посиланням:
                            <a target="_blank" href="https://habr.com/sandbox/87505/"><b>Російською</b></a>
                        </li>
                        <li>
                            <b>Офіційна документація:</b>
                            <a target="_blank"
                               href="https://ckeditor.com/docs/ckeditor4/latest/guide/dev_basics.html">https://ckeditor.com/docs/ckeditor4/latest/guide/dev_basics.html</a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-6">
                <button form="addProjectForm" type="submit" class="btn btn-sm btn-success">Зберегти</button>
            </div>
        </div>
    </div>

</div>


<?php $this->append('pageCss') ?>
<link href="/admin/assets/plugins/dropZone/css/dropZone.css" rel="stylesheet">
<link href="/admin/js/lightbox2/dist/css/lightbox.min.css" rel="stylesheet">
<link href="/admin/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet">

<link href="/admin/bower_components/sweetalert/dist/sweetalert.css" rel="stylesheet">
<style>
    .nopad {
        padding-left: 0 !important;
        padding-right: 0 !important;
    }

    /*image gallery*/
    .image-checkbox {
        cursor: pointer;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        border: 4px solid transparent;
        margin-bottom: 0;
        outline: 0;
    }

    .image-checkbox input[type="checkbox"] {
        display: none;
    }

    .image-checkbox-checked {
        border-color: #3276b1;
    }

    .image-checkbox .fa {
        position: absolute;
        color: #3276b1;
        background-color: #fff;
        padding: 10px;
        top: 0;
        right: 0;
    }

    .image-checkbox-checked .fa {
        display: block !important;
    }

    .image-icon {
        height: 50px;
    }
</style>
<?php $this->end(); ?>

<?php $this->append('pageScript'); ?>
<script src="/admin/js/ckeditor/ckeditor.js"></script>
<script src="/admin/assets/plugins/dropZone/js/dropZone.js"></script>
<script src="/admin/js/lightbox2/dist/js/lightbox.min.js"></script>
<script src="/admin/bower_components/sweetalert/dist/sweetalert.min.js"></script>
<script src="/admin/assets/plugins/select2/dist/js/select2.min.js"></script>
<script type="text/javascript">
    $('.select2').select2();

    function updateDataSort() {
        var images = $('.imageConvert');
        var j = images.length;
        if (j == 0) {
            $('.addedImages').hide();
        } else {
            for (var i = 0; i < images.length; i++) {
                $(images[i]).attr('data-sort', j);
                j--;
            }
        }
    }
    Dropzone.options.DropZone = {
        //your configuration goes here
        init: function () {
            var myDropzone = this;
            $(".uploadArea .errorMessage").remove();

            this.on("addedfile", function (file) {
                $(".errorMessage").remove();
            });

            this.on("thumbnail", function (file) {
                // Do the dimension checks you want to do
                if (file.width > 6000 || file.height > 6000) {
                    $(".uploadArea .dz-message").append('<div class="errorMessage">' + file.name + ' Error! ' + 'Wrong image resolution! 1' + '</div>');
                    DropZone.removeFile(file);
                    return false;
                }
                <?php if(!empty($minHeight) && !empty($minWight)) { ?>
                if (file.width < <?= $minWight ?> || file.height < <?= $minHeight ?>) {
                    $(".uploadArea .dz-message").append('<div class="errorMessage">' + file.name + ' Error! ' + 'Wrong image resolution! 2' + '</div>');
                    DropZone.removeFile(file);
                    return false;
                }
                ;
                <?php } ?>

            });
            this.on("totaluploadprogress", function (progress) {
                $(".uploadArea .iconPhoto").hide();
                $(".uploadArea .placeholderText").hide();
                $(".uploadArea .progress").show();
                document.querySelector(".uploadArea .progress-bar").style.width = progress + "%";
            });

            //and this to handle any error
            this.on("error", function (file, response) {
//                    myDropzone.removeAllFiles(true);
                document.querySelector(".uploadArea .progress-bar").style.width = "0%";
                $(".uploadArea .progress").hide();
                $(".uploadArea .iconPhoto").show();
                $(".uploadArea .placeholderText").show();
                $(".uploadArea .dz-message").append('<div class="errorMessage">' + file.name + ' Error! ' + response + '</div>');
                //handle errors here
            });


            this.on("queuecomplete", function (progress) {
                $(".uploadArea .iconPhoto").show();
                $(".uploadArea .placeholderText").show();
                $(".uploadArea .progress").hide();
                document.querySelector(".uploadArea .progress-bar").style.width = "0%";
            });

            this.on("successmultiple", function (file, response) {
                var images = $('.imageConvert');
                console.log(response)
                for (var i = 0; i < response.images.length; i++) {
                    var templateImgBox = $('#imgBoxTemplate')[0];
                    if (i == 0 && images.length == 0) {
                        $(templateImgBox.content.querySelector('.imageBox')).addClass('cover')
                            .append('<div class="overlay"><span>Обкладинка</span></div>');
                    } else if ($(templateImgBox.content.querySelector('.imageBox')).hasClass('cover')) {
                        $(templateImgBox.content.querySelector('.imageBox')).removeClass('cover');
                        $(templateImgBox.content.querySelector('.imageBox')).find('.overlay').remove();
                    }
                    $(templateImgBox.content.querySelector('img')).attr('src', response.images[i].img_small);
                    $(templateImgBox.content.querySelector('.imageConvert')).attr('data-id', response.images[i].id);
                    $(templateImgBox.content.querySelector('.imageConvert')).attr('data-img_original', response.images[i].img_original);
                    $(templateImgBox.content.querySelector('.imageConvert')).attr('data-img_edit', response.images[i].img_original);
                    var clone = document.importNode(templateImgBox.content, true);
//                    var cartSel = this.cartSel;
                    $('.addedImages').show();
                    $('.addedImages .well ul').append(clone);
                }
                updateDataSort();


//                    myDropzone.removeAllFiles(true);
            });

        }
    };
    var DropZone = new Dropzone("#DropZone", {
        url: '/admindom/projects/uploadImages<?= (!empty($project)) ? "/$project->id" : '' ?>',
        paramName: "file", // The name that will be used to transfer the file
        maxFilesize: 20, // MB
        uploadMultiple: true,
        acceptedFiles: 'image/jpeg,.png',
        parallelUploads: 2,
        autoProcessQueue: true
    });

    $(document).on("click", '.imageBox', function (event) {
        $('.wellContent .active').not($(this)).removeClass('active');
        $(this).toggleClass('active');
        if ($(this).hasClass('active')) {
            $('#notActive').hide();
            $('#doCrop').show();
            $('#doDelete').show();
            $('#doPreview').show()
                .attr('href', $(this).parent().attr('data-img_original'));

        } else {
            $('#notActive').show();
            $('#doCrop').hide();
            $('#doDelete').hide();
            $('#doPreview').hide();
        }
    });

    $(document).on("click", '#doDelete', function (event) {
        swal({
            title: "Видалення фотографії",
            text: "Ви дійсно бажаєте видалити фото?",
            imageUrl: $('.wellContent .active img').attr('src').replace(/\\/g, "/"),
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
            confirmButtonColor: "#ff5b57",
            confirmButtonText: "Так, видалити!",
            cancelButtonColor: "#b6c2c9",
            cancelButtonText: "Ні, відмінити."
        }, function (isConfirm) {
            if (isConfirm) {
                $.ajax({
                    type: "POST",
                    url: '/admindom/projects/deleteImg<?= (!empty($product)) ? "/$product->id" : '' ?>',
                    data: {
                        id: $('.wellContent .active').parent().attr('data-id'),
                        sort: $('#sortable').sortable("toArray", {attribute: 'data-sort'})
                    },
                    success: function (response) {
                        if (!response.delete) {
                            if (response.error.message) {
                                swal({
                                    title: "ERROR",
                                    text: response.error.message,
                                    closeOnConfirm: false,
                                    showLoaderOnConfirm: true,
                                    confirmButtonColor: "#ff5b57",
                                    confirmButtonText: "OK",
                                    cancelButtonColor: "#b6c2c9",
                                    cancelButtonText: "Ні, відмінити."
                                }, function (isConfirm) {
                                    if (isConfirm) {
                                        window.location.reload();
                                    }
                                });
                            } else {
                                window.location.reload();
                            }
                        } else {
                            var active = $('.wellContent .active');
                            if (active.hasClass('cover')) {
                                var newCover = $($('.wellContent').children()[1]).children()[0];
                                $('.overlay').prependTo(newCover);
                                $('.cover').removeClass('cover');
                                $(newCover).addClass('cover');
                            }
                            $('#notActive').show();
                            $('#doCrop').hide();
                            $('#doRotate').hide();
                            $('#doDelete').hide();
                            $('#doPreview').hide();
                            active.attr('style', 'border-color: #ff5b57');
                            swal({
                                title: "Видалено!",
                                text: 'Ваша фотографія видалена.',
                                confirmButtonColor: "#49b6d6",
                                type: 'success'
                            }, function () {
                                active.addClass('delete');
                                setTimeout(function () {
                                    active.parent().remove();
                                    updateDataSort();
                                }, 300);
                            });
                        }
                    }
                });
            }


        });

    });

    $("#sortable").sortable({
        revert: true,
        delay: 100,
        stop: function (event, ui) {
            var newCover = $(ui.item[0]).children();
            if (newCover.hasClass('cover')) {
                newCover = $(event.target.firstElementChild).children();
                $('.overlay').prependTo(newCover);
                $('.cover').removeClass('cover');
                newCover.addClass('cover');
            } else if (ui.item.index() == 0) {
                $('.overlay').prependTo(newCover);
                $('.cover').removeClass('cover');
                newCover.addClass('cover');
            }
            $.ajax({
                type: "POST",
                url: '/admindom/projects/sortingImages<?= (!empty($project)) ? "/$project->id" : '' ?>',
                data: {sort: $(this).sortable("toArray", {attribute: 'data-sort'})},
                success: function (response) {
                    if (!response.sorted) {
                        alert(response.error.message);
                        window.location.reload();
                    }
                }
            });
            updateDataSort();
        }
    });

    $(document).on('submit', '#addProjectForm', function () {
        if($('.imageBox ').length === 0) {
            swal('Не завантажено жодної фотографії!');
            return false;
        }
    });addProjectForm
</script>
<script>
    var lastVidos = $('.js-videos').last();
    $(document).on('click', '.add', function () {
        $('.js-videos-add').last().clone().insertBefore(lastVidos);
    });
    $(document).on('click', '.remove', function () {
        if ($('.js-videos-add').length > 1) {
            $('.js-videos-add').last().remove();
        }
    });
</script>
<script type="text/javascript">
    var seo_fields = {
        init: function () {
            this.fillAll();
            this.events();
        },
        events: function () {
            var self = this;
            $(document).on('keyup', '.seo_field', function () {
                self.fillOne(this);
            });
        },
        fillAll: function () {
            var fields = $('.seo_field');
            for (var i = 0; i < fields.length; i++) {
                this.fillOne(fields[i])
            }
        },
        fillOne: function (field) {
            $(field).closest('.form-group').find('.seo_symb').text($(field).val().length);
        }
    };
    seo_fields.init();

    $(document).on("click", ".js_translate_button", function () {
        let lang_from = $(this).data('lang_from');
        let lang_to = $(this).data('lang_to');
        let ident = $(this).data('ident');
        let text = $('.' + ident + '_' + lang_from).val();
        if (ident === 'complet' || ident === 'construct' || ident === 'materials' || ident === 'plan') {
            let editorFrom = CKEDITOR.instances[ident+'_'+ lang_from];
            if (!editorFrom) {
                CKEDITOR.replace(ident+'_'+ lang_from);
                editorFrom = CKEDITOR.instances[ident+'_'+ lang_from];
            }
            if (editorFrom) {
                text = editorFrom.getData();
            } else {
                console.error('CKEditor instance not found for language: ' + lang_from);
            }
        }
        if (text === '' || text === '<p>&nbsp;</p>' || text === '&nbsp;') {
            alert('Поле пусте!');
            return false;
        }
        $('.js_content_loader').show();

        $.ajax({
            type: "POST",
            url: '/admindom/translateApi/translate',
            data: {
                "lang_from": lang_from,
                "lang_to": lang_to,
                "text": text,
            },
            success: function (response) {
                if (response.error) {
                    alert('Помилка');
                } else {
                    if (ident === 'complet' || ident === 'construct' || ident === 'materials' || ident === 'plan') {
                        let editorTo = CKEDITOR.instances[ident+'_' + lang_to];
                        if (!editorTo) {
                            CKEDITOR.replace(ident+'_' + lang_to);
                            editorTo = CKEDITOR.instances[ident+'_' + lang_to];
                        }
                        if (editorTo) {
                            editorTo.setData(response.text);
                        } else {
                            console.error('CKEditor instance not found for language: ' + lang_to);
                        }
                    } else {
                        $('.' + ident + '_' + lang_to).val(response.text);
                    }
                    seo_fields.fillAll();
                }
                $('.js_content_loader').hide();
            }
        });
    });
</script>

<?php $this->end(); ?>
