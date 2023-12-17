<?php

class M_approval extends CI_Model
{

    public function get_all_approval()
    {
        $hasil = $this->db->query('SELECT * FROM approval JOIN user ON approval.id_user = user.id_user JOIN user_detail ON user.id_user_detail = user_detail.id_user_detail ORDER BY user_detail.nama_lengkap ASC');
        return $hasil;
    }

    public function get_all_approval_by_id_user($id_user)
    {
        $hasil = $this->db->query("SELECT * FROM approval JOIN user ON approval.id_user = user.id_user JOIN user_detail ON user.id_user_detail = user_detail.id_user_detail WHERE approval.id_user='$id_user'");
        return $hasil;
    }

    public function get_all_approval_first_by_id_user($id_user)
    {
        $hasil = $this->db->query("SELECT * FROM approval JOIN user ON approval.id_user = user.id_user JOIN user_detail ON user.id_user_detail = user_detail.id_user_detail WHERE approval.id_user='$id_user' AND approval.id_status_approval='2' ORDER BY approval.tgl_diajukan DESC LIMIT 1");
        return $hasil;
    }

    public function get_all_approval_by_id_approval($id_approval)
    {
        $hasil = $this->db->query("SELECT * FROM approval JOIN user ON approval.id_user = user.id_user JOIN user_detail ON user.id_user_detail = user_detail.id_user_detail WHERE approval.id_approval='$id_approval'");
        return $hasil;
    }

    public function insert_data_approval($id_approval, $id_user, $alasan, $mulai, $berakhir, $id_status_approval, $perihal_approval)
    {
        $this->db->trans_start();
        $this->db->query("INSERT INTO approval(id_approval,id_user, alasan, tgl_diajukan, mulai, berakhir, id_status_approval, perihal_approval) VALUES ('$id_approval','$id_user','$alasan',NOW(),'$mulai', '$berakhir', '$id_status_approval', '$perihal_approval')");
        $this->db->trans_complete();
        if($this->db->trans_status()==true)
            return true;
        else
            return false;
    }

    public function delete_approval($id_approval)
    {
        $this->db->trans_start();
        $this->db->query("DELETE FROM approval WHERE id_approval='$id_approval'");
        $this->db->trans_complete();
        if($this->db->trans_status()==true)
            return true;
        else
            return false;
    }

    public function update_approval($alasan, $perihal_approval, $tgl_diajukan, $mulai, $berakhir, $id_approval)
    {
        $this->db->trans_start();
        $this->db->query("UPDATE approval SET alasan='$alasan', perihal_approval='$perihal_approval', tgl_diajukan='$tgl_diajukan', mulai='$mulai', berakhir='$berakhir' WHERE id_approval='$id_approval'");
        $this->db->trans_complete();
        if($this->db->trans_status()==true)
            return true;
        else
            return false;
    }

    public function confirm_approval($id_approval, $id_status_approval, $alasan_verifikasi)
    {
        $this->db->trans_start();
        $this->db->query("UPDATE approval SET id_status_approval='$id_status_approval', alasan_verifikasi='$alasan_verifikasi' WHERE id_approval='$id_approval'");
        $this->db->trans_complete();
        if($this->db->trans_status()==true)
            return true;
        else
            return false;
    }

   
    public function count_all_approval()
    {
        $hasil = $this->db->query('SELECT COUNT(id_approval) as total_approval FROM approval JOIN user ON approval.id_user = user.id_user JOIN user_detail ON user.id_user_detail = user_detail.id_user_detail');
        return $hasil;
    }

    public function count_all_approval_by_id($id_user)
    {
        $hasil = $this->db->query("SELECT COUNT(id_approval) as total_approval FROM approval JOIN user ON approval.id_user = user.id_user JOIN user_detail ON user.id_user_detail = user_detail.id_user_detail WHERE approval.id_user='$id_user'");
        return $hasil;
    }

    public function count_all_approval_acc()
    {
        $hasil = $this->db->query('SELECT COUNT(id_approval) as total_approval FROM approval JOIN user ON approval.id_user = user.id_user JOIN user_detail ON user.id_user_detail = user_detail.id_user_detail WHERE id_status_approval=2');
        return $hasil;
    }

    public function count_all_approval_acc_by_id($id_user)
    {
        $hasil = $this->db->query("SELECT COUNT(id_approval) as total_approval FROM approval JOIN user ON approval.id_user = user.id_user JOIN user_detail ON user.id_user_detail = user_detail.id_user_detail WHERE id_status_approval=2 AND approval.id_user='$id_user'");
        return $hasil;
    }

    public function count_all_approval_confirm()
    {
        $hasil = $this->db->query('SELECT COUNT(id_approval) as total_approval FROM approval JOIN user ON approval.id_user = user.id_user JOIN user_detail ON user.id_user_detail = user_detail.id_user_detail WHERE id_status_approval=1');
        return $hasil;
    }

    public function count_all_approval_confirm_by_id($id_user)
    {
        $hasil = $this->db->query("SELECT COUNT(id_approval) as total_approval FROM approval JOIN user ON approval.id_user = user.id_user JOIN user_detail ON user.id_user_detail = user_detail.id_user_detail WHERE id_status_approval=1 AND approval.id_user='$id_user'");
        return $hasil;
    }

    public function count_all_approval_reject()
    {
        $hasil = $this->db->query('SELECT COUNT(id_approval) as total_approval FROM approval JOIN user ON approval.id_user = user.id_user JOIN user_detail ON user.id_user_detail = user_detail.id_user_detail WHERE id_status_approval=3');
        return $hasil;
    }

    public function count_all_approval_reject_by_id($id_user)
    {
        $hasil = $this->db->query("SELECT COUNT(id_approval) as total_approval FROM approval JOIN user ON approval.id_user = user.id_user JOIN user_detail ON user.id_user_detail = user_detail.id_user_detail WHERE id_status_approval=3 AND approval.id_user='$id_user'");
        return $hasil;
    }


}