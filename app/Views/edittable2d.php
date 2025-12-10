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
                <h3 class="font-weight-bolder text-white mb-0">Edit Table 2.C</h3>
            </nav>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                    <!-- Search bar dihapus atau dibiarkan statis karena ini halaman edit -->
                </div>
            </div>
        </div>
    </nav>

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-0">
                    <div class="card-header pb-0">
                        <h5>Form Edit Data Mahasiswa (TS)</h5>

                        <div class="card-body px-0 pt-0 pb-2">
                            <!-- Action dikosongkan agar submit ke URL saat ini (controller edit) -->
                            <form action="" method="post" id="text-editor">

                                <input type="hidden" name="id" value="<?= $table2d['no'] ?>" />

                                <div class="form-group mb-3">
                                    <label for="sumber_rekognisi">Sumber Rekognisi</label>
                                    <input type="text" name="sumber_rekognisi" class="form-control"
                                        value="<?= $table2d['sumber_rekognisi'] ?>" placeholder="Sumber Rekognisi" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="jenis_pengakuan_lulusan">Jenis Pengakuan Lulusan</label>
                                    <input type="text" name="jenis_pengakuan_lulusan" class="form-control"
                                        value="<?= $table2d['jenis_pengakuan_lulusan'] ?>" placeholder="Jenis Pengakuan" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="tahun_akademik">Tahun Akademik</label>
                                    <input type="number" name="tahun_akademik" class="form-control"
                                        value="<?= $table2d['tahun_akademik'] ?>" placeholder="2024" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="link_bukti">Link Bukti</label>
                                    <input type="text" name="link_bukti" class="form-control"
                                        value="<?= $table2d['link_bukti'] ?>" placeholder="https://...">
                                </div>

                                <div class="form-group mt-4">
                                    <button type="submit" name="status" value="simpan" class="btn btn-primary">Simpan Perubahan</button>
                                    <a href="<?= base_url('table/table2d') ?>" class="btn btn-secondary">Batal</a>
                                </div>

                            </form>
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
</body>

<?= $this->endSection() ?>