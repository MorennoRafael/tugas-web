<?= $this->extend('layout/admin/layout') ?>
<?= $this->section('content') ?>

<main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
                    <li class="breadcrumb-item text-sm text-white active" aria-current="page">Users</li>
                </ol>
                <h3 class="font-weight-bolder text-white mb-0">Edit User</h3>
            </nav>
        </div>
    </nav>

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-0">
                    <div class="card-header pb-0">
                        <h5>Form Edit User</h5>

                        <div class="card-body px-0 pt-0 pb-2">
                            <form action="<?= base_url('table/users/' . $user->username . '/edit') ?>" method="post" id="editUserForm">

                                <div class="form-group mb-3">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" class="form-control" value="<?= $user->username ?>" readonly>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="password">Password <small>(kosongkan jika tidak diubah)</small></label>
                                    <input type="password" name="password" class="form-control">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="name">Nama</label>
                                    <input type="text" name="name" class="form-control" value="<?= $user->name ?>" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="role">Role</label>
                                    <select name="role" class="form-control" required>
                                        <option value="admin" <?= $user->role == 'admin' ? 'selected' : '' ?>>Admin</option>
                                        <option value="staff" <?= $user->role == 'staff' ? 'selected' : '' ?>>Staff</option>
                                        <option value="manajer" <?= $user->role == 'manajer' ? 'selected' : '' ?>>Manajer</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<body class="g-sidenav-show bg-primary">
    <div class="min-height-300 bg-gray-100 position-absolute w-100"></div>
</body>

<?= $this->endSection() ?>