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
    <style>
        :root {
            --info: #3366FF;
            --success: #84DC5B;
            --error: #FF4F30;
            --warning: #FFDA66;
        }

        body {
            overflow-x: hidden;
        }

        .sidebar {
            width: 170px;
            height: 100vh;
            background-color: #252525;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 10px;
            transition: transform 0.3s ease;
            z-index: 1050;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: #ccc transparent;
        }

        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background-color: #ccc;
            border-radius: 3px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar.hide {
            transform: translateX(-100%);
        }

        .sidebar a,
        .sidebar button {
            color: white;
            padding: 15px 30px;
            display: flex;
            align-items: center;
            justify-content: start;
            gap: 18px;
            width: 100%;
            border: none;
            background: none;
            text-align: left;
            text-decoration: none;
        }

        .sidebar a:hover,
        .sidebar button:hover {
            background-color: #046377;
        }



        .dropdown-container a {
            padding: 10px 15px;
        }



        .dropdown-container {
            max-height: 0;
            overflow: hidden;
            flex-direction: column;
            padding-left: 30px;
            transition: max-height 0.3s ease;
        }

        .sidebar .active+.dropdown-container {
            max-height: 200px;
        }





        .header {
            height: 60px;
            background-color: #fff;
            border-bottom: 1px solid #ddd;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            margin-left: 170px;
            transition: margin-left 0.3s ease;
            position: relative;
            z-index: 1060;
        }

        .header.shifted {
            margin-left: 0;
        }

        .content {
            margin-left: 170px;
            padding: 20px;
            transition: margin-left 0.3s ease;
        }

        .content.shifted {
            margin-left: 0;
        }

        .toggle-btn {
            display: inline-block;
            cursor: pointer;
        }

        #logoContainer {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            margin-bottom: 1rem;
            margin-top: 1rem;
        }

        #logoContainer .logo {
            width: 80px;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .header,
            .content {
                margin-left: 0;
            }
        }
    </style>
    <link rel="stylesheet" href="<?= path()->css("notification.css?t=" . $t); ?>">
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
        <h2>Dashboard</h2>
        <p>Conteúdo principal aqui.</p>
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

    <?php
    enableNotifications();
    forgetSessions(['old', 'zarkify', 'isWrong']);
    ?>
</body>

</html>