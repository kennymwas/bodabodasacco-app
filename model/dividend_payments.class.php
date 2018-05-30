<?class dividend_payments extends db_auto{

	public function __construct($id=''){
		if(empty($id)){
			parent::__construct();
			$this->load_structure('dividend_payments');
		}else{
			parent::__construct(array('dividend_payments_id' => $id), 'dividend_payments', '*');
		}
	}
	
}