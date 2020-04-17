<?php
libxml_use_internal_errors(true);
$Street="2201 Yale Street";
$City="Houston";
$StateAbr="TA";
$Zip="78008";

$request_doc_template = <<<EOT
<?XML version="1.0"?>
<AddressValidateRequest USERID="741UNIVE1585">
    <Revision>1</Revision>
    <Address ID="0">
        <Address1>$Street</Address1>
        <Address2></Address2>
        <City>$City</City>
        <State>$StateAbr</State>
        <Zip5>$Zip</Zip5>
        <Zip4/>
    </Address>
</AddressValidateRequest>
EOT;
/*
<?XML version="1.0"?>
<AddressValidateRequest USERID="741UNIVE1585">
    <Revision>1</Revision>
    <Address ID="0">
        <Address1>2335 S State</Address1>
        <Address2>Suite 300</Address2>
        <City>Provo</City>
        <State>UT</City>
        <Zip5>84604</Zip5>
        <Zip4></Zip4>
    </Address>
</AddressValidateRequest>
*/
// prepare xml doc for query string
$doc_string = preg_replace('/[\t\n]/', '', $request_doc_template);
$doc_string = urlencode($doc_string);

$url = "http://production.shippingapis.com/ShippingAPI.dll?API=Verify&XML=".$doc_string;
echo $url."\n\n";

// perform the get
$response = file_get_contents($url);

$xml=simplexml_load_string($response) or die("Error: Cannot create object");
print_r($xml);
if(libxml_get_errors())
{
    echo "HIIIIIIIIII";
}
else
{
    echo "Address1: ".$xml->Address->Address1."\n";
    echo "Address2: ".$xml->Address->Address2."\n";
    echo "City: ".$xml->Address->City."\n";
    echo "State: ".$xml->Address->State."\n";
    echo "Zip5: ".$xml->Address->Zip5."\n";
}


?>