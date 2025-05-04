<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Missão Sementes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">

    <link
        rel="stylesheet"
        type="text/css"
        href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/regular/style.css" />

    <link rel="stylesheet" href="<?= path()->css('bs5.css'); ?>">
    <link rel="stylesheet" href="<?= path()->css('app.css'); ?>">
</head>

<body>

    <div id="preloader">
        <div class="loader"></div>
    </div>


    <div class="login-area login-bg">
        <div class="container">
            <div class="login-box ptb--100">
                <form method="POST" action="<?= route('auth.registerStore'); ?>">
                    <div class="login-form-head">
                        <img src="<?= path()->images('missao.png') ?>" alt="Missão Sementes" class="img-fluid" style="filter: brightness(0) invert(1);">
                        <p class="m-0"><?= el("login_description") ?></p>
                    </div>
                    <div class="login-form-body">
                        <div class="mb-3">
                            <label for="email" class="form-label"><?= el('login_email_label') ?></label>
                            <input type="email" id="email" name="email" class="form-control form-control-sm" placeholder="📩 <?= el('login_email_placeholder') ?>">
                        </div>
                        <div class="mb-3">
                            <label for="passwd"><?= el('login_passwd_label'); ?></label>
                            <input type="password" id="passwd" name="passwd" class="form-control form-control-sm" placeholder="🔐 ************">
                        </div>

                        <div class="mb-3">
                            <label for="passwd_confirmation"><?= el("register_passwd_confirmation_label"); ?></label>
                            <input type="password" id="passwd_confirmation" name="passwd_confirmation" class="form-control form-control-sm" placeholder="🔐 ************">
                        </div>
                        <div class="submit-btn-area">
                            <button id="form_submit" type="submit"><?= el("register_button_submit") ?> <i class="ph ph-paper-plane-tilt"></i></button>
                        </div>
                        <div class="form-footer text-center mt-5">
                            <p class="text-muted"><?= el("register_you_have_account") ?> <a href="<?= route('auth.login') ?>" class="text-decoration-none"><?= el("register_back_login") ?></a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>