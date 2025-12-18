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
                <h3 class="font-weight-bolder text-white mb-0">Users</h3>
            </nav>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                    <div class="input-group">
                        <form action="<?= base_url('users/cari') ?>" method="GET" id="searchForm">
                            <span class="input-group-text text-body">
                                <input type="search" id="searchInput" name="search" placeholder="Cari berdasarkan username atau nama.." />
                                <i class="fas fa-search" aria-hidden="true"></i>
                            </span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-0">
                    <div class="card-header pb-0">
                        <h5>Daftar Users</h5>
                        <!-- button tambah -->
                        <button type="button" class="btn bg-gradient-success btn-block mb-3" data-bs-toggle="modal" data-bs-target="#modalCreateUser">
                            Tambah User
                        </button>
                        <br>
                    </div>

                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table table-hover align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Username</th>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Role</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($users as $user): ?>
                                        <tr>
                                            <td class="text-center"><?= $no ?></td>
                                            <td class="text-center"><?= $user->username ?></td>
                                            <td class="text-center"><?= $user->name ?></td>
                                            <td class="text-center"><?= ucfirst($user->role) ?></td>
                                            <td class="text-center">
                                                <a href="<?= base_url('users/' . $user->username . '/edit') ?>" class="btn bg-gradient-info">Edit</a>

                                                <a href="#" data-href="<?= base_url('users/' . $user->username . '/delete') ?>"
                                                    onclick="confirmToDelete(this)"
                                                    class="btn bg-gradient-danger"
                                                    data-bs-toggle="modal" data-bs-target="#confirm-dialog">
                                                    Hapus
                                                </a>
                                            </td>
                                        </tr>
                                    <?php $no++;
                                    endforeach ?>
                                </tbody>
                            </table>

                            <!-- js message data tidak ditemukan  -->
                            <div id="resultMessage" class="result-message text-center"></div>

                            <!-- Modal Hapus -->
                            <div class="modal fade" id="confirm-dialog" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5>Konfirmasi Hapus</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">Apakah Anda yakin ingin menghapus user ini?</div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="button" class="btn btn-danger" onclick="deleteData()">Hapus</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script>
                                function confirmToDelete(element) {
                                    var btn = document.querySelector('#confirm-dialog .btn-danger');
                                    btn.setAttribute('data-href', element.getAttribute('data-href'));
                                }

                                function deleteData() {
                                    var url = document.querySelector('#confirm-dialog .btn-danger').getAttribute('data-href');
                                    window.location.href = url;
                                }
                            </script>

                            <!-- Modal Tambah User -->
                            <div class="modal fade" id="modalCreateUser" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered modal-md">
                                    <div class="modal-content">
                                        <div class="modal-body p-0">
                                            <div class="card card-plain">
                                                <div class="card-header pb-0">
                                                    <h3 class="font-weight-bolder text-primary">Tambah User</h3>
                                                </div>

                                                <div class="card-body pb-3">
                                                    <form action="<?= base_url('table/users/new') ?>" method="post">
                                                        <label>Username</label>
                                                        <input type="text" class="form-control mb-3" name="username" required>

                                                        <label>Password</label>
                                                        <input type="password" class="form-control mb-3" name="password" required>

                                                        <label>Nama</label>
                                                        <input type="text" class="form-control mb-3" name="name" required>

                                                        <label>Role</label>
                                                        <select name="role" class="form-control mb-3" required>
                                                            <option value="admin">Admin</option>
                                                            <option value="staff">Staff</option>
                                                            <option value="manajer">Manajer</option>
                                                        </select>

                                                        <button type="submit" class="btn btn-primary w-100">Tambah</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
</main>

<body class="g-sidenav-show bg-primary">
    <div class="min-height-300 bg-gray-100 position-absolute w-100"></div>

    <!-- js search -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const searchForm = document.getElementById("searchForm");
            const searchInput = document.getElementById("searchInput");
            const resultMessage = document.getElementById("resultMessage");
            const tableBody = document.querySelector(".table tbody");

            function filterRows() {
                const searchText = searchInput.value.toLowerCase();
                let foundRows = 0;

                tableBody.querySelectorAll("tr").forEach(function(row, index) {
                    const cells = row.querySelectorAll("td");
                    const textToSearch = (cells[1].textContent + cells[2].textContent).toLowerCase();

                    if (textToSearch.includes(searchText)) {
                        row.style.display = "";
                        foundRows++;
                    } else {
                        row.style.display = "none";
                    }
                });

                if (foundRows === 0) {
                    resultMessage.textContent = "Data tidak ditemukan";
                } else {
                    resultMessage.textContent = "";
                }
            }

            searchForm.addEventListener("submit", function(event) {
                event.preventDefault();
                filterRows();
            });

            searchInput.addEventListener("input", filterRows);
            filterRows();
        });
    </script>
</body>

<?= $this->endSection() ?>