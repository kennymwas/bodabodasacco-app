<?php
	//Connection

	$conn=mysqli_connect('localhost','root','','sacco');


	$sql = "SELECT * FROM member";
	$records = mysqli_query($conn,$sql);

	$sql2 = "SELECT * FROM phone";
	$records2 = mysqli_query($conn,$sql2);



?>
	<!--<html>
	<head>
	<title> Phone test</title>
	</head>
	<body>
		<table width="600" border="1" cellpadding="1">
			<tr>
			 <th>Name</th>
			 <th>Phone</th>	
			</tr>
	</body>
	</html> -->
<?php
while (($member=mysqli_fetch_assoc($records)) && (($phone=mysqli_fetch_assoc($records2))) ) 
{
	# code...
	#echo "<tr>";
	#echo "<td>".$member['member_name']. "<td> ";
	#echo "<td>".$phone['phone_detail']. "<td> ";
	#echo "</tr>";

	require_once('AfricasTalkingGateway.php');
// Specify your authentication credentials
$username   = "kennethmwangi";
$apikey     = "2e0f646c8bcc109bcf0a51a884c9d0c0a5cac662e43835a6acf2820ce4c92558";
// Specify the numbers that you want to send to in a comma-separated list
// Please ensure you include the country code (+254 for Kenya in this case)
//$recipients = "+254711XXXYYY,+254733YYYZZZ";
$recipients = $phone['phone_detail'];
// And of course we want our recipients to know what we really do
$message    = $member['member_name'] ." Share dividends have been paye out.Please visit your account to confirm.  @Bodaboda Sacco";
// Create a new instance of our awesome gateway class
$gateway    = new AfricasTalkingGateway($username, $apikey);
/*************************************************************************************
  NOTE: If connecting to the sandbox:
  1. Use "sandbox" as the username
  2. Use the apiKey generated from your sandbox application
     https://account.africastalking.com/apps/sandbox/settings/key
  3. Add the "sandbox" flag to the constructor
  $gateway  = new AfricasTalkingGateway($username, $apiKey, "sandbox");
**************************************************************************************/
// Any gateway error will be captured by our custom Exception class below, 
// so wrap the call in a try-catch block

try
{ 
  // Thats it, hit send and we'll take care of the rest. 
  $results = $gateway->sendMessage($recipients, $message);
            
  foreach($results as $result) {
    // status is either "Success" or "error message"
   // echo " Number: " .$result->number;
    //echo " Status: " .$result->status;
    //echo " MessageId: " .$result->messageId;
    //echo " Cost: "   .$result->cost."\n";
  }
}
catch ( AfricasTalkingGatewayException $e )
{
  echo "Encountered an error while sending: ".$e->getMessage();
}


}
?>