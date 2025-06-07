<?php $t = time(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WOZK - <?= $pageTitle ?></title>
    <link
        rel="stylesheet"
        type="text/css"
        href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/regular/style.css" />
    <link rel="stylesheet" href="<?= path()->css("auth.css?t=" . $t); ?>">
</head>

<body class="align">

    <div class="grid">
        <?= $this->section("content"); ?>
    </div>


    <div id="handleTheme">
        <div>
            <input type="checkbox" class="checkbox" id="checkbox">
            <label for="checkbox" class="checkbox-label">
                <i class="ph ph-moon"></i>
                <i class="ph ph-sun"></i>
                <span class="ball"></span>
            </label>
        </div>
    </div>
</body>

<script src="<?= path()->js("auth.js?t=" . $t); ?>"></script>

</html>