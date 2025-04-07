<?= $this->layout('templates/base', [
    'title' => 'Users',
    'cardTitle' => 'Users',
    'styles' => [path()->css("/table-responsive.css")],
]) ?>

<form action="<?= route('users.store'); ?>" method="post">
    <div class="row g-3">
        <div class="col-12 col-md-2">
            <label for="id" class="form-label fw-bold">Id <span class="">*</span></label>
            <input type="text" class="form-control" name="id" id="id" placeholder="#ID">
        </div>
        <div class="col-12 col-md-3">
            <label for="name" class="form-label fw-bold">Name <span class="">*</span></label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Name">
        </div>
        <div class="col-12 col-md-3">
            <label for="age" class="form-label fw-bold">Age <span class="">*</span></label>
            <input type="number" class="form-control" name="age" id="age" step="1" placeholder="Age">
        </div>
        <div class="col-12 col-md-3">
            <label for="gender" class="form-label fw-bold">Gender <span class="">*</span></label>
            <select name="gender" id="gender" class="form-select">
                <option value="">Select Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
        </div>
        <div class="col-12">
            <button class="btn btn-company float-end">Create <i class="ph ph-paper-plane-tilt"></i></button>
        </div>
    </div>
</form>

<?php $this->insert('users/table', ['users' => $users]) ?>
