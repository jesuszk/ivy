<?= $this->layout('templates/base', [
    'title' => 'Categories',
    'cardTitle' => 'Categories',
    'styles' => [path()->css("/table-responsive.css")],
]) ?>

<form action="<?= route('categories.store'); ?>" method="post">
    <div class="row g-3">
        <div class="col-12 col-md-4">
            <label for="name" class="form-label fw-bold">Name <span class="">*</span></label>
            <input type="text" class="form-control form-control-sm" name="name" id="name" placeholder="Name">
        </div>
        <div class="col-12 col-md-2">
            <label for="active" class="form-label fw-bold">Active <span class="">*</span></label>
            <select name="active" id="active" class="form-select form-select-sm">
                <option value="Y">Active</option>
                <option value="N">Inactive</option>
            </select>
        </div>
        <div class="col-12">
            <button class="btn btn-company float-end">Create <i class="ph ph-paper-plane-tilt"></i></button>
        </div>
    </div>
</form>

<?php $this->insert('categories/table', ['categories' => $categories]) ?>
