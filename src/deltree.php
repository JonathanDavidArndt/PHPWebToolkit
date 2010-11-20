<?php

/////////////////////////////////////////////////////////////////////////////
// Choose decimal precision for file sizes

// How many decimals to show if the file size is under 1,000 KB?
define("_DECIMAL_PRECISION_KB", 0);

// How many decimals to show if the file size is under 1,000 MB?
define("_DECIMAL_PRECISION_MB", 1);

// How many decimals to show if the file size is under 1,000 GB?
define("_DECIMAL_PRECISION_GB", 2);
/////////////////////////////////////////////////////////////////////////////



/////////////////////////////////////////////////////////////////////////////
// Load global vars into local vars
empty($_GET['dir'])     ? $dir    = "." : $dir    = urldecode($_GET['dir']);
empty($_POST['action']) ? $action = ""  : $action = $_POST['action'];
/////////////////////////////////////////////////////////////////////////////



/////////////////////////////////////////////////////////////////////////////
process_dir($dir);
/////////////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////////////////////
if ( $dir == "." ) {
   $dir_disp = "the current directory";
}
else {
   $dir_disp = "the directory \"{$dir}\"";
}
/////////////////////////////////////////////////////////////////////////////



/////////////////////////////////////////////////////////////////////////////
$errors = array();

if ( $action == "Delete" ) {

   if ( empty($_POST['del_subdirs']) ) { $_POST['del_subdirs'] = array(); }
   if ( empty($_POST['del_files'])   ) { $_POST['del_files']   = array(); }

   foreach ( $_POST['del_subdirs'] as $next ) {
      $next = stripslashes($next);
      deltree($next, $errors);
   }

   foreach ( $_POST['del_files'] as $next ) {
      $next = stripslashes($next);
      if ( !delfile($next) ) {
         $errors[] = $next;
      }
   }
}
/////////////////////////////////////////////////////////////////////////////


?><html>

<head>

<title>Index of files in <?php echo $dir_disp; ?></title>

<style>

body {
   margin-top:2%;
   margin-left:2%;
   margin-right:2%;
   margin-bottom:2%;
}


th.grayed {
   background-color:#C0C0C0;
   color:#000000;
}

h4 {
   font-style:italic;
   text-align:center;
}

.fixedwidth {
   font-family:"Courier New",monospace;
   font-weight:bold;
}

.grayed {
   background-color:#FFFFFF;
   color:#C0C0C0;
}

.alert {
   color:#FF0000;
   font-weight:bold;
}


</style>

</head>

<body>

<table border="0" cellpadding="8" cellspacing="0" width="100%">
  <tr>
    <td align="center"><h1>Index of files in <?php echo $dir_disp; ?></h1></td>
  </tr>
</table>

<br>

<?php

if ( !empty($errors) ) {

?>

<div align="center">
  <center>

  <table cellpadding="4" cellspacing="0" border="1" width="75%">
    <tr bgcolor="#C0C0C0">
      <td><h4>The following files and directories could not be deleted</h4></td>
    </tr>

<?php
  
   $total_errors = count($errors);
   for ( $i = 0; $i < $total_errors; $i += 1 ) {

?>

    <tr<?php if ( $i % 2 == 1 ) { echo " bgcolor=\"#C0C0C0\""; } ?>>
      <td valign="top" width="100%" class="fixedwidth"><font class="alert"><?php echo $errors[$i]; ?></font></td>
    </tr>

<?php
   }
?>

  </table>

  </center>
</div>

<br>
<br>
<br>

<?php
}
else if ( $action == "Delete" ) {

?>

<div align="center">
  <center>

  <table border="1" cellpadding="8" cellspacing="0" width="75%">
    <tr>
      <td align="center"><br><h4>All files and directories deleted successfully</h4></td>
    </tr>
  </table>

  </center>
</div>

<br>
<br>
<br>

<?php

}

?>

<table border="1" cellpadding="8" cellspacing="0" width="100%">
  <tr>
    <td align="left" valign="middle"><font class="fixedwidth">^</font> <a href="deltree.php?dir=<?php echo parent_dir($dir); ?>">Parent Directory</a></td>
  </tr>
</table>

<br>

<table border="1" cellpadding="8" cellspacing="0" width="100%">
  <tr>
    <td align="center" class="alert">
      <h1>Warning</h1>
      Directories are deleted recursively!<br>
      All files and subdirectories will be deleted!<br><br>
      Files and directories cannot be recovered once deleted!</td>
  </tr>
</table>

<br>

<form action="deltree.php?dir=<?php echo urlencode($dir); ?>" method="post" name="deltreeform" target="_self">

<table border="1" cellpadding="8" cellspacing="0" width="100%">
  <tr>
    <th align="center" class="grayed"><input type="checkbox" name="allbox" value="1" onClick="javascript:check_all();"></th>
    <th align="center" class="grayed">Size</th>
    <th align="center" class="grayed" width="100%">Name</th>
  </tr>
<?php

$subdirs = find_all_subdirectories($dir);
usort($subdirs, "caseInsensitive");

$total_subdirs = count($subdirs);
for ( $i = 0; $i < $total_subdirs; $i += 1 ) {

?>

  <tr>
    <td align="center" valign="top"><input type="checkbox" name="del_subdirs[<?php echo $i; ?>]" value="<?php echo "{$dir}/{$subdirs[$i]}"; ?>"></td>
    <td nowrap><i>directory</i></td>
    <td width="100%"><a href="deltree.php?dir=<?php echo urlencode("{$dir}/{$subdirs[$i]}"); ?>"><?php echo $subdirs[$i]; ?></a></td>
  </tr>
<?php

}


