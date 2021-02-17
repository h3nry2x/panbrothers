<script id="jquery-index">
    $(document).ready(function() {
        $('#jquery-index').remove();
        const base_url = '<?php echo base_url() ?>';
        const penduduktemplate = $('#penduduk-template').html();
        const penduduktbody = $('.penduduk-tbody').html();
        const pendudukformtemplate = $('#penduduk-form-template').html();
        const pendudukdetailtemplate = $('#penduduk-detail-template').html();
        const pendudukdetailtbody = $('.penduduk-detail-tbody').html();
        const pendudukdeletetemplate = $('#penduduk-delete-template').html();

        // SWEETALERT2
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 10000,
        });

        load_page();

        function load_page() {
            add_command();
            cancle_command();
            loader();
            penduduk_list();
            add_edit_penduduk();
        }

        function add_command() {
            $('#add-penduduk').click(function() {
                form_create();
            });
        }

        function cancle_command() {
            $('#cancle-penduduk').click(function() {
                $('#penduduk-form').html(null);
                $('#penduduk-detail').html(null);
                $('#penduduk-delete').html(null);
                $('#penduduk-list').slideDown();
                $('#cancle-penduduk').fadeOut().removeClass('d-inline-block');
                $('#add-penduduk').addClass('d-inline-block').fadeIn();
            });
        }

        function form_create() {
            var html = pendudukformtemplate;

            $('#penduduk-form').html(html);
            $('#penduduk-list').slideUp();
            $('#add-penduduk').fadeOut().removeClass('d-inline-block');
            $('#cancle-penduduk').addClass('d-inline-block').fadeIn();
        }

        function detail_create() {
            var html = pendudukdetailtemplate;

            $('#penduduk-detail').html(html);
            $('#penduduk-list').slideUp();
            $('#add-penduduk').fadeOut().removeClass('d-inline-block');
            $('#cancle-penduduk').addClass('d-inline-block').fadeIn();
        }

        function loader() {
            $('#penduduk-loader').html('<center><div class="spinner-border text-primary mb-4" role="status"><span class="sr-only">Loading...</span></div></center>').show();
            $('.form-submit').prop('disabled', true);
            $('.form-close').prop('disabled', true);
            $('.form-reset').prop('disabled', true);
        }

        function unloader() {
            $('#penduduk-loader').hide();
        }

        function penduduk_list() {
            $('#penduduk-list').html(penduduktemplate);
            $('#penduduk-list > .penduduk-table').DataTable({
                "serverSide": true,
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "language": {
                    "emptyTable": "Data Kosong",
                    "info": "Menampilkan _START_ - _END_ dari _TOTAL_ Penduduk",
                    "infoEmpty": "Menampilkan 0 - 0 dari 0 Penduduk",
                    "infoFiltered": "(Mencari dari _MAX_ Penduduk)",
                    "lengthMenu": "Menampilkan _MENU_ Penduduk",
                    "loadingRecords": "Memuat...",
                    "processing": "Memproses...",
                    "search": "Cari:",
                    "zeroRecords": "Tidak ada Penduduk yang cocok",
                    "paginate": {
                        "first": "Awal",
                        "last": "Akhir",
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    },
                    "aria": {
                        "sortAscending": ": aktif mengurutkan kolom terurut",
                        "sortDescending": ": aktif mengurutkan kolom terbalik"
                    },
                },
                "lengthMenu": [
                    [5, 10, 25, 50, 100],
                    [5, 10, 25, 50, 100]
                ],
                'columnDefs': [{
                    "targets": "_all", // your case first column
                    "className": "text-center align-middle",
                }, {
                    "orderable": false,
                    "targets": [0, 3]
                }, {
                    "width": "40%",
                    "targets": 2
                }],
                "ajax": {
                    url: base_url + 'Penduduk/penduduk_datatables',
                    type: 'POST',
                    dataType: 'JSON',
                    error: function() {
                        var html = '';
                        var template = penduduktemplate;
                        var el = penduduktbody;

                        $('#penduduk-list').html(template);
                        $('.penduduk-tbody').html("<tr><td colspan='4'>Daftar Penduduk Masih Kosong</td></tr>");
                        unloader();
                    }
                },
                "drawCallback": function(settings) {
                    unloader();
                    penduduk_data();
                    penduduk_detail();
                    delete_penduduk();
                }
            });
        }

        function penduduk_data() {
            $('.btn-update').click(function(e) {
                penduduk_data_load(e);
            });
        }

        function penduduk_data_load(e) {
            form_create();
            var id = e.currentTarget.dataset.id;
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Penduduk/get_penduduk') ?>",
                data: {
                    id: id
                },
                dataType: "JSON",
                async: false,
                cache: false,
                success: function(data) {
                    var html = '';

                    html += '<input id="id" type="hidden" name="id" value="' + data.id + '">';

                    $('#nik').val(data.nik);
                    $('#nama').val(data.nama);
                    $('#alamat').val(data.alamat);
                    if (data.jenis_kelamin == 'L') {
                        $('#jkl').prop('checked', true);
                    } else {
                        $('#jkp').prop('checked', true);
                    }

                    $('#hidden-penduduk-form').html(html);
                }
            });
            return false;
        }

        function penduduk_detail() {
            $('.btn-detail').click(function(e) {
                penduduk_detail_load(e);
            });
        }

        function penduduk_detail_load(e) {
            detail_create();

            var id = e.currentTarget.dataset.id;
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Penduduk/get_penduduk') ?>",
                data: {
                    id: id
                },
                dataType: "JSON",
                async: false,
                cache: false,
                success: function(data) {
                    var html = '';
                    var template = pendudukdetailtemplate;
                    var el = pendudukdetailtbody;

                    template = template.replace(/@id/g, data.id);

                    data.tanggalupdate == null ? update_date = '-' : update_date = data.tanggalupdate;
                    data.userupdate == null ? update_user = '-' : update_user = data.userupdate;

                    dom = el.replace('@nik', data.nik);
                    dom = dom.replace('@nama', data.nama);
                    dom = dom.replace('@alamat', data.alamat);
                    dom = dom.replace('@jk', data.jenis_kelamin);
                    dom = dom.replace('@createdate', data.tanggalinput);
                    dom = dom.replace('@createuser', data.userinput);
                    dom = dom.replace('@updatedate', update_date);
                    dom = dom.replace('@updateuser', update_user);


                    html = html + dom;

                    $('#penduduk-detail').html(template);
                    $('.penduduk-detail-tbody').html(html);

                    btn_update(data);
                    btn_delete(data);
                }
            });
            return false;
        }

        function add_edit_penduduk() {
            $("#penduduk-form").submit(function(e) {
                e.preventDefault();
                var nik = $('#nik').val();
                if (nik.length < 16) {
                    toastr.error('Masukkan NIK dengan format 16 Digit');
                } else if (nik.length > 16) {
                    toastr.error('Masukkan NIK dengan format 16 Digit');
                } else {

                    var formdata = $('#penduduk-form').serialize();
                    loader();
                    $.ajax({
                        type: "POST",
                        url: "<?php echo site_url('Penduduk/add_new_penduduk') ?>",
                        dataType: "JSON",
                        data: formdata,
                        success: function(data) {
                            $('#cancle-penduduk').trigger('click');
                            penduduk_list();
                            if (data.success == 1) {
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Penduduk Berhasil Ditambahkan'
                                });
                            } else if (data.success == 2) {
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Penduduk Berhasil Diupdate'
                                });
                            }
                        },
                        error: function() {
                            toastr.error('Oops! Terjadi kesalahan.');
                        }
                    });
                    return false;

                }

            });
        };

        function delete_penduduk() {
            $('.btn-delete').click(function(e) {
                delete_penduduk_load(e)
            });
        }

        function delete_penduduk_load(e) {
            var html = pendudukdeletetemplate;

            $('#penduduk-delete').html(html);
            $('#penduduk-list').slideUp();
            $('#add-penduduk').fadeOut().removeClass('d-inline-block');
            $('#cancle-penduduk').addClass('d-inline-block').fadeIn();

            $('.btn-cancle').click(function() {
                $('#cancle-penduduk').trigger('click');
            });

            var id = e.currentTarget.dataset.id;
            $('.btn-confirm').click(function() {
                loader();
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('Penduduk/delete_penduduk') ?>",
                    data: {
                        id: id
                    },
                    dataType: "JSON",
                    success: function(data) {
                        $('#cancle-penduduk').trigger('click');
                        Toast.fire({
                            icon: 'success',
                            title: 'Penduduk Berhasil Dihapus'
                        });

                        penduduk_list();
                    }
                });
                return false;
            });
        }

        function btn_update(data) {
            $('.btn-update').click(function(e) {
                var html = pendudukformtemplate;

                $('#penduduk-form').html(html);
                $('#penduduk-detail').html(null);

                var html = '';

                html += '<input id="id" type="hidden" name="id" value="' + data.id + '">' +

                $('#nik').val(data.nik);
                $('#nama').val(data.nama);
                $('#alamat').val(data.alamat);
                if (data.jenis_kelamin == 'L') {
                    $('#jkl').prop('checked', true);
                } else {
                    $('#jkp').prop('checked', true);
                }

                $('#hidden-penduduk-form').html(html);
            });
        }

        function btn_delete(data) {
            $('.btn-delete').click(function(e) {
                var id = e.currentTarget.dataset.id;

                var html = pendudukdeletetemplate;

                $('#penduduk-delete').html(html);
                $('#penduduk-detail').html(null);
                $('.btn-cancle').click(function() {
                    $('#cancle-penduduk').trigger('click');
                });

                $('.btn-confirm').click(function() {
                    loader();
                    $.ajax({
                        type: "POST",
                        url: "<?php echo site_url('Penduduk/delete_penduduk') ?>",
                        data: {
                            id: id
                        },
                        dataType: "JSON",
                        success: function(data) {
                            $('#cancle-penduduk').trigger('click');
                            Toast.fire({
                                icon: 'success',
                                title: 'Penduduk Berhasil Dihapus'
                            });

                            penduduk_list();
                        }
                    });
                    return false;
                });
            });
        }
    });
</script>