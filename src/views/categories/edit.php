<?= $this->layout('templates/base', [
    'title' => 'Edit Category',
    'cardTitle' => 'Edit Category',
]) ?>

<form action="<?= route('categories.update', ['uuid' => $category->uuid]); ?>" method="post">
    <div class="row g-3">
        <input type="hidden" name="uuid" value="<?= $category->uuid; ?>">

        <div class="col-12 col-md-4">
            <label for="name" class="form-label fw-bold">Name <span class="">*</span></label>
            <input type="text" class="form-control" name="name" id="name" value="<?= $category->name; ?>" placeholder="Name">
        </div>
        <div class="col-12 col-md-2">
            <label for="active" class="form-label fw-bold">Active <span class="">*</span></label>
            <select name="active" id="active" class="form-select">
                <option value="Y" <?= $category->active == 'Y' ? 'selected' : ''; ?>>Active</option>
                <option value="N" <?= $category->active == 'N' ? 'selected' : ''; ?>>Inactive</option>
            </select>
        </div>
        <div class="col-12">
            <button class="btn btn-company float-end">Update <i class="ph ph-paper-plane-tilt"></i></button>
        </div>
    </div>
</form>
