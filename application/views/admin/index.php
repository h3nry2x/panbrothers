<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Gudang</h1>
  </div>

  <!-- DataTales Example -->
  <div class="card shadow mb-4 overflow-hidden sm:rounded-lg">
    <div class="card-header d-sm-flex align-items-center justify-content-between mb-4 py-3">
      <h6 class="m-0 font-weight-bold text-primary">Data Gudang</h6>
      <a id="add-warehouse" href="#" class="d-none d-inline-block btn btn-sm btn-primary btn-icon-split shadow-sm">
        <span class="icon">
          <i class="fas fa-plus-circle fa-sm text-white-50"></i>
        </span>
        <span class="text">Tambah Data</span>
      </a>
      <a id="cancle-warehouse" href="#" class="d-none btn btn-sm btn-danger btn-icon-split shadow-sm" style="display: none;">
        <span class="icon">
          <i class="fas fa-arrow-left fa-sm text-white-50"></i>
        </span>
        <span class="text">Kembali</span>
      </a>
    </div>
    <div class="card-body">
      <div id="warehouse-loader"></div>
      <div id="warehouse-alert"></div>
      <div id="warehouse-list" class="table-responsive"></div>
      <div id="warehouse-barcode" style="display: none;"></div>
      <div id="warehouse-barcode-style" style="display: none;"></div>
      <form id="warehouse-form" method="post"></form>
      <div id="warehouse-detail"></div>
      <div id="warehouse-delete"></div>
    </div>
  </div>

</div>