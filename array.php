

<?php
/*
eg: 2 3 4 5 1
from sudhakar to Everyone:
eg: 5 1 2 3 4
from sudhakar to Everyone:
input
from sudhakar to Everyone:
int findMinimum(array $arr)

*/
//$array = array("0" => "0", "1" => "1", "2" => "2" , "3" => "3", "4" => "4", "5" => "5");

echo "<input type='text' name='array'></input>";

function findMinimun($array) {

	for($i=0;$i<count($array);$i++){
		$aux = $array[$i];
		for($j=0;$j<count($array);$j++) {

		if($aux<$array[$j]){
		
			$result = $aux;	
		
		}else{

			$result = $array[$j];
		
		}
		
		}	
	}
	return $result;
}
?>