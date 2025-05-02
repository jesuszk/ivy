<table class="table-responsive my-3">
<thead>
    <tr>
        <th>Name</th>
        <th>Active</th>
        <th>Actions</th>
    </tr>
</thead>
<tbody>
    <?php if ($categories) : ?>
        <?php foreach ($categories as $category) : ?>
            <tr>
                <td><?= $category->name; ?></td>
                <td><?= $category->active; ?></td>
                <td>
                    <a href="<?= route('categories.edit', ['uuid' => $category->uuid]); ?>" class="btn btn-primary">Edit</a>
                    <a href="<?= route('categories.delete', ['uuid' => $category->uuid]); ?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else : ?>
        <tr>
            <td colspan="3" class="text-center">No categories found 😟</td>
        </tr>
    <?php endif; ?>
</tbody>
</table>