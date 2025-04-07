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
            <input type="number" class="form-control" name="price" id="price" value="<?= $product->price; ?>" step="0.01" placeholder="Price">
        </div>
        <div class="col-12 col-md-2">
            <label for="quantity" class="form-label fw-bold">Quantity <span class="">*</span></label>
            <input type="number" class="form-control" name="quantity" id="quantity" value="<?= $product->quantity; ?>" placeholder="Quantity">
        </div>
        <div class="col-12 col-md-2">
            <label for="control_stock" class="form-label fw-bold">Control stock <span class="">*</span></label>
            <select name="control_stock" id="control_stock" class="form-select">
                <option value="" <?= $product->control_stock == '' ? 'selected' : ''; ?>>Select Control Stock</option>
                <option value="1" <?= $product->control_stock == '1' ? 'selected' : ''; ?>>Yes</option>
                <option value="0" <?= $product->control_stock == '0' ? 'selected' : ''; ?>>No</option>
            </select>
        </div>
        <div class="col-12 col-md-2">
            <label for="value_min" class="form-label fw-bold">Value min</label>
            <input type="number" class="form-control" name="value_min" id="value_min" value="<?= $product->value_min; ?>" placeholder="Value Min">
        </div>
        <div class="col-12">
            <button class="btn btn-company float-end">Update <i class="ph ph-paper-plane-tilt"></i></button>
        </div>
    </div>
</form>
