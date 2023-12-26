<h1 class="page-header">Дошка
    <small>Основні властивості</small>
</h1>
<?= $this->Flash->render() ?>
<?php $this->append('pageCss'); ?>
<style type="text/css">
    form {
        /*border-bottom: 1px solid #eee; padding-bottom: 20px;*/
    }
</style>
<?php $this->end(); ?>

<div class="row">
    <div class="col-sm-6">
        <!-- begin panel -->
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i
                                class="fa fa-expand"></i></a>
                </div>
                <h4 class="panel-title">Зміна телефонів на сайті:</h4>
            </div>
            <div class="panel-body">
                <form class="form-horizontal col-sm-12 form-bordered"
                      action="/admindom/changePhones" id="changePhonesForm" method="post">
                    <h4 class="m-t-0 text-center">Зміна телефонів на сайті:</h4>
                    <div id="phones">
                        <?php if (!empty($configs['phones'])) {
                            foreach ($configs['phones'] as $phone) { ?>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Номер:</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <input type="text" name="phones[]" value="<?= $phone ?>"
                                                   class="form-control user_phone">
                                            <div class="input-group-btn">
                                                <button type="button" class="btn btn-danger phone_minus">
                                                    <i class="fa fa-minus" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php }
                        } else { ?>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Номер:</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <input type="text" name="phones[]" class="form-control user_phone">
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-danger phone_minus">
                                                <i class="fa fa-minus" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <template id="phone_template">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Номер:</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <input type="text" name="phones[]" class="form-control user_phone">
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-danger phone_minus">
                                                <i class="fa fa-minus" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-9 col-sm-offset-3">
                            <div class="input-group">
                                <div class="input-group-btn">
                                    <button type="button" id="phone_plus" class="btn btn-success pull-right">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Зберегти зміни:</label>
                        <div class="col-md-9">
                            <button type="submit" class="btn btn-sm btn-success">Зберегти</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <!-- begin panel -->
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i
                                class="fa fa-expand"></i></a>
                </div>
                <h4 class="panel-title">Вайбер</h4>
            </div>
            <div class="panel-body">
                <form class="form-horizontal col-sm-12 form-bordered" action="/admindom/changeConf" method="post">
                    <h4 class="m-t-0 text-center">Вайбер</h4>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Номер:</label>
                        <div class="col-sm-9">
                            <input type="text" name="viber"
                                   value="<?= (!empty($configs['viber'][0])) ? $configs['viber'][0] : '' ?>"
                                   class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Зберегти зміни:</label>
                        <div class="col-md-9">
                            <button type="submit" class="btn btn-sm btn-success">Зберегти</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <!-- begin panel -->
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i
                                class="fa fa-expand"></i></a>
                </div>
                <h4 class="panel-title">WhatsApp</h4>
            </div>
            <div class="panel-body">
                <form class="form-horizontal col-sm-12 form-bordered" action="/admindom/changeConf" method="post">
                    <h4 class="m-t-0 text-center">WhatsApp</h4>
                    <div class="form-group">
                        <label class="col-md-3 control-label">WhatsApp:</label>
                        <div class="col-sm-9">
                            <input type="text" name="whatsapp"
                                   value="<?= (!empty($configs['whatsapp'][0])) ? $configs['whatsapp'][0] : '' ?>"
                                   class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Зберегти зміни:</label>
                        <div class="col-md-9">
                            <button type="submit" class="btn btn-sm btn-success">Зберегти</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<div class="row">

    <div class="col-sm-6">
        <!-- begin panel -->
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i
                                class="fa fa-expand"></i></a>
                </div>
                <h4 class="panel-title">Зміна Email для відправки форм:</h4>
            </div>
            <div class="panel-body">
                <form class="form-horizontal col-sm-12 form-bordered" action="/admindom/changeConf" method="post">
                    <h4 class="m-t-0 text-center">Зміна Email для відправки форм:</h4>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Email:</label>
                        <div class="col-sm-9">
                            <input type="email" name="email_contact"
                                   value="<?= (!empty($configs['email_contact'][0])) ? $configs['email_contact'][0] : '' ?>"
                                   class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Зберегти зміни:</label>
                        <div class="col-md-9">
                            <button type="submit" class="btn btn-sm btn-success">Зберегти</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <!-- begin panel -->
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i
                                class="fa fa-expand"></i></a>
                </div>
                <h4 class="panel-title">Зміна Email на сторіінці "Контакти":</h4>
            </div>
            <div class="panel-body">
                <form class="form-horizontal col-sm-12 form-bordered" action="/admindom/changeConf" method="post">
                    <h4 class="m-t-0 text-center">Зміна Email на сторіінці "Контакти":</h4>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Email:</label>
                        <div class="col-sm-9">
                            <input type="email" name="email"
                                   value="<?= (!empty($configs['email'][0])) ? $configs['email'][0] : '' ?>"
                                   class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Зберегти зміни:</label>
                        <div class="col-md-9">
                            <button type="submit" class="btn btn-sm btn-success">Зберегти</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i
                                class="fa fa-expand"></i></a>
                </div>
                <h4 class="panel-title">Соціальні мережі:</h4>
            </div>
            <div class="panel-body">
                <form class="form-horizontal col-sm-12 form-bordered" action="/admindom/changeConf" method="post">
                    <h4 class="m-t-0 text-center">Соціальні мережі:</h4>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Facebook:</label>
                        <div class="col-sm-9">
                            <input type="text" name="social_facebook"
                                   value="<?= (!empty($configs['social_facebook'][0])) ? $configs['social_facebook'][0] : '' ?>"
                                   class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Instagram:</label>
                        <div class="col-sm-9">
                            <input type="text" name="social_instagram"
                                   value="<?= (!empty($configs['social_instagram'][0])) ? $configs['social_instagram'][0] : '' ?>"
                                   class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Зберегти зміни:</label>
                        <div class="col-md-9">
                            <button type="submit" class="btn btn-sm btn-success">Зберегти</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i
                                class="fa fa-expand"></i></a>
                </div>
                <h4 class="panel-title">Коефіцієнт для клієнтів не з України (Проекти)</h4>
            </div>
            <div class="panel-body">
                <form class="form-horizontal col-sm-12 form-bordered" action="/admindom/changeConf" method="post">
                    <h4 class="m-t-0 text-center">Коефіцієнт для клієнтів не з України (Проекти)</h4>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Коефіцієнт:</label>
                        <div class="col-sm-9">
                            <input type="number" step="any" name="projects_coefficient"
                                   value="<?= (!empty($configs['projects_coefficient'][0])) ? $configs['projects_coefficient'][0] : '' ?>"
                                   class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Зберегти зміни:</label>
                        <div class="col-md-9">
                            <button type="submit" class="btn btn-sm btn-success">Зберегти</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>


<?php $this->append('pageCss'); ?>
<style type="text/css">

</style>
<?php $this->end(); ?>

<?php $this->append('pageScript'); ?>
<script src="/old_www/libs/mask/jquery.mask.min.js"></script>
<script type="text/javascript">
    $('.user_phone').mask('+38 000 000 00 00', {placeholder: "+38"});

    $('#phone_plus').on('click', function () {
        var phones_count = $('.user_phone').length;
        if (phones_count < 5) {
            var templatePhone = document.querySelector('#phone_template');
            var clone = document.importNode(templatePhone.content, true);
            $('#phones').append(clone);
        }

        if (phones_count === 4) {
            $('#phone_plus').hide();
        }
    });
    $(document).on("click", ".phone_minus", function (a) {
        var phones_count = $('.user_phone').length;
        if (phones_count > 1) {
            $(this).closest('.form-group').remove();
        }
        if (phones_count === 5) {
            $('#phone_plus').show();
        }
    });
</script>

<script type="text/javascript">
    $("#changePhonesForm").validate({
        errorElement: 'span',
        errorClass: 'has-error',
        validClass: 'has-success',
        rules: {
            'phones[]': {
                required: true,
                minlength: 17,
                maxlength: 17
            }
        },
        highlight: function (element, errorClass, validClass) {
            $(element).parent().addClass(errorClass).removeClass(validClass);
            $('.' + errorClass).find(".fa").addClass('fa-times').removeClass('fa-check');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).parent().removeClass(errorClass).addClass(validClass);
            $('.' + validClass).find(".fa").addClass('fa-check').removeClass('fa-times');
        },
        success: function (label) {
            label.remove();
        },
        errorPlacement: function (error, element) {
            return true;
        },
        submitHandler: function (form) {
            for (var i = 0; i < $('.user_phone').length; i++) {
                var val = $('.user_phone')[i].value;
                if (val.length !== 17) {
                    $($('.user_phone')[i]).parent().addClass('has-error').removeClass('has-success');
                    return false;
                }
            }
            form.submit();
        }
    });
</script>
<?php $this->end(); ?>