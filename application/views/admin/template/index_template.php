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
                    <input class="custom-control-input" type="radio" id="jkl" name="jenis_kelamin" required>
                    <label for="jkl" class="custom-control-label">L</label>
                </div>
            </div>
            <div class="form-check form-check-inline">
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="jkp" name="jenis_kelamin">
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
        <div id="warehouse-toolbar" class="d-sm-flex align-items-center justify-content-between mb-4 py-3">
            <a href="#" class="btn btn-update btn-success btn-icon-split btn-sm" data-id="@id">
                <span class="icon text-white-50"><i class="fas fa-cog"></i></span>
                <span class="text">Update</span>
            </a>
            <a href="#" class="btn btn-delete btn-danger btn-icon-split btn-sm" data-id="@id">
                <span class="icon text-white-50"><i class="fas fa-cog"></i></span>
                <span class="text">Hapus</span>
            </a>
        </div>
        <div class="shadow overflow-x-auto border-2 border-blue-500 border-opacity-25 mb-4 sm:rounded-lg">
            <table class="warehouse-detail-table min-w-full divide-y divide-gray-200" id="dataTable" width="100%" cellspacing="0">
                <tbody class="warehouse-detail-tbody divide-y divide-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">Kode Barang</th>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">@item_code</td>
                    </tr>
                    <tr>
                        <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">Barcode</th>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">@barcode</td>
                    </tr>
                    <tr>
                        <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">Nama Barang</th>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">@item</td>
                    </tr>
                    <tr>
                        <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">Satuan</th>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">@satuan</td>
                    </tr>
                    <tr>
                        <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">Tipe Satuan</th>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">@tipe_satuan</td>
                    </tr>
                    <tr>
                        <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">Harga Beli per Satuan (1 Unit)</th>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">@buy_price</td>
                    </tr>
                    <tr>
                        <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">Stok Gudang</th>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">@stock</td>
                    </tr>
                    <tr>
                        <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">Tanggal Ditambahkan</th>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">@create_date</td>
                    </tr>
                    <tr>
                        <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">Tanggal Terakhir Diubah</th>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">@update_date</td>
                    </tr>
                </tbody>
            </table>
        </div>
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