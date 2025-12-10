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
                        <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                        <input type="text" class="form-control" placeholder="Type here...">
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
                        <h5>Form Edit</h5>

                        <div class="card-body px-0 pt-0 pb-2">
                            <form action="" method="post" id="text-editor">
                                <input type="hidden" name="id" value="<?= $table2b6['id'] ?>" />

                                <div class="form-group mb-3">
                                    <label for="jenis_kemampuan">Jenis Kemampuan</label>
                                    <input type="text" name="jenis_kemampuan" class="form-control"
                                        value="<?= $table2b6['jenis_kemampuan'] ?>" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="sangat_baik">Sangat Baik</label>
                                    <input type="number" name="sangat_baik" class="form-control"
                                        value="<?= $table2b6['sangat_baik'] ?>" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="baik">Baik</label>
                                    <input type="number" name="baik" class="form-control"
                                        value="<?= $table2b6['baik'] ?>" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="cukup">Cukup</label>
                                    <input type="number" name="cukup" class="form-control"
                                        value="<?= $table2b6['cukup'] ?>" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="kurang">Kurang</label>
                                    <input type="number" name="kurang" class="form-control"
                                        value="<?= $table2b6['kurang'] ?>" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="rencana_tindak">Rencana Tindak Lanjut</label>
                                    <input type="text" name="rencana_tindak" class="form-control"
                                        value="<?= $table2b6['rencana_tindak'] ?>" required>
                                </div>

                                <div class="form-group">
                                    <button type="submit" name="status" value="simpan" class="btn btn-primary">Simpan</button>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
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