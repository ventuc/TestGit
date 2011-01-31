<?php

class A
{
    public function who()
        {
        echo __CLASS__;
    }

    public function test()
        {
        $this->who();      
    }
	
	public function test1(A $a){
		$a->myF();
	}
}  

class B extends A
{   
    public function who(){
         echo __CLASS__;
    }
	
	public function myF(){
		echo "sono B";
	}
}   

$b = new B();
$b->test(); // Output: A;

$b->test1($b);

?>
