<?php 
error_reporting(E_ALL);
ini_set('display_errors',1);
echo "This is a SOAP test for Vertex 6 server.\n";

$xmlstring=
'<VertexEnvelope xmlns="urn:vertexinc:o-series:tps:6:0" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
  <Login>
    <UserName>USERNAME</UserName>
    <Password>PASSWORD</Password>
  </Login>
  <QuotationRequest documentDate="2019-01-17" returnAssistedParametersIndicator="true" transactionType="SALE">
    <Seller>
      <Company>0000000</Company>
      <Division>10028US</Division>
    </Seller>
    <Customer>
      <CustomerCode>2222222222222</CustomerCode>
    </Customer>
    <LineItem taxDate="2019-01-17" lineItemNumber="1">
      <Seller>
        <PhysicalOrigin>
          <StreetAddress1>22222222 FIRST Street</StreetAddress1>
          <City>LOS ANGELES</City>
          <MainDivision>CA</MainDivision>
          <PostalCode>91706</PostalCode>
          <Country>US</Country>
        </PhysicalOrigin>
      </Seller>
      <Customer>
        <Destination>
          <StreetAddress1>222222 FORTH Ave</StreetAddress1>
          <City>Arcadia</City>
          <MainDivision>CA</MainDivision>
          <PostalCode>91006</PostalCode>
          <Country>US</Country>
        </Destination>
      </Customer>
      <Product productClass="85">PRODUCTCODE</Product>
      <Quantity>1000</Quantity>
      <UnitPrice>30</UnitPrice>
      <ExtendedPrice>10</ExtendedPrice>
      <Discount userDefinedDiscountCode="R">
        <DiscountAmount>0</DiscountAmount>
      </Discount>
      <FlexibleFields>
        <FlexibleCodeField fieldId="1">0</FlexibleCodeField>
        <FlexibleCodeField fieldId="2">Arcadia, CA 91006</FlexibleCodeField>
        <FlexibleCodeField fieldId="3">Arcadia, CA 91006</FlexibleCodeField>
        <FlexibleCodeField fieldId="4">1</FlexibleCodeField>
        <FlexibleCodeField fieldId="5">001</FlexibleCodeField>
        <FlexibleCodeField fieldId="6">PRODUCT/FlexibleCodeField>
        <FlexibleCodeField fieldId="25">CODECODECODE</FlexibleCodeField>
      </FlexibleFields>
    </LineItem>
  </QuotationRequest>
</VertexEnvelope>';
$xml = new SoapVar($xmlstring, XSD_ANYXML);
$client = new SoapClient("http://IP:8095/vertex-ws/services/CalculateTax60?wsdl",
    array(
      'username'=>'USERNAME',
      'password'=>'PASSWORD',
      'trace'=>1
    )
);


try{$result = $client->calculateTax60($xml);
echo "Success: The total tax is: ";
echo($result->QuotationResponse->TotalTax->_);
echo "\n";
    

    
}catch(SoapFault $fault){
    echo "Failed\n";
    echo "failcode: ".$fault->faultcode."\n";
}

echo "\n";
echo ("The XML response : \n".$client->__getLastResponse());
echo "\n";
echo ("XML request:\n".$client->__getLastRequest());
// The available functions: var_dump($client->__getFunctions()); 
// The available types: ($client->__getTypes()); 
