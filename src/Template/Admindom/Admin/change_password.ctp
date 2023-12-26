Layout<?= $this->element('Admin/crumbs', ['active' => 'Налаштування аккаунта']) ?>

<div class="col-md-12 ui-sortable">

    <div class="panel panel-inverse" data-sortable-id="form-validation-1" data-init="true">
        <div class="panel-heading">
            <h4 class="panel-title">Змінити пароль</h4>
        </div>
        <div class="panel-body panel-form">
            <?= $this->Flash->render() ?>
            <form class="form-horizontal form-bordered" method="post"  action="/admindom/changePassword" id="change_pass">
                <div class="form-group has-feedback">
                    <label class="control-label col-md-4 col-sm-4" for="old_pass">Старий пароль * :</label>
                    <div class="col-md-6 col-sm-6">
                        <input class="form-control" type="text" id="old_pass" name="old_pass" required="">
                        <span class="fa form-control-feedback"></span>
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <label class="control-label col-md-4 col-sm-4" for="pass">Новий пароль * :</label>

                    <div class="col-md-6 col-sm-6">
                        <input class="form-control" type="password" id="pass" name="pass">
                        <span class="fa form-control-feedback"></span>
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <label class="control-label col-md-4 col-sm-4" for="conf_pass">Підтвердити * :</label>

                    <div class="col-md-6 col-sm-6">
                        <input class="form-control" type="password" id="conf_pass" name="conf_pass">
                        <span class="fa form-control-feedback"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm-4"></label>

                    <div class="col-md-6 col-sm-6">
                        <button type="submit" class="btn btn-primary">Змінити</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $this->append('pageCss'); ?>
<style type="text/css">
    span.has-error{
        position: absolute;
        bottom: 0;
    }
</style>
<?php $this->end(); ?>
<?php $this->append('pageScript'); ?>
<script type="text/javascript">
    $("#change_pass").validate({
        errorElement: 'span',
        errorClass: 'has-error',
        validClass: 'has-success',
        rules: {
            old_pass: {
                required: true,
                minlength: 5,
                maxlength: 25
            },
            pass: {
                required: true,
                minlength: 6,
                maxlength: 25
            },
            conf_pass: {
                required: true,
                equalTo: "#pass"
            }
        },
        messages: {
            old_pass: {
                required: "Enter your old password",
                minlength: "Password should be more than 6 characters",
                maxlength: "Password should be less than 25 characters"

            },
            pass: {
                required: "Enter your new password",
                minlength: "Password should be more than 6 characters",
                maxlength: "Password should be less than 25 characters"

            },
            conf_pass: {
                required: "Enter your password again",
                equalTo: "Passwords do not match"
            }
        },
        highlight: function(element, errorClass, validClass) {
            $(element).parent().addClass(errorClass).removeClass(validClass);
            $('.'+ errorClass).find(".fa").addClass('fa-times').removeClass('fa-check');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).parent().removeClass(errorClass).addClass(validClass);
            $('.'+ validClass).find(".fa").addClass('fa-check').removeClass('fa-times');
        },
        success: function(label) {
            label.remove();
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
</script>
<?php $this->end(); ?>
