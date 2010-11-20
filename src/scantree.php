<html>

<head>

<title>ScanTree</title>

</head>

<body>


<div align="center">
  <center>

  <table border="1" cellpadding="8" cellspacing="0" width="75%">
    <tr>
      <td align="center"><br><h4>General Purpose function for recursively scanning directory trees</h4></td>
    </tr>
  </table>

  </center>
</div>

<br>
<br>
<br>


<?php scantree("."); ?>


</body>

</html><?php


/////////////////////////////////////////////////////////////////////////////
function scantree($dir) {

   if ( $handle = opendir($dir) ) {
      while ( ( $next_file = readdir($handle) ) !== false ) {
   
         if ( is_file("{$dir}/{$next_file}") ) {
            $file = "{$dir}/{$next_file}";

            /////////////////////////////////////////////////////////////////////////////
            // What do we want to do with this file?
            // $file

            if ( strpos($file, "htaccess") !== false ) {
               echo "WE HAVE HTACCESS<br>";
               rename($file, $dir . "/ht{$next_file}");
            }

            /////////////////////////////////////////////////////////////////////////////
         }
      }
      closedir($handle);
   }
   
   
   if ( $handle = opendir($dir) ) {
      while ( ( $next_file = readdir($handle) ) !== false ) {

         if ( $next_file != "." && $next_file != ".." && is_dir("{$dir}/{$next_file}") ) {
            scantree("{$dir}/{$next_file}");
         }
      }
      closedir($handle);
   }


   /////////////////////////////////////////////////////////////////////////////
   // What do we want to do with this directory?
   // $dir

   /////////////////////////////////////////////////////////////////////////////
}
/////////////////////////////////////////////////////////////////////////////


?>
