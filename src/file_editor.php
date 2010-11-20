<?php


/////////////////////////////////////////////////////////////////////////////
// Trying to turn off magic quotes
ini_set("magic_quotes_gpc",     "0");
ini_set("magic_quotes_runtime", "0");
ini_set("magic_quotes_sybase",  "0");
/////////////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////////////////////
// Set some defaults, if others are not specified
$default_filename = "";
$rows = "18";
$cols = "86";
/////////////////////////////////////////////////////////////////////////////



/////////////////////////////////////////////////////////////////////////////
// These variables can come from either GET or POST
if ( !empty($_GET['action']) ) { $_POST['action'] = urldecode($_GET['action']); }
/////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////
// Load global vars into local vars
empty($_GET['result'])  ? $result = "" : $result = urldecode($_GET['result']);
empty($_POST['action']) ? $action = "" : $action = $_POST['action'];

empty($_POST['filename'])      ? $filename      = "" : $filename      = $_POST['filename'];
empty($_POST['mainbody_text']) ? $mainbody_text = "" : $mainbody_text = $_POST['mainbody_text'];

empty($_GET['delete_confirm']) ? $delete_confirm = "" : $delete_confirm = $_GET['delete_confirm'];
/////////////////////////////////////////////////////////////////////////////



/////////////////////////////////////////////////////////////////////////////
$file_loaded = false;
/////////////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////////////////////
switch ( $result ) {

   case "success":
      $message = "File was saved successfully in<br><font class=\"fixedwidth\">{$_GET['filename']}</font>";
   break;

   case "failure":
      $message = "<font class=\"alert\">File could not be saved in<br><font class=\"fixedwidth\">{$_GET['filename']}</font></font>";
   break;

   case "delete_success":
      $message = "<font class=\"fixedwidth\">{$_GET['filename']}</font><br>was deleted successfully";
   break;

   case "delete_failure":
      $message = "<font class=\"alert\"><font class=\"fixedwidth\">{$_GET['filename']}</font><br>could not be deleted</font>";
   break;

   default:

      // If there is no result, you can grab the name of the file from the Address Bar
      // and open it for reading
      if ( !empty($_GET['filename']) && file_exists($_GET['filename']) ) {

         $filename      = $_GET['filename'];
         $mainbody_text = file_read($filename);


         // Preparing to delete the selected file
         if ( $action == "delete" ) {

            // Deleting the file
            if ( $delete_confirm == "nuke" ) {

               if ( @unlink($filename) ) {

                  // What happens if the file is deleted successfully
                  header("Location: file_editor.php?filename=" . urlencode($filename) . "&result=delete_success");
                  exit();
               }
               else {

                  // What happens if the file is not deleted
                  header("Location: file_editor.php?filename=" . urlencode($filename) . "&result=delete_failure");
                  exit();
               }

            }

            // Showing a confirmation box
            else {
               $message = "

                    <br><font class=\"fixedwidth\">{$filename}</font> will be <i>permanently deleted</i><br><br>
                    <font class=\"alert\">This action cannot be undone</font><br><br>
                    Do you still want to delete this file?<br><br>

                    <br>

                    <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"50%\">
                      <tr>
                        <td width=\"50%\" align=\"center\">[ <a href=\"file_editor.php?filename={$filename}&amp;action=delete&amp;delete_confirm=nuke\" target=\"_self\">Yes</a> ]</td>
                        <td width=\"50%\" align=\"center\">[ <a href=\"file_editor.php?filename={$filename}\" target=\"_self\">No</a> ]</td>
                      </tr>
                    </table>

                    <br>";


            }

         }

         // Loading the selected file
         else {
            $action = "";
            $file_loaded = true;
         }
      }

      $result = "";
   break;
}

