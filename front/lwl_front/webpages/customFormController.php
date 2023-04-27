<?php
## CONFIG ##
include("connectiondb.php");

# LIST EMAIL ADDRESS
$recipient = "forms@resellerprohub.com";

# SUBJECT (Subscribe/Remove)
$subject = "Order Form Query";
// $ebpage = "App development";

# RESULT PAGE
$location = "/thankyou.php";

## FORM VALUES ##

# SENDER - WE ALSO USE THE RECIPIENT AS SENDER IN THIS SAMPLE
# DON'T INCLUDE UNFILTERED USER INPUT IN THE MAIL HEADER!
$sender = "support@resellerprohub.com";


if (isset($_POST['NDA'])) {

    $sNDA = "Required";

} else {

   $sNDA = "Not Required";

}

# MAIL BODY
$subscriber_email = $_REQUEST['Email'];
$subscriber_subject = "THANK YOU FOR CONTACTING RESELLER PROHUB, ONE OF OUR CONSULTANTS WILL REACH YOU SOON.";
$subscriber_email_data = file_get_contents('http://www.resellerprohub.com/email/queryFormThankyou.html');




if(isset($_REQUEST['hiddencapcha']) && $_REQUEST['hiddencapcha'] == "" ){
if(isset($_REQUEST['Name']) && $_REQUEST['Name'] != "" 
  && isset($_REQUEST['Email']) && $_REQUEST['Email'] != "" 
  && isset($_REQUEST['ctry']) && $_REQUEST['ctry'] != "" 
  && isset($_REQUEST['pc']) && $_REQUEST['pc'] != "" 
  && isset($_REQUEST['Number']) && $_REQUEST['Number'] != ""){
     


$body .= "Name: ".$_REQUEST['Name']." \n";
$body .= "Email: ".$_REQUEST['Email']." \n";
$body .= "Country Name: ".$_REQUEST['ctry']." \n";
$body .= "Country code: ".$_REQUEST['pc']." \n";
$body .= "Number: ".$_REQUEST['Number']." \n";
$body .= "Comment: ".$_REQUEST['Comment']." \n";
$body .= "NDA Status: ".$sNDA." \n";


if($_FILES["file"]["error"]>0)
{
    echo "FILE ERROR";
    die();
}
// $filename = "FOLDER/".$_FILES["file"]["name"];

 $info = pathinfo($_FILES['wordfile']['name']);
$ext = $info['extension']; // get the extension of the file
$newname = time().'.'.$ext; 

$target = '../Folder/'.$newname;
// move file to a folder
if (!move_uploaded_file($_FILES["wordfile"]["tmp_name"], $target)) { 
    //  echo "Sorry, there was an error uploading your file.";
    //  die();
    $target = 'No file attached';
 }

$body .= "file: ".$target." \n";


if (mysqli_connect_errno()){  echo "Failed to connect to MySQL: " . mysqli_connect_error(); }
else{ $sql = 'insert into customForm_query (cust_name,cust_email,country_code,country_name,cust_phonenumber,cust_comment,file,send_NDA) values ("'.$_REQUEST['Name'].'","'.$_REQUEST['Email'].'","'.$_REQUEST['pc'].'","'.$_REQUEST['ctry'].'","'.$_REQUEST['Number'].'","'.$_REQUEST['Comment'].'","'.$target.'","'.$sNDA.'")';

mysqli_query($con,$sql);
mysqli_close($con);
}


$headers = "From: " . $sender . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
# add more fields here if required
## SEND MESSGAE ##

mail( $recipient, $subject, $body,   "From: $sender" ) or die ("Mail could not be sent.");
mail( $subscriber_email, $subscriber_subject, $subscriber_email_data, $headers) or die ("Unable to send email to subscriber");

## SHOW RESULT PAGE ##
header( "Location: $location" );

  }

    
}



?>