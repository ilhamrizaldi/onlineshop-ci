<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
/** ----------------------------------------------------------------------
 * CRUD SYSTEM (Create, Update, Delete)
 * -----------------------------------------------------------------------
 * @author Muhammad Ilham Rizaldi | Email : muhammadilhamrizaldi@gmail.com
 * @version 1.0
 * -----------------------------------------------------------------------
 */
class M_crud extends CI_Model {


    protected $table;

    /**
     * Create table
     * @param $table
     * @param $data (array)
     * @return Boolean
     */
    public function create($table, $data)
    {
        $query = $this->db->insert($table, $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    } 
    /**
     * Update table
     * @param $table (String)
     * @param $data (array)
     * @param $where (array)
     * @return Boolean
     */
    public function update($table, $data, $where)
    {
        $query  = $this->db->update($table, $data, $where);
        if ($query) {
            return true;
        } else {
            return false;
        }
    } 
    /**
     * Delete table
     * @param $table (String)
     * @param $id (array)
     * @return Boolean
     */
    public function delete($table, $id)
    {
        $query = $this->db->delete($table, $id);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

}

/* End of file ModelName.php */