$files = find_all_files($dir);
usort($files, "caseInsensitive");

$total_files = count($files);
for ( $i = 0; $i < $total_files; $i += 1 ) {

   $file_size = filesize("{$dir}/{$files[$i]}");

   if ( 999999999 < $file_size ) {
      $file_size = number_format($file_size / 1000000000, _DECIMAL_PRECISION_GB) . " GB";
   }
   else if ( 999999 < $file_size ) {
      $file_size = number_format($file_size / 1000000, _DECIMAL_PRECISION_MB) . " MB";
   }
   else if ( 999 < $file_size ) {
      $file_size = number_format($file_size / 1000, _DECIMAL_PRECISION_KB) . " KB";
   }
   else if ( 0 < $file_size ) {
      $file_size .= " bytes";
   }
   else {
      $file_size = "0 bytes";
   }


?>
  <tr>
    <td align="center" valign="top"><input type="checkbox" name="del_files[<?php echo $i; ?>]" value="<?php echo "{$dir}/{$files[$i]}"; ?>" id="del_file<?php echo $i; ?>"></td>
    <td align="right" nowrap><?php echo $file_size; ?></td>
    <td width="100%"><label for="del_file<?php echo $i; ?>"><?php echo $files[$i]; ?></label></td>
  </tr>
<?php

}


if ( count($subdirs) < 1 && count($files) < 1 ) {

?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="100%" align="center"><br><i>There are no files or subdirectories in <?php echo $dir_disp; ?></i><br><br></td>
  </tr>
<?php

}



?>
  <tr>
    <th align="left" class="grayed" colspan="3"><input type="submit" name="action" value="Delete"></th>
  </tr>
</table>

</form>

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


<script language="JavaScript">
<!--

function check_all() {
   for ( var i = 0; i < document.deltreeform.elements.length; i += 1 ) {
      var e = document.deltreeform.elements[i];

      if ( e.type == 'checkbox' && e.name != 'allbox' ) {
         e.checked = document.deltreeform.allbox.checked;
      }
   }
}
// -->
</script>


</body>

</html><?php


/////////////////////////////////////////////////////////////////////////////
// Find all files in a certain directory
function find_all_files($file_directory) {

   if ( !is_dir($file_directory) ) {
      return array();
   }

   $file_list = array();

   if ( $directory_handle = opendir($file_directory) ) {
      while ( false !== ( $file = readdir($directory_handle) ) ) {

         if ( $file != "." && $file != ".." && is_file("{$file_directory}/{$file}") ) {
            $file_list[] = $file;
         }
      }
      closedir($directory_handle);
   }

   return $file_list;
}
/////////////////////////////////////////////////////////////////////////////



/////////////////////////////////////////////////////////////////////////////
// Finds all subdirectories in a certain directory
function find_all_subdirectories($file_directory) {

   if ( !is_dir($file_directory) ) {
      return array();
   }

   $file_list = array();

   if ( $directory_handle = opendir($file_directory) ) {
      while ( false !== ( $file = readdir($directory_handle) ) ) {

         if ( $file != "." && $file != ".." && is_dir("{$file_directory}/{$file}") ) {
            $file_list[] = $file;
         }
      }
      closedir($directory_handle);
   }

   return $file_list;

}
/////////////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////////////////////
// Case-insentative string comparison
function caseInsensitive($a, $b) {
    return strcmp( strtolower($a), strtolower($b) );
}
/////////////////////////////////////////////////////////////////////////////



/////////////////////////////////////////////////////////////////////////////
function process_dir(& $dir) {

   $dir = stripslashes($dir);

   if ( $dir != "" && substr($dir, -1) == "/" ) {
      $dir = substr($dir, 0, -1);
   }

}
/////////////////////////////////////////////////////////////////////////////



/////////////////////////////////////////////////////////////////////////////
function parent_dir($dir) {

   $dir_parts = explode("/", $dir);
   array_pop($dir_parts);

   $dir = implode("/", $dir_parts);

   if ( empty($dir) ) {
      $dir = ".";
   }

   return $dir;
}
/////////////////////////////////////////////////////////////////////////////



/////////////////////////////////////////////////////////////////////////////
function delfile($file) {

   if ( !is_file($file) ) {
      return false;
   }

   return @unlink($file);
}
/////////////////////////////////////////////////////////////////////////////



/////////////////////////////////////////////////////////////////////////////
function deldir($dir) {

   if ( !is_dir($dir) ) {
      return false;
   }

   return @rmdir($dir);
}
/////////////////////////////////////////////////////////////////////////////



/////////////////////////////////////////////////////////////////////////////
function deltree($starting_point, & $errors) {

   if ( !is_dir($starting_point) ) {
      return false;
   }

  
   if ( $handle = opendir($starting_point) ) {
      while ( ( $file = readdir($handle) ) !== false ) {
   
         if ( is_file("{$starting_point}/{$file}") ) {

            if ( !delfile("{$starting_point}/{$file}") ) {
               $errors[] = "{$starting_point}/{$file}";
            }
         }
      }
      closedir($handle);
   }
   
   
   if ( $handle = opendir($starting_point) ) {
      while ( ( $file = readdir($handle) ) !== false ) {

         if ( $file != "." && $file != ".." && is_dir("{$starting_point}/{$file}") ) {
            deltree("{$starting_point}/{$file}", $errors);
         }
      }
      closedir($handle);
   }


   if ( !deldir($starting_point) ) {
      $errors[] = $starting_point;
   }
}
/////////////////////////////////////////////////////////////////////////////





?>