<script id="jquery-warehouse">
    $(document).ready(function() {
        $('#jquery-warehouse').remove();
        const base_url = '<?php echo base_url() ?>';
        const warehousetemplate = $('#warehouse-template').html();
        const warehousetbody = $('.warehouse-tbody').html();
        const warehouseformtemplate = $('#warehouse-form-template').html();
        const warehousestoktemplate = $('#warehouse-stok-template').html();
        const warehousedetailtemplate = $('#warehouse-detail-template').html();
        const warehousedetailtbody = $('.warehouse-detail-tbody').html();
        const warehousestokopnametemplate = $('#warehouse-stokopname-template').html();
        const warehousestokopnametbody = $('.warehouse-stokopname-tbody').html();
        const warehousedeletetemplate = $('#warehouse-delete-template').html();
        const warehousestyletemplate = $('#style').html();

        // SWEETALERT2
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 10000,
        });

        load_page();

        function load_page() {
            app_config();
            add_command();
            cancle_command();
            loader();
            warehouse_list();
            add_edit_warehouse();
        }

        function app_config() {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Admin/get_aplikasi') ?>",
                dataType: "JSON",
                success: function(data) {
                    $('title').html(data.title);
                    $('.sidebar-brand-text').html(data.icon_caption);
                    $('.copyright').html('<span>' + data.footer + '</span>');
                }
            });
            return false;
        }

        function add_command() {
            $('#add-warehouse').click(function(e) {
                form_create();
                dropdown_satuan(e);

                $('#harga-beli,#harga-jual,#stok').on('change', function() {
                    old_stok = parseInt(0);
                    old_buy = parseInt(0);
                    stok = parseInt($('#stok').val());
                    stok_off = stok - old_stok;
                    bp = parseInt($('#harga-beli').val());
                    sp = parseInt($('#harga-jual').val());

                    if (old_buy == bp) {
                        est_buy = (bp * stok_off).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                        est_profit = ((sp * stok_off) - (bp * stok_off)).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                    } else {
                        est_buy = (bp * stok_off).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                        est_profit = (((old_buy * old_stok) + (sp * stok_off)) - ((old_buy * old_stok) + (bp * stok_off))).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                    }
                    stok_off >= 0 ? $('#est-stock').html('+' + stok_off) : $('#est-stock').html(stok_off);
                    $('#est-buy').html('Rp. ' + est_buy + ',-');
                    $('#est-profit').html('Rp. ' + est_profit + ',-');
                });
            });
        }

        function cancle_command() {
            $('#cancle-warehouse').click(function() {
                $('#warehouse-form').html(null);
                $('#warehouse-detail').html(null);
                $('#warehouse-delete').html(null);
                $('#warehouse-list').slideDown();
                $('#cancle-warehouse').fadeOut().removeClass('d-inline-block');
                $('#add-warehouse').addClass('d-inline-block').fadeIn();
            });
        }

        function form_create() {
            var html = warehouseformtemplate;

            $('#warehouse-form').html(html);
            $('#warehouse-list').slideUp();
            $('#add-warehouse').fadeOut().removeClass('d-inline-block');
            $('#cancle-warehouse').addClass('d-inline-block').fadeIn();

            $('#est-stock').html('0');
            $('#est-buy').html('Rp. 0,-');
        }

        function detail_create() {
            var html = warehousedetailtemplate;

            $('#warehouse-detail').html(html);
            $('#warehouse-list').slideUp();
            $('#add-warehouse').fadeOut().removeClass('d-inline-block');
            $('#cancle-warehouse').addClass('d-inline-block').fadeIn();
        }

        function loader() {
            $('#warehouse-loader').html('<center><div class="spinner-border text-primary mb-4" role="status"><span class="sr-only">Loading...</span></div></center>').show();
            $('.form-submit').prop('disabled', true);
            $('.form-close').prop('disabled', true);
            $('.form-reset').prop('disabled', true);
        }

        function unloader() {
            $('#warehouse-loader').hide();
        }

        function warehouse_list() {
            $('#warehouse-list').html(warehousetemplate);
            $('#warehouse-list > .warehouse-table').DataTable({
                "serverSide": true,
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "language": {
                    "emptyTable": "Data Kosong",
                    "info": "Menampilkan _START_ - _END_ dari _TOTAL_ Barang Gudang",
                    "infoEmpty": "Menampilkan 0 - 0 dari 0 Barang Gudang",
                    "infoFiltered": "(Mencari dari _MAX_ Total Barang Gudang)",
                    "lengthMenu": "Menampilkan _MENU_ Barang Gudang",
                    "loadingRecords": "Memuat...",
                    "processing": "Memproses...",
                    "search": "Cari:",
                    "zeroRecords": "Tidak ada Barang Gudang yang cocok",
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
                    "targets": [0, 4]
                }, {
                    "width": "40%",
                    "targets": 1
                }],
                "ajax": {
                    url: base_url + 'Admin/warehouse_datatables',
                    type: 'POST',
                    dataType: 'JSON',
                    error: function() {
                        var html = '';
                        var template = warehousetemplate;
                        var el = warehousetbody;

                        $('#warehouse-list').html(template);
                        $('.warehouse-tbody').html("<tr><td colspan='5'>Daftar Barang Gudang Masih Kosong</td></tr>");
                        unloader();
                    }
                },
                "drawCallback": function(settings) {
                    unloader();
                    warehouse_barcode();
                    warehouse_data();
                    warehouse_detail();
                    delete_warehouse();
                }
            });
        }

        function warehouse_barcode() {
            $('.btn-print').click(function(e) {
                barcode_config(e);
            });
        }

        function barcode_config(e) {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Admin/get_barcode_config') ?>",
                dataType: "JSON",
                success: function(data) {
                    config = data
                    warehouse_barcode_load(e,config)                
                }
            });

            return false;
        }

        function warehouse_barcode_load(e,config) {
            var html = '<img id="barcode-item" style="width:'+ config.holder_width +'mm; height: '+ config.holder_height +'mm"/>';
            var id = e.currentTarget.dataset.id;
            var nama_barang = e.currentTarget.dataset.nama_barang;
            var barcode = e.currentTarget.dataset.barcode;

            var el = warehousestyletemplate;
            dom = el.replace('paper_width', config.paper_width);
            dom = dom.replace('paper_height', config.paper_height);
            dom = dom.replace('paper_margin', config.margin);
            dom = dom.replace('paper_padding', config.padding);

            $('#warehouse-barcode-style').html(dom);

            $('#warehouse-barcode').html(html);

            if(config.barcode_text == 1){
                text = 'GUDANG/'+ barcode;
            } else {
                text = 'GUDANG/'+ nama_barang.toUpperCase();
            }

            JsBarcode("#barcode-item", barcode, {
                format: config.barcode_format,
                text: text,
                width: config.barcode_width,
                height: config.barcode_height,
                fontSize: config.barcode_fontsize,
                background: config.barcode_background,
                font: config.barcode_font,
                fontOptions: config.barcode_fontoptions,
                lineColor: config.barcode_linecolor,
                textMargin: config.barcode_textmargin,
                textAlign: config.barcode_textalign,
                textPosition: config.barcode_textposition,
                marginLeft: parseInt(config.barcode_marginleft),
                marginRight: parseInt(config.barcode_marginright),
                marginTop: parseInt(config.barcode_margintop),
                marginBottom: parseInt(config.barcode_marginbottom),
            });

            jQuery('#barcode-item').print();

        }

        function warehouse_data() {
            $('.btn-update').click(function(e) {
                warehouse_data_load(e);
            });

            //DATATABLES GLITCH HANDLER
            // $('.warehouse-table').on('click', '.btn-update', function(e) {
            //     warehouse_data_load(e);
            // });
        }

        function warehouse_data_load(e) {
            form_create();
            var id = e.currentTarget.dataset.id;
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Admin/get_warehouse') ?>",
                data: {
                    id: id
                },
                dataType: "JSON",
                async: false,
                cache: false,
                success: function(data) {
                    var html = '';

                    html += '<input id="id" type="hidden" name="id" value="' + data.id + '">' +
                        '<input id="id_detail_warehouse" type="hidden" name="id_detail_warehouse" value="' + data.id_detail_warehouse + '">' +
                        '<input id="old-stok" type="hidden" name="old_stok" value="' + data.stok + '">' +
                        '<input id="old-harga-jual" type="hidden" name="old_harga_beli" value="' + data.harga_beli + '">';

                    $('#nama-barang').val(data.nama_barang);
                    dynamic_dropdown_satuan(data.id_satuan, data.nama_satuan);
                    $('#harga-beli').val(data.harga_beli);
                    $('#stok').val(data.stok);

                    $('#est-stock').html('0');
                    $('#est-buy').html('Rp. 0,-');

                    $('#hidden-warehouse-form').html(html);

                    $('#harga-beli,#stok').on('change', function() {
                        old_stok = parseInt(data.stok);
                        old_buy = parseInt(data.harga_beli);
                        stok = parseInt($('#stok').val());
                        stok_offset = stok - old_stok;
                        bp = parseInt($('#harga-beli').val());

                        est_buy = (bp * stok_offset).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                        stok_offset >= 0 ? $('#est-stock').html('+' + stok_offset) : $('#est-stock').html(stok_offset);

                        $('#est-buy').html('Rp. ' + est_buy + ',-');
                    });
                }
            });
            return false;
        }

        function dropdown_satuan() {
            $("#id-satuan").select2({
                theme: 'bootstrap4',
                placeholder: 'Pilih Satuan',
                language: {
                    noResults: function() {
                        return "Satuan tidak ditemukan !"
                    },
                    searching: function() {
                        return "Mencari Satuan"
                    },
                    errorLoading: function() {
                        return "Satuan tidak ditemukan !"
                    }
                },
                ajax: {
                    url: base_url + 'Admin/satuan_select2',
                    type: "post",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            searchTerm: params.term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data
                        };
                    },
                }
            });
            $('b[role="presentation"]').hide();
        }

        function dynamic_dropdown_satuan(id_satuan, nama_satuan) {
            html = '<option value="' + id_satuan + '">' + nama_satuan + '</option>';
            $('#id-satuan').html(html);

            $("#id-satuan").select2({
                theme: 'bootstrap4',
                placeholder: 'Pilih Satuan',
                language: {
                    noResults: function() {
                        return "Satuan tidak ditemukan !"
                    },
                    searching: function() {
                        return "Mencari Satuan"
                    },
                    errorLoading: function() {
                        return "Satuan tidak ditemukan !"
                    }
                },
                ajax: {
                    url: base_url + 'Admin/satuan_select2',
                    type: "post",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            searchTerm: params.term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data
                        };
                    },
                }
            });
            $('b[role="presentation"]').hide();
        }

        function warehouse_detail() {
            $('.btn-detail').click(function(e) {
                warehouse_detail_load(e);
            });

            //DATATABLES GLITCH HANDLER
            // $('.warehouse-table').on('click', '.btn-detail', function(e) {
            //     warehouse_detail_load(e);
            // });
        }

        function warehouse_detail_load(e) {
            detail_create();

            var id = e.currentTarget.dataset.id;
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Admin/get_warehouse') ?>",
                data: {
                    id: id
                },
                dataType: "JSON",
                async: false,
                cache: false,
                success: function(data) {
                    var html = '';
                    var template = warehousedetailtemplate;
                    var el = warehousedetailtbody;

                    template = template.replace(/@id/g, data.id);

                    data.createdate == null ? create_date = '-' : create_date = data.createdate;
                    data.updatedate == null ? update_date = '-' : update_date = data.updatedate;
                    harga_beli = data.harga_beli.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");

                    dom = el.replace('@item_code', data.kode_barang);
                    dom = dom.replace('@barcode', '<img class="barcode" id="barcode-detail" style="width:75mm; height: 35mm"/>');
                    dom = dom.replace('@item', data.nama_barang);
                    dom = dom.replace('@satuan', data.nama_satuan);
                    dom = dom.replace('@tipe_satuan', data.tipe_satuan);
                    dom = dom.replace('@create_date', create_date);
                    dom = dom.replace('@update_date', update_date);
                    dom = dom.replace('@buy_price', 'Rp. ' + harga_beli + ',-');
                    dom = dom.replace('@stock', data.stok);


                    html = html + dom;

                    $('#warehouse-detail').html(template);
                    $('.warehouse-detail-tbody').html(html);

                    chart_harga(data);
                    stok_opname(data);
                    btn_update(data);
                    btn_stok(data);
                    barcode_detail_config(data);
                    btn_delete(data);
                }
            });
            return false;
        }

        function stok_opname(data) {
            var id = data.id;
            $('#warehouse-stokopname-list').html(warehousestokopnametemplate);
            $('#warehouse-stokopname-list > .warehouse-stokopname-table').DataTable({
                "serverSide": true,
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "language": {
                    "emptyTable": "Data Kosong",
                    "info": "Menampilkan _START_ - _END_ dari _TOTAL_ Stok Opname",
                    "infoEmpty": "Menampilkan 0 - 0 dari 0 Stok Opname",
                    "infoFiltered": "(Mencari dari _MAX_ Total Stok Opname)",
                    "lengthMenu": "Menampilkan _MENU_ Stok Opname",
                    "loadingRecords": "Memuat...",
                    "processing": "Memproses...",
                    "search": "Cari:",
                    "zeroRecords": "Tidak ada Stok Opname yang cocok",
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
                    "targets": [0, 4]
                }],
                "ajax": {
                    url: base_url + 'Admin/detail_warehouse_datatables',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        id: id
                    },
                    error: function() {
                        var html = '';
                        var template = warehousestokopnametemplate;
                        var el = warehousestokopnametbody;

                        $('#warehouse-stokopname-list').html(template);
                        $('.warehouse-stokopname-tbody').html("<tr><td colspan='5'>Daftar Stok Opname Masih Kosong</td></tr>");
                        unloader();
                    }
                },
                "drawCallback": function(settings) {
                    unloader();
                    btn_valid(data);
                    btn_invalid(data);
                }
            });
        }

        function add_edit_warehouse() {
            $("#warehouse-form").submit(function(e) {
                e.preventDefault();

                var bp = $('#harga-beli').val();
                var st = $('#stok').val();
                var mp = $('#harga-member').val();
                var gp = $('#harga-nonmember').val();
                var is = $('#isstok').val();
                var idsatuan = $('#id-satuan').val();


                if (st < 0) {
                    $('.stok-alert').html('<div class="alert alert-danger" role="alert">Stok harus diatas 0</div>').slideDown().delay(5000).slideUp();
                } else if (is == 1) {
                    var formdata = $('#warehouse-form').serialize();
                    loader();
                    $.ajax({
                        type: "POST",
                        url: "<?php echo site_url('Admin/add_new_warehouse') ?>",
                        dataType: "JSON",
                        data: formdata,
                        success: function(data) {
                            $('#cancle-warehouse').trigger('click');
                            warehouse_list();
                            if (data.success == 1) {
                                Toast.fire({
                                    type: 'success',
                                    title: 'Barang Berhasil Ditambahkan'
                                });
                            } else if (data.success == 2) {
                                Toast.fire({
                                    type: 'success',
                                    title: 'Barang Berhasil Diupdate'
                                });
                            }
                        },
                        error: function() {
                            toastr.error('Oops! Terjadi kesalahan.');
                        }
                    });
                    return false;
                } else {
                    if (idsatuan == -1) {
                        toastr.error('Pilih Satuan Terlebih Dahulu');
                    } else {
                        var formdata = $('#warehouse-form').serialize();
                        loader();
                        $.ajax({
                            type: "POST",
                            url: "<?php echo site_url('Admin/add_new_warehouse') ?>",
                            dataType: "JSON",
                            data: formdata,
                            success: function(data) {
                                $('#cancle-warehouse').trigger('click');
                                warehouse_list();
                                if (data.success == 1) {
                                    Toast.fire({
                                        type: 'success',
                                        title: 'Barang Berhasil Ditambahkan'
                                    });
                                } else if (data.success == 2) {
                                    Toast.fire({
                                        type: 'success',
                                        title: 'Barang Berhasil Diupdate'
                                    });
                                }
                            },
                            error: function() {
                                toastr.error('Oops! Terjadi kesalahan.');
                            }
                        });
                        return false;
                    }
                }

            });
        };

        function delete_warehouse() {
            $('.btn-delete').click(function(e) {
                delete_warehouse_load(e)
            });

            //DATATABLES GLITCH HANDLER
            // $('.warehouse-table').on('click', '.btn-delete', function(e) {
            //     delete_warehouse_load(e);
            // });
        }

        function delete_warehouse_load(e) {
            var html = warehousedeletetemplate;

            $('#warehouse-delete').html(html);
            $('#warehouse-list').slideUp();
            $('#add-warehouse').fadeOut().removeClass('d-inline-block');
            $('#cancle-warehouse').addClass('d-inline-block').fadeIn();

            $('.btn-cancle').click(function() {
                $('#cancle-warehouse').trigger('click');
            });

            var id = e.currentTarget.dataset.id;
            $('.btn-confirm').click(function() {
                loader();
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('Admin/delete_warehouse') ?>",
                    data: {
                        id: id
                    },
                    dataType: "JSON",
                    success: function(data) {
                        $('#cancle-warehouse').trigger('click');
                        Toast.fire({
                            type: 'success',
                            title: 'Barang Berhasil Dihapus'
                        });

                        warehouse_list();
                    }
                });
                return false;
            });
        }

        function btn_update(data) {
            $('.btn-update').click(function(e) {
                var html = warehouseformtemplate;

                $('#warehouse-form').html(html);
                $('#warehouse-detail').html(null);

                var html = '';

                html += '<input id="id" type="hidden" name="id" value="' + data.id + '">' +
                    '<input id="id_detail_warehouse" type="hidden" name="id_detail_warehouse" value="' + data.id_detail_warehouse + '">' +
                    '<input id="old-stok" type="hidden" name="old_stok" value="' + data.stok + '">' +
                    '<input id="old-harga-jual" type="hidden" name="old_harga_beli" value="' + data.harga_beli + '">';

                $('#nama-barang').val(data.nama_barang);
                dynamic_dropdown_satuan(data.id_satuan, data.nama_satuan);
                $('#harga-beli').val(data.harga_beli);
                $('#stok').val(data.stok);

                $('#est-stock').html('0');
                $('#est-buy').html('Rp. 0,-');

                $('#hidden-warehouse-form').html(html);

                $('#harga-beli,#stok').on('change', function() {
                    old_stok = parseInt(data.stok);
                    old_buy = parseInt(data.harga_beli);
                    stok = parseInt($('#stok').val());
                    stok_offset = stok - old_stok;
                    bp = parseInt($('#harga-beli').val());

                    est_buy = (bp * stok_offset).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                    stok_offset >= 0 ? $('#est-stock').html('+' + stok_offset) : $('#est-stock').html(stok_offset);

                    $('#est-buy').html('Rp. ' + est_buy + ',-');
                    $('#est-profit').html('Rp. ' + est_profit + ',-');
                });
            });
        }

        function btn_delete(data) {
            $('.btn-delete').click(function(e) {
                var id = e.currentTarget.dataset.id;

                var html = warehousedeletetemplate;

                $('#warehouse-delete').html(html);
                $('#warehouse-detail').html(null);
                $('.btn-cancle').click(function() {
                    $('#cancle-warehouse').trigger('click');
                });

                $('.btn-confirm').click(function() {
                    loader();
                    $.ajax({
                        type: "POST",
                        url: "<?php echo site_url('Admin/delete_warehouse') ?>",
                        data: {
                            id: id
                        },
                        dataType: "JSON",
                        success: function(data) {
                            $('#cancle-warehouse').trigger('click');
                            Toast.fire({
                                type: 'success',
                                title: 'Barang Berhasil Dihapus'
                            });

                            warehouse_list();
                        }
                    });
                    return false;
                });
            });
        }

        function btn_stok(data) {
            $('.btn-stok').click(function() {
                var html = warehousestoktemplate;

                $('#warehouse-form').html(html);

                html = '';
                html += '<input id="id" type="hidden" name="id" value="' + data.id + '">' +
                    '<input id="id_detail_warehouse" type="hidden" name="id_detail_warehouse" value="' + data.id_detail_warehouse + '">' +
                    '<input id="old-stok" type="hidden" name="old_stok" value="' + data.stok + '">' +
                    '<input id="old-harga-jual" type="hidden" name="old_harga_beli" value="' + data.harga_beli + '">' +
                    '<input id="isstok" type="hidden" name="isstok" value="1">';

                $('#hidden-warehouse-form').html(html);

                $('#harga-beli').val(data.harga_beli);
                $('#stok').val(data.stok);

                $('#est-stock').html('0');
                $('#est-buy').html('Rp. 0,-');

                $('#harga-beli,#stok').on('change', function() {
                    old_stok = parseInt(data.stok);
                    old_buy = parseInt(data.harga_beli);
                    stok = parseInt($('#stok').val());
                    stok_offset = stok - old_stok;
                    bp = parseInt($('#harga-beli').val());

                    est_buy = (bp * stok_offset).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                    stok_offset >= 0 ? $('#est-stock').html('+' + stok_offset) : $('#est-stock').html(stok_offset);

                    $('#est-buy').html('Rp. ' + est_buy + ',-');
                    $('#est-profit').html('Rp. ' + est_profit + ',-');
                });

                btn_remove(data);
            });

        }

        function btn_valid(data) {
            $('.btn-valid').click(function(e) {
                var id = e.currentTarget.dataset.id;
                $('.btn-valid').addClass('disabled');
                $('.btn-invalid').addClass('disabled');
                loader();
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('Admin/valid_warehouse') ?>",
                    data: {
                        id: id
                    },
                    dataType: "JSON",
                    success: function(data) {
                        Toast.fire({
                            type: 'success',
                            title: 'Stok Berhasil Divalidasi'
                        });
                        $('#cancle-warehouse').trigger('click');
                        warehouse_list();
                    }
                });
                return false;
            });
        }

        function btn_invalid(data) {
            $('.btn-invalid').click(function(e) {
                var id = e.currentTarget.dataset.id;
                $('.btn-valid').addClass('disabled');
                $('.btn-invalid').addClass('disabled');
                loader();
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('Admin/invalid_warehouse') ?>",
                    data: {
                        id: id
                    },
                    dataType: "JSON",
                    success: function(data) {
                        Toast.fire({
                            type: 'success',
                            title: 'Stok & Harga Berhasil Direset'
                        });
                        $('#cancle-warehouse').trigger('click');
                        warehouse_list();
                    }
                });
                return false;
            });
        }

        function barcode_detail_config(result) {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Admin/get_barcode_config') ?>",
                dataType: "JSON",
                success: function(data) {
                    config = data
                    warehouse_detail_barcode_load(result,config)                
                }
            });

            return false;
        }

        function warehouse_detail_barcode_load(result,config){
            var id = result.id;
            var nama_barang = result.nama_barang;
            var barcode = result.barcode;

            var el = warehousestyletemplate;
            dom = el.replace('paper_width', config.paper_width);
            dom = dom.replace('paper_height', config.paper_height);
            dom = dom.replace('paper_margin', config.margin);
            dom = dom.replace('paper_padding', config.padding);

            $('#warehouse-barcode-style').html(dom);

            if(config.barcode_text == 1){
                text = 'GUDANG/'+ barcode;
            } else {
                text = 'GUDANG/'+ nama_barang.toUpperCase();
            }

            JsBarcode("#barcode-detail", barcode, {
                format: config.barcode_format,
                text: text,
                width: config.barcode_width,
                height: config.barcode_height,
                fontSize: config.barcode_fontsize,
                background: config.barcode_background,
                font: config.barcode_font,
                fontOptions: config.barcode_fontoptions,
                lineColor: config.barcode_linecolor,
                textMargin: config.barcode_textmargin,
                textAlign: config.barcode_textalign,
                textPosition: config.barcode_textposition,
                marginLeft: parseInt(config.barcode_marginleft),
                marginRight: parseInt(config.barcode_marginright),
                marginTop: parseInt(config.barcode_margintop),
                marginBottom: parseInt(config.barcode_marginbottom),
            });

            btn_barcode();
        }

        function btn_barcode() {
            $('.btn-barcode').click(function() {
                jQuery('#barcode-detail').print();
            });
        }

        function chart_harga(data) {
            id = data.id;
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Admin/get_history_harga') ?>",
                data: {
                    id: id
                },
                dataType: "JSON",
                async: false,
                cache: false,
                success: function(data) {
                    var label = [];
                    var value = [];
                    for (i = 0; i < data.length; i++) {
                        label.push(data[i].createdate);
                        value.push(data[i].harga_beli);
                    }

                    var ctx = document.getElementById('chart-harga').getContext('2d');
                    var chart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: label,
                            datasets: [{
                                label: 'Harga Beli',
                                lineTension: 0.3,
                                backgroundColor: "rgba(78, 115, 223, 0.05)",
                                borderColor: "rgba(78, 115, 223, 1)",
                                pointRadius: 3,
                                pointBackgroundColor: "rgba(78, 115, 223, 1)",
                                pointBorderColor: "rgba(78, 115, 223, 1)",
                                pointHoverRadius: 3,
                                pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                                pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                                pointHitRadius: 10,
                                pointBorderWidth: 2,
                                data: value
                            }]
                        },
                        options: {
                            maintainAspectRatio: false,
                            layout: {
                                padding: {
                                    left: 10,
                                    right: 25,
                                    top: 25,
                                    bottom: 0
                                }
                            },
                            scales: {
                                xAxes: [{
                                    time: {
                                        unit: 'date'
                                    },
                                    gridLines: {
                                        display: false,
                                        drawBorder: false
                                    },
                                    ticks: {
                                        maxTicksLimit: 7
                                    }
                                }],
                                yAxes: [{
                                    ticks: {
                                        maxTicksLimit: 5,
                                        padding: 10,
                                        // Include a dollar sign in the ticks
                                        callback: function(value, index, values) {
                                            return 'Rp' + number_format(value);
                                        }
                                    },
                                    gridLines: {
                                        color: "rgb(234, 236, 244)",
                                        zeroLineColor: "rgb(234, 236, 244)",
                                        drawBorder: false,
                                        borderDash: [2],
                                        zeroLineBorderDash: [2]
                                    }
                                }],
                            },
                            legend: {
                                display: false
                            },
                            tooltips: {
                                backgroundColor: "rgb(255,255,255)",
                                bodyFontColor: "#858796",
                                titleMarginBottom: 10,
                                titleFontColor: '#6e707e',
                                titleFontSize: 14,
                                borderColor: '#dddfeb',
                                borderWidth: 1,
                                xPadding: 15,
                                yPadding: 15,
                                displayColors: false,
                                intersect: false,
                                mode: 'index',
                                caretPadding: 10,
                                callbacks: {
                                    label: function(tooltipItem, chart) {
                                        var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                                        return datasetLabel + ': Rp' + number_format(tooltipItem.yLabel);
                                    }
                                }
                            }
                        }
                    });
                }
            });
        }

        function btn_remove(data) {
            tool = $('#warehouse-toolbar').html();
            $('#warehouse-toolbar').html(null);

            $('.btn-remove').click(function() {
                $('#warehouse-toolbar').html(tool);
                $('#warehouse-form').html(null);
                btn_stok(data);
                btn_update(data);
                btn_barcode(data);
                btn_delete(data);
            });
        }

        function stok_offset(e) {
            var toggle = $(e).data('stok_offset_toggle');
            var offset = parseInt($(e).data('stok_offset'));

            if (toggle == 'collapse') {
                $('.stok-offset-toggle').data('stok_offset_toggle', 'expand').html('<i class="fas fa-angle-double-left"></i>');
                $('.stok-offset').slideDown();
            } else if (toggle == 'expand') {
                $('.stok-offset-toggle').data('stok_offset_toggle', 'collapse').html('<i class="fas fa-angle-double-right"></i>');
                $('.stok-offset').slideUp();
            }

            if (offset >= -50) {
                var stok = parseInt($('#stok').val());

                var val = stok + offset;
                val < 0 ? $('.stok-alert').html('<div class="alert alert-danger" role="alert">Stok harus diatas 0</div>').slideDown().delay(5000).slideUp() : '';
                val < 0 ? val = 0 : val;
                $('#stok').val(val).trigger('change');
            }
        };

        function barcode_print(e) {
            // DATATABLES GLITCH HANDLER
            $('.warehouse-table').on('click', '.barcode', function(e) {
                el = e.currentTarget;
                jQuery(el).print();
            });
        }
    });
</script>