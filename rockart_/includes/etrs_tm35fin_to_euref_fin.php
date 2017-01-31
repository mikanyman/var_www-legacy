<?php
function MuunnaKoordinaatit ($E,$N) {

// Meridiaanin pituisen ympyrän säde
	$A1 = 6367449.14577105;
	
// Mittakaavakerroin keskimeridiaanilla
	$k0 = 0.9996;
	
// Itäkoordinaatin arvo keskimeridiaanilla
	$E0 = 500000;

// Projektion keskimeridiaani (radiaaneina)
	$km = 0.471238898038469;
	
// Apusuureita
	$s = $N / ($A1 * $k0);
	$n = ($E - $E0) / ($A1 * $k0);
	
// Laskentaa
	$s1 = 0.000837732168164 * sin(2 * $s)* cosh(2 * $n);
	$s2 = 0.000000059058696 * sin(4 * $s)* cosh(4 * $n);
	$s3 = 0.000000000167349 * sin(6 * $s)* cosh(6 * $n);
	$s4 = 0.000000000000217 * sin(8 * $s)* cosh(8 * $n);
	
	$n1 = 0.000837732168164 * cos(2 * $s)* sinh(2 * $n);
	$n2 = 0.000000059058696 * cos(4 * $s)* sinh(4 * $n);
	$n3 = 0.000000000167349 * cos(6 * $s)* sinh(6 * $n);
	$n4 = 0.000000000000217 * cos(8 * $s)* sinh(8 * $n);
	
	$ss = $s - ($s1 + $s2 + $s3 + $s4);
	$nn = $n - ($n1 + $n2 + $n3 + $n4);
		
	$b = asin((sin($ss) / cosh($nn)));
	$l = asin(tanh($nn) / cos($b)); 
	
	$q = log(tan($b) + sqrt(pow(tan($b), 2) + 1));
	
// $e = ensimmäinen epäkeskisyys
	$e = pow (2 * 1/298.257222101 - (pow(1/298.257222101, 2)), 0.5);

// Iteroidaan, kunnes muutos on tarpeeksi lähellä nollaa
	$q1 = $q + $e * (0.5 * log((1 + $e * tanh($q)) / (1 - $e * tanh($q))));
	$q2 = $q + $e * (0.5 * log((1 + $e * tanh($q1)) / (1 - $e * tanh($q1))));
	$q3 = $q + $e * (0.5 * log((1 + $e * tanh($q2)) / (1 - $e * tanh($q2))));
	$q4 = $q + $e * (0.5 * log((1 + $e * tanh($q3)) / (1 - $e * tanh($q3))));
	
	
// Lopputulos, maantieteelliset koordinaatit, asteina
	$NN = rad2deg(atan(sinh($q4)));
	$EE = rad2deg($km + $l);
	
	return $NN.",".$EE;
		
} //function
?>