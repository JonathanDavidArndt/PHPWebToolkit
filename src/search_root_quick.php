<?php


if ( empty($_GET['how_deep']) ) {
   $how_deep = "all";
}
else {
   settype($_GET['how_deep'], "integer");
   $how_deep = $_GET['how_deep'];
}

empty($_GET['show_dirs_only']) ? $show_dirs_only = false : $show_dirs_only = true;




/////////////////////////////////////////////////////////////////////////////
// How many levels of subfolders to dig through
// Set to "all" for no limit
define("_HOW_DEEP", $how_deep);
/////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////
// Only show the directory structure. Do not show the files. (Much faster!)
define("_SHOW_DIRS_ONLY", $show_dirs_only);
/////////////////////////////////////////////////////////////////////////////



if ( !empty($_GET['dir'] ) && $_GET['dir'] != "." ) {
   $start = $_GET['dir'];
   $display = $start;

   if ( substr($start, -1) == "/" ) {
      $start = substr($start, 0, -1);
   }
}
else {
   $start = ".";
   $display = "current directory";
}


?><html>

<head>

<title>Search of <?php echo $display; ?></title>

<style>

body {
   font-family:"Courier New",monospace;
   font-size:.8em;

   margin-top:1.5em;
   margin-left:2em;
   margin-right:2em;
   margin-bottom:1.5em;
}

h1 {
   font-family:"Times New Roman",sans-serif,serif;
}

h4 {
   font-family:"Times New Roman",sans-serif,serif;
   font-style:italic;
   text-align:center;
}

div {
   font-family:"Times New Roman",sans-serif,serif;
   font-size:1.25em;
   margin:0px 0px 0px 15px;
}

</style>

</head>

<body>

<h1>Search of <?php echo $display; ?></h1>

<hr><br><br>

<?php print_tree($start); ?>

<br><br><hr><h4>This is the end of the file list.</h4><hr><br><br>

<div>

<p align="center">
<i>Input can be taking in through the address bar in the following format:</i><br><br>
<?php echo $_SERVER['PHP_SELF']; ?>?variable=value&amp;variable2=value2</p>

<table border="1" width="50%" align="center">
  <tr>
    <th>Variable</td>
    <th>Value</td>
  </tr>
  <tr>
    <td>dir</td>
    <td>&lt;name of a directory&gt;<br><br>indicates where you want to start searching from<br><br>default value is the current directory</td>
  </tr>
  <tr>
    <td>how_deep</td>
    <td>&lt;any positive number&gt;<br><br>indicates how many levels of subdirectories to search through<br><br>default value is "all" for no limit</td>
  </tr>
  <tr>
    <td>show_dirs_only</td>
    <td>"0" or "1"<br><br>indicate if you only want to show the directory structure, and not show any files (much faster)<br><br>default value is "0"</td>
  </tr>
</table>

</div>

</body>

</html><?php


/////////////////////////////////////////////////////////////////////////////
// Finds and prints a tree of directories and files
function print_tree($start, $level = 0) {

   if ( _HOW_DEEP != "all" && _HOW_DEEP < $level ) {
      return;
   }

?><b><?php echo $start; ?></b><br>
<?php

   /////////////////////////////////////////////////////////////////////////////
   if ( !_SHOW_DIRS_ONLY ) {

      $data = array();
   
      $handle = opendir($start);
      while ( $file = readdir($handle) ) {
   
         if ( is_file("{$start}/{$file}") ) {
            $data[] = $file;
         }
      }
      closedir($handle);
      usort($data, "caseSensitive");
   
   
      $total = count($data);
      for ( $i = 0; $i < $total; $i += 1 ) {
         echo $data[$i]; ?><br>
   <?php
      }
      echo "<br>";
   
   }
   /////////////////////////////////////////////////////////////////////////////
   

   /////////////////////////////////////////////////////////////////////////////
   $data = array();

   $handle = opendir($start);
   while ( $file = readdir($handle) ) {

      if ( is_dir("{$start}/{$file}") ) {
         $data[] = $file;
      }
   }
   closedir($handle);
   usort($data, "caseSensitive");

   $total = count($data);
   for ( $i = 0; $i < $total; $i += 1 ) {

      switch ( $data[$i] ) {

         case ".":
         case "..":
            continue;
         break;

         default:
            print_tree($start . "/" . $data[$i], $level + 1);
         break;
      }
   }
   /////////////////////////////////////////////////////////////////////////////

}
/////////////////////////////////////////////////////////////////////////////



/////////////////////////////////////////////////////////////////////////////
// Case-insentative string comparison
function caseSensitive(& $a, & $b) {
    return strcmp($a, $b);
}
/////////////////////////////////////////////////////////////////////////////


?>
