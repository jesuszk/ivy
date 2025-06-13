<?= $this->layout("templates/panel", [
    "styles" => [
        path()->css("table.css"),
        path()->css("home.css")
    ],
    "js" => [
        "https://cdn.jsdelivr.net/npm/apexcharts",
        path()->js("home.min.js"),
    ]
]); ?>






<div class="container-grid">
    <?= $this->insert("panel/cards"); ?>
    <?= $this->insert("panel/pending"); ?>
    <?= $this->insert("panel/graphs"); ?>
</div>