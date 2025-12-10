<?= $this->extend('layout/admin/layout') ?>

<?= $this->section('content') ?>

<main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
                    <li class="breadcrumb-item text-sm text-white active" aria-current="page">Tables</li>
                </ol>
                <h3 class="font-weight-bolder text-white mb-0">Tables</h3>
            </nav>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                    <div class="input-group">
                        <form action="<?= base_url('table/table2b6/cari') ?>" method="GET" id="searchForm">
                            <span class="input-group-text text-body"><input type="search" id="searchInput" name="search" placeholder="Cari berdasarkan keterangan.." /><i class="fas fa-search" aria-hidden="true"></i></span>
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
                        <h5>Tabel 2.b.6</h5>
                        <h6>Morenno Rafael 240611059</h6>
                        <!-- button tambah -->
                        <button type="button" class="btn bg-gradient-success btn-block mb-3" data-bs-toggle="modal" data-bs-target="#modalCreate">
                            Tambah Data
                        </button>
                        <br>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table table-hover align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Jenis Kemampuan</th>
                                        <th class="text-center">Sangat Baik</th>
                                        <th class="text-center">Baik</th>
                                        <th class="text-center">Cukup</th>
                                        <th class="text-center">Kurang</th>
                                        <th class="text-center">Rencana Tindak</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $no = 1;
                                    foreach ($table2b6 as $row): ?>
                                        <tr>
                                            <td class="text-center"><?= $no ?></td>
                                            <td class="text-center"><?= $row['jenis_kemampuan'] ?></td>
                                            <td class="text-center"><?= $row['sangat_baik'] ?></td>
                                            <td class="text-center"><?= $row['baik'] ?></td>
                                            <td class="text-center"><?= $row['cukup'] ?></td>
                                            <td class="text-center"><?= $row['kurang'] ?></td>
                                            <td class="text-center"><?= $row['rencana_tindak'] ?></td>

                                            <td class="text-center">
                                                <a href="<?= base_url('table/table2b6/' . $row['id'] . '/edit') ?>"
                                                    class="btn bg-gradient-info">
                                                    Edit
                                                </a>

                                                <a href="#" data-href="<?= base_url('table/table2b6/' . $row['id'] . '/delete') ?>"
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
                                        <div class="modal-body">Apakah Anda yakin ingin menghapus data ini?</div>
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

                            <!-- Modal Tambah -->
                            <div class="modal fade" id="modalCreate" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered modal-md">
                                    <div class="modal-content">
                                        <div class="modal-body p-0">
                                            <div class="card card-plain">
                                                <div class="card-header pb-0">
                                                    <h3 class="font-weight-bolder text-primary">Tambah Data</h3>
                                                </div>

                                                <div class="card-body pb-3">
                                                    <form action="<?= base_url('table/table2b6/new') ?>" method="post">

                                                        <label>Jenis Kemampuan</label>
                                                        <input type="text" class="form-control mb-3" name="jenis_kemampuan">

                                                        <label>Sangat Baik</label>
                                                        <input type="number" class="form-control mb-3" name="sangat_baik">

                                                        <label>Baik</label>
                                                        <input type="number" class="form-control mb-3" name="baik">

                                                        <label>Cukup</label>
                                                        <input type="number" class="form-control mb-3" name="cukup">

                                                        <label>Kurang</label>
                                                        <input type="number" class="form-control mb-3" name="kurang">

                                                        <label>Rencana Tindak</label>
                                                        <input type="text" class="form-control mb-3" name="rencana_tindak">

                                                        <button type="submit" class="btn bg-gradient-primary w-100 mt-4">Tambah</button>
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
                    const kategoriText = cells[1].textContent.toLowerCase();                    // Ubah sesuai dengan indeks kolom yang berisi kategori

                    if (kategoriText.includes(searchText)) {
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