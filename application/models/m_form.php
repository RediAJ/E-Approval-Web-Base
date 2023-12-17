<?php
class M_form extends CI_Model {
    public function getAutofillData($input_data1, $input_data2) {
        // Check which input has data and fetch data accordingly
        if (!empty($input_data1)) {
            $query = $this->db->get_where('pengguna', array('no_telp' => $input_data1));
        } elseif (!empty($input_data2)) {
            $query = $this->db->get_where('pengguna', array('no_ktp' => $input_data2));
            
        } else {
            // If neither input has data, handle this case as needed
            return array(); // or handle it based on your requirements
        }

        return $query->row_array();
    }
}
