<html>
<head>
<title>PHP Reanme image example</title>
</head>
<body>

<?php

	for($i = 01; $i <= 31; $i++){

		if (strlen($i)<= 2){
			$i = '0' . $i;
		} else{
			echo $i . '<br>' ;

		}



		// $pad_length = 1;
		// $pad_char = 0;
		// $str_type = 'd'; // treats input as integer, and outputs as a (signed) decimal number

		// $format = "%{$pad_char}{$pad_length}{$str_type}"; // or "%04d"

		// output and echo
		// printf($format, $i);

		// output to a variable
		// $formatted_str = sprintf($format, 123);

		// output: 0123




		
	} 

?>
</body>
</html>