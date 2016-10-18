<script type="text/javascript">

function check() {
    if (document.getElementById('f').checked) {
		document.getElementById('nod').style.display = 'none';
		document.getElementById('nok').style.display = 'none';
        document.getElementById('fib').style.display = 'block';
        document.getElementById('mod').style.display = 'none';
    } else if (document.getElementById('n').checked) {
		document.getElementById('nod').style.display = 'block';
        document.getElementById('fib').style.display = 'none';
        document.getElementById('nok').style.display = 'none';
        document.getElementById('mod').style.display = 'none';
    } else if (document.getElementById('no').checked) {
    	document.getElementById('nod').style.display = 'none';
		document.getElementById('nok').style.display = 'block';
        document.getElementById('fib').style.display = 'none';
        document.getElementById('mod').style.display = 'none';
    } else if (document.getElementById('mo').checked) {
    	document.getElementById('nod').style.display = 'none';
		document.getElementById('nok').style.display = 'none';
        document.getElementById('fib').style.display = 'none';
        document.getElementById('mod').style.display = 'block';
    }
}

</script>
<form name="authForm" method="GET" action="<?=$_SERVER['PHP_SELF']?>">
	<input type="radio" name="func" value="fib" onclick="javascript:check();" id="f">Fibonacci
	<input type="radio" name="func" value="nod" onclick="javascript:check();" id="n">NOD
	<input type="radio" name="func" value="nok" onclick="javascript:check();" id="no">NOK
	<input type="radio" name="func" value="mod" onclick="javascript:check();" id="mo">MOD	
	<br><br>

	<div id="fib" style="display: none;">
		length:<input type="text" name="fiblen">
	</div>
	<div id="nod" style="display: none;">
		a:<input type="text" name="a"><br>
		b:<input type="text" name="b">
	</div>
	<div id="nok" style="display: none;">
		aa:<input type="text" name="aa"><br>
		bb:<input type="text" name="bb">
	</div>
	<div id="mod" style="display: none;">
		n1:<input type="text" name="n1"><br>
		n2:<input type="text" name="n2"><br>
		Zn:<input type="text" name="Zn"><br>
	</div>

	<input type="submit">
</form>

<?php
	function saveToXML($rreq, $rresp) {
		$doc = new DOMDocument('1.0');
		$doc->formatOutput = true;

		$root = $doc->createElement('soapRequest');
		$root = $doc->appendChild($root);

		$req = $doc->createElement('request');
		$req = $root->appendChild($req);
		$reqText = $doc->createTextNode($rreq);
		$reqText = $req->appendChild($reqText);

		$resp = $doc->createElement('response');
		$resp = $root->appendChild($resp);
		$respText = $doc->createTextNode($rresp);
		$respText = $resp->appendChild($respText);

		$doc->save("Result.xml");
	}

	if (isset($_GET['fiblen']) && $_GET['fiblen'] != '') {
		$client=new SoapClient('http://localhost/server.php?wsdl', ['trace'=>1,'cache_wsdl'=>WSDL_CACHE_NONE]);

		$resp = $client->fib($_GET['fiblen']);
	
		print($resp);
		saveToXML($_GET['fiblen'], $resp);
	} else if (isset($_GET['a']) && isset($_GET['b']) && $_GET['a'] != '' && $_GET['b'] != '') {
		$client=new SoapClient('http://localhost/server.php?wsdl', ['trace'=>1,'cache_wsdl'=>WSDL_CACHE_NONE]);

		$resp = $client->nod($_GET['a'], $_GET['b']);
	
		print($resp);
		saveToXML($_GET['a']." ".$_GET['b'], $resp);
	} else if (isset($_GET['aa']) && isset($_GET['bb']) && $_GET['aa'] != '' && $_GET['bb'] != '') {
		$client=new SoapClient('http://localhost/server.php?wsdl', ['trace'=>1,'cache_wsdl'=>WSDL_CACHE_NONE]);

		$resp = $client->nok($_GET['aa'], $_GET['bb']);
	
		print($resp);
		saveToXML($_GET['aa']." ".$_GET['bb'], $resp);
	}  else if (isset($_GET['n1']) && isset($_GET['n2']) && isset($_GET['Zn']) && $_GET['n1'] != '' && $_GET['n2'] != '' && $_GET['Zn'] != '') {
		$client=new SoapClient('http://localhost/server.php?wsdl', ['trace'=>1,'cache_wsdl'=>WSDL_CACHE_NONE]);

		$resp = $client->modSum($_GET['n1'], $_GET['n2'], $_GET['Zn']);
		$resp2 = $client->modMul($_GET['n1'], $_GET['n2'], $_GET['Zn']);

		print(" Sum by mod:");
		print($resp);
		print("Mul by mod:");
		print($resp2);
		saveToXML($_GET['n1']." ".$_GET['n2']." ".$_GET['Zn'], $resp, $resp2);
	}
?>
