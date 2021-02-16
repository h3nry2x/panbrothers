<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_model extends CI_Model
{


    function __construct()
    {
        parent::__construct();
    }

    // DASHBOARD SECTION
    function get_penjualan($period)
    {
        $this->db->select('coalesce(sum(sub_total),0) nominal');
        $this->db->from('tbl_detail_transaksi');
        if ($period == 1) {
            $this->db->where('year(createdate)=year(now())');
            $this->db->where('month(createdate)=month(now())');
            $this->db->where('day(createdate)=day(now())');
        } else if ($period == 2) {
            $this->db->where('year(createdate)=year(now())');
            $this->db->where('week(createdate)=week(now())');
        } else if ($period == 3) {
            $this->db->where('year(createdate)=year(now())');
            $this->db->where('month(createdate)=month(now())');
        } else if ($period == 4) {
            $this->db->where('year(createdate)=year(now())');
        } else {
            $this->db->where('year(createdate)=year(now())');
            $this->db->where('month(createdate)=month(now())');
            $this->db->where('day(createdate)=day(now())');
        }

        $query = $this->db->get();
        return $query;
    }

    function get_pembelian($period)
    {
        $this->db->select('coalesce(sum(harga_beli * jumlah),0) nominal');
        $this->db->from('tbl_detail_transaksi');
        if ($period == 1) {
            $this->db->where('year(createdate)=year(now())');
            $this->db->where('month(createdate)=month(now())');
            $this->db->where('day(createdate)=day(now())');
        } else if ($period == 2) {
            $this->db->where('year(createdate)=year(now())');
            $this->db->where('week(createdate)=week(now())');
        } else if ($period == 3) {
            $this->db->where('year(createdate)=year(now())');
            $this->db->where('month(createdate)=month(now())');
        } else if ($period == 4) {
            $this->db->where('year(createdate)=year(now())');
        } else {
            $this->db->where('year(createdate)=year(now())');
            $this->db->where('month(createdate)=month(now())');
            $this->db->where('day(createdate)=day(now())');
        }

        $query = $this->db->get();
        return $query;
    }

    function get_amttransaksi($period)
    {
        $this->db->select('coalesce(count(*),0) amount');
        $this->db->from('tbl_transaksi');
        if ($period == 1) {
            $this->db->where('year(createdate)=year(now())');
            $this->db->where('month(createdate)=month(now())');
            $this->db->where('day(createdate)=day(now())');
        } else if ($period == 2) {
            $this->db->where('year(createdate)=year(now())');
            $this->db->where('week(createdate)=week(now())');
        } else if ($period == 3) {
            $this->db->where('year(createdate)=year(now())');
            $this->db->where('month(createdate)=month(now())');
        } else if ($period == 4) {
            $this->db->where('year(createdate)=year(now())');
        } else {
            $this->db->where('year(createdate)=year(now())');
            $this->db->where('month(createdate)=month(now())');
            $this->db->where('day(createdate)=day(now())');
        }

        $query = $this->db->get();
        return $query;
    }

    function get_past_penjualan($period)
    {
        $this->db->select('coalesce(sum(sub_total),0) nominal');
        $this->db->from('tbl_detail_transaksi');
        if ($period == 1) {
            $this->db->where('year(createdate)=year(now())');
            $this->db->where('month(createdate)=month(now())');
            $this->db->where('day(createdate)=day(now() - interval 1 day)');
        } else if ($period == 2) {
            $this->db->where('year(createdate)=year(now())');
            $this->db->where('week(createdate)=week(now() - interval 1 week)');
        } else if ($period == 3) {
            $this->db->where('year(createdate)=year(now())');
            $this->db->where('month(createdate)=month(now() - interval 1 month)');
        } else if ($period == 4) {
            $this->db->where('year(createdate)=year(now() - interval 1 year)');
        } else {
            $this->db->where('year(createdate)=year(now())');
            $this->db->where('month(createdate)=month(now())');
            $this->db->where('day(createdate)=day(now() - interval 1 day)');
        }

        $query = $this->db->get();
        return $query;
    }

    function get_past_pembelian($period)
    {
        $this->db->select('coalesce(sum(harga_beli * jumlah),0) nominal');
        $this->db->from('tbl_detail_transaksi');
        if ($period == 1) {
            $this->db->where('year(createdate)=year(now())');
            $this->db->where('month(createdate)=month(now())');
            $this->db->where('day(createdate)=day(now() - interval 1 day)');
        } else if ($period == 2) {
            $this->db->where('year(createdate)=year(now())');
            $this->db->where('week(createdate)=week(now() - interval 1 week)');
        } else if ($period == 3) {
            $this->db->where('year(createdate)=year(now())');
            $this->db->where('month(createdate)=month(now() - interval 1 month)');
        } else if ($period == 4) {
            $this->db->where('year(createdate)=year(now() - interval 1 year)');
        } else {
            $this->db->where('year(createdate)=year(now())');
            $this->db->where('month(createdate)=month(now())');
            $this->db->where('day(createdate)=day(now() - interval 1 day)');
        }

        $query = $this->db->get();
        return $query;
    }

    function get_amtretur($period)
    {
        $this->db->select('coalesce(count(*),0) amount');
        $this->db->from('tbl_retur');
        if ($period == 1) {
            $this->db->where('year(createdate)=year(now())');
            $this->db->where('month(createdate)=month(now())');
            $this->db->where('day(createdate)=day(now())');
        } else if ($period == 2) {
            $this->db->where('year(createdate)=year(now())');
            $this->db->where('week(createdate)=week(now())');
        } else if ($period == 3) {
            $this->db->where('year(createdate)=year(now())');
            $this->db->where('month(createdate)=month(now())');
        } else if ($period == 4) {
            $this->db->where('year(createdate)=year(now())');
        } else {
            $this->db->where('year(createdate)=year(now())');
            $this->db->where('month(createdate)=month(now())');
            $this->db->where('day(createdate)=day(now())');
        }

        $query = $this->db->get();
        return $query;
    }

    function get_margin()
    {
        $this->db->distinct();
        $this->db->select('sum(akumulasi)over(order by id) total');
        $this->db->from('v_margin');
        $this->db->order_by('id', 'desc');
        $this->db->limit(1);

        $query = $this->db->get();
        return $query;
    }

    function get_chart_profit($period)
    {
        $this->db->distinct();
        if ($period == 1) {
            $this->db->select('createhour createdate, sum(akumulasi)over(order by id) total');
            $this->db->from('v_dailyprofit');
            $this->db->order_by('id asc');
        } else if ($period == 2) {
            $this->db->select('createday createdate, akumulasi total');
            $this->db->from('v_weeklyprofit');
            $this->db->order_by('id asc');
        } else if ($period == 3) {
            $this->db->select('createdate, akumulasi total');
            $this->db->from('v_monthlyprofit');
            $this->db->order_by('id asc');
        } else if ($period == 4) {
            $this->db->select('createmonth createdate, akumulasi total');
            $this->db->from('v_yearprofit');
            $this->db->order_by('id', 'asc');
        } else {
            $this->db->select('createhour createdate, sum(akumulasi)over(order by id) total');
            $this->db->from('v_dailyprofit');
            $this->db->order_by('id asc');
        }


        $query = $this->db->get();
        return $query;
    }

    function get_chart_summary()
    {
        $this->db->select("createyearmonth createdate, akumulasi total");
        $this->db->from('v_runningmargin');
        $this->db->where('createyear=year(now())');
        $this->db->order_by('id', 'asc');

        $query = $this->db->get();
        return $query;
    }

    function get_all_lasttransaksi()
    {
        $this->db->select('*');
        $this->db->from('tbl_transaksi');
        $this->db->where('isactive', 1);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(5);
        $query = $this->db->get();
        return $query;
    }

    function get_all_popularproduct($period)
    {
        $this->db->distinct();
        $this->db->select('b.nama_barang, sum(a.jumlah)over(partition by a.id_barang) amount');
        $this->db->from('tbl_detail_transaksi a');
        $this->db->join('tbl_barang b', 'a.id_barang=b.id');
        if ($period == 1) {
            $this->db->where('year(a.createdate)=year(now())');
            $this->db->where('month(a.createdate)=month(now())');
            $this->db->where('day(a.createdate)=day(now())');
        } else if ($period == 2) {
            $this->db->where('year(a.createdate)=year(now())');
            $this->db->where('week(a.createdate)=week(now())');
        } else if ($period == 3) {
            $this->db->where('year(a.createdate)=year(now())');
            $this->db->where('month(a.createdate)=month(now())');
        } else if ($period == 4) {
            $this->db->where('year(a.createdate)=year(now())');
        } else {
            $this->db->where('year(a.createdate)=year(now())');
            $this->db->where('month(a.createdate)=month(now())');
            $this->db->where('day(a.createdate)=day(now())');
        }
        $this->db->order_by('sum(a.jumlah)over(partition by a.id_barang) desc');
        $this->db->limit(5);
        $query = $this->db->get();
        return $query;
    }

    // TRANSAKSI SECTION
    function get_transaksi_datatables($start = null, $length = null, $order = null, $search = null)
    {
        $this->db->select('*');
        $this->db->from('tbl_transaksi');
        $this->db->where('isactive',1);
        
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
			1 => 'kode_transaksi',
			2 => 'createdate',
			3 => 'total',
		);
		if (!isset($valid_columns[$col])) {
			$order = null;
		} else {
			$order = $valid_columns[$col];
		}
		if ($order != null) {
			$this->db->order_by($order, $dir);
		} else {
            $this->db->order_by('createdate','DESC');
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

    function get_transaksi_length($search=null){
        $this->db->select('*');
        $this->db->from('tbl_transaksi');
        $this->db->where('isactive',1);

        $valid_columns = array(
			1 => 'kode_transaksi',
			2 => 'createdate',
			3 => 'total',
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
    
    function get_all_transaksi()
    {
        $this->db->select('*');
        $this->db->from('tbl_transaksi');
        $this->db->where('isactive', 1);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    function get_transaksi($id)
    {
        $this->db->select('a.*');
        $this->db->from('tbl_transaksi a');
        $this->db->where('a.id', $id);
        $query = $this->db->get();
        return $query;
    }

    function get_max_transaksi_id()
    {
        $this->db->select('max(id) max_id');
        $this->db->from('transaksi');
        $query = $this->db->get();
        return $query;
    }

    function get_transaksi_bycode($code)
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->where('kode_transaksi', $code);
        $query = $this->db->get();
        return $query;
    }

    function get_transaksi_select2($search,$limit)
    {
        $this->db->select('*');
        $this->db->from('tbl_transaksi');
        $this->db->where('isactive', 1);
        if ($search) {
            $this->db->like('kode_transaksi', $search);
            $this->db->limit($limit);
            $this->db->order_by('id', 'DESC');
        } else {
            $this->db->limit(5);
            $this->db->order_by('id', 'DESC');
        }

        $query = $this->db->get();
        return $query;
    }

    // DETAIL TRANSAKSI SECTION
    function get_detail_transaksi($id)
    {
        $this->db->select('a.*, b.diskon, c.barcode, c.nama_barang, c.jumlah isi');
        $this->db->from('tbl_detail_transaksi a');
        $this->db->join('tbl_transaksi b', 'a.id_transaksi = b.id');
        $this->db->join('tbl_barang c', 'a.id_barang = c.id');
        $this->db->where('a.id_transaksi', $id);
        $this->db->where('b.isactive', 1);
        $query = $this->db->get();
        return $query;
    }

    // BARANG SECTION
    function get_barang_datatables($start = null, $length = null, $order = null, $search = null)
    {
        $this->db->select('a.*, b.stok, b.harga_beli, floor(b.stok/a.jumlah) est_stok, (a.harga_jual - (b.harga_beli * a.jumlah)) profit');
        $this->db->from('tbl_barang a');
        $this->db->join('tbl_warehouse b', 'a.id_warehouse=b.id');
        $this->db->where('a.isactive', 1);
        $this->db->where('b.isactive', 1);
        
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
			1 => 'a.nama_barang',
			2 => 'a.harga_jual',
            3 => '(a.harga_jual - (b.harga_beli * a.jumlah))',
            4 => '(floor(b.stok/a.jumlah))',
            5 => 'a.jumlah'
		);
		if (!isset($valid_columns[$col])) {
			$order = null;
		} else {
			$order = $valid_columns[$col];
		}
		if ($order != null) {
			$this->db->order_by($order, $dir);
		} else {
            $this->db->order_by('a.nama_barang','ASC');
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

    function get_barang_length($search=null){
        $this->db->select('a.*, b.stok, b.harga_beli, floor(b.stok/a.jumlah) est_stok, (a.harga_jual - (b.harga_beli * a.jumlah))');
        $this->db->from('tbl_barang a');
        $this->db->join('tbl_warehouse b', 'a.id_warehouse=b.id');
        $this->db->where('a.isactive', 1);
        $this->db->where('b.isactive', 1);

        $valid_columns = array(
			1 => 'a.nama_barang',
			2 => 'a.harga_jual',
            3 => '(a.harga_jual - (b.harga_beli * a.jumlah))',
            4 => '(floor(b.stok/a.jumlah))',
            5 => 'a.jumlah'
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

    function get_all_barang()
    {
        $this->db->select('a.*, b.stok, b.harga_beli');
        $this->db->from('tbl_barang a');
        $this->db->join('tbl_warehouse b', 'a.id_warehouse=b.id');
        $this->db->where('a.isactive', 1);
        $this->db->where('b.isactive', 1);
        $this->db->order_by('a.id', 'ASC');
        $query = $this->db->get();
        return $query;
    }

    function get_barang($id)
    {
        $this->db->select('a.*, b.nama_barang barang_induk, b.harga_beli, b.stok,c.kode_satuan, c.nama_satuan, d.tipe_satuan');
        $this->db->from('tbl_barang a');
        $this->db->join('tbl_warehouse b', 'a.id_warehouse=b.id');
        $this->db->join('tbl_satuan c', 'a.id_satuan=c.id');
        $this->db->join('tbl_tipe_satuan d', 'c.id_tipe_satuan=d.id');
        $this->db->where('a.id', $id);
        $this->db->where('a.isactive', 1);
        $this->db->where('b.isactive', 1);
        $query = $this->db->get();
        return $query;
    }

    function get_max_barang_id()
    {
        $this->db->select('max(id) max_id');
        $this->db->from('tbl_barang');
        $query = $this->db->get();
        return $query;
    }

    function get_barang_bycode($code)
    {
        $this->db->select('*');
        $this->db->from('tbl_barang');
        $this->db->where('kode_barang', $code);
        $this->db->where('isactive', 1);
        $query = $this->db->get();
        return $query;
    }

    function get_barang_inwarehouse($param)
    {
        $this->db->select('a.*, b.stok');
        $this->db->from('tbl_barang a');
        $this->db->join('tbl_warehouse b', 'a.id_warehouse=b.id');
        $this->db->where_in('a.id_warehouse', $param);
        $this->db->where('a.isactive', 1);
        $this->db->where('b.isactive', 1);
        $query = $this->db->get();
        return $query;
    }

    function get_barang_bybarcode($barcode)
    {
        $this->db->select('a.*, b.stok');
        $this->db->from('tbl_barang a');
        $this->db->join('tbl_warehouse b', 'a.id_warehouse=b.id');
        $this->db->where('a.barcode', $barcode);
        $this->db->where('a.isactive', 1);
        $this->db->where('b.isactive', 1);
        $query = $this->db->get();

        return $query;
    }

    // WAREHOUSE SECTION
    function get_warehouse_datatables($start = null, $length = null, $order = null, $search = null)
    {
        $this->db->select('*');
        $this->db->from('tbl_warehouse');
        $this->db->where('isactive',1);
        
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
			1 => 'nama_barang',
			2 => 'harga_beli',
			3 => 'stok',
		);
		if (!isset($valid_columns[$col])) {
			$order = null;
		} else {
			$order = $valid_columns[$col];
		}
		if ($order != null) {
			$this->db->order_by($order, $dir);
		} else {
            $this->db->order_by('nama_barang','ASC');
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

    function get_warehouse_length($search=null){
        $this->db->select('*');
        $this->db->from('tbl_warehouse');
        $this->db->where('isactive',1);

        $valid_columns = array(
			1 => 'nama_barang',
			2 => 'harga_beli',
			3 => 'stok',
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

    function get_all_warehouse()
    {
        $this->db->select('*');
        $this->db->from('tbl_warehouse');
        $this->db->where('isactive', 1);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    function get_warehouse($id)
    {
        $this->db->select('a.*, b.id id_detail_warehouse, c.kode_satuan, c.nama_satuan, d.tipe_satuan');
        $this->db->from('tbl_warehouse a');
        $this->db->join('tbl_detail_warehouse b', 'a.id=b.id_warehouse', 'left');
        $this->db->join('tbl_satuan c', 'a.id_satuan=c.id');
        $this->db->join('tbl_tipe_satuan d', 'c.id_tipe_satuan=d.id');
        $this->db->where('a.id', $id);
        $this->db->where('b.isactive', 1);
        $query = $this->db->get();
        return $query;
    }

    function get_history_harga($id)
    {
        $this->db->select('a.*');
        $this->db->from('(select * from tbl_detail_warehouse where id_warehouse=' . $id . ' order by id desc limit 10) a');
        $this->db->order_by('a.createdate', 'ASC');
        $query = $this->db->get();
        return $query;
    }

    function get_max_warehouse_id()
    {
        $this->db->select('max(id) max_id');
        $this->db->from('tbl_warehouse');
        $query = $this->db->get();
        return $query;
    }

    function get_warehouse_bycode($code)
    {
        $this->db->select('*');
        $this->db->from('tbl_warehouse');
        $this->db->where('kode_barang', $code);
        $query = $this->db->get();
        return $query;
    }

    function get_warehouse_bytransaksi($id)
    {
        $this->db->select('b.id_warehouse');
        $this->db->from('tbl_detail_transaksi a');
        $this->db->join('tbl_barang b', 'a.id_barang=b.id');
        $this->db->where('a.id_transaksi', $id);
        $this->db->where('b.isactive', 1);
        $query = $this->db->get();
        return $query;
    }

    function get_detail_warehouse_datatables($id, $start = null, $length = null, $order = null, $search = null)
    {
        $this->db->select("*, DATE_FORMAT(createdate, '%a, %d %M %Y %H:%i') waktu");
        $this->db->from('tbl_detail_warehouse');
        $this->db->where('id_warehouse', $id);
        
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
			1 => "createdate",
			2 => 'harga_beli',
			3 => 'stok_opname',
		);
		if (!isset($valid_columns[$col])) {
			$order = null;
		} else {
			$order = $valid_columns[$col];
		}
		if ($order != null) {
			$this->db->order_by($order, $dir);
		} else {
            $this->db->order_by('createdate','DESC');
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

    function get_detail_warehouse_length($id, $search=null){
        $this->db->select("*, DATE_FORMAT(createdate, '%a, %d %M %Y %H:%i') waktu");
        $this->db->from('tbl_detail_warehouse');
        $this->db->where('id_warehouse', $id);

        $valid_columns = array(
			1 => "createdate",
			2 => 'harga_beli',
			3 => 'stok_opname',
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

    function get_all_detail_warehouse($id)
    {
        $this->db->select("*, DATE_FORMAT(createdate, '%a, %d %M %Y %H:%i') waktu");
        $this->db->from('tbl_detail_warehouse');
        $this->db->where('id_warehouse', $id);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    function get_detail_warehouse($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_detail_warehouse');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query;
    }

    function get_detail_warehouse_bywarehouse($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_detail_warehouse');
        $this->db->where('id_warehouse', $id);
        $this->db->where('isactive', 1);
        $query = $this->db->get();
        return $query;
    }

    function get_warehouse_select2($search, $limit)
    {
        $this->db->select('*');
        $this->db->from('tbl_warehouse');
        $this->db->where('isactive', 1);
        if ($search) {
            $like = "(";
            $like = $like."barcode like '%".$search."%' ";
            $like = $like." or nama_barang like '%".$search."%' ";
            $like = $like.')';
            $this->db->where(''.$like.'');
            $this->db->limit($limit);
            $this->db->order_by('id', 'DESC');
        } else {
            $this->db->limit(5);
            $this->db->order_by('id', 'DESC');
        }

        $query = $this->db->get();
        return $query;
    }

    // RETUR SECTION
    function get_all_retur()
    {
        $this->db->select('*');
        $this->db->from('tbl_retur');
        $this->db->where('isactive', 1);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    function get_retur($id)
    {
        $this->db->select('a.id,a.id_transaksi,a.kode_retur,a.sub_total sub_total_retur, a.diskon kompensasi, a.total total_retur, a.catatan, a.createdate, a.updatedate, a.isexchange, a.isactive,
        b.kode_transaksi, b.subtotal sub_total_transaksi, b.diskon, b.total total_transaksi');
        $this->db->from('tbl_retur a');
        $this->db->join('tbl_transaksi b', 'a.id_transaksi=b.id');
        $this->db->where('a.id', $id);
        $this->db->where('a.isactive', 1);
        $query = $this->db->get();
        return $query;
    }

    function get_max_retur_id()
    {
        $this->db->select('max(id) max_id');
        $this->db->from('tbl_retur');
        $query = $this->db->get();
        return $query;
    }

    function get_retur_bycode($code)
    {
        $this->db->select('*');
        $this->db->from('tbl_retur');
        $this->db->where('kode_retur', $code);
        $query = $this->db->get();
        return $query;
    }

    function get_nomornota()
    {
        //$date=date('Y-m-d');
        $date = substr(strrev(time()), 0, 8);
        $sql = "select max(id) AS kode_retur from tbl_retur";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $no = ((int)$row->kode_retur) + 1;
        } else {
            $no = "0001";
        }

        $nonota = "INV/RET" . $date . $no;
        return $nonota;
    }

    // RETUR DETAIL SECTION
    function get_retur_detail($id)
    {
        $this->db->select('a.*, b.barcode, b.nama_barang, b.jumlah isi');
        $this->db->from('tbl_detail_retur a');
        $this->db->join('tbl_barang b', 'a.id_barang=b.id');
        $this->db->where('a.id_retur', $id);
        $this->db->where('a.isactive', 1);
        $this->db->order_by('a.id', 'ASC');
        $query = $this->db->get();
        return $query;
    }

    // CART SECTION
    function get_all_cart($cart)
    {
        $this->db->select('*');
        $this->db->from('tbl_cart_retur');
        $this->db->where($cart);
        $query = $this->db->get();

        return $query;
    }

    function get_cart($cart)
    {
        $this->db->select('*');
        $this->db->from('tbl_cart_retur');
        $this->db->where($cart);

        $query = $this->db->get();

        return $query;
    }

    // SATUAN SECTION
    function get_satuan_datatables($start = null, $length = null, $order = null, $search = null)
    {
        $this->db->select('a.*, b.tipe_satuan');
        $this->db->from('tbl_satuan a');
        $this->db->join('tbl_tipe_satuan b', 'a.id_tipe_satuan=b.id');
        $this->db->where('a.isactive', 1);
        
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
            1 => 'a.nama_satuan',
            2 => 'a.kode_satuan',
            3 => 'b.tipe_satuan'
		);
		if (!isset($valid_columns[$col])) {
			$order = null;
		} else {
			$order = $valid_columns[$col];
		}
		if ($order != null) {
			$this->db->order_by($order, $dir);
		} else {
            $this->db->order_by('a.nama_satuan','ASC');
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

    function get_satuan_length($search=null){
        $this->db->select('a.*, b.tipe_satuan');
        $this->db->from('tbl_satuan a');
        $this->db->join('tbl_tipe_satuan b', 'a.id_tipe_satuan=b.id');
        $this->db->where('a.isactive', 1);

        $valid_columns = array(
            1 => 'a.nama_satuan',
            2 => 'a.kode_satuan',
            3 => 'b.tipe_satuan'
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

    function get_all_satuan()
    {
        $this->db->select('a.*, b.tipe_satuan');
        $this->db->from('tbl_satuan a');
        $this->db->join('tbl_tipe_satuan b', 'a.id_tipe_satuan=b.id');
        $this->db->where('a.isactive', 1);
        $this->db->order_by('a.id', 'ASC');
        $query = $this->db->get();
        return $query;
    }

    function get_satuan($id)
    {
        $this->db->select('a.*, b.tipe_satuan');
        $this->db->from('tbl_satuan a');
        $this->db->join('tbl_tipe_satuan b', 'a.id_tipe_satuan=b.id');
        $this->db->where('a.id', $id);
        $query = $this->db->get();
        return $query;
    }

    function get_satuan_select2($search, $limit)
    {
        $this->db->select('*');
        $this->db->from('tbl_satuan');
        $this->db->where('isactive', 1);
        if ($search) {
            $like = "(";
            $like = $like."kode_satuan like '%".$search."%' ";
            $like = $like." or nama_satuan like '%".$search."%' ";
            $like = $like.')';
            $this->db->where(''.$like.'');
            $this->db->limit($limit);
            $this->db->order_by('kode_satuan', 'ASC');
        } else {
            $this->db->limit(5);
            $this->db->order_by('kode_satuan', 'ASC');
        }

        $query = $this->db->get();
        return $query;
    }

    // TIPE SATUAN SECTION
    function get_tipesatuan_datatables($start = null, $length = null, $order = null, $search = null)
    {
        $this->db->select('*');
        $this->db->from('tbl_tipe_satuan');
        $this->db->where('isactive', 1);
        
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
			1 => 'tipe_satuan'
		);
		if (!isset($valid_columns[$col])) {
			$order = null;
		} else {
			$order = $valid_columns[$col];
		}
		if ($order != null) {
			$this->db->order_by($order, $dir);
		} else {
            $this->db->order_by('tipe_satuan','ASC');
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

    function get_tipesatuan_length($search=null){
        $this->db->select('*');
        $this->db->from('tbl_tipe_satuan');
        $this->db->where('isactive', 1);

        $valid_columns = array(
			1 => 'tipe_satuan'
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

    function get_all_tipesatuan()
    {
        $this->db->select('*');
        $this->db->from('tbl_tipe_satuan');
        $this->db->where('isactive', 1);
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query;
    }

    function get_tipesatuan($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_tipe_satuan');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query;
    }

    function get_tipesatuan_select2($search,$limit)
    {
        $this->db->select('*');
        $this->db->from('tbl_tipe_satuan');
        $this->db->where('isactive', 1);
        if ($search) {
            $this->db->like('tipe_satuan', $search);
            $this->db->limit($limit);
            $this->db->order_by('id', 'ASC');
        } else {
            $this->db->limit(5);
            $this->db->order_by('id', 'ASC');
        }

        $query = $this->db->get();
        return $query;
    }

    // USER SECTION
    function get_user_datatables($start = null, $length = null, $order = null, $search = null)
    {
        $superuser = $this->session->userdata('superuser');

        $this->db->select('a.id, a.id_role, a.username, a.name, a.mobile, b.role');
        $this->db->from('tbl_users a');
        $this->db->join('tbl_roles b', 'a.id_role=b.id');
        $this->db->where('a.isactive', 1);

        if($superuser == 0){
            $this->db->where('a.islocked', 0);
        }
        
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
			1 => 'a.username',
			2 => 'a.name',
            3 => 'a.mobile',
            4 => 'b.role'
		);
		if (!isset($valid_columns[$col])) {
			$order = null;
		} else {
			$order = $valid_columns[$col];
		}
		if ($order != null) {
			$this->db->order_by($order, $dir);
		} else {
            $this->db->order_by('a.id','ASC');
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

    function get_user_length($search=null){
        $superuser = $this->session->userdata('superuser');
        
        $this->db->select('a.id, a.id_role, a.username, a.name, a.mobile, b.role');
        $this->db->from('tbl_users a');
        $this->db->join('tbl_roles b', 'a.id_role=b.id');
        $this->db->where('a.isactive', 1);

        if($superuser == 0){
            $this->db->where('a.islocked', 0);
        }

        $valid_columns = array(
			1 => 'a.username',
			2 => 'a.name',
            3 => 'a.mobile',
            4 => 'b.role'
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

    function get_all_user()
    {
        $this->db->select('a.id, a.id_role, a.username, a.name, a.mobile, b.role');
        $this->db->from('tbl_users a');
        $this->db->join('tbl_roles b', 'a.id_role=b.id');
        $this->db->where('a.isactive', 1);
        $this->db->order_by('a.id', 'ASC');
        $query = $this->db->get();
        return $query;
    }

    function get_all_role()
    {
        $this->db->select('a.*');
        $this->db->from('tbl_roles a');
        $this->db->where('a.isactive', 1);
        $this->db->order_by('a.id', 'ASC');
        $query = $this->db->get();
        return $query;
    }

    function get_user($id)
    {
        $this->db->select('a.id, a.id_role, a.username, a.name, a.email, a.mobile, a.address, a.createdate, a.updatedate, a.islocked, a.isactive, b.role');
        $this->db->from('tbl_users a');
        $this->db->join('tbl_roles b', 'a.id_role=b.id');
        $this->db->where('a.id', $id);
        $this->db->where('a.isactive', 1);
        $query = $this->db->get();
        return $query;
    }

    function get_user_byusername($username)
    {
        $this->db->select('a.id, a.id_role, a.username, a.name, a.email, a.mobile, a.address, a.createdate, a.updatedate, a.islocked, a.isactive, b.role');
        $this->db->from('tbl_users a');
        $this->db->join('tbl_roles b', 'a.id_role=b.id');
        $this->db->where('a.username', $username);
        $this->db->where('a.isactive', 1);
        $query = $this->db->get();
        return $query;
    }

    // MEMBER SECTION
    function get_all_member()
    {
        $this->db->select('*');
        $this->db->from('tbl_members');
        $query = $this->db->get();

        return $query;
    }

    function get_member($id)
    {
        $this->db->select('a.*, b.jenis_member');
        $this->db->from('member a');
        $this->db->join('jenis_member b', 'a.id_jenis_member=b.id');
        $this->db->where('a.id', $id);
        $query = $this->db->get();
        return $query;
    }

    function get_max_member_id()
    {
        $this->db->select('max(id) max_id');
        $this->db->from('member');
        $query = $this->db->get();
        return $query;
    }

    function get_member_byuser($user)
    {
        $this->db->select('*');
        $this->db->from('member');
        $this->db->where('username', $user);
        $query = $this->db->get();
        return $query;
    }

    // APLIKASI SECTION
    function get_aplikasi_datatables($start = null, $length = null, $order = null, $search = null)
    {
        $this->db->select('*');
        $this->db->from('tbl_app_config');
        
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
            1 => 'halaman'
		);
		if (!isset($valid_columns[$col])) {
			$order = null;
		} else {
			$order = $valid_columns[$col];
		}
		if ($order != null) {
			$this->db->order_by($order, $dir);
		} else {
            $this->db->order_by('id','ASC');
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

    function get_aplikasi_length($search=null){
        $this->db->select('*');
        $this->db->from('tbl_app_config');

        $valid_columns = array(
            1 => 'halaman'
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

    function get_all_aplikasi()
    {
        $this->db->select('*');
        $this->db->from('tbl_app_config');
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query;
    }

    function get_aplikasi($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_app_config');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query;
    }

    // PRINTER SECTION
    function get_printer_datatables($start = null, $length = null, $order = null, $search = null)
    {
        $this->db->select('*');
        $this->db->from('tbl_printer_config');
        
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
            1 => 'printer_name',
            2 => 'printer_model',
            3 => 'port',
            4 => 'islocal'
		);
		if (!isset($valid_columns[$col])) {
			$order = null;
		} else {
			$order = $valid_columns[$col];
		}
		if ($order != null) {
			$this->db->order_by($order, $dir);
		} else {
            $this->db->order_by('id','ASC');
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

    function get_printer_length($search=null){
        $this->db->select('*');
        $this->db->from('tbl_printer_config');

        $valid_columns = array(
            1 => 'printer_name',
            2 => 'printer_model',
            3 => 'port',
            4 => 'islocal'
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

    function get_all_printer()
    {
        $this->db->select('*');
        $this->db->from('tbl_app_config');
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query;
    }

    function get_printer($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_printer_config');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query;
    }

    function get_barcode_config()
    {
        $this->db->select('*');
        $this->db->from('tbl_barcode_config');
        $this->db->where('id', 1);
        $query = $this->db->get();
        return $query;
    }

    function get_nota_config()
    {
        $this->db->select('*');
        $this->db->from('tbl_nota_config');
        $this->db->where('id', 1);
        $query = $this->db->get();
        return $query;
    }

    // LAPORAN TRANSAKSI SECTION
    function get_all_laptransaksi_date($start, $end)
    {
        $this->db->select("row_number()over(order by id) no, kode_transaksi, createdate tanggal_transaksi,
        bayar, kembali, catatan, subtotal sub_total, diskon, total");
        $this->db->from('tbl_transaksi');
        $this->db->where("cast(createdate as date) >= '" . $start . "' and cast(createdate as date) <='" . $end . "'");
        $query = $this->db->get();
        return $query;
    }

    function get_all_laptransaksi_weekly()
    {
        $this->db->select('row_number()over(order by id) no, kode_transaksi, createdate tanggal_transaksi,
        bayar, kembali, catatan, subtotal sub_total, diskon, total');
        $this->db->from('tbl_transaksi');
        $this->db->where('year(cast(createdate as date))=year(now())');
        $this->db->where('yearweek(cast(createdate as date))=yearweek(now())');
        $query = $this->db->get();
        return $query;
    }

    function get_all_laptransaksi_monthly()
    {
        $this->db->select("row_number()over(order by id) no, kode_transaksi, createdate tanggal_transaksi,
        bayar, kembali, catatan, subtotal sub_total, diskon, total");
        $this->db->from('tbl_transaksi');
        $this->db->where('year(cast(createdate as date))=year(now())');
        $this->db->where('month(cast(createdate as date))=month(now())');
        $query = $this->db->get();
        return $query;
    }

    function get_all_laptransaksi_year()
    {
        $this->db->select("row_number()over(order by id) no, kode_transaksi, createdate tanggal_transaksi,
        bayar, kembali, catatan, subtotal sub_total, diskon, total");
        $this->db->from('tbl_transaksi');
        $this->db->where('year(cast(createdate as date))=year(now())');
        $query = $this->db->get();
        return $query;
    }

    function get_all_laptransaksi_all()
    {
        $this->db->select("row_number()over(order by id) no, kode_transaksi, createdate tanggal_transaksi,
        bayar, kembali, catatan, subtotal sub_total, diskon, total");
        $this->db->from('tbl_transaksi');
        $query = $this->db->get();
        return $query;
    }

    function get_all_laptransaksi_barang_date($start, $end)
    {
        $this->db->distinct();
        $this->db->select("dense_rank()over(order by a.id_barang) no, b.barcode, b.nama_barang, a.harga_beli ,a.harga harga_jual,
        sum(a.jumlah)over(partition by a.id_barang) jumlah_penjualan, sum(a.sub_total)over(partition by a.id_barang) sub_total, ((a.harga - a.harga_beli) * sum(a.jumlah)over(partition by a.id_barang)) profit");
        $this->db->from('tbl_detail_transaksi a');
        $this->db->join('tbl_barang b', 'a.id_barang = b.id');
        $this->db->where("cast(a.createdate as date) >= '" . $start . "' and cast(a.createdate as date) <='" . $end . "'");

        $query = $this->db->get();
        return $query;
    }

    function get_all_laptransaksi_barang_weekly()
    {
        $this->db->distinct();
        $this->db->select("dense_rank()over(order by a.id_barang) no, b.barcode, b.nama_barang, a.harga_beli ,a.harga harga_jual,
        sum(a.jumlah)over(partition by a.id_barang) jumlah_penjualan, sum(a.sub_total)over(partition by a.id_barang) sub_total, ((a.harga - a.harga_beli) * sum(a.jumlah)over(partition by a.id_barang)) profit");
        $this->db->from('tbl_detail_transaksi a');
        $this->db->join('tbl_barang b', 'a.id_barang = b.id');
        $this->db->where('year(cast(a.createdate as date))=year(now())');
        $this->db->where('yearweek(cast(a.createdate as date))=yearweek(now())');
        $query = $this->db->get();
        return $query;
    }

    function get_all_laptransaksi_barang_monthly()
    {
        $this->db->distinct();
        $this->db->select("dense_rank()over(order by a.id_barang) no, b.barcode, b.nama_barang, a.harga_beli ,a.harga harga_jual,
        sum(a.jumlah)over(partition by a.id_barang) jumlah_penjualan, sum(a.sub_total)over(partition by a.id_barang) sub_total, ((a.harga - a.harga_beli) * sum(a.jumlah)over(partition by a.id_barang)) profit");
        $this->db->from('tbl_detail_transaksi a');
        $this->db->join('tbl_barang b', 'a.id_barang = b.id');
        $this->db->where('year(cast(a.createdate as date))=year(now())');
        $this->db->where('month(cast(a.createdate as date))=month(now())');
        $query = $this->db->get();
        return $query;
    }

    function get_all_laptransaksi_barang_year()
    {
        $this->db->distinct();
        $this->db->select("dense_rank()over(order by a.id_barang) no, b.barcode, b.nama_barang, a.harga_beli ,a.harga harga_jual,
        sum(a.jumlah)over(partition by a.id_barang) jumlah_penjualan, sum(a.sub_total)over(partition by a.id_barang) sub_total, ((a.harga - a.harga_beli) * sum(a.jumlah)over(partition by a.id_barang)) profit");
        $this->db->from('tbl_detail_transaksi a');
        $this->db->join('tbl_barang b', 'a.id_barang = b.id');
        $this->db->where('year(cast(a.createdate as date))=year(now())');
        $query = $this->db->get();
        return $query;
    }

    function get_all_laptransaksi_barang_all()
    {
        $this->db->distinct();
        $this->db->select("dense_rank()over(order by a.id_barang) no, b.barcode, b.nama_barang, a.harga_beli ,a.harga harga_jual,
        sum(a.jumlah)over(partition by a.id_barang) jumlah_penjualan, sum(a.sub_total)over(partition by a.id_barang) sub_total, ((a.harga - a.harga_beli) * sum(a.jumlah)over(partition by a.id_barang)) profit");
        $this->db->from('tbl_detail_transaksi a');
        $this->db->join('tbl_barang b', 'a.id_barang = b.id');
        $query = $this->db->get();
        return $query;
    }

    function get_all_laptransaksi_labarugi_date($start, $end)
    {
        $this->db->distinct();
        $this->db->select("row_number()over(order by createdate) no,
        case
        when tipetransaksi = 'Pengembalian'
            then 'Retur'
        when tipetransaksi = 'Pembelian'
            then 'Stok Opname'
        when tipetransaksi = 'Penjualan'
            then 'Penjualan'
        else
            'Lain-Lain'
        end jenis_transaksi, 
        createdate tanggal_transaksi,
        case
        when akumulasi < 0
            then (-1 * akumulasi)
        else
            akumulasi
        end nominal_transaksi,
        sum(akumulasi)over(order by createdate) margin_harian");
        $this->db->from('v_raw_sales');
        $this->db->where("createdate >= '" . $start . "' and createdate <='" . $end . "'");

        $query = $this->db->get();
        return $query;
    }

    function get_all_laptransaksi_labarugi_weekly()
    {
        $this->db->distinct();
        $this->db->select("row_number()over(order by createdate) no,
        case
        when tipetransaksi = 'Pengembalian'
            then 'Retur'
        when tipetransaksi = 'Pembelian'
            then 'Stok Opname'
        when tipetransaksi = 'Penjualan'
            then 'Penjualan'
        else
            'Lain-Lain'
        end jenis_transaksi, 
        createdate tanggal_transaksi,
        case
        when akumulasi < 0
            then (-1 * akumulasi)
        else
            akumulasi
        end nominal_transaksi,
        sum(akumulasi)over(order by createdate) margin_harian");
        $this->db->from('v_raw_sales');
        $this->db->where('year(createdate)=year(now())');
        $this->db->where('yearweek(createdate)=yearweek(now())');
        $query = $this->db->get();
        return $query;
    }

    function get_all_laptransaksi_labarugi_monthly()
    {
        $this->db->distinct();
        $this->db->select("row_number()over(order by createdate) no,
        case
        when tipetransaksi = 'Pengembalian'
            then 'Retur'
        when tipetransaksi = 'Pembelian'
            then 'Stok Opname'
        when tipetransaksi = 'Penjualan'
            then 'Penjualan'
        else
            'Lain-Lain'
        end jenis_transaksi, 
        createdate tanggal_transaksi,
        case
        when akumulasi < 0
            then (-1 * akumulasi)
        else
            akumulasi
        end nominal_transaksi,
        sum(akumulasi)over(order by createdate) margin_harian");
        $this->db->from('v_raw_sales');
        $this->db->where('year(createdate)=year(now())');
        $this->db->where('month(createdate)=month(now())');
        $query = $this->db->get();
        return $query;
    }

    function get_all_laptransaksi_labarugi_year()
    {
        $this->db->distinct();
        $this->db->select("row_number()over(order by createdate) no,
        case
        when tipetransaksi = 'Pengembalian'
            then 'Retur'
        when tipetransaksi = 'Pembelian'
            then 'Stok Opname'
        when tipetransaksi = 'Penjualan'
            then 'Penjualan'
        else
            'Lain-Lain'
        end jenis_transaksi, 
        createdate tanggal_transaksi,
        case
        when akumulasi < 0
            then (-1 * akumulasi)
        else
            akumulasi
        end nominal_transaksi,
        sum(akumulasi)over(order by createdate) margin_harian");
        $this->db->from('v_raw_sales');
        $this->db->where('year(createdate)=year(now())');
        $query = $this->db->get();
        return $query;
    }

    function get_all_laptransaksi_labarugi_all()
    {
        $this->db->distinct();
        $this->db->select("row_number()over(order by createdate) no,
        case
        when tipetransaksi = 'Pengembalian'
            then 'Retur'
        when tipetransaksi = 'Pembelian'
            then 'Stok Opname'
        when tipetransaksi = 'Penjualan'
            then 'Penjualan'
        else
            'Lain-Lain'
        end jenis_transaksi, 
        createdate tanggal_transaksi,
        case
        when akumulasi < 0
            then (-1 * akumulasi)
        else
            akumulasi
        end nominal_transaksi,
        sum(akumulasi)over(order by createdate) margin_harian");
        $this->db->from('v_raw_sales');
        $query = $this->db->get();
        return $query;
    }

    // LAPORAN BARANG SECTION
    function get_all_lapbarang_stok_date($start, $end)
    {
        $this->db->select('row_number()over(order by a.id) no, a.barcode, b.nama_barang barang_induk, a.nama_barang, a.jumlah isi, b.harga_beli, a.harga_jual,
        case
        when b.updatedate is not null
            then b.updatedate
        else
            b.createdate
        end tanggal_so, 
        floor(b.stok/a.jumlah) estimasi_stok, (a.harga_jual * floor(b.stok/a.jumlah)) gross_profit', false);
        $this->db->from('tbl_barang a');
        $this->db->join('tbl_warehouse b', 'a.id_warehouse = b.id');
        $this->db->where("cast(case when b.updatedate IS NOT NULL then b.updatedate ELSE b.createdate END as date) >= '" . $start . "' 
        and cast(case when b.updatedate IS NOT NULL then b.updatedate ELSE b.createdate END as date) <='" . $end . "'");
        $this->db->where('a.isactive', 1);
        $this->db->where('b.isactive', 1);
        $query = $this->db->get();
        return $query;
    }

    function get_all_lapbarang_stok_weekly()
    {
        $this->db->select('row_number()over(order by a.id) no, a.barcode, b.nama_barang barang_induk,a.nama_barang, a.jumlah isi, b.harga_beli, a.harga_jual,
        case
        when b.updatedate is not null
            then b.updatedate
        else
            b.createdate
        end tanggal_so, 
        floor(b.stok/a.jumlah) estimasi_stok, (a.harga_jual * floor(b.stok/a.jumlah)) gross_profit', false);
        $this->db->from('tbl_barang a');
        $this->db->join('tbl_warehouse b', 'a.id_warehouse = b.id');
        $this->db->where('year(cast(case when b.updatedate IS NOT NULL then b.updatedate ELSE b.createdate END as date))=year(now())');
        $this->db->where('yearweek(cast(case when b.updatedate IS NOT NULL then b.updatedate ELSE b.createdate END as date))=yearweek(now())');
        $this->db->where('a.isactive', 1);
        $this->db->where('b.isactive', 1);
        $query = $this->db->get();
        return $query;
    }

    function get_all_lapbarang_stok_monthly()
    {
        $this->db->select('row_number()over(order by a.id) no, a.barcode, b.nama_barang barang_induk,a.nama_barang, a.jumlah isi, b.harga_beli, a.harga_jual,
        case
        when b.updatedate is not null
            then b.updatedate
        else
            b.createdate
        end tanggal_so, 
        floor(b.stok/a.jumlah) estimasi_stok, (a.harga_jual * floor(b.stok/a.jumlah)) gross_profit', false);
        $this->db->from('tbl_barang a');
        $this->db->join('tbl_warehouse b', 'a.id_warehouse = b.id');
        $this->db->where('year(cast(case when b.updatedate IS NOT NULL then b.updatedate ELSE b.createdate END as date))=year(now())');
        $this->db->where('month(cast(case when b.updatedate IS NOT NULL then b.updatedate ELSE b.createdate END as date))=month(now())');
        $this->db->where('a.isactive', 1);
        $this->db->where('b.isactive', 1);
        $query = $this->db->get();
        return $query;
    }

    function get_all_lapbarang_stok_year()
    {
        $this->db->select('row_number()over(order by a.id) no, a.barcode, b.nama_barang barang_induk,a.nama_barang, a.jumlah isi, b.harga_beli, a.harga_jual,
        case
        when b.updatedate is not null
            then b.updatedate
        else
            b.createdate
        end tanggal_so, 
        floor(b.stok/a.jumlah) estimasi_stok, (a.harga_jual * floor(b.stok/a.jumlah)) gross_profit', false);
        $this->db->from('tbl_barang a');
        $this->db->join('tbl_warehouse b', 'a.id_warehouse = b.id');
        $this->db->where('year(cast(case when b.updatedate IS NOT NULL then b.updatedate ELSE b.createdate END as date))=year(now())');
        $this->db->where('a.isactive', 1);
        $this->db->where('a.isactive', 1);
        $query = $this->db->get();
        return $query;
    }

    function get_all_lapbarang_stok_all()
    {
        $this->db->select('row_number()over(order by a.id) no, a.barcode, b.nama_barang barang_induk,a.nama_barang, a.jumlah isi, b.harga_beli, a.harga_jual,
        case
        when b.updatedate is not null
            then b.updatedate
        else
            b.createdate
        end tanggal_so, 
        floor(b.stok/a.jumlah) estimasi_stok, (a.harga_jual * floor(b.stok/a.jumlah)) gross_profit', false);
        $this->db->from('tbl_barang a');
        $this->db->join('tbl_warehouse b', 'a.id_warehouse = b.id');
        $this->db->where('a.isactive', 1);
        $this->db->where('b.isactive', 1);
        $query = $this->db->get();
        return $query;
    }

    // LAPORAN WAREHOUSE SECTION
    function get_all_lapwarehouse_stok_date($start, $end)
    {
        $this->db->select('row_number()over(order by id) no, barcode, nama_barang, 
        case
        when updatedate is not null
            then updatedate
        else
            createdate
        end tanggal_pembelian, 
        harga_beli, stok, (harga_beli * stok) revenue', false);
        $this->db->from('tbl_warehouse');
        $this->db->where("cast(case when updatedate IS NOT NULL then updatedate ELSE createdate END as date) >= '" . $start . "' 
        and cast(case when updatedate IS NOT NULL then updatedate ELSE createdate END as date) <='" . $end . "'");
        $this->db->where('isactive', 1);
        $query = $this->db->get();
        return $query;
    }

    function get_all_lapwarehouse_stok_weekly()
    {
        $this->db->select('row_number()over(order by id) no, barcode, nama_barang, 
        case
        when updatedate is not null
            then updatedate
        else
            createdate
        end tanggal_pembelian, 
        harga_beli, stok, (harga_beli * stok) revenue', false);
        $this->db->from('tbl_warehouse');
        $this->db->where('year(cast(case when updatedate IS NOT NULL then updatedate ELSE createdate END as date))=year(now())');
        $this->db->where('yearweek(cast(case when updatedate IS NOT NULL then updatedate ELSE createdate END as date))=yearweek(now())');
        $this->db->where('isactive', 1);
        $query = $this->db->get();
        return $query;
    }

    function get_all_lapwarehouse_stok_monthly()
    {
        $this->db->select('row_number()over(order by id) no, barcode, nama_barang, 
        case
        when updatedate is not null
            then updatedate
        else
            createdate
        end tanggal_pembelian, 
        harga_beli, stok, (harga_beli * stok) revenue', false);
        $this->db->from('tbl_warehouse');
        $this->db->where('year(cast(case when updatedate IS NOT NULL then updatedate ELSE createdate END as date))=year(now())');
        $this->db->where('month(cast(case when updatedate IS NOT NULL then updatedate ELSE createdate END as date))=month(now())');
        $this->db->where('isactive', 1);
        $query = $this->db->get();
        return $query;
    }

    function get_all_lapwarehouse_stok_year()
    {
        $this->db->select('row_number()over(order by id) no, barcode, nama_barang, 
        case
        when updatedate is not null
            then updatedate
        else
            createdate
        end tanggal_pembelian, 
        harga_beli, stok, (harga_beli * stok) revenue', false);
        $this->db->from('tbl_warehouse');
        $this->db->where('year(cast(case when updatedate IS NOT NULL then updatedate ELSE createdate END as date))=year(now())');
        $this->db->where('isactive', 1);
        $query = $this->db->get();
        return $query;
    }

    function get_all_lapwarehouse_stok_all()
    {
        $this->db->select('row_number()over(order by id) no, barcode, nama_barang, 
        case
        when updatedate is not null
            then updatedate
        else
            createdate
        end tanggal_pembelian, 
        harga_beli, stok, (harga_beli * stok) revenue', false);
        $this->db->from('tbl_warehouse');
        $this->db->where('isactive', 1);
        $query = $this->db->get();
        return $query;
    }

    function get_all_lapwarehouse_stokopname_date($start, $end)
    {
        $this->db->select('row_number()over(order by b.id) no, a.barcode, a.nama_barang, 
        b.createdate tanggal_so, b.harga_beli, b.stok_opname jumlah, (b.harga_beli * b.stok_opname) subtotal');
        $this->db->from('tbl_warehouse a');
        $this->db->join('tbl_detail_warehouse b', 'a.id = b.id_warehouse');
        $this->db->where("cast(b.createdate as date) >= '" . $start . "' and cast(b.createdate as date) <='" . $end . "'");
        $query = $this->db->get();
        return $query;
    }

    function get_all_lapwarehouse_stokopname_weekly()
    {
        $this->db->select('row_number()over(order by b.id) no, a.barcode, a.nama_barang, 
        b.createdate tanggal_so, b.harga_beli, b.stok_opname jumlah, (b.harga_beli * b.stok_opname) subtotal');
        $this->db->from('tbl_warehouse a');
        $this->db->join('tbl_detail_warehouse b', 'a.id = b.id_warehouse');
        $this->db->where('year(b.createdate)=year(now())');
        $this->db->where('yearweek(b.createdate)=yearweek(now())');
        $query = $this->db->get();
        return $query;
    }

    function get_all_lapwarehouse_stokopname_monthly()
    {
        $this->db->select('row_number()over(order by b.id) no, a.barcode, a.nama_barang, 
        b.createdate tanggal_so, b.harga_beli, b.stok_opname jumlah, (b.harga_beli * b.stok_opname) subtotal');
        $this->db->from('tbl_warehouse a');
        $this->db->join('tbl_detail_warehouse b', 'a.id = b.id_warehouse');
        $this->db->where('year(b.createdate)=year(now())');
        $this->db->where('month(b.createdate)=month(now())');
        $query = $this->db->get();
        return $query;
    }

    function get_all_lapwarehouse_stokopname_year()
    {
        $this->db->select('row_number()over(order by b.id) no, a.barcode, a.nama_barang, 
        b.createdate tanggal_so, b.harga_beli, b.stok_opname jumlah, (b.harga_beli * b.stok_opname) subtotal');
        $this->db->from('tbl_warehouse a');
        $this->db->join('tbl_detail_warehouse b', 'a.id = b.id_warehouse');
        $this->db->where('year(b.createdate)=year(now())');
        $query = $this->db->get();
        return $query;
    }

    function get_all_lapwarehouse_stokopname_all()
    {
        $this->db->select('row_number()over(order by b.id) no, a.barcode, a.nama_barang, 
        b.createdate tanggal_so, b.harga_beli, b.stok_opname jumlah, (b.harga_beli * b.stok_opname) subtotal');
        $this->db->from('tbl_warehouse a');
        $this->db->join('tbl_detail_warehouse b', 'a.id = b.id_warehouse');
        $query = $this->db->get();
        return $query;
    }

    // LAPORAN RETUR SECTION
    function get_all_lapretur_date($start, $end)
    {
        $this->db->select("row_number()over(order by a.id) no, b.kode_transaksi kode_transaksi_induk, a.kode_retur, a.createdate tanggal_retur,
        a.sub_total, a.diskon kompensasi, a.total,
        case
        when a.isexchange = 1
            then 'Ya'
        else
            'Tidak'
        end penukaran_barang, a.catatan", false);
        $this->db->from('tbl_retur a');
        $this->db->join('tbl_transaksi b', 'a.id_transaksi = b.id');
        $this->db->where("cast(a.createdate as date) >= '" . $start . "' and cast(a.createdate as date) <='" . $end . "'");
        $query = $this->db->get();
        return $query;
    }

    function get_all_lapretur_weekly()
    {
        $this->db->select("row_number()over(order by a.id) no, b.kode_transaksi kode_transaksi_induk, a.kode_retur, a.createdate tanggal_retur,
        a.sub_total, a.diskon kompensasi, a.total,
        case
        when a.isexchange = 1
            then 'Ya'
        else
            'Tidak'
        end penukaran_barang, a.catatan", false);
        $this->db->from('tbl_retur a');
        $this->db->join('tbl_transaksi b', 'a.id_transaksi = b.id');
        $this->db->where('year(cast(a.createdate as date))=year(now())');
        $this->db->where('yearweek(cast(a.createdate as date))=yearweek(now())');
        $query = $this->db->get();
        return $query;
    }

    function get_all_lapretur_monthly()
    {
        $this->db->select("row_number()over(order by a.id) no, b.kode_transaksi kode_transaksi_induk, a.kode_retur, a.createdate tanggal_retur,
        a.sub_total, a.diskon kompensasi, a.total,
        case
        when a.isexchange = 1
            then 'Ya'
        else
            'Tidak'
        end penukaran_barang, a.catatan", false);
        $this->db->from('tbl_retur a');
        $this->db->join('tbl_transaksi b', 'a.id_transaksi = b.id');
        $this->db->where('year(cast(a.createdate as date))=year(now())');
        $this->db->where('month(cast(a.createdate as date))=month(now())');
        $query = $this->db->get();
        return $query;
    }

    function get_all_lapretur_year()
    {
        $this->db->select("row_number()over(order by a.id) no, b.kode_transaksi kode_transaksi_induk, a.kode_retur, a.createdate tanggal_retur,
        a.sub_total, a.diskon kompensasi, a.total,
        case
        when a.isexchange = 1
            then 'Ya'
        else
            'Tidak'
        end penukaran_barang, a.catatan", false);
        $this->db->from('tbl_retur a');
        $this->db->join('tbl_transaksi b', 'a.id_transaksi = b.id');
        $this->db->where('year(cast(a.createdate as date))=year(now())');
        $query = $this->db->get();
        return $query;
    }

    function get_all_lapretur_all()
    {
        $this->db->select("row_number()over(order by a.id) no, b.kode_transaksi kode_transaksi_induk, a.kode_retur, a.createdate tanggal_retur,
        a.sub_total, a.diskon kompensasi, a.total,
        case
        when a.isexchange = 1
            then 'Ya'
        else
            'Tidak'
        end penukaran_barang, a.catatan", false);
        $this->db->from('tbl_retur a');
        $this->db->join('tbl_transaksi b', 'a.id_transaksi = b.id');
        $query = $this->db->get();
        return $query;
    }

    function get_all_lapretur_barang_date($start, $end)
    {
        $this->db->distinct();
        $this->db->select("dense_rank()over(order by a.id_barang) no, b.barcode, b.nama_barang, cast(a.createdate as date) tanggal_retur, a.harga harga_barang,
        sum(a.jumlah)over(partition by a.id_barang) jumlah_dikembalikan, sum(a.sub_total)over(partition by a.id_barang) sub_total");
        $this->db->from('tbl_detail_retur a');
        $this->db->join('tbl_barang b', 'a.id_barang = b.id');
        $this->db->where("cast(a.createdate as date) >= '" . $start . "' and cast(a.createdate as date) <='" . $end . "'");

        $query = $this->db->get();
        return $query;
    }

    function get_all_lapretur_barang_weekly()
    {
        $this->db->distinct();
        $this->db->select("dense_rank()over(order by a.id_barang) no, b.barcode, b.nama_barang, cast(a.createdate as date) tanggal_retur, a.harga harga_barang,
        sum(a.jumlah)over(partition by a.id_barang) jumlah_dikembalikan, sum(a.sub_total)over(partition by a.id_barang) sub_total");
        $this->db->from('tbl_detail_retur a');
        $this->db->join('tbl_barang b', 'a.id_barang = b.id');
        $this->db->where('year(cast(a.createdate as date))=year(now())');
        $this->db->where('yearweek(cast(a.createdate as date))=yearweek(now())');
        $query = $this->db->get();
        return $query;
    }

    function get_all_lapretur_barang_monthly()
    {
        $this->db->distinct();
        $this->db->select("dense_rank()over(order by a.id_barang) no, b.barcode, b.nama_barang, cast(a.createdate as date) tanggal_retur, a.harga harga_barang,
        sum(a.jumlah)over(partition by a.id_barang) jumlah_dikembalikan, sum(a.sub_total)over(partition by a.id_barang) sub_total");
        $this->db->from('tbl_detail_retur a');
        $this->db->join('tbl_barang b', 'a.id_barang = b.id');
        $this->db->where('year(cast(a.createdate as date))=year(now())');
        $this->db->where('month(cast(a.createdate as date))=month(now())');
        $query = $this->db->get();
        return $query;
    }

    function get_all_lapretur_barang_year()
    {
        $this->db->distinct();
        $this->db->select("dense_rank()over(order by a.id_barang) no, b.barcode, b.nama_barang, cast(a.createdate as date) tanggal_retur, a.harga harga_barang,
        sum(a.jumlah)over(partition by a.id_barang) jumlah_dikembalikan, sum(a.sub_total)over(partition by a.id_barang) sub_total");
        $this->db->from('tbl_detail_retur a');
        $this->db->join('tbl_barang b', 'a.id_barang = b.id');
        $this->db->where('year(cast(a.createdate as date))=year(now())');
        $query = $this->db->get();
        return $query;
    }

    function get_all_lapretur_barang_all()
    {
        $this->db->distinct();
        $this->db->select("dense_rank()over(order by a.id_barang) no, b.barcode, b.nama_barang, cast(a.createdate as date) tanggal_retur, a.harga harga_barang,
        sum(a.jumlah)over(partition by a.id_barang) jumlah_dikembalikan, sum(a.sub_total)over(partition by a.id_barang) sub_total");
        $this->db->from('tbl_detail_retur a');
        $this->db->join('tbl_barang b', 'a.id_barang = b.id');
        $query = $this->db->get();
        return $query;
    }

    function add_barang($data)
    {
        $this->db->insert('tbl_barang', $data);
    }

    function add_warehouse($data)
    {
        $this->db->insert('tbl_warehouse', $data);
    }

    function add_detail_warehouse($data)
    {
        $this->db->insert('tbl_detail_warehouse', $data);
    }

    function add_retur($data)
    {
        $this->db->insert('tbl_retur', $data);
    }

    function add_detail_retur($data)
    {
        $this->db->insert('tbl_detail_retur', $data);
    }

    function add_cart($data)
    {
        $this->db->insert('tbl_cart_retur', $data);
    }

    function add_satuan($data)
    {
        $this->db->insert('tbl_satuan', $data);
    }

    function add_tipesatuan($data)
    {
        $this->db->insert('tbl_tipe_satuan', $data);
    }

    function add_user($data)
    {
        $this->db->insert('tbl_users', $data);
    }

    function add_member($data)
    {
        $this->db->insert('member', $data);
    }

    function add_aplikasi($data)
    {
        $this->db->insert('tbl_app_config', $data);
    }

    function add_printer($data)
    {
        $this->db->insert('tbl_printer_config', $data);
    }

    function add_printer_barcode($data)
    {
        $this->db->insert('tbl_barcode_config', $data);
    }

    function add_printer_nota($data)
    {
        $this->db->insert('tbl_nota_config', $data);
    }

    function update_transaksi($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('tbl_transaksi', $data);
    }

    function update_barang($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('tbl_barang', $data);
    }

    function update_warehouse($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('tbl_warehouse', $data);
    }

    function update_detail_warehouse($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('tbl_detail_warehouse', $data);
    }

    function update_detail_bywarehouse($data)
    {
        $this->db->where('id_warehouse', $data['id_warehouse']);
        $this->db->update('tbl_detail_warehouse', $data);
    }

    function update_cart($data)
    {
        $this->db->where('id_barang', $data['id_barang']);
        $this->db->where('ip_address', $data['ip_address']);
        $this->db->update('tbl_cart_retur', $data);
    }

    function update_amount($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('tbl_cart_retur', $data);
    }

    function update_retur($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('tbl_retur', $data);
    }

    function update_satuan($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('tbl_satuan', $data);
    }

    function update_tipesatuan($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('tbl_tipe_satuan', $data);
    }

    function update_user($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('tbl_users', $data);
    }

    function update_member($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('member', $data);
    }

    function update_aplikasi($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('tbl_app_config', $data);
    }

    function update_printer($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('tbl_printer_config', $data);
    }

    function update_printer_barcode($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('tbl_barcode_config', $data);
    }

    function update_printer_nota($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('tbl_nota_config', $data);
    }

    // delete data
    function delete_detail_warehouse($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tbl_detail_warehouse');
    }

    function delete_cart($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tbl_cart_retur');
    }

    function clear_cart($ip)
    {
        $this->db->where('ip_address', $ip);
        $this->db->delete('tbl_cart_retur');
    }
}
