<?php 
abstract class testAbstract{
   public function abc(){
       echo "Call abc";
   }
}

class testInherit extends testAbstract{
    public function def(){
        echo "call DEF";
    }
}
$obj = new testInherit();
echo $obj->abc();
?>