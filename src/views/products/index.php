<?= $this->layout('templates/base', [
    'title' => 'Products',
    'cardTitle' => 'Products',
    'styles' => [path()->css("/table-responsive.css")],
]) ?>

<form action="<?= route('products.store'); ?>" method="post" class="mb-5">
    <div class="row g-3">
        <div class="col-12 col-md-5">
            <label for="name" class="form-label fw-bold">Name <span class="">*</span></label>
            <input type="text" class="form-control form-control-sm <?= applyWrong('name') ?>" name="name" id="name" placeholder="Name">
        </div>
        <div class="col-12 col-md-3">
            <label for="price" class="form-label fw-bold">Price <span class="">*</span></label>
            <input type="number" class="form-control form-control-sm <?= applyWrong('price') ?>" name="price" id="price" placeholder="Price" step="0.01">
        </div>

        <div class="col-12 col-md-3">
            <label for="category_id" class="form-label fw-bold">Category <span class="">*</span></label>
            <select name="category_id" id="category_id" class="form-select form-select-sm <?= applyWrong('category_id') ?>">
                <option value="">Select Category</option>
                <?php foreach ($categories as $category) { ?>
                    <option value="<?= $category->id; ?>"><?= $category->name; ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="col-12 col-md-1 d-flex align-items-end">
            <button class="btn btn-company float-end">Create <i class="ph ph-paper-plane-tilt"></i></button>
        </div>
    </div>
</form>

<?php $this->insert('products/table', ['products' => $products]) ?>