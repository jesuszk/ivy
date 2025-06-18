<?= $this->layout("templates/panel", [
    "styles" => [
        path()->css("table.css"),
        path()->css("home.css"),
        "https://unpkg.com/slim-select@latest/dist/slimselect.css"
    ],
    "js" => [
        "https://cdn.jsdelivr.net/npm/apexcharts",
        path()->js("home.min.js"),
    ],
    "js_started" => [
        "https://unpkg.com/slim-select@latest/dist/slimselect.min.js"
    ]
]); ?>




<div class="row">
    <div class="col-12">
        <a href="#" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">NOVO HÁBITO <i class="ph ph-plus"></i></a>
    </div>
</div>

<?= $this->insert("panel/cards"); ?>

<div class="group-pending-graphs">
    <?= $this->insert("panel/pending"); ?>
    <?= $this->insert("panel/graphs"); ?>
</div>

<?= $this->insert("panel/habit_add"); ?>