/////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////
if ( empty($result) && $action == "Save" ) {

   if ( empty($filename) ) {
      $message = "<font class=\"alert\">You need to choose a filename</font>";
   }
   else {

      // If quotes were added, we are stripping them away.
      // Users were warned about this earlier, and it should not present
      // a problem when only writing ordinary text files.
      if ( get_magic_quotes_gpc() ) {
         $mainbody_text = stripslashes($mainbody_text);
      }

      if ( file_write($filename, $mainbody_text) ) {

         // What happens if the file is stored successfully
         header("Location: file_editor.php?filename=" . urlencode($filename) . "&result=success");
         exit();
      }
      else {

         // What happens if the file cannot be stored for some reason
         header("Location: file_editor.php?filename=" . urlencode($filename) . "&result=failure");
         exit();
      }
   }
}
/////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////
$filename = str_replace("''", '"', $filename);
/////////////////////////////////////////////////////////////////////////////


?><html>

<head>

<title>File Editor</title>

<style>

body {
   margin-top:2%;
   margin-left:2%;
   margin-right:2%;
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

  <form action="file_editor.php" method="post" name="editorform" target="_self">

  <table border="0" cellpadding="0" cellspacing="0" width="0*">
    <tr>
      <td align="center"><h1>File Editor</h1><br>

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

/////////////////////////////////////////////////////////////////////////////
// It was discovered that HTML presented a problem, especially if
// the HTML was something like </textarea>
// The tags are all automatically converted back to "normal" HTML when the form is submitted
$mainbody_text = str_replace( array("<", ">"), array("&lt;", "&gt;"), $mainbody_text);
/////////////////////////////////////////////////////////////////////////////

?>
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
          <tr>
            <td width="100%" align="center"><?php

if ( $file_loaded ) {
?>

Now editing file:&nbsp; <font class="fixedwidth"><?php echo $filename; ?></font><br>
<a href="file_editor.php?filename=<?php echo $filename; ?>&amp;action=delete" target="_self">Delete this file</a><br><br>
<?php
}

if ( get_magic_quotes_gpc() ) {
?>

<font class="alert">Warning:</font><br>
All \backslashes\ will be automatically stripped from this file.<br>
This is a program configuration, and there is nothing this web page can do to turn it off.<br><br>
<?php
}

?><textarea name="mainbody_text" rows="<?php echo $rows; ?>" cols="<?php echo $cols; ?>"><?php echo $mainbody_text; ?>

</textarea>

              <br>
              <br>

              <label for="filename">File name:&nbsp;</label>
              <input type="text" name="filename" size="48" value="<?php echo $filename; ?>" id="filename">
              <input type="submit" name="action" value="Save" accesskey="S">

            </td>
          </tr>
        </table>

      </td>
    </tr>
  </table>

  </form>

  </center>
</div>

<br><br><br>

<hr>

<p align="center">
<i>Input can be taking in through the address bar in the following format:</i><br><br>
<?php echo $_SERVER['PHP_SELF']; ?>?variable=value&amp;variable2=value2</p>

<table border="1" width="50%" align="center">
  <tr>
    <th>Variable</td>
    <th>Value</td>
  </tr>
  <tr>
    <td>filename</td>
    <td>&lt;path of file to edit&gt;</td>
  </tr>
  <tr>
    <td>action</td>
    <td>"delete"</td>
  </tr>
  <tr>
    <td>delete_confirm</td>
    <td>"nuke"</td>
  </tr>
</table>


<script language="JavaScript">
<!--

if ( document.editorform.mainbody_text.value == "" ) {
   document.editorform.mainbody_text.focus();
}
else if ( document.editorform.filename.value == "" ) {
   document.editorform.filename.focus();
}

// -->
</script>

</body>

</html><?php



/////////////////////////////////////////////////////////////////////////////
function file_read($file) {

   if ( file_exists($file) ) {

      $filePointer = fopen($file, "r");
      $contents = fread($filePointer, filesize($file) );
      fclose($filePointer);

      return $contents;
   }

   return "";
}
/////////////////////////////////////////////////////////////////////////////



/////////////////////////////////////////////////////////////////////////////
function file_write($file, & $contents) {

   if (
        ( $filePointer = fopen($file, "w") ) &&
        ( fwrite($filePointer, $contents) )  &&
        ( fclose($filePointer) )
                                 ) {
      return true;
   }

   return false;
}
/////////////////////////////////////////////////////////////////////////////



?>
