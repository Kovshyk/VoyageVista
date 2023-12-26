<li class="dropdown navbar-user">
    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
        <span class="hidden-xs"><?php echo $user['login'] ?></span> <b class="caret"></b>
    </a>
    <ul class="dropdown-menu animated fadeInLeft">
        <li class="arrow"></li>
        <li>
            <?= $this->HTML->link('Змінити пароль',['controller' => 'Admin','action' => 'change_password']); ?>
        </li>
        <li class="divider"></li>
        <li><a href="/admindom/logout">Вийти</a></li>
    </ul>
</li>