<?php 
/**
 * 
 */
include 'polymorphysm.php';
class Struktural
{
	protected 	$Nama,
				$Kontak,
				$Jabatan,
				$con;
	public static $Lembaga;		

	
	// public function __construct($nama=NULL, $kontak=NULL, $jabatan=NULL)
	// {
	// 	$this->Nama = $nama;
	// 	$this->Kontak = $kontak;
	// 	$this->Jabatan = $jabatan;
	// }

	public function __construct($host, $user, $pass, $db){
		$this->con = new DB_Mysql();
		$this->con->connection($host ,$user, $pass, $db);
	}

	public function setData($nama ,$kontak, $jabatan, $mapel1="none", $mapel2="none"){
		$this->con->insert();
		$this->con->from("tb_guru");
		$this->con->values("'','$nama', '$kontak', '$jabatan', '$mapel1', '$mapel2'");
		$data = $this->con->generate_query_insert();

	}
	public function getData(){
		$this->con->select("*");
		$this->con->from("tb_guru");
		$data = $this->con->generate_query_read();
		return $data;
	}
	public function __destruct(){
	 	echo "Ini Destructor" . "<br>";
	 }

	public function __call($name,$argument){ // overloading 
		if ($name=='setJam') {
			switch (sizeof($argument)) {
				case 1:
					$this->Jumlah = $argument[0];
					break;
				case 2:
					# code...
					$this->Jumlah = $argument[0] + $argument[1];
					
					break;
				case 3:
					# code...
					$this->Jumlah = $argument[0] + $argument[1] + $argument[2];
					
					break;
				case 4:
					# code...
					$this->Jumlah = $argument[0] + $argument[1] + $argument[2] + $argument[3];
					
					break;
				case 5:
					# code...
					$this->Jumlah = $argument[0] + $argument[1] + $argument[2] + $argument[3] + $argument[4];
					
					break;				
				case 6:
					# code...
					$this->Jumlah = $argument[0] + $argument[1] + $argument[2] + $argument[3] + $argument[4] + $argument[5];
					
					break;
			}
		}
	}	
	// Setter
	public function setNama($nama){$this->Nama = $nama;}
	public function setKontak($kontak){$this->Kontak = $kontak;}
	public function setJabatan($jabatan){$this->Jabatan = $jabatan;}


	// Getter
	// public function getNama(){return $this->Nama;}
	// public function getKontak(){return $this->Kontak;}
	// public function getJabatan(){return $this->Jabatan;}
	// public function getJam(){return $this->Jumlah;}
	// public static function getLembaga(){return self::$Lembaga;}
}

class Guru extends Struktural 
{
	private $Mapel1, $Mapel2;
	public function __construct($host, $user, $pass, $db){
		$this->con = new DB_Mysql();
		$this->con->connection($host ,$user, $pass, $db);
	}

	// public function __construct($nama=NULL, $kontak=NULL, $jabatan=NULL ,$mapel1=NULL, $mapel2=NULL)
	// {
	// 	$this->Nama = $nama;
	// 	$this->Kontak = $kontak;
	// 	$this->Jabatan = $jabatan;
	// 	$this->Mapel1 = $mapel1;
	// 	$this->Mapel2 = $mapel2;
	// }
	
	public function setMapel($mapel1, $mapel2){
		$this->Mapel1 = $mapel1;
		$this->Mapel2 = $mapel2;
	}

	

	private function getMapel(){
		return $this->Mapel1 . " & " . $this->Mapel2;

	}

	public function getJam(){ // overriding
		return parent::getJam() . ", dengan mapel : " . self::getMapel() ;
	} 
} 


$guru = new Guru("localhost","root","","dbguru");

$guru->setData("Umam" ,"00000000", "Tim IT");

$data = $guru->getData();
while ($r = $data->fetch_array()) {
			echo $r['nama'] . "<br>";
			echo $r['kontak'] . "<br>";
			echo $r['jabatan'] . "<br>";
			echo $r['mapel1'] . "<br>";
			echo $r['mapel2'] . "<br>";
		}






























// // Instansiasi Objek dari SuperClass 

// $struktural = new Struktural('Shinigami', '08123456789', 'Kepala Madrasah');

// //Setter 
// $struktural->setJam(36);

// // setter attribut static
// Struktural::$Lembaga = 'MDI';

// // Getter
// echo "Nama    	: " . $struktural->getNama() . "<br>";
// echo "Kontak  	: " . $struktural->getKontak() . "<br>";
// echo "Jabatan 	: " . $struktural->getJabatan() . "<br>";
// echo "Jam/Mapel : " . $struktural->getJam() . "<br>";
// echo "Lembaga 	: "	. Struktural::getLembaga() . "<br>" ;
// echo "======================= <p>";




// Array Object dari subclass
// $guru = [];
// $guru[] = new Guru('Sunthree', '08987654321', 'Guru Fak', 'Akhlaq', 'Fiqih');
// $guru[] = new Guru('Deepelover', '08939393939' ,'Guru Fak','Shorrof','Nahwu');

// // setter overloading method
// $guru[0]->setJam(2,4,1,4,2,3);
// $guru[1]->setJam(2,1,1,4,6,3);


// // Getter
// foreach ($guru as $pengabdi) {
// 	echo "Nama    	: " . $pengabdi->getNama() . "<br>";
// 	echo "Kontak  	: " . $pengabdi->getKontak() . "<br>";
// 	echo "Jabatan 	: " . $pengabdi->getJabatan() . "<br>";
// 	echo "Jam/Mapel : " . $pengabdi->getJam() . "<br>";
// 	echo "Lembaga : " . Struktural::getLembaga() . "<br>";
// 	echo "======================= <p>";
// }
?>