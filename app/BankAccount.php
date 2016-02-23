<?php

class BankAccount{

	//VARS
	private $accountBalance;

	public function __BankAccount($accountBalance = 0){
		$this->setBalance($accountBalance);

	}

	public function getBalance(){
		return $this->accountBalance;

	}

	public function setBalance($balance){
		if($balance >= 0 && is_numeric($balance)){
			$this->accountBalance = $balance;
		}
		elseif (!is_numeric($balance)){}
		elseif ($balance < 0){
			$this->accountBalance = 0;
		}
	}

	public function withdraw($amount){
		if($amount > $this->accountBalance || !is_numeric($amount)) return false;
		else
		$this->setBalance($this->accountBalance - $amount);
		return $this->getBalance();

	}

	public function deposit($amount){
		$this->setBalance($this->accountBalance + $amount);
		return $this->getBalance();

	}

}

?>