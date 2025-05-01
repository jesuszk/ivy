<?= $this->layout('templates/base', [
    'title' => 'Products',
    'cardTitle' => 'Products',
    'styles' => [path()->css("/table-responsive.css")],
]) ?>

<form action="<?= route('products.store'); ?>" method="post">
    <div class="row g-3">
        <div class="col-12 col-md-4">
            <label for="name" class="form-label fw-bold">Name <span class="">*</span></label>
            <input type="text" class="form-control form-control-sm" name="name" id="name" placeholder="Name">
        </div>
        <div class="col-12 col-md-2">
            <label for="price" class="form-label fw-bold">Price <span class="">*</span></label>
            <input type="number" class="form-control form-control-sm" name="price" id="price" placeholder="Price" step="0.01">
        </div>
        <div class="col-12">
            <button class="btn btn-company float-end">Create <i class="ph ph-paper-plane-tilt"></i></button>
        </div>
    </div>
</form>

<?php $this->insert('products/table', ['products' => $products]) ?>
