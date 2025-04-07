<?= $this->layout('templates/base', [
    'title' => 'Edit User',
    'cardTitle' => 'Edit User',
]) ?>

<form action="<?= route('users.update', ['uuid' => $user->uuid]); ?>" method="post">
    <div class="row g-3">
        <input type="hidden" name="uuid" value="<?= $user->uuid; ?>">

        <div class="col-12 col-md-2">
            <label for="id" class="form-label fw-bold">Id <span class="">*</span></label>
            <input type="text" class="form-control" name="id" id="id" value="<?= $user->id; ?>" placeholder="#ID">
        </div>
        <div class="col-12 col-md-3">
            <label for="name" class="form-label fw-bold">Name <span class="">*</span></label>
            <input type="text" class="form-control" name="name" id="name" value="<?= $user->name; ?>" placeholder="Name">
        </div>
        <div class="col-12 col-md-3">
            <label for="age" class="form-label fw-bold">Age <span class="">*</span></label>
            <input type="number" class="form-control" name="age" id="age" value="<?= $user->age; ?>" step="1" placeholder="Age">
        </div>
        <div class="col-12 col-md-3">
            <label for="gender" class="form-label fw-bold">Gender <span class="">*</span></label>
            <select name="gender" id="gender" class="form-select">
                <option value="" <?= $user->gender == '' ? 'selected' : ''; ?>>Select Gender</option>
                <option value="male" <?= $user->gender == 'male' ? 'selected' : ''; ?>>Male</option>
                <option value="female" <?= $user->gender == 'female' ? 'selected' : ''; ?>>Female</option>
            </select>
        </div>
        <div class="col-12">
            <button class="btn btn-company float-end">Update <i class="ph ph-paper-plane-tilt"></i></button>
        </div>
    </div>
</form>
