<?php 

namespace Hcode;
	
use Rain\Tpl;

Class Page{

	private $tpl;
	private $defaults = ["data"=>[]];
	private $options = [];

	public function __construct($opts = array()){

		$this->options = array_merge($this->defaults, $opts);

		$config = array(
		    "tpl_dir"       => $_SERVER["DOCUMENT_ROOT"]."/views",
		    "cache_dir"     => $_SERVER["DOCUMENT_ROOT"]."/views-cache",
		    "debug"         => false, // set to false to improve the speed
		);

		Tpl::configure( $config );

		$this->tpl = new Tpl;

		$this->setData($this->options["data"]);

		$this->tpl->draw("header");

	}

	private function setData($data = array()){

		foreach ($this->options["data"] as $key => $value) {
			
			$this->tpl->assign($key, $value);

		}

	}


	public function setTpl($name, $data = array(), $returnHtml = false){

		$this->setData($data);//

		return $this->tpl->draw($name, $returnHtml);


	}

	public function __destruct(){

		$this->tpl->draw("footer");

	}

}

 ?>