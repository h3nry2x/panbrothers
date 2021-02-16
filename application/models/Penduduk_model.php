<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Penduduk_model extends CI_Model
{


    function __construct()
    {
        parent::__construct();
    }

    // PENDUDUK SECTION
    function get_penduduk_datatables($start = null, $length = null, $order = null, $search = null)
    {
        $this->db->select('*');
        $this->db->from('penduduk');
        
        $col = 0;
		$dir = "";
		if (!empty($order)) {
			foreach ($order as $o) {
				$col = $o['column'];
				$dir = $o['dir'];
			}
		}

		if ($dir != "asc" && $dir != "desc") {
			$dir = "desc";
		}
		$valid_columns = array(
			1 => 'nik',
			2 => 'nama',
		);
		if (!isset($valid_columns[$col])) {
			$order = null;
		} else {
			$order = $valid_columns[$col];
		}
		if ($order != null) {
			$this->db->order_by($order, $dir);
		} else {
            $this->db->order_by('nik','ASC');
        }

		if (!empty($search)) {
            $x = 0;
            $like = "(";
			foreach ($valid_columns as $sterm) {
				if ($x == 0) {
                    $like = $like.$sterm." like '%".$search."%' ";
				} else {
                    $like = $like." or ".$sterm." like '%".$search."%' ";
				}
				$x++;
            }
            $like = $like.')';
            $this->db->where("".$like."");
        }
        
		$this->db->limit($length, $start);

        $query = $this->db->get();
        return $query;
    }

    function get_penduduk_length($search=null){
        $this->db->select('*');
        $this->db->from('penduduk');

        $valid_columns = array(
			1 => 'nik',
			2 => 'nama',
		);
        
        if (!empty($search)) {
			$x = 0;
			$like = "(";
			foreach ($valid_columns as $sterm) {
				if ($x == 0) {
                    $like = $like.$sterm." like '%".$search."%' ";
				} else {
                    $like = $like." or ".$sterm." like '%".$search."%' ";
				}
				$x++;
            }
            $like = $like.')';
            $this->db->where("".$like."");
        }
        
        $query = $this->db->get();
        return $query;
    }

    // read all data
    function get_all_penduduk()
    {
        $this->db->select('*');
        $this->db->from('penduduk');
        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query;
    }

    // read data
    function get_penduduk($id)
    {
        $this->db->select('*');
        $this->db->from('penduduk');
        $this->db->where('id', $id);
        
        $query = $this->db->get();
        return $query;
    }

    // create data
    function add_penduduk($data)
    {
        $this->db->insert('penduduk', $data);
    }

    // update data
    function update_penduduk($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('penduduk', $data);
    }

    // delete data
    function delete_penduduk($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('penduduk');
    }
}
