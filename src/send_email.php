<?php

/////////////////////////////////////////////////////////////////////////////
// These variables can come from either GET or POST
if ( !empty($_GET['from']) )     { $_POST['from']     = urldecode($_GET['from']);     }
if ( !empty($_GET['sendmail']) ) { $_POST['sendmail'] = urldecode($_GET['sendmail']); }
if ( !empty($_GET['reply_to']) ) { $_POST['reply_to'] = urldecode($_GET['reply_to']); }
if ( !empty($_GET['subject']) )  { $_POST['subject']  = urldecode($_GET['subject']);  }
if ( !empty($_GET['message']) )  { $_POST['message']  = urldecode($_GET['message']);  }
/////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////
// Load global vars into local vars
empty($_GET['success'])   ? $success  = "" : $success  = urldecode($_GET['success']);
empty($_POST['action'])   ? $action   = "" : $action   = $_POST['action'];
/////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////
// This is a special button in the e-mail form
if ( $action == "Cancel" ) {
   header("Location: send_email.php");
   exit();
}
/////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////
// Load POST info into local array
if ( !empty( $_POST['from'] )     ) { $info['from']     = $_POST['from'];     }
if ( !empty( $_POST['sendmail'] ) ) { $info['sendmail'] = $_POST['sendmail']; }
if ( !empty( $_POST['reply_to'] ) ) { $info['reply_to'] = $_POST['reply_to']; }
if ( !empty( $_POST['subject'] )  ) { $info['subject']  = $_POST['subject'];  }
if ( !empty( $_POST['message'] )  ) { $info['message']  = $_POST['message'];  }
/////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////
process_email_info($info);
/////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////
if ( $action == "Send" ) {

   /////////////////////////////////////////////////////////////////////////////
   // Trying to send the mail...
   if ( empty($info['sendmail']) ) {
      $success = false;
   }
   else if ( sendmail($info['sendmail'], $info['subject'], $info['message'], $info['from'], $info['reply_to']) ) {
      header("Location: send_email.php?success=" . urlencode($info['sendmail']) );
      exit();
   }

}
/////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////
$info['from']     = str_replace("''", '"', $info['from']);
$info['sendmail'] = str_replace("''", '"', $info['sendmail']);
$info['reply_to'] = str_replace("''", '"', $info['reply_to']);
$info['subject']  = str_replace("''", '"', $info['subject']);
/////////////////////////////////////////////////////////////////////////////



?><html>

<head>

<title>E-mailer</title>

<style>

body {
   margin-top:2%;
   margin-left:8%;
   margin-right:8%;
   margin-bottom:2%;
}

.fixedwidth {
   font-family:"Courier New",monospace;
   font-weight:bold;
}

.alert {
   color:#FF0000;
   font-weight:bold;
}

</style>

</head>

<body>

<div align="center">
  <center>

  <form action="send_email.php" method="post" name="emailform" target="_self">

  <table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
      <td align="right" width="1600">&nbsp;</td>
      <td align="center"><h1>Send e-mail</h1>

<?php

/////////////////////////////////////////////////////////////////////////////
if ( $success === false ) {

?>
        <table border="1" cellpadding="18" cellspacing="0" width="100%">
          <tr>
            <td width="100%" align="center" class="alert">E-mail could not be sent.</td>
          </tr>
        </table>

        <br>

<?php

}
else if ( $success != "" ) {

?>
        <table border="1" cellpadding="18" cellspacing="0" width="100%">
          <tr>
            <td width="100%" align="center">E-mail was sent to<br><font class="fixedwidth"><?php echo $success; ?></font></td>
          </tr>
        </table>

        <br>

<?php

}
/////////////////////////////////////////////////////////////////////////////

?>
        <table border="1" cellpadding="18" cellspacing="0" width="100%">
          <tr>
            <td width="100%">

              <table border="0" cellpadding="2" cellspacing="2" width="100%">
                <tr>
                  <td align="right" nowrap><label for="from">From:&nbsp;</label></td>
                  <td align="left"><input type="text" size="48" name="from" value="<?php echo $info['from']; ?>" id="from"></td>
                </tr>
                <tr>
                  <td align="right" nowrap><label for="sendmail">To:&nbsp;</label></td>
                  <td align="left"><input type="text" size="48" name="sendmail" value="<?php echo $info['sendmail']; ?>" id="sendmail"></td>
                </tr>
                <tr>
                  <td align="right" nowrap><label for="reply_to">Reply-to:&nbsp;</label></td>
                  <td align="left"><input type="text" size="48" name="reply_to" value="<?php echo $info['reply_to']; ?>" id="reply_to"></td>
                </tr>
                <tr>
                  <td align="right" nowrap><label for="subject">Subject:&nbsp;</label></td>
                  <td align="left"><input type="text" size="48" name="subject" value="<?php echo $info['subject']; ?>" id="subject"></td>
                </tr>
                <tr>
                  <td align="right">&nbsp;</td>
                  <td align="left">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2"><textarea name="message" rows="12" cols="54"><?php echo $info['message']; ?>

