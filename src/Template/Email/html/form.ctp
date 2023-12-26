<?php if (!empty($data['type'])) { ?>
    <p>Тип форми: <?= $data['type'] ?></p>
<?php } ?>
<?php if (!empty($data['name'])) { ?>
    <p>Ім'я: <?= $data['name'] ?></p>
<?php } ?>
<?php if (!empty($data['phone'])) { ?>
    <p>Телефон: <?= $data['phone'] ?></p>
<?php } ?>
<?php if (!empty($data['message'])) { ?>
    <p>Повідомлення: <?= $data['message'] ?></p>
<?php } ?>