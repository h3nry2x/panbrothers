<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Penduduk</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Penduduk</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">

          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title"><i class="fas fa-users"></i> Data Penduduk</h3>
              <div class="card-tools">
                <a id="add-penduduk" href="#" class="d-none d-inline-block btn btn-sm btn-primary btn-icon-split">
                  <span class="icon">
                    <i class="fas fa-plus-circle fa-sm text-white"></i>
                  </span>
                  <span class="text">Tambah Data</span>
                </a>
                <a id="cancle-penduduk" href="#" class="d-none btn btn-sm btn-danger btn-icon-split" style="display: none;">
                  <span class="icon">
                    <i class="fas fa-arrow-left fa-sm text-white-50"></i>
                  </span>
                  <span class="text">Kembali</span>
                </a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div id="penduduk-loader"></div>
              <div id="penduduk-alert"></div>
              <div id="penduduk-list" class="table-responsive"></div>
              <form id="penduduk-form" method="post"></form>
              <div id="penduduk-detail"></div>
              <div id="penduduk-delete"></div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->