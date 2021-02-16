<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Admin extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->encryption->initialize(
			array(
				'cipher' => 'aes-256',
				'mode' => 'ctr',
				'key' => 'h3nry2x'
			)
		);
		// Proteksi halaman
		$this->simple_login->cek_login();
		if (($this->session->userdata('role') == '2')) {
			$this->session->set_flashdata('sukses', "<script>alert('Anda Tidak Diperbolehkan Mengakses Halaman Ini')</script>");
			redirect('Kasir');
		}

		$this->load->library('form_validation');
	}

	// DASHBOARD SECTION
	public function index()
	{

		$dir = 'admin';
		$view = 'index';
		$data = null;
		$template = 'index_template';
		$jquery = 'jquery_index';

		$this->view_loader($dir, $view, $data, $template, $jquery);
	}

	public function get_penjualan()
	{
		$period = $this->input->post('period');

		$query = $this->Admin_model->get_penjualan($period);
		foreach ($query->result() as $row => $val) {
			$obj[$row] = $val;
		}

		foreach ($obj as $row) {
			$data = $row;
		}

		echo json_encode($data);
	}

	public function get_pembelian()
	{
		$period = $this->input->post('period');

		$query = $this->Admin_model->get_pembelian($period);
		foreach ($query->result() as $row => $val) {
			$obj[$row] = $val;
		}

		foreach ($obj as $row) {
			$data = $row;
		}

		echo json_encode($data);
	}

	public function get_profit()
	{
		$period = $this->input->post('period');

		$query = $this->Admin_model->get_penjualan($period);
		$jual = $query->row()->nominal;
		$query = $this->Admin_model->get_pembelian($period);
		$beli = $query->row()->nominal;

		$data['nominal'] = $jual - $beli;

		echo json_encode($data);
	}

	public function get_amttransaksi()
	{
		$period = $this->input->post('period');

		$query = $this->Admin_model->get_amttransaksi($period);
		foreach ($query->result() as $row => $val) {
			$obj[$row] = $val;
		}

		foreach ($obj as $row) {
			$data = $row;
		}

		echo json_encode($data);
	}

	public function get_margin()
	{
		$query = $this->Admin_model->get_margin();
		foreach ($query->result() as $row => $val) {
			$obj[$row] = $val;
		}

		foreach ($obj as $row) {
			$data = $row;
		}

		echo json_encode($data);
	}

	public function get_growth()
	{
		$period = $this->input->post('period');

		$query = $this->Admin_model->get_penjualan($period);
		$jual = $query->row()->nominal;
		$query = $this->Admin_model->get_pembelian($period);
		$beli = $query->row()->nominal;
		$query = $this->Admin_model->get_past_penjualan($period);
		$past_jual = $query->row()->nominal;
		$query = $this->Admin_model->get_past_pembelian($period);
		$past_beli = $query->row()->nominal;

		$present = $jual - $beli;
		$past = $past_jual - $past_beli;

		$data['nominal'] = $present - $past;

		echo json_encode($data);
	}

	public function get_growthrate()
	{
		$period = $this->input->post('period');

		$query = $this->Admin_model->get_penjualan($period);
		$jual = $query->row()->nominal;
		$query = $this->Admin_model->get_pembelian($period);
		$beli = $query->row()->nominal;
		$query = $this->Admin_model->get_past_penjualan($period);
		$past_jual = $query->row()->nominal;
		$query = $this->Admin_model->get_past_pembelian($period);
		$past_beli = $query->row()->nominal;

		$present = $jual - $beli;
		$past = $past_jual - $past_beli;

		if ($past > 0) {
			$data['rasio'] = round((($present - $past) / $past) * 100, 2);
		} else if ($present > 0) {
			$data['rasio'] = 100;
		} else {
			$data['rasio'] = 0;
		}

		echo json_encode($data);
	}

	public function get_amtretur()
	{
		$period = $this->input->post('period');

		$query = $this->Admin_model->get_amtretur($period);
		foreach ($query->result() as $row => $val) {
			$obj[$row] = $val;
		}

		foreach ($obj as $row) {
			$data = $row;
		}

		echo json_encode($data);
	}

	public function get_chart_profit()
	{
		$period = $this->input->post('period');

		$query = $this->Admin_model->get_chart_profit($period);
		foreach ($query->result() as $row => $val) {
			$data[$row] = $val;
		}

		echo json_encode($data);
	}

	public function get_chart_summary()
	{
		$query = $this->Admin_model->get_chart_summary();
		foreach ($query->result() as $row => $val) {
			$data[$row] = $val;
		}

		echo json_encode($data);
	}

	public function lasttransaction_list()
	{

		$query = $this->Admin_model->get_all_lasttransaksi();
		foreach ($query->result() as $row => $val) {
			$data[$row] = $val;
		}

		echo json_encode($data);
	}

	public function popularproduct_list()
	{
		$period = $this->input->post('period');

		$query = $this->Admin_model->get_all_popularproduct($period);
		foreach ($query->result() as $row => $val) {
			$data[$row] = $val;
		}

		echo json_encode($data);
	}

	// TRANSAKSI SECTION
	public function transaksi()
	{

		$dir = 'admin';
		$view = 'transaksi';
		$data = null;
		$template = 'transaksi_template';
		$jquery = 'jquery_transaksi';

		$this->view_loader($dir, $view, $data, $template, $jquery);
	}

	public function transaksi_datatables()
	{
		$draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$length = intval($this->input->post("length"));
		$order = $this->input->post("order");
		$search = $this->input->post("search");
		$search = $search['value'];

		$query = $this->Admin_model->get_transaksi_datatables($start, $length, $order, $search);
		$data = array();
		$no = 1;
		foreach ($query->result() as $rows) {
			$detail = '<a href="#" class="btn btn-detail btn-primary btn-circle btn-sm" data-id="' . $rows->id . '"><i class="fas fa-file"></i></a>';
			$del = '<a href="#" class="btn btn-delete btn-danger btn-circle btn-sm" data-id="' . $rows->id . '"><i class="fas fa-trash"></i></a>';

			$total = 'Rp. ' . str_replace(',', '.', number_format($rows->total)) . ',-';

			$data[] = array(
				$no,
				$rows->kode_transaksi,
				$rows->createdate,
				$total,
				$detail . ' ' . $del
			);
			$no++;
		}

		if ($query->num_rows() > 0) {
			if ($search) {
				$total_rows = $this->Admin_model->get_transaksi_length($search)->num_rows();
			} else {
				$total_rows = $this->Admin_model->get_all_transaksi()->num_rows();
			}
		} else {
			$total_rows = 0;
		}

		$output = array(
			"draw" => $draw,
			"recordsTotal" => $total_rows,
			"recordsFiltered" => $total_rows,
			"data" => $data
		);
		echo json_encode($output);
	}

	public function transaksi_select2()
	{
		$search = $this->input->post('searchTerm');
		$limit = 5 * strlen($search);
		$query = $this->Admin_model->get_transaksi_select2($search, $limit);
		$no = 0;
		foreach ($query->result_array() as $rows) {
			$data[$no]['id'] = $rows['id'];
			$data[$no]['text'] = $rows['kode_transaksi'];
			$no++;
		}

		echo json_encode($data);
	}

	public function transaksi_list()
	{

		$query = $this->Admin_model->get_all_transaksi();
		foreach ($query->result() as $row => $val) {
			$data[$row] = $val;
		}

		echo json_encode($data);
	}

	public function get_transaksi()
	{
		$id = $this->input->post('id');

		$query = $this->Admin_model->get_transaksi($id);
		foreach ($query->result() as $row => $val) {
			$obj[$row] = $val;
		}

		foreach ($obj as $row) {
			$data = $row;
		}

		echo json_encode($data);
	}

	// DETAIL TRANSAKSI SECTION
	public function detail_transaksi_list()
	{
		$id = $this->input->post('id');

		$query = $this->Admin_model->get_detail_transaksi($id);
		foreach ($query->result() as $row => $val) {
			$data[$row] = $val;
		}

		echo json_encode($data);
	}

	public function struk_transaksi()
	{
		$query = $this->Admin_model->get_printer(2);
		$device = $query->row();

		$query = $this->Admin_model->get_nota_config();
		$config = $query->row();

		$divider = '';
		for ($i = 0; $i < $config->divider_length; $i++) {
			$divider = $divider . $config->divider_char;
		}

		$id = $this->input->post('id');

		$query = $this->Admin_model->get_transaksi($id);
		$row = $query->row();

		date_default_timezone_set('Asia/Jakarta');
		$data = array(
			//'total' => $_POST['total'],
			'diskon' => $row->diskon,
			'subtotal' => $row->subtotal,
			'nomornota' => $row->kode_transaksi,
			'user' => $this->session->userdata('nama'),
			'bayar' => $row->bayar,
			'kembali' => $row->kembali,
		);

		$query = $this->Admin_model->get_detail_transaksi($id);

		// me-load library escpos
		$this->load->library('escpos');

		// membuat connector printer ke shared printer bernama "printer_a" (yang telah disetting sebelumnya)
		$connector = new Escpos\PrintConnectors\WindowsPrintConnector($device->printer_name);

		// membuat objek $printer agar dapat di lakukan fungsinya
		$printer = new Escpos\Printer($connector);

		// membuat fungsi untuk membuat 1 baris tabel, agar dapat dipanggil berkali-kali dgn mudah
		function buatBaris4Kolom($kolom1, $kolom2, $kolom3, $kolom4)
		{
			// Mengatur lebar setiap kolom (dalam satuan karakter)
			$lebar_kolom_1 = 12;
			$lebar_kolom_2 = 8;
			$lebar_kolom_3 = 8;
			$lebar_kolom_4 = 9;

			// Melakukan wordwrap(), jadi jika karakter teks melebihi lebar kolom, ditambahkan \n 
			$kolom1 = wordwrap($kolom1, $lebar_kolom_1, "\n", true);
			$kolom2 = wordwrap($kolom2, $lebar_kolom_2, "\n", true);
			$kolom3 = wordwrap($kolom3, $lebar_kolom_3, "\n", true);
			$kolom4 = wordwrap($kolom4, $lebar_kolom_4, "\n", true);

			// Merubah hasil wordwrap menjadi array, kolom yang memiliki 2 index array berarti memiliki 2 baris (kena wordwrap)
			$kolom1Array = explode("\n", $kolom1);
			$kolom2Array = explode("\n", $kolom2);
			$kolom3Array = explode("\n", $kolom3);
			$kolom4Array = explode("\n", $kolom4);

			// Mengambil jumlah baris terbanyak dari kolom-kolom untuk dijadikan titik akhir perulangan
			$jmlBarisTerbanyak = max(count($kolom1Array), count($kolom2Array), count($kolom3Array), count($kolom4Array));

			// Mendeklarasikan variabel untuk menampung kolom yang sudah di edit
			$hasilBaris = array();

			// Melakukan perulangan setiap baris (yang dibentuk wordwrap), untuk menggabungkan setiap kolom menjadi 1 baris 
			for ($i = 0; $i < $jmlBarisTerbanyak; $i++) {

				// memberikan spasi di setiap cell berdasarkan lebar kolom yang ditentukan, 
				$hasilKolom1 = str_pad((isset($kolom1Array[$i]) ? $kolom1Array[$i] : ""), $lebar_kolom_1, " ");
				$hasilKolom2 = str_pad((isset($kolom2Array[$i]) ? $kolom2Array[$i] : ""), $lebar_kolom_2, " ");

				// memberikan rata kanan pada kolom 3 dan 4 karena akan kita gunakan untuk harga dan total harga
				$hasilKolom3 = str_pad((isset($kolom3Array[$i]) ? $kolom3Array[$i] : ""), $lebar_kolom_3, " ", STR_PAD_LEFT);
				$hasilKolom4 = str_pad((isset($kolom4Array[$i]) ? $kolom4Array[$i] : ""), $lebar_kolom_4, " ", STR_PAD_LEFT);

				// Menggabungkan kolom tersebut menjadi 1 baris dan ditampung ke variabel hasil (ada 1 spasi disetiap kolom)
				$hasilBaris[] = $hasilKolom1 . " " . $hasilKolom2 . " " . $hasilKolom3 . " " . $hasilKolom4;
			}

			// Hasil yang berupa array, disatukan kembali menjadi string dan tambahkan \n disetiap barisnya.
			return implode("\n", $hasilBaris);
		}

		// Membuat judul
		$printer->initialize();
		$printer->selectPrintMode(Escpos\Printer::MODE_DOUBLE_HEIGHT); // Setting teks menjadi lebih besar
		$printer->setJustification(Escpos\Printer::JUSTIFY_CENTER); // Setting teks menjadi rata tengah
		$printer->text($config->title."\n");
		$printer->text("\n");


		// Data transaksi
		$printer->initialize();
		$printer->setJustification(Escpos\Printer::JUSTIFY_CENTER);
		$printer->text($data['nomornota']);
		$printer->text("\n");
		$printer->text($data['user']);
		$printer->text(" Waktu : " . date('Y-m-d H:i:s') . "\n");

		// Membuat tabel
		$printer->initialize(); // Reset bentuk/jenis teks
		$printer->setJustification(Escpos\Printer::JUSTIFY_LEFT);
		$printer->text($divider."\n");
		$printer->text("Barang \n");
		$printer->text(buatBaris4Kolom("Qty", "Harga", "Subtotal", ""));
		$printer->text("\n");
		$printer->text($divider."\n");
		$total = 0;
		foreach ($query->result_array() as $barang) {
			$printer->initialize(); // Reset bentuk/jenis teks
			$printer->setJustification(Escpos\Printer::JUSTIFY_LEFT);
			$printer->text($barang['nama_barang']);
			$printer->text("\n");
			$printer->text(buatBaris4Kolom($barang['jumlah'], $barang['harga'], $barang['sub_total'], ""));
			$total = $total + $barang['sub_total'];
		}

		$total = $total - $data['diskon'];
		// print kolom pembayaran
		$printer->text("\n");
		$printer->text($divider."\n");

		$printer->initialize();
		$printer->setJustification(Escpos\Printer::JUSTIFY_LEFT);
		$printer->text("Subtotal : " . number_format($data['subtotal']) . "\n");
		$printer->text("Diskon   : " . number_format($data['diskon']) . "\n");
		$printer->text("Total    : " . number_format($total) . "\n");
		$printer->text("Bayar    : " . number_format($data['bayar']) . "\n");
		$printer->text("Kembali  : " . number_format($data['kembali']) . "\n");
		$printer->text("\n");

		// Pesan penutup
		$printer->initialize();
		$printer->setJustification(Escpos\Printer::JUSTIFY_CENTER);
		$printer->text($config->footer_line_1."\n");
		$printer->text($config->footer_line_2."\n");
		$printer->text($config->footer_line_3."\n");

		$printer->feed(5); // mencetak 5 baris kosong agar terangkat (pemotong kertas saya memiliki jarak 5 baris dari toner)
		$printer->close();

		$data['sukses'] = "sukses cetak";
		echo json_encode($data);
	}

	public function delete_transaksi()
	{
		$data['id'] = $this->input->post('id');
		$data['isactive'] = 0;

		$this->Admin_model->update_transaksi($data);

		// RESPONSES
		$result['success'] = 1;
		$result['message'] = 'Data deleted succesfully';

		echo json_encode($result);
	}

	// BARANG SECTION
	public function barang()
	{

		$dir = 'admin';
		$view = 'barang';
		$data = null;
		$template = 'barang_template';
		$jquery = 'jquery_barang';

		$this->view_loader($dir, $view, $data, $template, $jquery);
	}

	public function barang_datatables()
	{
		$draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$length = intval($this->input->post("length"));
		$order = $this->input->post("order");
		$search = $this->input->post("search");
		$search = $search['value'];

		$query = $this->Admin_model->get_barang_datatables($start, $length, $order, $search);
		$data = array();
		$no = 1;
		foreach ($query->result() as $rows) {
			$print = '<a href="#" class="btn btn-print btn-warning btn-circle btn-sm" data-id="' . $rows->id . '" data-nama_barang="' . $rows->nama_barang . '" data-barcode="' . $rows->barcode . '"><i class="fas fa-barcode"></i></a>';
			$detail = '<a href="#" class="btn btn-detail btn-primary btn-circle btn-sm" data-id="' . $rows->id . '"><i class="fas fa-file"></i></a>';
			$update = '<a href="#" class="btn btn-update btn-success btn-circle btn-sm" data-id="' . $rows->id . '"><i class="fas fa-cog"></i></a>';
			$del = '<a href="#" class="btn btn-delete btn-danger btn-circle btn-sm" data-id="' . $rows->id . '"><i class="fas fa-trash"></i></a>';

			$nama_barang = ucwords($rows->nama_barang);
			if ($rows->harga_jual <= 0) {
				$harga_jual = '<span class="text-danger">Rp. ' . str_replace(',', '.', number_format($rows->harga_jual)) . ',-</span>';
			} else {
				$harga_jual = 'Rp. ' . str_replace(',', '.', number_format($rows->harga_jual)) . ',-';
			}
			if ($rows->est_stok <= 0) {
				$stok = '<span class="text-danger">0</span>';
			} else {
				$stok = $rows->est_stok;
			}

			if ($rows->profit < 0) {
				$profit = '<span class="text-danger">Rp. ' . str_replace(',', '.', number_format($rows->profit)) . ',-</span>';
			} else {
				$profit = 'Rp. ' . str_replace(',', '.', number_format($rows->profit)) . ',-';
			}

			$data[] = array(
				$no,
				$nama_barang,
				$harga_jual,
				$profit,
				$stok,
				$rows->jumlah,
				$print . ' ' . $detail . ' ' . $update . ' ' . $del
			);
			$no++;
		}

		if ($query->num_rows() > 0) {
			if ($search) {
				$total_rows = $this->Admin_model->get_barang_length($search)->num_rows();
			} else {
				$total_rows = $this->Admin_model->get_all_barang()->num_rows();
			}
		} else {
			$total_rows = 0;
		}

		$output = array(
			"draw" => $draw,
			"recordsTotal" => $total_rows,
			"recordsFiltered" => $total_rows,
			"data" => $data
		);
		echo json_encode($output);
	}

	public function barang_list()
	{

		$query = $this->Admin_model->get_all_barang();
		foreach ($query->result() as $row => $val) {
			$data[$row] = $val;
		}

		echo json_encode($data);
	}

	public function add_new_barang()
	{
		$id = $this->input->post('id');

		if (!$id) {
			// GENERATE BARANG CODE
			$query = $this->Admin_model->get_max_barang_id();
			$row = $query->row();

			$max_id = $row->max_id + 1;
			// GENERATE BARCODE
			$barcode = time() . $this->session->userdata('iduser');
			if ($max_id < 10) {
				$data['kode_barang'] = 'BAR-00000' . $max_id;
			} else if ($max_id < 100) {
				$data['kode_barang'] = 'BAR-0000' . $max_id;
			} else if ($max_id < 1000) {
				$data['kode_barang'] = 'BAR-000' . $max_id;
			} else if ($max_id < 10000) {
				$data['kode_barang'] = 'BAR-00' . $max_id;
			} else if ($max_id < 100000) {
				$data['kode_barang'] = 'BAR-0' . $max_id;
			} else {
				$data['kode_barang'] = 'BAR-' . $max_id;
			}

			$data['id_warehouse'] = $this->input->post('id_warehouse');
			$data['id_satuan'] = $this->input->post('id_satuan');
			$data['nama_barang'] = $this->input->post('nama_barang');
			$data['harga_jual'] = $this->input->post('harga_jual');
			$data['jumlah'] = $this->input->post('jumlah');
			if ($this->input->post('ismanufacture')) {
				$data['barcode'] = $this->input->post('barcode');
			} else {
				$data['barcode'] = $barcode;
			}

			// ADD BARANG
			$this->Admin_model->add_barang($data);

			// RESPONSES
			$result['success'] = 1;
			$result['message'] = 'Data added succesfully';
		} else if ($id) {
			$isjumlah = $this->input->post('isjumlah');
			// CHECK FORM INPUT
			if ($isjumlah) {
				$data['id'] = $id;
				$data['harga_jual'] = $this->input->post('harga_jual');
				$data['jumlah'] = $this->input->post('jumlah');
			} else {
				$data['id'] = $id;
				$data['id_warehouse'] = $this->input->post('id_warehouse');
				$data['id_satuan'] = $this->input->post('id_satuan');
				$data['nama_barang'] = $this->input->post('nama_barang');
				$data['harga_jual'] = $this->input->post('harga_jual');
				$data['jumlah'] = $this->input->post('jumlah');
				if ($this->input->post('ismanufacture')) {
					$data['barcode'] = $this->input->post('barcode');
				}
			}

			// UPDATE BARANG
			$data3['updatedate'] = date('Y-m-d H:i:s');
			$this->Admin_model->update_barang($data);

			// RESPONSES
			$result['success'] = 2;
			$result['message'] = 'Data updated succesfully';
		} else {
			$result['success'] = 3;
			$result['message'] = 'Oops! Something went wrong';
		}


		echo json_encode($result);
	}

	public function get_barang()
	{
		$id = $this->input->post('id');

		$query = $this->Admin_model->get_barang($id);
		foreach ($query->result() as $row => $val) {
			$obj[$row] = $val;
		}

		foreach ($obj as $row) {
			$data = $row;
		}

		echo json_encode($data);
	}

	public function delete_barang()
	{
		$data['id'] = $this->input->post('id');
		$data['isactive'] = 0;

		$this->Admin_model->update_barang($data);

		// RESPONSES
		$result['success'] = 1;
		$result['message'] = 'Data deleted succesfully';

		echo json_encode($result);
	}

	// WAREHOUSE SECTION
	public function warehouse()
	{

		$dir = 'admin';
		$view = 'warehouse';
		$data = null;
		$template = 'warehouse_template';
		$jquery = 'jquery_warehouse';

		$this->view_loader($dir, $view, $data, $template, $jquery);
	}

	public function warehouse_datatables()
	{
		$draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$length = intval($this->input->post("length"));
		$order = $this->input->post("order");
		$search = $this->input->post("search");
		$search = $search['value'];

		$query = $this->Admin_model->get_warehouse_datatables($start, $length, $order, $search);
		$data = array();
		$no = 1;
		foreach ($query->result() as $rows) {
			$print = '<a href="#" class="btn btn-print btn-warning btn-circle btn-sm" data-id="' . $rows->id . '" data-nama_barang="' . $rows->nama_barang . '" data-barcode="' . $rows->barcode . '"><i class="fas fa-barcode"></i></a>';
			$detail = '<a href="#" class="btn btn-detail btn-primary btn-circle btn-sm" data-id="' . $rows->id . '"><i class="fas fa-file"></i></a>';
			$update = '<a href="#" class="btn btn-update btn-success btn-circle btn-sm" data-id="' . $rows->id . '"><i class="fas fa-cog"></i></a>';
			$del = '<a href="#" class="btn btn-delete btn-danger btn-circle btn-sm" data-id="' . $rows->id . '"><i class="fas fa-trash"></i></a>';

			$nama_barang = ucwords($rows->nama_barang);

			if ($rows->harga_beli <= 0) {
				$harga_beli = '<span class="text-danger">Rp. ' . str_replace(',', '.', number_format($rows->harga_beli)) . ',-</span>';
			} else {
				$harga_beli = 'Rp. ' . str_replace(',', '.', number_format($rows->harga_beli)) . ',-';
			}

			if ($rows->stok <= 0) {
				$stok = '<span class="text-danger">' . $rows->stok . '</span>';
			} else {
				$stok = $rows->stok;
			}

			$data[] = array(
				$no,
				$nama_barang,
				$harga_beli,
				$stok,
				$print . ' ' . $detail . ' ' . $update . ' ' . $del
			);
			$no++;
		}

		if ($query->num_rows() > 0) {
			if ($search) {
				$total_rows = $this->Admin_model->get_warehouse_length($search)->num_rows();
			} else {
				$total_rows = $this->Admin_model->get_all_warehouse()->num_rows();
			}
		} else {
			$total_rows = 0;
		}

		$output = array(
			"draw" => $draw,
			"recordsTotal" => $total_rows,
			"recordsFiltered" => $total_rows,
			"data" => $data
		);
		echo json_encode($output);
	}

	public function warehouse_select2()
	{
		$search = $this->input->post('searchTerm');
		$limit = 5 * strlen($search);
		$query = $this->Admin_model->get_warehouse_select2($search, $limit);
		$no = 0;
		foreach ($query->result_array() as $rows) {
			$data[$no]['id'] = $rows['id'];
			$data[$no]['text'] = $rows['barcode'] . '-' . ucwords($rows['nama_barang']) . ' (Harga Beli: Rp. ' . str_replace(',', '.', number_format($rows['harga_beli'])) . ',-/Stok: ' . $rows['stok'] . ')';
			$no++;
		}

		echo json_encode($data);
	}

	public function warehouse_list()
	{

		$query = $this->Admin_model->get_all_warehouse();
		foreach ($query->result() as $row => $val) {
			$data[$row] = $val;
		}

		echo json_encode($data);
	}

	public function detail_warehouse_datatables()
	{
		$id = $this->input->post('id');
		$draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$length = intval($this->input->post("length"));
		$order = $this->input->post("order");
		$search = $this->input->post("search");
		$search = $search['value'];

		$query = $this->Admin_model->get_detail_warehouse_datatables($id, $start, $length, $order, $search);
		$data = array();
		$no = 1;
		foreach ($query->result() as $rows) {
			$valid = '<a href="#" class="btn btn-valid btn-primary btn-circle btn-sm" data-id="' . $rows->id . '"><i class="fas fa-thumbs-up"></i></a>';
			$invalid = '<a href="#" class="btn btn-invalid btn-danger btn-circle btn-sm" data-id="' . $rows->id . '"><i class="fas fa-thumbs-down"></i></a>';
			$verified = '<a href="#" class="btn btn-verified btn-success btn-circle btn-sm disabled"><i class="fas fa-check"></i></a>';

			$rows->isvalid == 0 ? $action = $valid . ' ' . $invalid : $action = $verified;
			$harga_beli = 'Rp. ' . str_replace(',', '.', number_format($rows->harga_beli)) . ',-';

			$data[] = array(
				$no,
				$rows->waktu,
				$harga_beli,
				$rows->stok_opname,
				$action
			);
			$no++;
		}

		if ($query->num_rows() > 0) {
			if ($search) {
				$total_rows = $this->Admin_model->get_detail_warehouse_length($id, $search)->num_rows();
			} else {
				$total_rows = $this->Admin_model->get_all_detail_warehouse($id)->num_rows();
			}
		} else {
			$total_rows = 0;
		}

		$output = array(
			"draw" => $draw,
			"recordsTotal" => $total_rows,
			"recordsFiltered" => $total_rows,
			"data" => $data
		);
		echo json_encode($output);
	}

	public function detail_warehouse_list()
	{
		$id = $this->input->post('id');

		$query = $this->Admin_model->get_all_detail_warehouse($id);
		foreach ($query->result() as $row => $val) {
			$data[$row] = $val;
		}

		echo json_encode($data);
	}

	public function add_new_warehouse()
	{
		$id = $this->input->post('id');

		if (!$id) {
			// GENERATE WAREHOUSE CODE
			$query = $this->Admin_model->get_max_warehouse_id();
			$row = $query->row();

			$max_id = $row->max_id + 1;
			// GENERATE BARCODE
			$barcode = time() . $this->session->userdata('iduser');
			if ($max_id < 10) {
				$data['kode_barang'] = 'WRH-00000' . $max_id;
			} else if ($max_id < 100) {
				$data['kode_barang'] = 'WRH-0000' . $max_id;
			} else if ($max_id < 1000) {
				$data['kode_barang'] = 'WRH-000' . $max_id;
			} else if ($max_id < 10000) {
				$data['kode_barang'] = 'WRH-00' . $max_id;
			} else if ($max_id < 100000) {
				$data['kode_barang'] = 'WRH-0' . $max_id;
			} else {
				$data['kode_barang'] = 'WRH-' . $max_id;
			}

			$data['id_satuan'] = $this->input->post('id_satuan');
			$data['barcode'] = $barcode;
			$data['nama_barang'] = $this->input->post('nama_barang');
			$data['harga_beli'] = $this->input->post('harga_beli');
			$data['stok'] = $this->input->post('stok');

			// ADD WAREHOUSE
			$this->Admin_model->add_warehouse($data);

			// GET WAREHOUSE ID
			$code = $data['kode_barang'];
			$query = $this->Admin_model->get_warehouse_bycode($code);
			$row = $query->row();

			$data2['id_warehouse'] = $row->id;
			$data2['harga_beli'] = $this->input->post('harga_beli');
			$data2['stok_opname'] = $this->input->post('stok');
			if ($this->input->post('isvalid')) {
				$data2['isvalid'] = 1;
			}

			// ADD DETAIL WAREHOUSE
			$this->Admin_model->add_detail_warehouse($data2);

			// RESPONSES
			$result['success'] = 1;
			$result['message'] = 'Data added succesfully';
		} else if ($id) {
			$isstok = $this->input->post('isstok');
			// CHECK FORM INPUT
			if ($isstok) {
				$data['harga_beli'] = $this->input->post('harga_beli');
				$data['stok'] = $this->input->post('stok');
				$data2['harga_beli'] = $this->input->post('harga_beli');
			} else {
				$data['id_satuan'] = $this->input->post('id_satuan');
				$data['nama_barang'] = $this->input->post('nama_barang');
				$data['harga_beli'] = $this->input->post('harga_beli');
				$data['stok'] = $this->input->post('stok');
				$data2['harga_beli'] = $this->input->post('harga_beli');
			}

			// UPDATE WAREHOUSE
			$data['id'] = $id;
			$data['updatedate'] = date('Y-m-d H:i:s');
			$this->Admin_model->update_warehouse($data);

			// STOK OFFSET
			$old_stok = $this->input->post('old_stok');
			$stok = $this->input->post('stok');
			$stok_offset = $stok - $old_stok;

			if ($stok_offset != 0) {
				$data3['id'] = $this->input->post('id_detail_warehouse');

				// UPDATE DETAIL WAREHOUSE - DEACTIVED
				$data3['updatedate'] = date('Y-m-d H:i:s');
				$data3['isactive'] = 0;
				$this->Admin_model->update_detail_warehouse($data3);

				$data2['id_warehouse'] = $id;
				$data2['stok_opname'] = $stok_offset;
				if ($this->input->post('isvalid')) {
					$data2['isvalid'] = 1;
				}

				// ADD DETAIL WAREHOUSE
				$this->Admin_model->add_detail_warehouse($data2);
			}

			// RESPONSES
			$result['success'] = 2;
			$result['message'] = 'Data updated succesfully';
		} else {
			$result['success'] = 3;
			$result['message'] = 'Oops! Something went wrong';
		}


		echo json_encode($result);
	}

	public function get_warehouse()
	{
		$id = $this->input->post('id');

		$query = $this->Admin_model->get_warehouse($id);
		foreach ($query->result() as $row => $val) {
			$obj[$row] = $val;
		}

		foreach ($obj as $row) {
			$data = $row;
		}

		echo json_encode($data);
	}

	public function get_history_harga()
	{
		$id = $this->input->post('id');

		$query = $this->Admin_model->get_history_harga($id);
		foreach ($query->result() as $row => $val) {
			$data[$row] = $val;
		}

		echo json_encode($data);
	}

	public function valid_warehouse()
	{
		$data['id'] = $this->input->post('id');
		$data['isvalid'] = 1;

		$this->Admin_model->update_detail_warehouse($data);

		$id = $this->input->post('id');
		$query = $this->Admin_model->get_detail_warehouse($id);
		$row = $query->row();

		$result['id'] = $row->id_warehouse;
		$result['message'] = 1;

		echo json_encode($result);
	}

	public function invalid_warehouse()
	{
		$id_detail = $this->input->post('id');

		$query = $this->Admin_model->get_detail_warehouse($id_detail);
		$row = $query->row();

		$id_warehouse = $row->id_warehouse;
		$stok_opname = $row->stok_opname;

		$query = $this->Admin_model->get_warehouse($id_warehouse);
		$key = $query->row();

		$stok_offset = $key->stok - $stok_opname;
		$data['id'] = $id_warehouse;
		$data['stok'] = $stok_offset;
		$data['harga_beli'] = 0;

		// ROLL BACK WAREHOUSE STOK
		$this->Admin_model->update_warehouse($data);

		// REMOVE WAREHOUSE HISTORY
		$this->Admin_model->delete_detail_warehouse($id_detail);

		$data3['id'] = $id_detail;

		// UPDATE DETAIL WAREHOUSE - DEACTIVED
		$data3['updatedate'] = date('Y-m-d H:i:s');
		$data3['isactive'] = 0;
		$this->Admin_model->update_detail_warehouse($data3);

		$data2['id_warehouse'] = $id_warehouse;
		$data2['stok_opname'] = $stok_offset;
		$data2['harga_beli'] = 0;
		$data2['isvalid'] = 1;

		// ADD DETAIL WAREHOUSE
		$this->Admin_model->add_detail_warehouse($data2);

		$result['id'] = $id_warehouse;
		$result['message'] = 1;

		echo json_encode($result);
	}

	public function delete_warehouse()
	{
		$data['id'] = $this->input->post('id');
		$data['harga_beli'] = 0;
		$data['stok'] = 0;
		$data['isactive'] = 0;

		$this->Admin_model->update_warehouse($data);

		$data2['id_warehouse'] = $this->input->post('id');
		$data2['harga_beli'] = 0;
		$data2['stok_opname'] = 0;
		$data2['isactive'] = 0;

		$this->Admin_model->update_detail_bywarehouse($data2);

		// RESPONSES
		$result['success'] = 1;
		$result['message'] = 'Data deleted succesfully';

		echo json_encode($result);
	}

	// RETUR SECTION
	public function retur()
	{

		$dir = 'admin';
		$view = 'retur';
		$data = null;
		$template = 'retur_template';
		$jquery = 'jquery_retur';

		$this->view_loader($dir, $view, $data, $template, $jquery);
	}

	public function retur_list()
	{

		$query = $this->Admin_model->get_all_retur();
		foreach ($query->result() as $row => $val) {
			$data[$row] = $val;
		}

		echo json_encode($data);
	}

	public function add_new_retur()
	{
		$data['id_transaksi'] = $this->input->post('id_transaksi');
		$data['kode_retur'] = $this->input->post('nomornota');
		$data['sub_total'] = $this->input->post('subtotal');
		$data['diskon'] = $this->input->post('diskon');
		$data['total'] = $this->input->post('total');
		$data['catatan'] = $this->input->post('catatan');
		$data['isexchange'] = $this->input->post('isexchange');
		$isexchange = $this->input->post('isexchange');

		// ADD RETUR
		$this->Admin_model->add_retur($data);

		// GET RETUR
		$code = $this->input->post('nomornota');
		$query = $this->Admin_model->get_retur_bycode($code);
		$row = $query->row();
		$id_retur = $row->id;

		// GET CART ITEM
		$cart['ip_address'] = $this->get_client_ip();
		$query = $this->Admin_model->get_cart($cart);

		// ADD DETAIL RETUR
		foreach ($query->result_array() as $val) {
			$data2['id_barang'] = $val['id_barang'];
			$data2['id_retur'] = $id_retur;
			$data2['harga'] = $val['harga'];
			$data2['jumlah'] = $val['jumlah'];
			$data2['sub_total'] = $val['subtotal'];

			$this->Admin_model->add_detail_retur($data2);

			if ($isexchange == 1) {
				// GET BARANG
				$id = $data2['id_barang'];
				$query = $this->Admin_model->get_barang($id);
				$row = $query->row();

				$jumlah_beli = $data2['jumlah'];
				$jumlah_satuan = $row->jumlah;

				$stok_gudang = $row->stok;
				$stok = $stok_gudang - ($jumlah_beli * $jumlah_satuan);

				$data3['id'] = $row->id_warehouse;
				$data3['stok'] = $stok;

				// UPDATE WAREHOUSE
				$this->Admin_model->update_warehouse($data3);
			}
		}

		$ip = $this->get_client_ip();

		// CLEAR CART
		$this->Admin_model->clear_cart($ip);


		$result['message'] = 1;
		echo json_encode($result);
	}

	public function get_retur()
	{
		$id = $this->input->post('id');

		//GET RETUR
		$query = $this->Admin_model->get_retur($id);
		foreach ($query->result() as $row => $val) {
			$obj[$row] = $val;
		}

		foreach ($obj as $row) {
			$data = $row;
		}

		echo json_encode($data);
	}

	public function get_retur_detail()
	{
		$id = $this->input->post('id');

		$query = $this->Admin_model->get_retur_detail($id);
		foreach ($query->result() as $row => $val) {
			$data[$row] = $val;
		}

		echo json_encode($data);
	}

	public function get_nomornota()
	{
		$nomornota = $this->Admin_model->get_nomornota();
		$data['nomornota'] = $nomornota;

		echo json_encode($data);
	}

	public function get_barang_bytransaksi()
	{
		$id = $this->input->post('id');

		$query = $this->Admin_model->get_warehouse_bytransaksi($id);
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $key) {
				$param[] = $key['id_warehouse'];
			}

			$query = $this->Admin_model->get_barang_inwarehouse($param);
			foreach ($query->result() as $row => $val) {
				$data[$row] = $val;
			}
		}

		echo json_encode($data);
	}

	public function delete_retur()
	{
		$data['id'] = $this->input->post('id');
		$data['isactive'] = 0;

		$this->Admin_model->update_retur($data);

		// RESPONSES
		$result['success'] = 1;
		$result['message'] = 'Data deleted succesfully';

		echo json_encode($result);
	}

	// CART SECTION
	public function cart_list()
	{
		$cart['ip_address'] = $this->get_client_ip();

		$query = $this->Admin_model->get_all_cart($cart);
		foreach ($query->result() as $row => $val) {
			$data[$row] = $val;
		}

		echo json_encode($data);
	}

	public function add_to_cart()
	{
		$cart['id_barang'] = $this->input->post('id_barang');
		$cart['ip_address'] = $this->get_client_ip();

		// CHECK IF CART ITEM EXIST
		$query = $this->Admin_model->get_cart($cart);
		if ($query->num_rows() > 0) {
			$row = $query->row();
			$jumlah = $row->jumlah;
			$id_barang = $row->id_barang;

			// CHECK AVAILABLE STOK
			$query = $this->Admin_model->get_barang($id_barang);
			$key = $query->row();
			$stok = $key->stok / $key->jumlah;

			if ($jumlah < $stok) {
				$data['id_barang'] = $this->input->post('id_barang');
				$data['ip_address'] = $this->get_client_ip();
				$data['jumlah'] = $row->jumlah + 1;
				$data['subtotal'] = $data['jumlah'] * $row->harga;

				// UPDATE BARANG
				$this->Admin_model->update_cart($data);

				$result['message'] = 2;
				echo json_encode($result);
			} else {
				$result['message'] = 0;
				echo json_encode($result);
			}
		} else {
			// GET BARANG
			$id = $this->input->post('id_barang');
			$query = $this->Admin_model->get_barang($id);
			$row = $query->row();
			$harga = $row->harga_jual;

			$data['id_barang'] = $this->input->post('id_barang');
			$data['ip_address'] = $this->get_client_ip();
			$data['barcode'] = $row->barcode;
			$data['nama_barang'] = $row->nama_barang;
			$data['harga'] = $harga;
			$data['jumlah'] = 1;
			$data['subtotal'] = $harga;

			// ADD CART
			$this->Admin_model->add_cart($data);

			$result['message'] = 1;
			echo json_encode($result);
		}
	}

	public function barcode_to_cart()
	{
		$cart['barcode'] = $this->input->post('barcode');
		$cart['ip_address'] = $this->get_client_ip();

		// CHECK IF CART ITEM EXIST
		$query = $this->Admin_model->get_cart($cart);
		if ($query->num_rows() > 0) {
			$row = $query->row();
			$jumlah = $row->jumlah;
			$id_barang = $row->id_barang;

			// CHECK AVAILABLE STOK
			$query = $this->Admin_model->get_barang($id_barang);
			$key = $query->row();
			$stok = $key->stok / $key->jumlah;

			if ($jumlah < $stok) {
				$data['id_barang'] = $row->id_barang;
				$data['ip_address'] = $this->get_client_ip();
				$data['jumlah'] = $row->jumlah + 1;
				$data['subtotal'] = $data['jumlah'] * $row->harga;

				// UPDATE BARANG
				$this->Admin_model->update_cart($data);

				$result['message'] = 2;
				echo json_encode($result);
			} else {
				$result['message'] = 0;
				echo json_encode($result);
			}
		} else {
			// GET BARANG BY BARCODE
			$barcode = $this->input->post('barcode');
			$query = $this->Admin_model->get_barang_bybarcode($barcode);

			if ($query->num_rows() > 0) {
				$row = $query->row();
				$harga = $row->harga_jual;

				$data['id_barang'] = $row->id;
				$data['ip_address'] = $this->get_client_ip();
				$data['barcode'] = $row->barcode;
				$data['nama_barang'] = $row->nama_barang;
				$data['harga'] = $harga;
				$data['jumlah'] = 1;
				$data['subtotal'] = $harga;

				// ADD CART
				$this->Admin_model->add_cart($data);

				$result['message'] = 1;
				echo json_encode($result);
			} else {
				$result['message'] = 0;
				echo json_encode($result);
			}
		}
	}

	public function update_amount()
	{
		$cart['id'] = $this->input->post('id');

		// GET CART
		$query = $this->Admin_model->get_cart($cart);
		$row = $query->row();

		$jumlah = $this->input->post('jumlah');
		$id_barang = $row->id_barang;

		// CHECK AVAILABLE STOK
		$query = $this->Admin_model->get_barang($id_barang);
		$key = $query->row();
		$stok = $key->stok / $key->jumlah;

		if ($jumlah < $stok) {
			$data['id'] = $this->input->post('id');
			$data['jumlah'] = $this->input->post('jumlah');
			$data['subtotal'] = $data['jumlah'] * $row->harga;

			// UPDATE CART
			$this->Admin_model->update_amount($data);

			$result['message'] = 1;
			echo json_encode($result);
		} else {
			$result['message'] = 0;
			echo json_encode($result);
		}
	}

	public function remove_cart()
	{
		$id = $this->input->post('id');

		// DELETE CART
		$this->Admin_model->delete_cart($id);

		$result['message'] = 1;
		echo json_encode($result);
	}

	public function clear_cart()
	{
		$ip = $this->get_client_ip();

		// CLEAR CART
		$this->Admin_model->clear_cart($ip);

		$result['message'] = 1;
		echo json_encode($result);
	}

	// SATUAN SECTION
	public function satuan()
	{

		$dir = 'admin';
		$view = 'satuan';
		$data = null;
		$template = 'satuan_template';
		$jquery = 'jquery_satuan';

		$this->view_loader($dir, $view, $data, $template, $jquery);
	}

	public function satuan_select2()
	{
		$search = $this->input->post('searchTerm');
		$limit = 5 * strlen($search);
		$query = $this->Admin_model->get_satuan_select2($search, $limit);
		$no = 0;
		foreach ($query->result_array() as $rows) {
			$data[$no]['id'] = $rows['id'];
			$data[$no]['text'] = $rows['nama_satuan'] . ' (' . $rows['kode_satuan'] . ')';
			$no++;
		}

		echo json_encode($data);
	}

	public function satuan_datatables()
	{
		$draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$length = intval($this->input->post("length"));
		$order = $this->input->post("order");
		$search = $this->input->post("search");
		$search = $search['value'];

		$query = $this->Admin_model->get_satuan_datatables($start, $length, $order, $search);
		$data = array();
		$no = 1;
		foreach ($query->result() as $rows) {
			$detail = '<a href="#" class="btn btn-detail btn-primary btn-circle btn-sm" data-id="' . $rows->id . '"><i class="fas fa-file"></i></a>';
			$update = '<a href="#" class="btn btn-update btn-success btn-circle btn-sm" data-id="' . $rows->id . '"><i class="fas fa-cog"></i></a>';
			$del = '<a href="#" class="btn btn-delete btn-danger btn-circle btn-sm" data-id="' . $rows->id . '"><i class="fas fa-trash"></i></a>';

			$namasatuan = ucwords($rows->nama_satuan);
			$kodesatuan = ucwords($rows->kode_satuan);
			$tipesatuan = ucwords($rows->tipe_satuan);

			$data[] = array(
				$no,
				$namasatuan,
				$kodesatuan,
				$tipesatuan,
				$detail . ' ' . $update . ' ' . $del
			);
			$no++;
		}

		if ($query->num_rows() > 0) {
			if ($search) {
				$total_rows = $this->Admin_model->get_satuan_length($search)->num_rows();
			} else {
				$total_rows = $this->Admin_model->get_all_satuan()->num_rows();
			}
		} else {
			$total_rows = 0;
		}

		$output = array(
			"draw" => $draw,
			"recordsTotal" => $total_rows,
			"recordsFiltered" => $total_rows,
			"data" => $data
		);
		echo json_encode($output);
	}

	public function satuan_list()
	{

		$query = $this->Admin_model->get_all_satuan();
		foreach ($query->result() as $row => $val) {
			$data[$row] = $val;
		}

		echo json_encode($data);
	}

	public function add_new_satuan()
	{
		$id = $this->input->post('id');
		$data['id_tipe_satuan'] = $this->input->post('id_tipe_satuan');
		$data['kode_satuan'] = $this->input->post('kode_satuan');
		$data['nama_satuan'] = $this->input->post('nama_satuan');


		if (!$id) {
			// ADD SATUAN
			$this->Admin_model->add_satuan($data);

			// RESPONSES
			$result['success'] = 1;
			$result['message'] = 'Data added succesfully';
		} else if ($id) {
			// UPDATE SATUAN
			$data['id'] = $id;
			$data['updatedate'] = date('Y-m-d H:i:s');
			$this->Admin_model->update_satuan($data);

			// RESPONSES
			$result['success'] = 2;
			$result['message'] = 'Data updated succesfully';
		} else {
			$result['success'] = 3;
			$result['message'] = 'Oops! Something went wrong';
		}


		echo json_encode($result);
	}

	public function get_satuan()
	{
		$id = $this->input->post('id');

		//GET SATUAN
		$query = $this->Admin_model->get_satuan($id);
		foreach ($query->result() as $row => $val) {
			$obj[$row] = $val;
		}

		foreach ($obj as $row) {
			$data = $row;
		}

		echo json_encode($data);
	}

	public function delete_satuan()
	{
		$data['id'] = $this->input->post('id');
		$data['isactive'] = 0;

		$this->Admin_model->update_satuan($data);

		// RESPONSES
		$result['success'] = 1;
		$result['message'] = 'Data deleted succesfully';

		echo json_encode($result);
	}

	// TIPE SATUAN SECTION
	public function tipesatuan()
	{

		$dir = 'admin';
		$view = 'tipesatuan';
		$data = null;
		$template = 'tipesatuan_template';
		$jquery = 'jquery_tipesatuan';

		$this->view_loader($dir, $view, $data, $template, $jquery);
	}

	public function tipesatuan_datatables()
	{
		$draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$length = intval($this->input->post("length"));
		$order = $this->input->post("order");
		$search = $this->input->post("search");
		$search = $search['value'];

		$query = $this->Admin_model->get_tipesatuan_datatables($start, $length, $order, $search);
		$data = array();
		$no = 1;
		foreach ($query->result() as $rows) {
			$detail = '<a href="#" class="btn btn-detail btn-primary btn-circle btn-sm" data-id="' . $rows->id . '"><i class="fas fa-file"></i></a>';
			$update = '<a href="#" class="btn btn-update btn-success btn-circle btn-sm" data-id="' . $rows->id . '"><i class="fas fa-cog"></i></a>';
			$del = '<a href="#" class="btn btn-delete btn-danger btn-circle btn-sm" data-id="' . $rows->id . '"><i class="fas fa-trash"></i></a>';

			$tipesatuan = ucwords($rows->tipe_satuan);

			$data[] = array(
				$no,
				$tipesatuan,
				$detail . ' ' . $update . ' ' . $del
			);
			$no++;
		}

		if ($query->num_rows() > 0) {
			if ($search) {
				$total_rows = $this->Admin_model->get_tipesatuan_length($search)->num_rows();
			} else {
				$total_rows = $this->Admin_model->get_all_tipesatuan()->num_rows();
			}
		} else {
			$total_rows = 0;
		}

		$output = array(
			"draw" => $draw,
			"recordsTotal" => $total_rows,
			"recordsFiltered" => $total_rows,
			"data" => $data
		);
		echo json_encode($output);
	}

	public function tipesatuan_select2()
	{
		$search = $this->input->post('searchTerm');
		$limit = 5 * strlen($search);
		$query = $this->Admin_model->get_tipesatuan_select2($search, $limit);
		$no = 0;
		foreach ($query->result_array() as $rows) {
			$data[$no]['id'] = $rows['id'];
			$data[$no]['text'] = $rows['tipe_satuan'];
			$no++;
		}

		echo json_encode($data);
	}

	public function tipesatuan_list()
	{

		$query = $this->Admin_model->get_all_tipesatuan();
		foreach ($query->result() as $row => $val) {
			$data[$row] = $val;
		}

		echo json_encode($data);
	}

	public function add_new_tipesatuan()
	{
		$id = $this->input->post('id');
		$data['tipe_satuan'] = $this->input->post('tipe_satuan');


		if (!$id) {
			// ADD TIPESATUAN
			$this->Admin_model->add_tipesatuan($data);

			// RESPONSES
			$result['success'] = 1;
			$result['message'] = 'Data added succesfully';
		} else if ($id) {
			// UPDATE MEMBER
			$data['id'] = $id;
			$data['updatedate'] = date('Y-m-d H:i:s');
			$this->Admin_model->update_tipesatuan($data);

			// RESPONSES
			$result['success'] = 2;
			$result['message'] = 'Data updated succesfully';
		} else {
			$result['success'] = 3;
			$result['message'] = 'Oops! Something went wrong';
		}


		echo json_encode($result);
	}

	public function get_tipesatuan()
	{
		$id = $this->input->post('id');

		//GET TIPESATUAN
		$query = $this->Admin_model->get_tipesatuan($id);
		foreach ($query->result() as $row => $val) {
			$obj[$row] = $val;
		}

		foreach ($obj as $row) {
			$data = $row;
		}

		echo json_encode($data);
	}

	public function delete_tipesatuan()
	{
		$data['id'] = $this->input->post('id');
		$data['isactive'] = 0;

		$this->Admin_model->update_tipesatuan($data);

		// RESPONSES
		$result['success'] = 1;
		$result['message'] = 'Data deleted succesfully';

		echo json_encode($result);
	}

	// USER SECTION
	public function user()
	{

		$dir = 'admin';
		$view = 'user';
		$data = null;
		$template = 'user_template';
		$jquery = 'jquery_user';

		$this->view_loader($dir, $view, $data, $template, $jquery);
	}

	public function user_datatables()
	{
		$draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$length = intval($this->input->post("length"));
		$order = $this->input->post("order");
		$search = $this->input->post("search");
		$search = $search['value'];

		$query = $this->Admin_model->get_user_datatables($start, $length, $order, $search);
		$data = array();
		$no = 1;
		foreach ($query->result() as $rows) {
			$detail = '<a href="#" class="btn btn-detail btn-primary btn-circle btn-sm" data-id="' . $rows->id . '"><i class="fas fa-file"></i></a>';
			$update = '<a href="#" class="btn btn-update btn-success btn-circle btn-sm" data-id="' . $rows->id . '"><i class="fas fa-cog"></i></a>';
			$del = '<a href="#" class="btn btn-delete btn-danger btn-circle btn-sm" data-id="' . $rows->id . '"><i class="fas fa-trash"></i></a>';

			$nama = ucwords($rows->name);

			$data[] = array(
				$no,
				$nama,
				$rows->username,
				$rows->mobile,
				$rows->role,
				$detail . ' ' . $update . ' ' . $del
			);
			$no++;
		}

		if ($query->num_rows() > 0) {
			if ($search) {
				$total_rows = $this->Admin_model->get_user_length($search)->num_rows();
			} else {
				$total_rows = $this->Admin_model->get_all_user()->num_rows();
			}
		} else {
			$total_rows = 0;
		}

		$output = array(
			"draw" => $draw,
			"recordsTotal" => $total_rows,
			"recordsFiltered" => $total_rows,
			"data" => $data
		);
		echo json_encode($output);
	}

	public function user_list()
	{

		$query = $this->Admin_model->get_all_user();
		foreach ($query->result() as $row => $val) {
			$data[$row] = $val;
		}

		echo json_encode($data);
	}

	public function role_list()
	{

		$query = $this->Admin_model->get_all_role();
		foreach ($query->result() as $row => $val) {
			$data[$row] = $val;
		}

		echo json_encode($data);
	}

	public function add_new_user()
	{
		$id = $this->input->post('id');

		if (!$id) {
			$data['id_role'] = $this->input->post('id_role');
			$data['username'] = $this->input->post('username');
			$data['name'] = $this->input->post('name');
			$data['email'] = $this->input->post('email');
			$data['mobile'] = $this->input->post('mobile');
			$data['address'] = $this->input->post('address');

			$password = $this->input->post('password_2');

			if (!empty($password)) {
				$password = $this->encryption->encrypt($password);
				$data['password'] = $password;
			}
			// CHECK USERNAME AVAILABLE
			$username = $this->input->post('username');
			$query = $this->Admin_model->get_user_byusername($username);
			if ($query->num_rows() > 0) {
				// RESPONSES
				$result['success'] = 0;
				$result['message'] = 'Some data restricted';
			} else {
				// ADD USER
				$this->Admin_model->add_user($data);

				// RESPONSES
				$result['success'] = 1;
				$result['message'] = 'Data added succesfully';
			}
		} else if ($id) {
			$isreset = $this->input->post('isreset');

			// CHECK FORM INPUT
			if ($isreset == 1) {
				$password = $this->input->post('password_2');

				if (!empty($password)) {
					$password = $this->encryption->encrypt($password);
					$data['password'] = $password;
				}
			} else {
				$data['id_role'] = $this->input->post('id_role');
				$data['username'] = $this->input->post('username');
				$data['name'] = $this->input->post('name');
				$data['email'] = $this->input->post('email');
				$data['mobile'] = $this->input->post('mobile');
				$data['address'] = $this->input->post('address');
			}

			// UPDATE USER
			$data['id'] = $id;
			$data['updatedate'] = date('Y-m-d H:i:s');
			$this->Admin_model->update_user($data);

			// RESPONSES
			$result['success'] = 2;
			$result['message'] = 'Data updated succesfully';
		} else {
			$result['success'] = 3;
			$result['message'] = 'Oops! Something went wrong';
		}


		echo json_encode($result);
	}

	public function get_user()
	{
		$id = $this->input->post('id');

		//GET USER
		$query = $this->Admin_model->get_user($id);
		foreach ($query->result() as $row => $val) {
			$obj[$row] = $val;
		}

		foreach ($obj as $row) {
			$data = $row;
		}

		echo json_encode($data);
	}

	public function delete_user()
	{
		$id = $this->input->post('id');

		// GET USER
		$query = $this->Admin_model->get_user($id);
		$row = $query->row();
		$islocked = $row->islocked;

		if ($islocked == 0) {
			$data['id'] = $this->input->post('id');
			$data['isactive'] = 0;

			$this->Admin_model->update_user($data);

			// RESPONSES
			$result['success'] = 1;
			$result['message'] = 'Data deleted succesfully';
		} else {
			// RESPONSES
			$result['success'] = 0;
			$result['message'] = 'Delete data restricted';
		}

		echo json_encode($result);
	}

	public function member()
	{

		$dir = 'admin';
		$view = 'member';
		$data = null;
		$template = 'member_template';
		$jquery = 'jquery_member';

		$this->view_loader($dir, $view, $data, $template, $jquery);
	}

	public function member_list()
	{

		$query = $this->Admin_model->get_all_member();
		foreach ($query->result() as $row => $val) {
			$data[$row] = $val;
		}

		echo json_encode($data);
	}

	public function add_new_member()
	{
		$id = $this->input->post('id');
		$data['id_jenis_member'] = 1;
		$data['nama'] = $this->input->post('nama');
		$data['alamat'] = $this->input->post('alamat');
		$data['email'] = $this->input->post('email');
		$data['handphone'] = $this->input->post('handphone');
		$data['gender'] = $this->input->post('gender');


		if (!$id) {
			// GENERATE USERNAME
			$query = $this->Admin_model->get_max_member_id();
			$row = $query->row();

			$max_id = $row->max_id + 1;
			if ($max_id < 10) {
				$data['username'] = 'user00' . $max_id;
			} else if ($max_id < 100) {
				$data['username'] = 'user0' . $max_id;
			} else {
				$data['username'] = 'user' . $max_id;
			}

			$data['password'] = $this->encryption->encrypt('123');


			// ADD MEMBER
			$this->Admin_model->add_member($data);

			// RESPONSES
			$result['success'] = 1;
			$result['message'] = 'Data added succesfully';
		} else if ($id) {
			// UPDATE MEMBER
			$data['id'] = $id;
			$data['update_date'] = date('Y-m-d');
			$this->Admin_model->update_member($data);

			// RESPONSES
			$result['success'] = 2;
			$result['message'] = 'Data updated succesfully';
		} else {
			$result['success'] = 3;
			$result['message'] = 'Oops! Something went wrong';
		}


		echo json_encode($result);
	}

	public function get_member()
	{
		$id = $this->input->post('id');

		//GET MEMBER
		$query = $this->Admin_model->get_member($id);
		foreach ($query->result() as $row => $val) {
			$obj[$row] = $val;
		}

		foreach ($obj as $row) {
			$data = $row;
		}

		echo json_encode($data);
	}

	public function delete_member()
	{
		$data['id'] = $this->input->post('id');
		$data['isactive'] = 0;

		$this->Admin_model->update_member($data);

		// RESPONSES
		$result['success'] = 1;
		$result['message'] = 'Data deleted succesfully';

		echo json_encode($result);
	}

	// APLIKASI SECTION
	public function aplikasi()
	{
		$dir = 'admin';
		$view = 'aplikasi';
		$data = null;
		$template = 'aplikasi_template';
		$jquery = 'jquery_aplikasi';

		$this->view_loader($dir, $view, $data, $template, $jquery);
	}

	public function aplikasi_datatables()
	{
		$draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$length = intval($this->input->post("length"));
		$order = $this->input->post("order");
		$search = $this->input->post("search");
		$search = $search['value'];

		$query = $this->Admin_model->get_aplikasi_datatables($start, $length, $order, $search);
		$data = array();
		$no = 1;
		foreach ($query->result() as $rows) {
			$detail = '<a href="#" class="btn btn-detail btn-primary btn-circle btn-sm" data-id="' . $rows->id . '"><i class="fas fa-file"></i></a>';
			$update = '<a href="#" class="btn btn-update btn-success btn-circle btn-sm" data-id="' . $rows->id . '"><i class="fas fa-cog"></i></a>';

			$data[] = array(
				$no,
				$rows->halaman,
				$detail . ' ' . $update
			);
			$no++;
		}

		if ($query->num_rows() > 0) {
			if ($search) {
				$total_rows = $this->Admin_model->get_aplikasi_length($search)->num_rows();
			} else {
				$total_rows = $this->Admin_model->get_all_aplikasi()->num_rows();
			}
		} else {
			$total_rows = 0;
		}

		$output = array(
			"draw" => $draw,
			"recordsTotal" => $total_rows,
			"recordsFiltered" => $total_rows,
			"data" => $data
		);
		echo json_encode($output);
	}

	public function aplikasi_list()
	{

		$query = $this->Admin_model->get_all_aplikasi();
		foreach ($query->result() as $row => $val) {
			$data[$row] = $val;
		}

		echo json_encode($data);
	}

	public function add_new_aplikasi()
	{
		$id = $this->input->post('id');
		$data['title'] = $this->input->post('title');
		$data['icon_caption'] = $this->input->post('icon_caption');
		$data['footer'] = $this->input->post('footer');


		if (!$id) {
			// ADD APLIKASI
			$this->Admin_model->add_aplikasi($data);

			// RESPONSES
			$result['success'] = 1;
			$result['message'] = 'Data added succesfully';
		} else if ($id) {
			// UPDATE APLIKASI
			$data['id'] = $id;
			$data['updatedate'] = date('Y-m-d H:i:s');
			$this->Admin_model->update_aplikasi($data);

			// RESPONSES
			$result['success'] = 2;
			$result['message'] = 'Data updated succesfully';
		} else {
			$result['success'] = 3;
			$result['message'] = 'Oops! Something went wrong';
		}


		echo json_encode($result);
	}

	public function get_aplikasi()
	{
		$this->input->post('id') ? $id = $this->input->post('id') : $id = $this->session->userdata('role');

		//GET APLIKASI
		$query = $this->Admin_model->get_aplikasi($id);
		foreach ($query->result() as $row => $val) {
			$obj[$row] = $val;
		}

		foreach ($obj as $row) {
			$data = $row;
		}

		echo json_encode($data);
	}

	// PRINTER SECTION
	public function printer()
	{
		$dir = 'admin';
		$view = 'printer';
		$data = null;
		$template = 'printer_template';
		$jquery = 'jquery_printer';

		$this->view_loader($dir, $view, $data, $template, $jquery);
	}

	public function printer_datatables()
	{
		$draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$length = intval($this->input->post("length"));
		$order = $this->input->post("order");
		$search = $this->input->post("search");
		$search = $search['value'];

		$query = $this->Admin_model->get_printer_datatables($start, $length, $order, $search);
		$data = array();
		$no = 1;
		foreach ($query->result() as $rows) {
			$detail = '<a href="#" class="btn btn-detail btn-primary btn-circle btn-sm" data-id="' . $rows->id . '"><i class="fas fa-file"></i></a>';
			$update = '<a href="#" class="btn btn-update btn-success btn-circle btn-sm" data-id="' . $rows->id . '"><i class="fas fa-cog"></i></a>';

			$rows->islocal == 1 ? $env = 'Lokal' : 'Network';

			$data[] = array(
				$no,
				$rows->printer_name,
				$rows->printer_model,
				$rows->port,
				$env,
				$detail . ' ' . $update
			);
			$no++;
		}

		if ($query->num_rows() > 0) {
			if ($search) {
				$total_rows = $this->Admin_model->get_printer_length($search)->num_rows();
			} else {
				$total_rows = $this->Admin_model->get_all_printer()->num_rows();
			}
		} else {
			$total_rows = 0;
		}

		$output = array(
			"draw" => $draw,
			"recordsTotal" => $total_rows,
			"recordsFiltered" => $total_rows,
			"data" => $data
		);
		echo json_encode($output);
	}

	public function printer_list()
	{

		$query = $this->Admin_model->get_all_printer();
		foreach ($query->result() as $row => $val) {
			$data[$row] = $val;
		}

		echo json_encode($data);
	}

	public function add_new_printer()
	{
		$id = $this->input->post('id');
		$data['printer_name'] = $this->input->post('printer_name');
		$data['printer_model'] = $this->input->post('printer_model');
		$data['port'] = $this->input->post('port');


		if (!$id) {
			// ADD PRINTER
			$this->Admin_model->add_printer($data);

			// RESPONSES
			$result['success'] = 1;
			$result['message'] = 'Data added succesfully';
		} else if ($id) {
			// UPDATE PRINTER
			$data['id'] = $id;
			$data['updatedate'] = date('Y-m-d H:i:s');
			$this->Admin_model->update_printer($data);

			// RESPONSES
			$result['success'] = 2;
			$result['message'] = 'Data updated succesfully';
		} else {
			$result['success'] = 3;
			$result['message'] = 'Oops! Something went wrong';
		}


		echo json_encode($result);
	}

	public function add_new_printer_barcode()
	{
		$id = $this->input->post('id');
		$data['paper_width'] = $this->input->post('paper_width');
		$data['paper_height'] = $this->input->post('paper_height');
		$data['margin'] = $this->input->post('margin');
		$data['padding'] = $this->input->post('padding');
		$data['holder_width'] = $this->input->post('holder_width');
		$data['holder_height'] = $this->input->post('holder_height');
		$data['barcode_text'] = $this->input->post('barcode_text');
		$data['barcode_width'] = $this->input->post('barcode_width');
		$data['barcode_height'] = $this->input->post('barcode_height');
		$data['barcode_background'] = $this->input->post('barcode_background');
		$data['barcode_fontsize'] = $this->input->post('barcode_fontsize');
		$data['barcode_font'] = $this->input->post('barcode_font');
		$data['barcode_fontoptions'] = $this->input->post('barcode_fontoptions');
		$data['barcode_linecolor'] = $this->input->post('barcode_linecolor');
		$data['barcode_textmargin'] = $this->input->post('barcode_textmargin');
		$data['barcode_textalign'] = $this->input->post('barcode_textalign');
		$data['barcode_textposition'] = $this->input->post('barcode_textposition');
		$data['barcode_marginleft'] = $this->input->post('barcode_marginleft');
		$data['barcode_marginright'] = $this->input->post('barcode_marginright');
		$data['barcode_margintop'] = $this->input->post('barcode_margintop');
		$data['barcode_marginbottom'] = $this->input->post('barcode_marginbottom');


		if (!$id) {
			// ADD PRINTER
			$this->Admin_model->add_printer_barcode($data);

			// RESPONSES
			$result['success'] = 1;
			$result['message'] = 'Data added succesfully';
		} else if ($id) {
			// UPDATE PRINTER
			$data['id'] = $id;
			$this->Admin_model->update_printer_barcode($data);

			// RESPONSES
			$result['success'] = 2;
			$result['message'] = 'Data updated succesfully';
		} else {
			$result['success'] = 3;
			$result['message'] = 'Oops! Something went wrong';
		}


		echo json_encode($result);
	}

	public function add_new_printer_nota()
	{
		$id = $this->input->post('id');
		$data['paper_width'] = $this->input->post('paper_width');
		$data['title'] = $this->input->post('title');
		$data['divider_char'] = $this->input->post('divider_char');
		$data['divider_length'] = $this->input->post('divider_length');
		$data['footer_line_1'] = $this->input->post('footer_line_1');
		$data['footer_line_2'] = $this->input->post('footer_line_2');
		$data['footer_line_3'] = $this->input->post('footer_line_3');

		if (!$id) {
			// ADD PRINTER
			$this->Admin_model->add_printer_nota($data);

			// RESPONSES
			$result['success'] = 1;
			$result['message'] = 'Data added succesfully';
		} else if ($id) {
			// UPDATE PRINTER
			$data['id'] = $id;
			$this->Admin_model->update_printer_nota($data);

			// RESPONSES
			$result['success'] = 2;
			$result['message'] = 'Data updated succesfully';
		} else {
			$result['success'] = 3;
			$result['message'] = 'Oops! Something went wrong';
		}


		echo json_encode($result);
	}

	public function get_printer()
	{
		$id = $this->input->post('id');

		//GET PRINTER
		$query = $this->Admin_model->get_printer($id);
		foreach ($query->result() as $row => $val) {
			$obj[$row] = $val;
		}

		foreach ($obj as $row) {
			$data = $row;
		}

		echo json_encode($data);
	}

	public function get_barcode_config()
	{
		//GET BARCODE CONFIG
		$query = $this->Admin_model->get_barcode_config();
		foreach ($query->result() as $row => $val) {
			$obj[$row] = $val;
		}

		foreach ($obj as $row) {
			$data = $row;
		}

		echo json_encode($data);
	}

	public function get_nota_config()
	{
		//GET BARCODE CONFIG
		$query = $this->Admin_model->get_nota_config();
		foreach ($query->result() as $row => $val) {
			$obj[$row] = $val;
		}

		foreach ($obj as $row) {
			$data = $row;
		}

		echo json_encode($data);
	}

	// LAPORAN TRANSAKSI SECTION
	public function laptransaksi()
	{

		$dir = 'admin';
		$view = 'laptransaksi';
		$data = null;
		$template = 'laptransaksi_template';
		$jquery = 'jquery_laptransaksi';

		$this->view_loader($dir, $view, $data, $template, $jquery);
	}

	public function laptransaksi_date($start, $end)
	{
		$title = 'Laporan Transaksi per ' . $start . '_' . $end;
		$query = $this->Admin_model->get_all_laptransaksi_date($start, $end);
		$field = $query->list_fields();
		$filename = 'Transaksi_' . date('ymdHi');

		// GENERATE
		$this->generate_excel($title, $field, $query, $filename);
	}

	public function laptransaksi_weekly()
	{
		$title = 'Laporan Transaksi Mingguan';
		$query = $this->Admin_model->get_all_laptransaksi_weekly();
		$field = $query->list_fields();
		$filename = 'Transaksi_Mingguan_' . date('ymdHi');

		// GENERATE
		$this->generate_excel($title, $field, $query, $filename);
	}

	public function laptransaksi_monthly()
	{
		$title = 'Laporan Transaksi Bulanan';
		$query = $this->Admin_model->get_all_laptransaksi_monthly();
		$field = $query->list_fields();
		$filename = 'Transaksi_Bulanan_' . date('ymdHi');

		// GENERATE
		$this->generate_excel($title, $field, $query, $filename);
	}

	public function laptransaksi_year()
	{
		$title = 'Laporan Transaksi Tahunan';
		$query = $this->Admin_model->get_all_laptransaksi_year();
		$field = $query->list_fields();
		$filename = 'Transaksi_Tahunan_' . date('ymdHi');

		// GENERATE
		$this->generate_excel($title, $field, $query, $filename);
	}

	public function laptransaksi_all()
	{
		$title = 'Laporan Transaksi';
		$query = $this->Admin_model->get_all_laptransaksi_all();
		$field = $query->list_fields();
		$filename = 'Transaksi_All_' . date('ymdHi');

		// GENERATE
		$this->generate_excel($title, $field, $query, $filename);
	}

	public function laptransaksi_barang_date($start, $end)
	{
		$title = 'Laporan Laba Rugi per ' . $start . '_' . $end;
		$query = $this->Admin_model->get_all_laptransaksi_barang_date($start, $end);
		$field = $query->list_fields();
		$filename = 'Laba_Rugi_' . date('ymdHi');

		// GENERATE
		$this->generate_excel($title, $field, $query, $filename);
	}

	public function laptransaksi_barang_weekly()
	{
		$title = 'Laporan Laba Rugi Mingguan';
		$query = $this->Admin_model->get_all_laptransaksi_barang_weekly();
		$field = $query->list_fields();
		$filename = 'Laba_Rugi_Mingguan_' . date('ymdHi');

		// GENERATE
		$this->generate_excel($title, $field, $query, $filename);
	}

	public function laptransaksi_barang_monthly()
	{
		$title = 'Laporan Laba Rugi Bulanan';
		$query = $this->Admin_model->get_all_laptransaksi_barang_monthly();
		$field = $query->list_fields();
		$filename = 'Laba_Rugi_Bulanan_' . date('ymdHi');

		// GENERATE
		$this->generate_excel($title, $field, $query, $filename);
	}

	public function laptransaksi_barang_year()
	{
		$title = 'Laporan Laba Rugi Tahunan';
		$query = $this->Admin_model->get_all_laptransaksi_barang_year();
		$field = $query->list_fields();
		$filename = 'Laba_Rugi_Tahunan_' . date('ymdHi');

		// GENERATE
		$this->generate_excel($title, $field, $query, $filename);
	}

	public function laptransaksi_barang_all()
	{
		$title = 'Laporan Laba Rugi';
		$query = $this->Admin_model->get_all_laptransaksi_barang_all();
		$field = $query->list_fields();
		$filename = 'Laba_Rugi_All_' . date('ymdHi');

		// GENERATE
		$this->generate_excel($title, $field, $query, $filename);
	}

	public function laptransaksi_labarugi_date($start, $end)
	{
		$title = 'Laporan Modal per ' . $start . '_' . $end;
		$query = $this->Admin_model->get_all_laptransaksi_labarugi_date($start, $end);
		$field = $query->list_fields();
		$filename = 'Modal_' . date('ymdHi');

		// GENERATE
		$this->generate_excel($title, $field, $query, $filename);
	}

	public function laptransaksi_labarugi_weekly()
	{
		$title = 'Laporan Modal Mingguan';
		$query = $this->Admin_model->get_all_laptransaksi_labarugi_weekly();
		$field = $query->list_fields();
		$filename = 'Modal_Mingguan_' . date('ymdHi');

		// GENERATE
		$this->generate_excel($title, $field, $query, $filename);
	}

	public function laptransaksi_labarugi_monthly()
	{
		$title = 'Laporan Modal Bulanan';
		$query = $this->Admin_model->get_all_laptransaksi_labarugi_monthly();
		$field = $query->list_fields();
		$filename = 'Modal_Bulanan_' . date('ymdHi');

		// GENERATE
		$this->generate_excel($title, $field, $query, $filename);
	}

	public function laptransaksi_labarugi_year()
	{
		$title = 'Laporan Modal Tahunan';
		$query = $this->Admin_model->get_all_laptransaksi_labarugi_year();
		$field = $query->list_fields();
		$filename = 'Modal_Tahunan_' . date('ymdHi');

		// GENERATE
		$this->generate_excel($title, $field, $query, $filename);
	}

	public function laptransaksi_labarugi_all()
	{
		$title = 'Laporan Modal';
		$query = $this->Admin_model->get_all_laptransaksi_labarugi_all();
		$field = $query->list_fields();
		$filename = 'Modal_All_' . date('ymdHi');

		// GENERATE
		$this->generate_excel($title, $field, $query, $filename);
	}

	// LAPORAN BARANG SECTION
	public function lapbarang()
	{

		$dir = 'admin';
		$view = 'lapbarang';
		$data = null;
		$template = 'lapbarang_template';
		$jquery = 'jquery_lapbarang';

		$this->view_loader($dir, $view, $data, $template, $jquery);
	}

	public function lapbarang_stok_date($start, $end)
	{
		$title = 'Laporan Stok Toko per ' . $start . '_' . $end;
		$query = $this->Admin_model->get_all_lapbarang_stok_date($start, $end);
		$field = $query->list_fields();
		$filename = 'Stok_Toko_' . date('ymdHi');

		// GENERATE
		$this->generate_excel($title, $field, $query, $filename);
	}

	public function lapbarang_stok_weekly()
	{
		$title = 'Laporan Stok Toko Mingguan';
		$query = $this->Admin_model->get_all_lapbarang_stok_weekly();
		$field = $query->list_fields();
		$filename = 'Stok_Toko_Mingguan_' . date('ymdHi');

		// GENERATE
		$this->generate_excel($title, $field, $query, $filename);
	}

	public function lapbarang_stok_monthly()
	{
		$title = 'Laporan Stok Toko Bulanan';
		$query = $this->Admin_model->get_all_lapbarang_stok_monthly();
		$field = $query->list_fields();
		$filename = 'Stok_Toko_Bulanan_' . date('ymdHi');

		// GENERATE
		$this->generate_excel($title, $field, $query, $filename);
	}

	public function lapbarang_stok_year()
	{
		$title = 'Laporan Stok Toko Tahunan';
		$query = $this->Admin_model->get_all_lapbarang_stok_year();
		$field = $query->list_fields();
		$filename = 'Stok_Toko_Tahunan_' . date('ymdHi');

		// GENERATE
		$this->generate_excel($title, $field, $query, $filename);
	}

	public function lapbarang_stok_all()
	{
		$title = 'Laporan Stok Toko';
		$query = $this->Admin_model->get_all_lapbarang_stok_all();
		$field = $query->list_fields();
		$filename = 'Stok_Toko_All_' . date('ymdHi');

		// GENERATE
		$this->generate_excel($title, $field, $query, $filename);
	}

	// LAPORAN WAREHOUSE SECTION
	public function lapwarehouse()
	{

		$dir = 'admin';
		$view = 'lapwarehouse';
		$data = null;
		$template = 'lapwarehouse_template';
		$jquery = 'jquery_lapwarehouse';

		$this->view_loader($dir, $view, $data, $template, $jquery);
	}

	public function lapwarehouse_stok_date($start, $end)
	{
		$title = 'Laporan Stok Gudang per ' . $start . '_' . $end;
		$query = $this->Admin_model->get_all_lapwarehouse_stok_date($start, $end);
		$field = $query->list_fields();
		$filename = 'Stok_Gudang_' . date('ymdHi');

		// GENERATE
		$this->generate_excel($title, $field, $query, $filename);
	}

	public function lapwarehouse_stok_weekly()
	{
		$title = 'Laporan Stok Gudang Mingguan';
		$query = $this->Admin_model->get_all_lapwarehouse_stok_weekly();
		$field = $query->list_fields();
		$filename = 'Stok_Gudang_Mingguan_' . date('ymdHi');

		// GENERATE
		$this->generate_excel($title, $field, $query, $filename);
	}

	public function lapwarehouse_stok_monthly()
	{
		$title = 'Laporan Stok Gudang Bulanan';
		$query = $this->Admin_model->get_all_lapwarehouse_stok_monthly();
		$field = $query->list_fields();
		$filename = 'Stok_Gudang_Bulanan_' . date('ymdHi');

		// GENERATE
		$this->generate_excel($title, $field, $query, $filename);
	}

	public function lapwarehouse_stok_year()
	{
		$title = 'Laporan Stok Gudang Tahunan';
		$query = $this->Admin_model->get_all_lapwarehouse_stok_year();
		$field = $query->list_fields();
		$filename = 'Stok_Gudang_Tahunan_' . date('ymdHi');

		// GENERATE
		$this->generate_excel($title, $field, $query, $filename);
	}

	public function lapwarehouse_stok_all()
	{
		$title = 'Laporan Stok Gudang';
		$query = $this->Admin_model->get_all_lapwarehouse_stok_all();
		$field = $query->list_fields();
		$filename = 'Stok_Gudang_All_' . date('ymdHi');

		// GENERATE
		$this->generate_excel($title, $field, $query, $filename);
	}

	public function lapwarehouse_stokopname_date($start, $end)
	{
		$title = 'Laporan Stok Opname per ' . $start . '_' . $end;
		$query = $this->Admin_model->get_all_lapwarehouse_stokopname_date($start, $end);
		$field = $query->list_fields();
		$filename = 'Stok_Opname_' . date('ymdHi');

		// GENERATE
		$this->generate_excel($title, $field, $query, $filename);
	}

	public function lapwarehouse_stokopname_weekly()
	{
		$title = 'Laporan Stok Opname Mingguan';
		$query = $this->Admin_model->get_all_lapwarehouse_stokopname_weekly();
		$field = $query->list_fields();
		$filename = 'Stok_Opname_Mingguan_' . date('ymdHi');

		// GENERATE
		$this->generate_excel($title, $field, $query, $filename);
	}

	public function lapwarehouse_stokopname_monthly()
	{
		$title = 'Laporan Stok Opname Bulanan';
		$query = $this->Admin_model->get_all_lapwarehouse_stokopname_monthly();
		$field = $query->list_fields();
		$filename = 'Stok_Opname_Bulanan_' . date('ymdHi');

		// GENERATE
		$this->generate_excel($title, $field, $query, $filename);
	}

	public function lapwarehouse_stokopname_year()
	{
		$title = 'Laporan Stok Opname Tahunan';
		$query = $this->Admin_model->get_all_lapwarehouse_stokopname_year();
		$field = $query->list_fields();
		$filename = 'Stok_Opname_Tahunan_' . date('ymdHi');

		// GENERATE
		$this->generate_excel($title, $field, $query, $filename);
	}

	public function lapwarehouse_stokopname_all()
	{
		$title = 'Laporan Stok Opname';
		$query = $this->Admin_model->get_all_lapwarehouse_stokopname_all();
		$field = $query->list_fields();
		$filename = 'Stok_Opname_All_' . date('ymdHi');

		// GENERATE
		$this->generate_excel($title, $field, $query, $filename);
	}

	// LAPORAN RETUR SECTION
	public function lapretur()
	{

		$dir = 'admin';
		$view = 'lapretur';
		$data = null;
		$template = 'lapretur_template';
		$jquery = 'jquery_lapretur';

		$this->view_loader($dir, $view, $data, $template, $jquery);
	}

	public function lapretur_date($start, $end)
	{
		$title = 'Laporan Retur per ' . $start . '_' . $end;
		$query = $this->Admin_model->get_all_lapretur_date($start, $end);
		$field = $query->list_fields();
		$filename = 'Retur_' . date('ymdHi');

		// GENERATE
		$this->generate_excel($title, $field, $query, $filename);
	}

	public function lapretur_weekly()
	{
		$title = 'Laporan Retur Mingguan';
		$query = $this->Admin_model->get_all_lapretur_weekly();
		$field = $query->list_fields();
		$filename = 'Retur_Mingguan_' . date('ymdHi');

		// GENERATE
		$this->generate_excel($title, $field, $query, $filename);
	}

	public function lapretur_monthly()
	{
		$title = 'Laporan Retur Bulanan';
		$query = $this->Admin_model->get_all_lapretur_monthly();
		$field = $query->list_fields();
		$filename = 'Retur_Bulanan_' . date('ymdHi');

		// GENERATE
		$this->generate_excel($title, $field, $query, $filename);
	}

	public function lapretur_year()
	{
		$title = 'Laporan Retur Tahunan';
		$query = $this->Admin_model->get_all_lapretur_year();
		$field = $query->list_fields();
		$filename = 'Retur_Tahunan_' . date('ymdHi');

		// GENERATE
		$this->generate_excel($title, $field, $query, $filename);
	}

	public function lapretur_all()
	{
		$title = 'Laporan Retur';
		$query = $this->Admin_model->get_all_lapretur_all();
		$field = $query->list_fields();
		$filename = 'Retur_All_' . date('ymdHi');

		// GENERATE
		$this->generate_excel($title, $field, $query, $filename);
	}

	public function lapretur_barang_date($start, $end)
	{
		$title = 'Laporan Retur Barang per ' . $start . '_' . $end;
		$query = $this->Admin_model->get_all_lapretur_barang_date($start, $end);
		$field = $query->list_fields();
		$filename = 'Retur_Barang_' . date('ymdHi');

		// GENERATE
		$this->generate_excel($title, $field, $query, $filename);
	}

	public function lapretur_barang_weekly()
	{
		$title = 'Laporan Retur Barang Mingguan';
		$query = $this->Admin_model->get_all_lapretur_barang_weekly();
		$field = $query->list_fields();
		$filename = 'Retur_Barang_Mingguan_' . date('ymdHi');

		// GENERATE
		$this->generate_excel($title, $field, $query, $filename);
	}

	public function lapretur_barang_monthly()
	{
		$title = 'Laporan Retur Barang Bulanan';
		$query = $this->Admin_model->get_all_lapretur_barang_monthly();
		$field = $query->list_fields();
		$filename = 'Retur_Barang_Bulanan_' . date('ymdHi');

		// GENERATE
		$this->generate_excel($title, $field, $query, $filename);
	}

	public function lapretur_barang_year()
	{
		$title = 'Laporan Retur Barang Tahunan';
		$query = $this->Admin_model->get_all_lapretur_barang_year();
		$field = $query->list_fields();
		$filename = 'Retur_Barang_Tahunan_' . date('ymdHi');

		// GENERATE
		$this->generate_excel($title, $field, $query, $filename);
	}

	public function lapretur_barang_all()
	{
		$title = 'Laporan Retur Barang';
		$query = $this->Admin_model->get_all_lapretur_barang_all();
		$field = $query->list_fields();
		$filename = 'Retur_Barang_All_' . date('ymdHi');

		// GENERATE
		$this->generate_excel($title, $field, $query, $filename);
	}

	public function dark_mode()
	{
		$checked = $this->input->post('checked');

		$checked == 1 ? $this->session->set_userdata('dark_mode', 1) : $this->session->set_userdata('dark_mode', 0);
		$checked == 1 ? $data['dark_mode'] = 1 : $data['dark_mode'] = 0;

		echo json_encode($data);
	}

	public function generate_excel($title, $field, $query, $filename)
	{
		// INIT
		$spreadsheet = $this->phpspreadsheet->init_excel();

		// SPREADSHEET INSTANCE
		$sheet = $spreadsheet->getActiveSheet();

		// DEFINE CELL ALPHABHET
		$max_col = count($field);
		$alpha = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X ', 'Y', 'Z');

		// EXCEL TITLE
		$sheet->setCellValueByColumnAndRow(1, 2, strtoupper($title));

		// TITLE STYLE
		$cell = 'A2:' . $alpha[$max_col - 1] . '2';
		$sheet->mergeCells($cell);

		$sheet->getStyle($cell)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
		$sheet->getStyle($cell)->getFont()->setBold(true);

		// BORDER STYLE
		$styleArray = [
			'borders' => [
				'outline' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
				],
			],
		];

		// COLUMN NAME
		$col = 1;
		foreach ($field as $field_name) {
			$cell = $alpha[$col - 1] . '4';
			$sheet->setCellValueByColumnAndRow($col, 4, str_replace('_', ' ', strtoupper($field_name)));
			$sheet->getStyle($cell)->applyFromArray($styleArray);
			$col++;
		}

		// ROW DATA
		$row = 5;
		foreach ($query->result() as $data) {
			$col = 1;
			foreach ($field as $field_name) {
				$cell = $alpha[$col - 1] . $row;
				$sheet->setCellValueByColumnAndRow($col, $row, $data->$field_name);
				$sheet->getStyle($cell)->applyFromArray($styleArray);
				$col++;
			}

			$row++;
		}

		// GENERATE
		$this->phpspreadsheet->compile_excel($spreadsheet, $filename);
	}

	public function generate_pdf()
	{
		$param = $this->input->post('pdf');
		$this->pdf->load_view($param);
	}

	// HARDWARE DETECTION SECTION
	public function get_client_ip()
	{
		$ipaddress = '';
		if (isset($_SERVER['HTTP_CLIENT_IP']))
			$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
		else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
			$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		else if (isset($_SERVER['HTTP_X_FORWARDED']))
			$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
		else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
			$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
		else if (isset($_SERVER['HTTP_FORWARDED']))
			$ipaddress = $_SERVER['HTTP_FORWARDED'];
		else if (isset($_SERVER['REMOTE_ADDR']))
			$ipaddress = $_SERVER['REMOTE_ADDR'];
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}

	public function view_loader($dir, $view, $data, $template = null, $jquery = null)
	{
		$this->load->view($dir . '/layout/head');
		$this->load->view($dir . '/layout/header');
		$this->load->view($dir . '/' . $view, $data);
		$this->load->view($dir . '/layout/footer');
		$template ? $this->load->view($dir . '/template/' . $template) : '';
		$jquery ? $this->load->view($dir . '/client_side/' . $jquery) : '';
	}
}
