<?php


/////////////////////////////////////////////////////////////////////////////
// Set some defaults, if others are not specified
$default_dir = current_dir();
/////////////////////////////////////////////////////////////////////////////



/////////////////////////////////////////////////////////////////////////////
// These variables can come from either GET or POST
if ( !empty($_GET['dir']) ) { $_POST['dir'] = urldecode($_GET['dir']); }
/////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////
// Load global vars into local vars
empty($_GET['filename']) ? $filename = "" : $filename = urldecode($_GET['filename']);
empty($_GET['result'])   ? $result   = "" : $result   = urldecode($_GET['result']);

empty($_POST['dir'])    ? $dir    = "" : $dir    = $_POST['dir'];
empty($_POST['action']) ? $action = "" : $action = $_POST['action'];
/////////////////////////////////////////////////////////////////////////////



/////////////////////////////////////////////////////////////////////////////
switch ( $result ) {

   case "success":
      $message = "File was uploaded successfully to<br><font class=\"fixedwidth\">{$filename}</font>";
   break;

   case "failure":
      $message = "<font class=\"alert\">File could not be uploaded to<br><font class=\"fixedwidth\">{$filename}</font></font>";
   break;

   case "blank":
      $message = "<font class=\"alert\">Either you did not choose a file, or else it is too large</font>";
   break;

   default:
      $result = "";
   break;
}
/////////////////////////////////////////////////////////////////////////////



/////////////////////////////////////////////////////////////////////////////
process_text_input($dir);
/////////////////////////////////////////////////////////////////////////////



/////////////////////////////////////////////////////////////////////////////
if ( empty($result) && $action == "Upload" ) {

   // $bytesize = $_FILES['upload_file']['size'];
   $source = $_FILES['upload_file']['tmp_name'];
   $dest = $_FILES['upload_file']['name'];


   if ( $source != 'none' && $source != "" ) {

      // Allows only A-Z, 0-9, periods, hyphens, and underscores in the destination name
      $dest = preg_replace("/[^\w\.\-]+/", "_", $dest);
      $dest = preg_replace("/_{2,}/", "_", $dest);


      // If the last character of "dir" is not a slash, a slash is added
      process_dir($dir);

      $dest = "{$dir}/{$dest}";


      if ( @move_uploaded_file($source, $dest) ) {

         // What happens if the file is stored successfully
         header("Location: file_uploader.php?dir=" . urlencode($dir) . "&result=success&filename=" . urlencode($dest) );
         exit();
      }
      else {

         // What happens if the file cannot be stored for some reason
         header("Location: file_uploader.php?dir=" . urlencode($dir) . "&result=failure&filename=" . urlencode($dest) );
         exit();
      }
   }
   else {

      // What happens if a blank form is submitted
      header("Location: file_uploader.php?dir=" . urlencode($dir) . "&result=blank");
      exit();
   }
}
/////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////
$dir = str_replace("''", '"', $dir);

if ( empty($dir) && !isset($_GET['dir']) ) {
   $dir = "." . $default_dir;
}
process_dir($dir);
/////////////////////////////////////////////////////////////////////////////


?><html>

<head>

<title>File Uploader</title>

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

  <form method="post" enctype="multipart/form-data" action="file_uploader.php" target="_self">

  <table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
      <td align="right" width="1600">&nbsp;</td>
      <td align="center"><h1>File Uploader</h1>

<?php

/////////////////////////////////////////////////////////////////////////////
if ( !empty($message) ) {

?>
        <table border="1" cellpadding="18" cellspacing="0" width="100%">
          <tr>
            <td width="100%" align="center"><?php echo $message; ?></td>
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
                  <td align="right" nowrap><label for="upload_file">File:&nbsp;</label></td>
                  <td align="left"><input type="file" name="upload_file" size="48" id="upload_file"></td>
                </tr>
                <tr>
                  <td align="right" nowrap><label for="dir">Directory:&nbsp;</label></td>
                  <td align="left"><input type="text" name="dir" size="48" value="<?php echo $dir; ?>" id="dir"></td>
                </tr>
                <tr>
                  <td colspan="2" align="center"><input type="submit" name="action" value="Upload" accesskey="U"></td>
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

<br><br><br>

<hr>

<p align="center">
<i>Input can be taking in through the address bar in the following format:</i><br><br>
<?php echo $_SERVER['PHP_SELF']; ?>?variable=value</p>

<table border="1" width="50%" align="center">
  <tr>
    <th>Variable</td>
    <th>Value</td>
  </tr>
  <tr>
    <td>dir</td>
    <td>&lt;name of a directory&gt;</td>
  </tr>
</table>


</body>

</html><?php


/////////////////////////////////////////////////////////////////////////////
function process_text_input(& $text) {

   $text = stripslashes($text);
   $text = strip_tags($text);
   $text = trim($text);
}
/////////////////////////////////////////////////////////////////////////////



/////////////////////////////////////////////////////////////////////////////
function process_dir(& $dir) {

   if ( $dir != "" && substr($dir, -1) == "/" ) {
      $dir = substr($dir, 0, -1);
   }

}
/////////////////////////////////////////////////////////////////////////////



/////////////////////////////////////////////////////////////////////////////
// Gets the path to the current directory
// Returns something along the lines of:
// /docs/path/to/
// If path cannot be determined, returns an empty string
function current_dir() {

   if ( !empty($_SERVER['PHP_SELF']) || !empty($_SERVER['SCRIPT_NAME']) ) {

      $server_root = "";

      if ( !empty($_SERVER['PHP_SELF']) ) {
         $script = $_SERVER['PHP_SELF'];
      }
      else {
         $script = $_SERVER['SCRIPT_NAME'];
      }

      $subDirList = explode("/", $script);
      array_pop($subDirList);

      $server_root = implode("/", $subDirList) . "/";
   }
   else {
      $server_root = "";
   }

   return $server_root;
}
/////////////////////////////////////////////////////////////////////////////






?>