</textarea></td>
                </tr>
                <tr>
                  <td align="left"><input type="submit" name="action" value="Send" accesskey="S"></td>
                  <td align="right"><input type="submit" name="action" value="Cancel"></td>
                </tr>
              </table>

            </td>
          </tr>
        </table>

      </td>
      <td align="left" width="1600">&nbsp;</td>
    </tr>
  </table>

  </form>

  </center>
</div>

<br><br><br><hr>

<p align="center">
<i>Input can be taking in through the address bar in the following format:</i><br><br>
<?php echo $_SERVER['PHP_SELF']; ?>?variable=value&amp;variable2=value2</p>

<table border="1" width="50%" align="center">
  <tr>
    <th>Variable</td>
    <th>Value</td>
  </tr>
  <tr>
    <td>from</td>
    <td>name of the sender</td>
  </tr>
  <tr>
    <td>sendmail</td>
    <td>e-mail address to send the message to</td>
  </tr>
  <tr>
    <td>reply_to</td>
    <td>e-mail address to reply to</td>
  </tr>
  <tr>
    <td>subject</td>
    <td>subject of the message</td>
  </tr>
  <tr>
    <td>message</td>
    <td>body of the message itself</td>
  </tr>
</table>


<script language="JavaScript">
<!--

if ( document.emailform.from.value == "" ) {
   document.emailform.from.focus();
}
else if ( document.emailform.sendmail.value == "" ) {
   document.emailform.sendmail.focus();
}
else if ( document.emailform.reply_to.value == "" ) {
   document.emailform.reply_to.focus();
}
else if ( document.emailform.subject.value == "" ) {
   document.emailform.subject.focus();
}
else if ( document.emailform.message.value == "" ) {
   document.emailform.message.focus();
}

// -->
</script>

</body>

</html><?php



/////////////////////////////////////////////////////////////////////////////
function sendmail($sendmail, $subject, $message, $from, $reply_to) {

   if ( @mail($sendmail, $subject, $message,
         "From: $from\n"
        ."Reply-To: $reply_to\n"
        ."X-Mailer: PHP/" . phpversion() ) ) {
      return true;
   }

   return false;
}
/////////////////////////////////////////////////////////////////////////////



/////////////////////////////////////////////////////////////////////////////
function process_email_info(& $info) {

   /////////////////////////////////////////////////////////////////////////////
   if ( !empty($info['from']) ) {
      process_text_input($info['from']);
   }
   else {
      $info['from'] = "";
   }
   /////////////////////////////////////////////////////////////////////////////

   /////////////////////////////////////////////////////////////////////////////
   if ( !empty($info['sendmail']) ) {
      process_text_input($info['sendmail']);
   }
   else {
      $info['sendmail'] = "";
   }
   /////////////////////////////////////////////////////////////////////////////

   /////////////////////////////////////////////////////////////////////////////
   if ( !empty($info['reply_to']) ) {
      process_text_input($info['reply_to']);
   }
   else {
      $info['reply_to'] = "";
   }
   /////////////////////////////////////////////////////////////////////////////

   /////////////////////////////////////////////////////////////////////////////
   if ( !empty($info['subject']) ) {
      process_text_input($info['subject']);
   }
   else {
      $info['subject'] = "";
   }
   /////////////////////////////////////////////////////////////////////////////

   /////////////////////////////////////////////////////////////////////////////
   if ( !empty($info['message']) ) {
      process_text_input($info['message']);
   }
   else {
      $info['message'] = "";
   }
   /////////////////////////////////////////////////////////////////////////////

}
/////////////////////////////////////////////////////////////////////////////



/////////////////////////////////////////////////////////////////////////////
function process_text_input(& $text) {

   $text = stripslashes($text);
   $text = strip_tags($text);
   $text = trim($text);
}
/////////////////////////////////////////////////////////////////////////////



?>
