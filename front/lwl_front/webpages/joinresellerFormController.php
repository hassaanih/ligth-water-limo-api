<?php
## CONFIG ##
include("connectiondb.php");

# LIST EMAIL ADDRESS
$recipient = "forms@resellerprohub.com";

# SUBJECT (Subscribe/Remove)
$subject = "New Reseller Registeration";
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
$subscriber_subject = "THANK YOU FOR JOINING ResellerProhub, ONE OF OUR CONSULTANTS WILL REACH YOU SOON.";
$subscriber_email_data = file_get_contents('http://www.resellerprohub.com/email/queryFormThankyou.html');


if(isset($_REQUEST['hiddencapcha']) && $_REQUEST['hiddencapcha'] == "" ){
if(isset($_REQUEST['Name']) && $_REQUEST['Name'] != "" 
  && isset($_REQUEST['Email']) && $_REQUEST['Email'] != "" 
  && isset($_REQUEST['Refferalemail']) && $_REQUEST['Refferalemail'] != "" 
  && isset($_REQUEST['Companyname']) && $_REQUEST['Companyname'] != "" 
  && isset($_REQUEST['WebsiteUrl']) && $_REQUEST['WebsiteUrl'] != "" 
  && isset($_REQUEST['Workingclients']) && $_REQUEST['Workingclients'] != ""){
      
      
      
$body .= "Name: ".$_REQUEST['Name']." \n";
$body .= "Email: ".$_REQUEST['Email']." \n";
$body .= "Refferal Email: ".$_REQUEST['Refferalemail']." \n";
$body .= "Company Name: ".$_REQUEST['Companyname']." \n";
$body .= "Website Url: ".$_REQUEST['WebsiteUrl']." \n";
$body .= "No. Of Working Clients: ".$_REQUEST['Workingclients']." \n";
$body .= "Comment: ".$_REQUEST['Comment']." \n";
$body .= "NDA Status: ".$sNDA." \n";

// $checkService = implode(',', $_POST['Services']);
$checkLogoServices = implode(',', $_POST['LogoServices']);
$checkWebsiteServices = implode(',', $_POST['WebsiteServices']);
$checkSEOServices = implode(',', $_POST['SEOServices']);
$checkMobileServices = implode(',', $_POST['MobileServices']);
$checkVideoServices = implode(',', $_POST['VideoServices']);
$checkMarketingautomation = implode(',', $_POST['Marketingautomation']);



$body .= "Do you currently offer logo services to clients? : ".$checkLogoServices." \n";
$body .= "Do you currently offer Website services to clients? : ".$checkWebsiteServices." \n";
$body .= "Do you currently offer SEO services to clients? : ".$checkSEOServices." \n";
$body .= "Do you currently offer Mobile App Development services to clients? : ".$checkMobileServices." \n";
$body .= "Do you currently offer Video services to clients? : ".$checkVideoServices." \n";
$body .= "Do you partner with any marketing automation platforms? : ".$checkMarketingautomation." \n";

// $body .= "PublishingGoals: ".$checkPublishingGoal." \n";





if (mysqli_connect_errno()){  echo "Failed to connect to MySQL: " . mysqli_connect_error(); }
else{ $sql = 'insert into joinresellertb (cust_name,cust_email,cust_refferalemail,company_name,Website_Url,Working_clients,Logo_Services,Website_Services,SEO_Services,Mobile_Services,Video_Services,Marketing_automation,user_comment,nda_status) values ("'.$_REQUEST['Name'].'","'.$_REQUEST['Email'].'","'.$_REQUEST['Refferalemail'].'","'.$_REQUEST['Companyname'].'","'.$_REQUEST['WebsiteUrl'].'","'.$_REQUEST['Workingclients'].'","'.$checkLogoServices.'","'.$checkWebsiteServices.'","'.$checkSEOServices.'","'.$checkMobileServices.'","'.$checkVideoServices.'","'.$checkMarketingautomation.'","'.$_REQUEST['Comment'].'","'.$sNDA.'")';

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