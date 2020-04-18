<?php
session_start();
require_once('./mysql-connect.php');

libxml_use_internal_errors(true);
$ID = $_SESSION['ID'];
$Address=$_POST['Address'];
$City=$_POST['City'];
$StateID = $_POST['StateN'];
    $query = "SELECT S.StateAbbreviation FROM states AS S WHERE S.ID_State = '$StateID'";
    $response = $dbc->query($query);
    while ($row = mysqli_fetch_array($response))
    {
      $StateAbr = $row['StateAbbreviation'];
    }
$Zip=$_POST['Zipcode'];

$request_doc_template = <<<EOT
<?XML version="1.0"?>
<AddressValidateRequest USERID="741UNIVE1585">
    <Revision>1</Revision>
    <Address ID="0">
        <Address1>$Address</Address1>
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

if ($xml->Address->Error->Number != null)
{
    header("Location: ./Order.php?verify=failure");
        exit();
}
else
{
    $Address = $xml->Address->Address2;
    $City = $xml->Address->City;
    $StateAbr = $xml->Address->State;
        $query = "SELECT S.ID_State FROM states AS S WHERE S.StateAbbreviation = '$StateAbr'";
        $response = $dbc->query($query);
        while ($row = mysqli_fetch_array($response))
        {
            $StateID = $row['ID_State'];
        }
    $Zipcode = $xml->Address->Zip5;
    $sql = "UPDATE profile SET Address = '$Address',City = '$City',State = '$StateID',Zipcode = '$Zipcode' WHERE ID_Profile = '$ID';";  
    mysqli_query( $dbc, $sql );
    mysqli_close($dbc);
       header("Location: ./Order.php?verify=success");
        exit();
}




?>