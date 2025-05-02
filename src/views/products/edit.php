<?= $this->layout('templates/base', [
    'title' => 'Edit Product',
    'cardTitle' => 'Edit Product',
]) ?>

<form action="<?= route('products.update', ['uuid' => $product->uuid]); ?>" method="post">
    <div class="row g-3">
        <input type="hidden" name="uuid" value="<?= $product->uuid; ?>">

        <div class="col-12 col-md-4">
            <label for="name" class="form-label fw-bold">Name <span class="">*</span></label>
            <input type="text" class="form-control" name="name" id="name" value="<?= $product->name; ?>" placeholder="Name">
        </div>
        <div class="col-12 col-md-2">
            <label for="price" class="form-label fw-bold">Price <span class="">*</span></label>
            <input type="number" class="form-control" name="price" id="price" value="<?= $product->price; ?>" placeholder="Price" step="0.01">
        </div>
        <div class="col-12 col-md-3">
            <label for="category_id" class="form-label fw-bold">Category <span class="">*</span></label>
            <select name="category_id" id="category_id" class="form-select form-select-sm" required>
                <option value="">Select Category</option>
                <?php foreach ($categories as $category) { ?>
                    <option value="<?= $category->id; ?>" <?= isSelect($product->category_id, $category->id) ?>><?= $category->name; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-12">
            <button class="btn btn-company float-end">Update <i class="ph ph-paper-plane-tilt"></i></button>
        </div>
    </div>
</form>