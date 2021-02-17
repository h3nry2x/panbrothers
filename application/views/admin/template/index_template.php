<div class="container-fluid" style="display: none">
    <!-- PENDUDUK LIST -->
    <div id="penduduk-template">
        <table class="table penduduk-table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead class="text-white bg-primary">
                <tr>
                    <th>#</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody class="penduduk-tbody">

            </tbody>
        </table>
    </div>

    <div id="penduduk-form-template">
        <div id="hidden-penduduk-form" style="display:none"></div>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <span>NIK</span>
                    </div>
                </div>
                <input id="nik" type="number" name="nik" class="form-control" required placeholder="NIK">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-credit-card"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <span>Nama</span>
                    </div>
                </div>
                <input id="nama" type="text" name="nama" class="form-control" required placeholder="Nama">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <span>Alamat</span>
                    </div>
                </div>
                <textarea name="alamat" id="alamat" class="form-control" cols="1" rows="3" required placeholder="Alamat"></textarea>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-home"></span>
                    </div>
                </div>
            </div>
        </div>
        <strong>
            <p>Jenis Kelamin</p>
        </strong>
        <div class="form-group">
            <div class="form-check form-check-inline">
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="jkl" name="jenis_kelamin" required value="L">
                    <label for="jkl" class="custom-control-label">L</label>
                </div>
            </div>
            <div class="form-check form-check-inline">
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="jkp" name="jenis_kelamin" value="P">
                    <label for="jkp" class="custom-control-label">P</label>
                </div>
            </div>
        </div>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <button type="reset" class="btn form-reset btn-success btn-circle btn-lg"><i class="fas fa-recycle"></i></button>
            <button type="submit" class="btn form-submit btn-primary btn-circle btn-lg"><i class="fas fa-check"></i></button>
        </div>
    </div>

    <div id="penduduk-detail-template">
        <div id="penduduk-toolbar" class="d-sm-flex align-items-center justify-content-between mb-4 py-3">
            <a href="#" class="btn btn-update btn-success btn-icon-split btn-sm" data-id="@id">
                <span class="icon text-white-50"><i class="fas fa-cog"></i></span>
                <span class="text">Update</span>
            </a>
            <a href="#" class="btn btn-delete btn-danger btn-icon-split btn-sm" data-id="@id">
                <span class="icon text-white-50"><i class="fas fa-cog"></i></span>
                <span class="text">Hapus</span>
            </a>
        </div>
        <table class="table penduduk-detail-table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
            <tbody class="penduduk-detail-tbody">
                <tr>
                    <th>NIK</th>
                    <td>@nik</td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td>@nama</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>@alamat</td>
                </tr>
                <tr>
                    <th>Jenis Kelamin</th>
                    <td>@jk</td>
                </tr>
                <tr>
                    <th>Tanggal Input</th>
                    <td>@createdate</td>
                </tr>
                <tr>
                    <th>User Input</th>
                    <td>@createuser</td>
                </tr>
                <tr>
                    <th>Tanggal Update</th>
                    <td>@updatedate</td>
                </tr>
                <tr>
                    <th>User Update</th>
                    <td>@updateuser</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div id="penduduk-delete-template">
        <center>
            <blockquote>
                <h3><em><strong>Peringatan!</strong> Apakah anda yakin ingin menghapus data?</em></h3>
            </blockquote>
        </center>
        <button type="button" class="btn btn-confirm btn-danger btn-block btn-lg"><span>Hapus</span></button>
        <button type="button" class="btn btn-cancle btn-success btn-block btn-lg"><span>Batalkan</span></button>
    </div>

    <!-- DATA ZERO -->
    <div id="data-zero">
        <div class="alert alert-info" style="width: 100%;">
            <marquee direction="down" height="80px" behavior="alternate" style="opacity: 1.0">
                <marquee behavior="alternate" direction="right">
                    <h5 style="color: red"><i class="icon fas fa-info"></i> Data Kosong</h5>
                </marquee>
            </marquee>
        </div>
    </div>
</div>