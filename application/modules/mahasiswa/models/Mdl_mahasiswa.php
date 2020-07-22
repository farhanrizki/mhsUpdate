<?php 
  
class Mdl_mahasiswa extends CI_Model
{	
	public function __construct()
    {
        parent::__construct();
    }

    public function saveDataMHS(){
		$data=array(
			'nama'   => $this->input->post('nama'),
			'alamat' => $this->input->post('alamat'),
			'agama'  => $this->input->post('agama')
		);
		$result = $this->db->insert('tbmhs', $data);
		return $result;
	}

    public function deleteDataMHS($id){
        return $this->db->delete('tbmhs', ['id' => $id]); 
    }

	/*public function getAgama($searchTerm=""){
		$this->db->select('*');
		$this->db->where("agama like '%".$searchTerm."%' ");
		$fetched_records = $this->db->get('tbagama');
		$agama = $fetched_records->result_array();
		$data = array();
		foreach($agama as $row){
			$data[] = array("id"=>$row['id'], "text"=>$row['agama']);
		}
		return $data;
	}*/
}