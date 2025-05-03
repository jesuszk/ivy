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
                <form>
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
                            <label for="passwd">Senha</label>
                            <input type="password" id="passwd" name="passwd" class="form-control form-control-sm" placeholder="🔐 ************">
                        </div>
                        <div class="row mb-4 rmber-area">
                            <div class="col-6 text-right">
                                <a href="#"><?= el("login_forgot_passwd") ?></a>
                            </div>
                        </div>
                        <div class="submit-btn-area">
                            <button id="form_submit" type="submit"><?= el("login_button_submit") ?> <i class="ph ph-sign-in"></i></button>
                        </div>
                        <div class="form-footer text-center mt-5">
                            <p class="text-muted"><?= el("login_dont_have_account") ?> <a href="register.html"><?= el("login_create_account") ?></a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>