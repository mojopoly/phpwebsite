<?php 
//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer; //this needs to be the very first code in the file
require 'vendor/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/src/Exception.php';
require 'vendor/phpmailer/src/SMTP.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim(filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING)); //name, email, details are "name" attribute from the form
    //$email = trim($_POST["email"]); below filter_input function does all filtering for us, better to use than this line of code
    $email = trim(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL));
    $details = trim(filter_input(INPUT_POST, "details", FILTER_SANITIZE_SPECIAL_CHARS));
    if ($name == "" OR $email == "" OR $details == "") {
        echo "Please fill in the required fields: Name, Email, and Details";
        exit;
    }
    if ($_POST["address"] != "") { //we addedd a css style none to this attr in form below to catch SPAM Honeypot spams
        echo "Bad from input";
        exit;
    }
    if(!PHPMailer::validateAddress($email)){
        echo "Invalid Email Address";
        exit;
    }
    $email_body ="";
    $email_body .= "Name " . $name  . "\n";
    $email_body .= "Email " . $email . "\n";
    $email_body .= "Details " . $details . "\n";
    
    //Create a new PHPMailer instance
    $mail = new PHPMailer;
    //Tell PHPMailer to use SMTP
    $mail->isSMTP();
    //Enable SMTP debugging
    // 0 = off (for production use)
    // 1 = client messages
    // 2 = client and server messages
    $mail->SMTPDebug = 2;
    //Set the hostname of the mail server
    $mail->Host = 'smtp.gmail.com';
    // use
    // $mail->Host = gethostbyname('smtp.gmail.com');
    // if your network does not support SMTP over IPv6
    //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
    $mail->Port = 587;
    //Set the encryption system to use - ssl (deprecated) or tls
    $mail->SMTPSecure = 'tls';
    //Whether to use SMTP authentication
    $mail->SMTPAuth = true;
    //Username to use for SMTP authentication - use full email address for gmail
    $mail->Username = "mojopoly1988@gmail.com";
    //Password to use for SMTP authentication
    $mail->Password = "nhtajzgtkfhsrmzn";
    //It's important not to use the submitter's address as the from address as it's forgery,
    //which will cause your messages to fail SPF checks.
    //Use an address in your own domain as the from address, put the submitter's address in a reply-to
    $mail->setFrom('cyrus@gazsix.com', $name);
    $mail->addReplyTo($email, $name);
    $mail->addAddress('cyrus@gazsix.com', 'Cyrus Eslamian');
    $mail->Subject = 'Library Suggestion from ' . $name;
    $mail->Body = $email_body;
    if (!$mail->send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
        exit;
    } 
    header("location:suggest.php?status=thanks"); //redirect to GET[status]
}
$pageTitle = "Suggest a Media item";
$section = "suggest";
include("inc/header.php"); ?>

<div class = "section page">
    <div class= "wrapper">
        <h1>Suggest a Media Item</h1>
        <?php if (isset($_GET["status"]) && $_GET["status"] == "thanks") { //we defined the get[status] on line 18 with header
            echo "<p>Thanks for the email! I&rsquo;ll check out your suggestion shortly!</p>";
        } else { ?>
        <p>If you think there is something I&rsquo;m missing, let me know! Complete the form to send me an email </p>
            <form method="post" action="suggest.php">
                <table>
                    <tr>
                        <th><label for ="name">Name</label></th>
                        <td><input type ="text" id ="name" name="name" /></td>
                    </tr>
                    <tr>
                        <th><label for ="email">Email</label></th>
                        <td><input type ="text" id ="email" name="email" /></td>
                    </tr>
                    <tr>
                        <th><label for ="details">Suggest Item Details</label></th>
                        <td><textarea name="details" id="details"></textarea></td>
                    </tr>
                    <tr style ="display:none"> 
                        <th><label for ="address">Address</label></th>
                        <td><input type="text" id="address" name="address"><p>Please leave this field blank. </p></td>
                    </tr>
                </table>
                <input type="submit" value="Send">
            </form>
        <?php } ?>
    </div>
</div>

<?php include("inc/footer.php"); ?>