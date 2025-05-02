<table class="table-responsive my-3">
<thead>
    <tr>
        <th>Name</th>
        <th>Price</th>
        <th>Category</th>
        <th>Actions</th>
    </tr>
</thead>
<tbody>
    <?php if ($products) : ?>
        <?php foreach ($products as $product) : ?>
            <tr>
                <td><?= $product->name; ?></td>
                <td><?= $product->price; ?></td>
                <td><?= $product->category->name; ?></td>
                <td>
                    <a href="<?= route('products.edit', ['uuid' => $product->uuid]); ?>" class="btn btn-primary">Edit</a>
                    <a href="<?= route('products.delete', ['uuid' => $product->uuid]); ?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else : ?>
        <tr>
            <td colspan="3" class="text-center">No products found 😟</td>
        </tr>
    <?php endif; ?>
</tbody>
</table>