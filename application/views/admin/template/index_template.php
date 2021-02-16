<div class="container-fluid" style="display: none">
    <div id="style">
        <style>
            @media print {
                @page {
                    size: 50mm 25mm;
                    margin: 0;
                    padding: 0;
                }

                html,
                body {
                    position: relative;
                    width: 100%;
                    height: 100%;
                    max-width: 100%;
                    max-height: 100%;
                    margin: 0;
                    padding: 0;
                }

                img {
                    width: 100%;
                    height: 100%;
                    max-width: 100%;
                    max-height: 100%;
                }
            }
        </style>
    </div>
    <!-- warehouse LIST -->
    <div id="warehouse-template">
        <table class="table warehouse-table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead class="text-white bg-primary">
                <tr>
                    <th>#</th>
                    <th>Barang</th>
                    <th>Harga Beli</th>
                    <th>Stok</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody class="warehouse-tbody">

            </tbody>
        </table>
    </div>

    <div id="warehouse-form-template">
        <div id="hidden-warehouse-form" style="display:none"></div>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <span>Barang</span>
                    </div>
                </div>
                <input id="nama-barang" type="text" name="nama_barang" class="form-control" required placeholder="Nama Barang">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-paper-plane"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <span>Satuan</span>
                    </div>
                </div>
                <select name="id_satuan" id="id-satuan" required class="form-control">
                    <option value="-1">Pilih Satuan</option>
                </select>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-cube"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <span>Harga Beli</span>
                    </div>
                    <div class="input-group-text">
                        <span>Rp</span>
                    </div>
                </div>
                <input id="harga-beli" type="number" name="harga_beli" class="form-control" min="0" required value="0" placeholder="Harga Beli">
            </div>
        </div>
        <div class="harga-beli-alert"></div>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <span>Stok</span>
                    </div>
                </div>
                <input id="stok" type="number" name="stok" class="form-control" min="0" step=".1" required value="0" placeholder="Stok">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-hourglass-end"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-check">
            <input class="form-check-input" name="isvalid" type="checkbox" value="1" id="isvalid">
            <label class="form-check-label" for="isvalid">
                Validasi Data Sekarang
            </label>
        </div>
        <div class="stok-alert"></div>
        <label><strong>Perubahan Stok : </strong><b id="est-stock"></b></label>
        <br>
        <label><strong>Estimasi Biaya : </strong><b id="est-buy"></b></label>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <button type="reset" class="btn form-reset btn-success btn-circle btn-lg"><i class="fas fa-recycle"></i></button>
            <button type="submit" class="btn form-submit btn-primary btn-circle btn-lg"><i class="fas fa-check"></i></button>
        </div>
    </div>

    <div id="warehouse-stok-template">
        <div id="hidden-warehouse-form" style="display:none"></div>
        <div class="stock-change">
            <div class="alert alert-info"><strong>Transaksi Stok</strong></div>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span>Harga Beli</span>
                        </div>
                        <div class="input-group-text">
                            <span>Rp</span>
                        </div>
                    </div>
                    <input id="harga-beli" type="number" name="harga_beli" class="form-control" min="0" required value="0" placeholder="Harga Beli">
                </div>
            </div>
            <div class="harga-beli-alert"></div>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span>Stok</span>
                        </div>
                    </div>
                    <input id="stok" type="number" name="stok" class="form-control" min="0" step=".1" required value="0" placeholder="Stok">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-hourglass-end"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-check">
                <input class="form-check-input" name="isvalid" type="checkbox" value="1" id="isvalid">
                <label class="form-check-label" for="isvalid">
                    Validasi Data Sekarang
                </label>
            </div>
            <div class="stok-alert"></div>
            <label><strong>Perubahan Stok : </strong><b id="est-stock"></b></label>
            <br>
            <label><strong>Estimasi Biaya : </strong><b id="est-buy"></b></label>
        </div>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <button type="reset" class="btn form-reset btn-success btn-circle btn-lg"><i class="fas fa-recycle"></i></button>
            <button type="button" class="btn form-close btn-remove btn-danger btn-circle btn-lg"><i class="fas fa-times"></i></button>
            <button type="submit" class="btn form-submit btn-primary btn-circle btn-lg"><i class="fas fa-check"></i></button>
        </div>
    </div>

    <div id="warehouse-detail-template">
        <div id="warehouse-toolbar" class="d-sm-flex align-items-center justify-content-between mb-4 py-3">
            <a href="#" class="btn btn-update btn-success btn-icon-split btn-sm" data-id="@id">
                <span class="icon text-white-50"><i class="fas fa-cog"></i></span>
                <span class="text">Update</span>
            </a>
            <a href="#" class="btn btn-stok btn-warning btn-icon-split btn-sm" data-id="@id">
                <span class="icon text-white-50"><i class="fas fa-briefcase"></i></span>
                <span class="text">Stok Opname</span>
            </a>
            <a href="#" class="btn btn-barcode btn-info btn-icon-split btn-sm" data-id="@id">
                <span class="icon text-white-50"><i class="fas fa-barcode"></i></span>
                <span class="text">Cetak Barcode</span>
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
        <div class="card shadow mb-4 overflow-hidden border-2 border-blue-500 border-opacity-25 sm:rounded-lg">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Riwayat Stok Opname</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div id="warehouse-stokopname-list" class="table-responsive"></div>
            </div>
        </div>
        <div class="card shadow mb-4 overflow-hidden border-2 border-blue-500 border-opacity-25 sm:rounded-lg">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Riwayat Harga Beli</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="chart-harga"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div id="warehouse-stokopname-template">
        <table class="table warehouse-stokopname-table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead class="text-white bg-primary">
                <tr>
                    <th>#</th>
                    <th>Waktu</th>
                    <th>Harga Beli</th>
                    <th>Stok</th>
                    <th>Validasi</th>
                </tr>
            </thead>
            <tbody class="warehouse-stokopname-tbody">

            </tbody>
        </table>
    </div>

    <div id="warehouse-delete-template">
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