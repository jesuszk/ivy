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




<div class="row">
    <div class="col-12">
        <a href="#" class="btn btn-add-habit fw-bold text-muted">Novo Hábito <i class="ph ph-plus"></i></a>
    </div>
</div>

<?= $this->insert("panel/cards"); ?>

<div class="group-pending-graphs">
    <?= $this->insert("panel/pending"); ?>
    <?= $this->insert("panel/graphs"); ?>
</div>