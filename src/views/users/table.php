<table class="table-responsive my-3">
<thead>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Age</th>
        <th>Gender</th>
        <th>Actions</th>
    </tr>
</thead>
<tbody>
    <?php if ($users) : ?>
        <?php foreach ($users as $user) : ?>
            <tr>
                <td><?= $user->id; ?></td>
                <td><?= $user->name; ?></td>
                <td><?= $user->age; ?></td>
                <td><?= $user->gender; ?></td>
                <td>
                    <a href="<?= route('users.edit', ['uuid' => $user->uuid]); ?>" class="btn btn-primary">Edit</a>
                    <a href="<?= route('users.delete', ['uuid' => $user->uuid]); ?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else : ?>
        <tr>
            <td colspan="5" class="text-center">No users found 😟</td>
        </tr>
    <?php endif; ?>
</tbody>
</table>