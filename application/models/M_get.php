<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class M_get extends CI_Model {

    /**
     * Protected columns database
     */
    protected $table;
    /**
     * Get all table
     * @param $table (string)
     * @return Void
     */
    public function all($table)
    {
        $query  = $this->db->get($table);
        if ($query) {
            return $query;
        } else {
            return null;
        }
    }
    /**
     * Get table where
     * @param $table (String)
     * @param $id (array)
     * @return Void
     */
    public function where($table, $id)
    {
       $this->db->select('*');
       $this->db->from($table);
       $this->db->where($id);
       $query = $this->db->get();
       if ($query) {
         return $query;
       } else {
         return null;
       }
    }
    /**
     * Get model pagination
     * @param $table (String)
     * @param $limit
     * @param $start
     * @param $by (Order by)
     * @param $type ('asc', 'desc)
     * @return Void
     */
    public function pagination($table, $limit, $start, $by, $type)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->order_by($by, $type);
        $this->db->limit($limit, $start);
        $query = $this->db->get()->result();
        return $query;
    }
    /**
     * Check Data
     * @param $table
     * @param $data
     * @return Void
     */
    public function check($table, $data)
    {
        return $this->db->get_where($table, $data)->num_rows();
    }
    /**
     * Get data with limit and order by
     * @param $table
     * @param $limit
     * @param $by
     */
    public function limit_by($table, $limit, $by, $type)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->order_by($by, $type);
        $this->db->limit($limit);
        $query = $this->db->get()->result();
        return $query;
    }
    /**
     * Search Product
     */
    public function search_product($keyword)
    {
			$this->db->select('*');
			$this->db->from('table_product');
			$this->db->like('name',$keyword);
			$this->db->or_like('price',$keyword);
			return $this->db->get()->result();
    }
    /**
     * 
     */
    public function join_order()
    {
        $this->db->select('*');
        $this->db->from('table_customer');
        $this->db->join('table_orders', 'table_orders.invoice = table_customer.invoice');
        return $this->db->limit(1)->get()->result();
    }
   
}

/* End of file M_get.php */
