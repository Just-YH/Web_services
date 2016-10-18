<?php
// turn off WSDL caching
ini_set("soap.wsdl_cache_enabled","0");


function fibonacci($n)
{
    if ($n < 3) {
        return 1; 
    }
    else {
        return fibonacci($n-1) + fibonacci($n-2);
    }
}


function fib($length) {
    $string = "";

    for ($n = 1; $n <= $length - 1; $n++) {
	$string = $string . strval(fibonacci($n)) . ", ";
    }
    
    $string = $string . strval(fibonacci($n));
    return $string;
}

function nod($a, $b) {
    while ($b != 0){
        $t = $a % $b;
        $a = $b;
        $b = $t;
    }
   return $a;
}

function nok($aa, $bb) {
    if($bb>$aa) {
    $max = $bb;
    }
    else {
        $max = $aa;
    }
    for ($n=$max; $n>0; $n++) {
        if (($n % $aa==0) && ($n % $bb==0)) {
            return $n;
        }
    }
}

function modSum($n1, $n2, $Zn) {
    $sum=($n1+$n2)%$Zn;
    return $sum;
}

function modMul($n1, $n2, $Zn) {
    $mul=($n1*$n2)%$Zn;
    return $mul;
}

// initialize SOAP Server
$server=new SoapServer("test.wsdl");

// register available functions
$server->addFunction('fib');
$server->addFunction('nod');
$server->addFunction('nok');
$server->addFunction('modSum');
$server->addFunction('modMul');

// start handling requests
$server->handle();
?>
