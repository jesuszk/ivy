<?php $t = time(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Template</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link
        rel="stylesheet"
        type="text/css"
        href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/regular/style.css" />
    <link rel="stylesheet" href="<?= path()->css("panel.css?t=" . $t); ?>">
    <link rel="stylesheet" href="<?= path()->css("notification.css?t=" . $t); ?>">

    <?php foreach ($styles as $i => $style) { ?>
        <link rel="stylesheet" href="<?= $style ?>">
    <?php } ?>

    <?php if (isset($js_started)) { ?>
        <?php foreach ($js_started as $i => $j) { ?>
            <script src="<?= $j . "?t=" . $t ?>"></script>
        <?php } ?>
    <?php } ?>
</head>

<body>
    <ul class="notificationsToasts"></ul>
    <div class="sidebar" id="sidebar">
        <div id="logoContainer">
            <img src="<?= path()->images("zk-dark.png"); ?>" alt="Logo" class="logo">
        </div>
        <a href="#"><i class="ph ph-house"></i> Home</a>
        <a href="#"><i class="ph ph-users"></i> Hábitos</a>
        <a href="#"><i class="ph ph-check-square"></i> Tarefas</a>
        <a href="#"><i class="ph ph-calendar"></i> Finanças</a>

        <button class="dropdown-btn" onclick="toggleDropdown(this)"><i class="ph ph-folders"></i> Projetos</button>
        <div class="dropdown-container">
            <a href="#">Projeto A</a>
            <a href="#">Projeto B</a>
        </div>

        <a href="#"><i class="ph ph-clock"></i> Ideias</a>
        <a href="#"><i class="ph ph-gear"></i> Configs</a>
        <a href="<?= route("auth.logout"); ?>"><i class="ph ph-sign-out"></i> Logout</a>
    </div>

    <div class="header" id="header">
        <div class="d-flex align-items-center">
            <button class="btn me-3" onclick="toggleSidebar()"><i class="ph ph-list"></i></button>
        </div>
        <div class="dropdown ms-auto">
            <img src="https://ui-avatars.com/api/?name=<?= user()->username ?>&size=40" alt="User" class="rounded-circle dropdown-toggle" data-bs-toggle="dropdown" style="cursor:pointer">
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#">Perfil</a></li>
                <li><a class="dropdown-item" href="<?= route("auth.logout") ?>">Logout</a></li>
            </ul>
        </div>
    </div>

    <div class="content" id="content">
        <?= $this->section("content"); ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const header = document.getElementById('header');
            const content = document.getElementById('content');
            const isHidden = sidebar.classList.toggle('hide');

            if (window.innerWidth >= 768) {
                header.classList.toggle('shifted', isHidden);
                content.classList.toggle('shifted', isHidden);
            } else {
                sidebar.classList.toggle('show');
            }
        }

        function toggleDropdown(button) {
            button.classList.toggle('active');
        }
    </script>

    <script src="<?= path()->js("notification.js?t=" . $t); ?>"></script>

    <?php if (isset($js)) { ?>
        <?php foreach ($js as $i => $j) { ?>
            <script src="<?= $j . "?t=" . $t ?>"></script>
        <?php } ?>
    <?php } ?>

    <?php
    enableNotifications();
    forgetSessions(['old', 'zarkify', 'isWrong']);
    ?>
</body>

</html>