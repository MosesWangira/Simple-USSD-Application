<?php
//Read variables sent via POST from AT gateway

//uniquely generated when session start and sent every time
//mobile subscriber response has been received
$sessionId = $_POST["sessionId"];

//unique short number that a user dials to initiate communication
//from mobile phone to telecom
$serviceCode = $_POST["serviceCode"];

//mobile number of subscriber (developer)
$phoneNumber = $_POST["phoneNumber"];

//user input text
$text = $_POST["text"];


//conditions classifying user to determine type of feedback

if(text == ""){
  //1st request .. Start response with CON
  $response = "CON What would you want to check \n";
  $response .= "1. My Account NO \n";
  $response .= "2. My Phone Number";
}else if($text == "1"){
  //Business logic for first level response
  $response = "CON Choose Account Information you want to view \n";
  $response .= "1. Account Number \n";
  $response .= "2. Account Balance";
}else if($text == "2"){
  //Business logic first level response
  //This is a terminal request. We start with END
  $response = "END YOur phone number is ".$phoneNumber ;
}else if($text == "1*1"){
  //Second level response where user selected 1 in the first instance

  //hardcoded
  //if connected to db look customer with that phone number and send
  //account number
  $accountNumber = "ACC1001";

  //Thus is a terminal request and should start with END
  $response = "END Your account Number is ".$accountNumber;
}else if($text == "1*2"){
  //second level response
  $balance = " KES 10,000";

  //can be obtained from database
  $response = "END Your balance is ".$balance;
}

//echo the response to the API. The response depends on the statement
// that is fulfilled in each instance
header('content-type: text/plain');
echo $response;


 ?>
