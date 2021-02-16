<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Penduduk extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}

	// INDEX SECTION
	public function index()
	{

		$dir = 'admin';
		$view = 'index';
		$data = null;
		$template = 'index_template';
		$jquery = 'jquery_index';

		$this->view_loader($dir, $view, $data, $template, $jquery);
	}

	public function penduduk_datatables()
	{
		$draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$length = intval($this->input->post("length"));
		$order = $this->input->post("order");
		$search = $this->input->post("search");
		$search = $search['value'];

		$query = $this->Penduduk_model->get_penduduk_datatables($start, $length, $order, $search);
		$data = array();
		$no = 1;
		foreach ($query->result() as $rows) {
			$detail = '<a href="#" class="btn btn-detail btn-primary btn-sm" data-id="' . $rows->id . '"><i class="fas fa-file"></i></a>';
			$update = '<a href="#" class="btn btn-update btn-success btn-sm" data-id="' . $rows->id . '"><i class="fas fa-cog"></i></a>';
			$del = '<a href="#" class="btn btn-delete btn-danger btn-sm" data-id="' . $rows->id . '"><i class="fas fa-trash"></i></a>';

			$nama = ucwords($rows->nama);

			$data[] = array(
				$no,
				$rows->nik,
				$nama,
				$detail . ' ' . $update . ' ' . $del
			);
			$no++;
		}

		if ($query->num_rows() > 0) {
			if ($search) {
				$total_rows = $this->Penduduk_model->get_penduduk_length($search)->num_rows();
			} else {
				$total_rows = $this->Penduduk_model->get_all_penduduk()->num_rows();
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

	public function penduduk_list()
	{

		$query = $this->Admin_model->get_all_penduduk();
		foreach ($query->result() as $row => $val) {
			$data[$row] = $val;
		}

		echo json_encode($data);
	}

	public function add_new_penduduk()
	{
		$id = $this->input->post('id');

		if (!$id) {
			$data['nik'] = $this->input->post('nik');
			$data['nama'] = $this->input->pots('nama');
			$data['jenis_kelamin'] = $this->input->post('jenis_kelamin');
			$data['alamat'] = $this->input->post('alamat');

			// ADD WAREHOUSE
			$data['tanggalinput'] = date('Y-m-d H:i:s');
			$data['userinput'] = 'Admin';
			$this->Penduduk_model->add_penduduk($data);

			// RESPONSES
			$result['success'] = 1;
			$result['message'] = 'Data added succesfully';
		} else if ($id) {

			$data['nik'] = $this->input->post('nik');
			$data['nama'] = $this->input->pots('nama');
			$data['jenis_kelamin'] = $this->input->post('jenis_kelamin');
			$data['alamat'] = $this->input->post('alamat');

			// UPDATE WAREHOUSE
			$data['id'] = $id;
			$data['tanggalupdate'] = date('Y-m-d H:i:s');
			$data['userupdate'] = 'Admin';
			$this->Admin_model->update_penduduk($data);

			// RESPONSES
			$result['success'] = 2;
			$result['message'] = 'Data updated succesfully';
		} else {
			$result['success'] = 3;
			$result['message'] = 'Oops! Something went wrong';
		}


		echo json_encode($result);
	}

	public function get_penduduk()
	{
		$id = $this->input->post('id');

		$query = $this->Penduduk_model->get_penduduk($id);
		foreach ($query->result() as $row => $val) {
			$obj[$row] = $val;
		}

		foreach ($obj as $row) {
			$data = $row;
		}

		echo json_encode($data);
	}

	public function delete_penduduk()
	{
		$id = $this->input->post('id');

		$this->Admin_model->delete_penduduk($id);

		// RESPONSES
		$result['success'] = 1;
		$result['message'] = 'Data deleted succesfully';

		echo json_encode($result);
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
