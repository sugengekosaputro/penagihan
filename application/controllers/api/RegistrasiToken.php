<?PHP
defined('BASEPATH') OR exit('No direct script access allowed');
class RegistrasiToken extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
	}

	public function index(){
    
      if(isset($_POST['token'])){

	      $token = $_POST['token'];
            $data = array('token' => $token);
            $this->db->where('role', 'admin')->update('tb_user', $data);
		
      }
    }

}
?>