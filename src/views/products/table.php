<table class="table-responsive my-3">
<thead>
    <tr>
        <th>Name</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Control stock</th>
        <th>Value min</th>
        <th>Above min</th>
        <th>Actions</th>
    </tr>
</thead>
<tbody>
    <?php if ($products) : ?>
        <?php foreach ($products as $product) : ?>
            <tr>
                <td><?= $product->name; ?></td>
                <td><?= $product->price; ?></td>
                <td><?= $product->quantity; ?></td>
                <td><?= $product->control_stock; ?></td>
                <td><?= $product->value_min; ?></td>
                <td><?= $product->above_min; ?></td>
                <td>
                    <a href="<?= route('products.edit', ['uuid' => $product->uuid]); ?>" class="btn btn-primary">Edit</a>
                    <a href="<?= route('products.delete', ['uuid' => $product->uuid]); ?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else : ?>
        <tr>
            <td colspan="7" class="text-center">No products found 😟</td>
        </tr>
    <?php endif; ?>
</tbody>
</table>