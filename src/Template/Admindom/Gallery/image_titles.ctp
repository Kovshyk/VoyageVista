<?php
function niceName($name, $language, $key)
{
    if ($language['type'] == 'main') {
        return 'items['.$key.']['.$name.']';
    } else {
        return 'items['.$key."][_translations][{$language['Locale']}][{$name}]";
    }
}
function niceValue($name, $language, $item, $project = false, $key = false)
{
    if ($language['type'] == 'main') {
        return $item->$name;
    } else {
        return (!empty($item->_translations[$language['Locale']]->$name)) ? $item->_translations[$language['Locale']]->$name : '';
    }
}
?>

<?= $this->element('Admin/crumbs', ['crumbs' => [0 => 'Проекти'], 'active' => 'Фото (Title / Alt)']) ?>
<div class="row">
    <div class="col-md-12">
        <ul class="nav nav-pills mb-2">
            <li class="nav-item active">
                <a href="#nav-pills-tab-1" data-toggle="tab" class="nav-link ">
                    <span class="d-sm-none">Галарея</span>
                </a>
            </li>
            <li class="nav-item ">
                <a href="#nav-pills-tab-2" data-toggle="tab" class="nav-link">
                    <span class="d-sm-none">Проекти</span>
                </a>
            </li>
        </ul>
        <div class="tab-content p-15 rounded bg-white mb-4">
            <div class="tab-pane fade active in" id="nav-pills-tab-1">
                <form action="/admindom/gallery/changeImageTitles" method="post">
                    <button type="submit" class="btn btn-sm btn-success m-r-5">Зберегти</button>
                    <table class="table table-striped m-b-0">
                        <thead>
                        <tr>
                            <th>Фото:</th>
                            <?php if (!empty($languages)) {
                            foreach ($languages as $key => $language) { ?>
                                <th><?= $language['name'] ?>:</th>
                            <?php }
                            } ?>
                        </tr>
                        </thead>
                        <tbody>

                        <?php if (!empty($gallery)) {
                            foreach ($gallery as $key => $item) { ?>
                                <tr>
                                    <input type="hidden" name="items[<?= $key ?>][id]" value="<?= $item->id ?>" >
                                    <td>
                                        <img src="<?= $item->img_src ?>" style="height: 150px" alt="">
                                    </td>
                                    <?php if (!empty($languages)) {
                                        foreach ($languages as $key2 => $language) { ?>
                                            <td>
                                                <?= $this->Element('Admin/Pages/lang_buttons', ['but_ident' => 'gallery_'.$item->id, 'but_current_language' => $language['Locale']]) ?>
                                                <textarea rows="5" name="<?= niceName('title', $language, $key) ?>" class="form-control gallery_<?= $item->id.'_'.$language['Locale'] ?>"><?= niceValue('title', $language, $item) ?></textarea>
                                            </td>
                                        <?php }
                                    } ?>
                                </tr>
                            <?php }
                        } ?>
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-sm btn-success m-r-5">Зберегти</button>
                </form>
            </div>
            <div class="tab-pane fade " id="nav-pills-tab-2">
                <form action="/admindom/gallery/changePhotosTitles" method="post">
                    <button type="submit" class="btn btn-sm btn-success m-r-5">Зберегти</button>
                    <table class="table table-striped m-b-0">
                        <thead>
                        <tr>
                            <th>Фото:</th>
                            <?php if (!empty($languages)) {
                                foreach ($languages as $key => $language) { ?>
                                    <th><?= $language['name'] ?>:</th>
                                <?php }
                            } ?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($projects)) {
                            $counter = 0;
                            foreach ($projects as  $project) {

                                foreach ($project->photos as $key => $photo) { ?>
                                <tr>
                                    <input type="hidden" name="items[<?= $counter ?>][id]" value="<?= $photo->id ?>" >
                                    <td>1
                                        <img src="<?= $photo->img_src ?>" style="height: 150px" alt="">
                                    </td>
                                    <?php if (!empty($languages)) {
                                        foreach ($languages as $key2 => $language) { ?>
                                            <td>
                                                <?= $this->Element('Admin/Pages/lang_buttons', ['but_ident' => 'project_'.$photo->id, 'but_current_language' => $language['Locale']]) ?>
                                                <textarea rows="5" name="<?= niceName('title', $language, $counter) ?>" class="form-control project_<?= $photo->id.'_'.$language['Locale'] ?>"><?= niceValue('title', $language, $photo, $project, $key) ?></textarea>
                                            </td>
                                        <?php }
                                    } ?>
                                </tr>
                                <?php $counter++; } ?>
                            <?php }
                        } ?>
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-sm btn-success m-r-5">Зберегти</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $this->append('pageScript'); ?>
<script type="text/javascript">
    $(document).on("click", ".js_translate_button", function () {
        let lang_from = $(this).data('lang_from');
        let lang_to = $(this).data('lang_to');
        let ident = $(this).data('ident');
        let text = $('.' + ident + '_' + lang_from).val();
        if (ident === 'js_content') {
            text = tinyMCE.get('tiny_'+lang_from).getContent();
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
                    if (ident === 'js_content') {
                        tinyMCE.get('tiny_'+lang_to).setContent(response.text);
                    } else {
                        $('.' + ident + '_' + lang_to).val(response.text.replace(/&quot;/gi, '"'));
                    }
                }
                $('.js_content_loader').hide();
            }
        });
    });
</script>
<?php $this->end(); ?>