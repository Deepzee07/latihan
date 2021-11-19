<?php 
abstract class DB 
{
	abstract public function connection($host, $user, $password, $db);
}

interface Query
{
	public function select($select);
	public function from($table_name);
	public function where($where_att);
	public function order_by($order);
	public function generate_query_read();
	public function generate_query_insert();
}

class DB_Mysql extends DB implements Query
{
	protected $selectQuery;
	protected $insertQuery;
	protected $valuesQuery;
	protected $tableQuery;
	protected $whereQuery;
	protected $orderQuery;
	protected $koneksi;

	public function connection($host, $user, $password, $db){
		$this->koneksi = new Mysqli($host, $user, $password, $db);
	}
	public function select($select){
		$this->selectQuery = "SELECT " . $select; 
	}
	public function insert(){
		$this->insertQuery = "INSERT INTO " . $this->tableQuery ."('nama','kontak','jabatan','mapel1','mapel2')";
	}
	public function values($values){
		$this->valuesQuery = " VALUES (" . $values . ")";
	} 
	public function from($table_name){
		$this->tableQuery = "FROM " . $table_name;
	}
	public function where($where_att){
		$this->whereQuery = "WHERE " . $where_att;
	}
	public function order_by($order){
		$this->orderQuery = "ORDER BY " . $order;
	}
 
	public function generate_query_read(){
		if ($this->koneksi) {
			return $this->koneksi->query($this->selectQuery . $this->tableQuery);
		}
		else{
			return "Koneksi GAGAL!!";
		}
	}
	public function generate_query_insert(){
		if ($this->koneksi) {
			return $this->koneksi->query($this->insertQuery . $this->valuesQuery );
		}
		else{
			return "Koneksi GAGAL!!";
		}
	}
}


 ?>