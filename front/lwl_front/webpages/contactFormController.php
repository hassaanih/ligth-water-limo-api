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
$subscriber_subject = "THANK YOU FOR CONTACTING ResellerProhub, ONE OF OUR CONSULTANTS WILL REACH YOU SOON.";
$subscriber_email_data = file_get_contents('http://www.resellerprohub.com/email/queryFormThankyou.html');




if(isset($_REQUEST['hiddencapcha']) && $_REQUEST['hiddencapcha'] == "" ){
if(isset($_REQUEST['Name']) && $_REQUEST['Name'] != "" 
  && isset($_REQUEST['Email']) && $_REQUEST['Email'] != "" 
  && isset($_REQUEST['ctry']) && $_REQUEST['ctry'] != "" 
  && isset($_REQUEST['pc']) && $_REQUEST['pc'] != "" 
  && isset($_REQUEST['Number']) && $_REQUEST['Number'] != "" 
  && isset($_REQUEST['Package']) && $_REQUEST['Package'] != ""){
     


$body .= "Name: ".$_REQUEST['Name']." \n";
$body .= "Email: ".$_REQUEST['Email']." \n";
$body .= "Country Name: ".$_REQUEST['ctry']." \n";
$body .= "Country code: ".$_REQUEST['pc']." \n";
$body .= "Number: ".$_REQUEST['Number']." \n";
$body .= "Package: ".$_REQUEST['Package']." \n";
$body .= "Comment: ".$_REQUEST['Comment']." \n";
$body .= "NDA Status: ".$sNDA." \n";

$checkService = implode(',', $_POST['Services']);
// $checkGenre = implode(',', $_POST['Genre']);
// $checkPublishingGoal = implode(',', $_POST['PublishingGoals']);
// $body .= "Page: ".$ebpage." \n";

$body .= "Services: ".$checkService." \n";
// $body .= "Genre: ".$checkGenre." \n";
// $body .= "PublishingGoals: ".$checkPublishingGoal." \n";


switch ($_REQUEST['Package']) {
     case 'Basic Website Packages - $244.00':
        $location = "https://www.designquotations.com/terminal/paynow/index.php?id=a2daafeb-f345-11e8-be72-0cc47ac0118a";
        break; 


    case 'Startup Website Packages - $394.00':
        $location = "https://www.designquotations.com/terminal/paynow/index.php?id=d167ad27-f345-11e8-be72-0cc47ac0118a";
        break;

    case 'Professional Website Packages - $844.00':
        $location = "https://www.designquotations.com/terminal/paynow/index.php?id=f74518a7-f345-11e8-be72-0cc47ac0118a";
        break;

    case 'Basic Logo Package - $44.00':
        $location = "https://www.designquotations.com/terminal/paynow/index.php?id=3bb39535-f345-11e8-be72-0cc47ac0118a";
        break;

    case 'Start Up Logo Package - $74.00':
        $location = "https://www.designquotations.com/terminal/paynow/index.php?id=53a32021-f345-11e8-be72-0cc47ac0118a";
        break;

    case 'Professional Logo Package - $124.00':
        $location = "https://www.designquotations.com/terminal/paynow/index.php?id=72588557-f345-11e8-be72-0cc47ac0118a";
        break;

    case 'Startup SEO Plan - $1,000.00':
        $location = "https://www.designquotations.com/terminal/paynow/index.php?id=d7ebff70-f344-11e8-be72-0cc47ac0118a";
        break;

    case 'Scaling SEO Plan - $1,500.00':
        $location = "https://www.designquotations.com/terminal/paynow/index.php?id=f3d6c0e9-f344-11e8-be72-0cc47ac0118a";
        break;

    case 'Venture SEO Plan - $2,000.00':
        $location = "https://www.designquotations.com/terminal/paynow/index.php?id=12e10a76-f345-11e8-be72-0cc47ac0118a";
        break;

    case 'Starter Video Package - $349.00':
        $location = "https://www.designquotations.com/terminal/paynow/index.php?id=3c2cb591-f344-11e8-be72-0cc47ac0118a";
        break;

    case 'Business Video Package - $599.00':
        $location = "https://www.designquotations.com/terminal/paynow/index.php?id=7dba79ec-f344-11e8-be72-0cc47ac0118a";
        break;

    case 'Premium Video Package - $999.00':
        $location = "https://www.designquotations.com/terminal/paynow/index.php?id=a0bcaf06-f344-11e8-be72-0cc47ac0118a";
        break;

    default:
        $location = "/thankyou.php";
        break;

}

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
else{ $sql = 'insert into contactForm_query (cust_name,cust_email,country_code,country_name,cust_phonenumber,Package,cust_comment,service_interest,file,send_NDA) values ("'.$_REQUEST['Name'].'","'.$_REQUEST['Email'].'","'.$_REQUEST['pc'].'","'.$_REQUEST['ctry'].'","'.$_REQUEST['Number'].'","'.$_REQUEST['Package'].'","'.$_REQUEST['Comment'].'","'.$checkService.'","'.$target.'","'.$sNDA.'")';

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