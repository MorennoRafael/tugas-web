<?= $this->extend('layout/admin/layout') ?>

<?= $this->section('content') ?>

<main class="main-content position-relative border-radius-lg ">
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
                    <li class="breadcrumb-item text-sm text-white active" aria-current="page">Tables</li>
                </ol>
                <h3 class="font-weight-bolder text-white mb-0">Table 2.C</h3>
            </nav>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                    <div class="input-group">
                        <form action="<?= base_url('table/table2c/cari') ?>" method="GET" id="searchForm">
                            <span class="input-group-text text-body"><input type="search" id="searchInput" name="search" placeholder="Cari data..." /><i class="fas fa-search" aria-hidden="true"></i></span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-0">
                    <div class="card-header pb-0">
                        <h5>Table 2.d</h5>
                        <h6>Muhamad Yasir 240611093</h6>

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
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder ">No</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder ">Sumber Rekognisi</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder ">Jenis Pengakuan Lulusan</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder ">Tahun Akademik</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder ">Link Bukti</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder ">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $no = 1;
                                    foreach ($table2d as $row): ?>
                                        <tr>
                                            <td class="text-center">
                                                <p class="mb-0 text-sm"><?= $no; ?></p>
                                            </td>

                                            <td class="text-center">
                                                <p class="mb-0 text-sm"><?= $row['sumber_rekognisi'] ?></p>
                                            </td>

                                            <td class="text-center">
                                                <p class="mb-0 text-sm"><?= $row['jenis_pengakuan_lulusan'] ?></p>
                                            </td>

                                            <td class="text-center">
                                                <p class="mb-0 text-sm"><?= $row['tahun_akademik'] ?></p>
                                            </td>

                                            <td class="text-center">
                                                <p class="mb-0 text-sm text-truncate" style="max-width: 150px;">
                                                    <a href="<?= $row['link_bukti'] ?>" target="_blank"><?= $row['link_bukti'] ?></a>
                                                </p>
                                            </td>

                                            <td class="text-center">
                                                <a href="<?= base_url('table/table2d/' . $row['no'] . '/edit') ?>" class="btn bg-gradient-info btn-sm">Edit</a>
                                                <a href="#" data-href="<?= base_url('table/table2d/' . $row['no'] . '/delete') ?>" onclick="confirmToDelete(this)" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#confirm-dialog">Hapus</a>
                                            </td>
                                        </tr>
                                    <?php $no++;
                                    endforeach ?>
                                </tbody>
                            </table>

                            <div id="resultMessage" class="result-message text-center"></div>

                            <div class="modal fade" id="confirm-dialog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda yakin ingin menghapus data ini?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="button" class="btn btn-danger" onclick="deleteData()">Hapus</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script>
                                function confirmToDelete(element) {
                                    var deleteButton = document.getElementById('confirm-dialog').querySelector('.btn-danger');
                                    deleteButton.setAttribute('data-href', element.getAttribute('data-href'));
                                }

                                function deleteData() {
                                    var deleteUrl = document.getElementById('confirm-dialog').querySelector('.btn-danger').getAttribute('data-href');

                                    window.location.href = deleteUrl;
                                }
                            </script>

                            <!-- Modal Tambah Data -->
                            <div class="modal fade" id="modalCreate" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered modal-md">
                                    <div class="modal-content">
                                        <div class="modal-body p-0">
                                            <div class="card card-plain">
                                                <div class="card-header pb-0 text-left">
                                                    <h3 class="font-weight-bolder text-primary text-gradient">Tambah Data Table 2D</h3>
                                                    <p class="mb-0">Masukkan data yang anda inginkan</p>
                                                </div>

                                                <div class="card-body pb-3">
                                                    <form action="<?= base_url('table/table2d/new') ?>" method="post">

                                                        <label>Sumber Rekognisi</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control" name="sumber_rekognisi" required>
                                                        </div>

                                                        <label>Jenis Pengakuan Lulusan</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control" name="jenis_pengakuan_lulusan" required>
                                                        </div>

                                                        <label>Tahun Akademik</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control" name="tahun_akademik" placeholder="2023/2024" required>
                                                        </div>

                                                        <label>Link Bukti</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control" name="link_bukti" placeholder="https://..." required>
                                                        </div>

                                                        <button type="submit" class="btn bg-gradient-primary btn-lg btn-rounded w-100 mt-4 mb-0">Simpan Data</button>

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
        </div>
</main>

<body class="g-sidenav-show bg-primary">
    <div class="min-height-300 bg-gray-100 position-absolute w-100"></div>

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
                    // Index 2 biasanya adalah 'Jenis Pembelajaran' pada layout ini
                    if (cells.length > 2) {
                        const kategoriText = cells[1].textContent.toLowerCase();

                        if (kategoriText.includes(searchText)) {
                            row.style.display = "";
                            foundRows++;
                        } else {
                            row.style.display = "none";
                        }
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