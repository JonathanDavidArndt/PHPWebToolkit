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
   $starting_point = $_GET['dir'];
   $display = $starting_point;
}
else {
   $starting_point = ".";
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

.times {
   font-family:"Times New Roman",sans-serif,serif;
}

span.folders_root {
   display:block;
   cursor:hand;
}

span.files_root {
   display:block;
   cursor:default;
}

span.folders {
   display:block;
   cursor:hand;
}

span.files {
   display:none;
   cursor:default;
}

</style>


<script>

<!--

//=================================================================================
// Shows or hides the selected menu and flips the picture
function showhide(levelID) {

   this_level = document.getElementById(levelID);

   if (this_level.style.display == 'block') {
      this_level.style.display = 'none';
   }
   else {
      this_level.style.display = 'block';
   }

}


//=================================================================================
// Runs through some loops to SHOW all the sub-menus
function showALL() {

   var Nodes = document.getElementsByTagName("span");
   var max = Nodes.length;

   for ( var i = 0; i < max; i++ ) {
      var nodeObj = Nodes.item(i);
      nodeObj.style.display = 'block';
   }

}

//=================================================================================
// Runs through some loops to HIDE all the sub-menus
function hideALL() {

   var Nodes = document.getElementsByTagName("span");
   var Max = Nodes.length;

   for ( var i = 0; i < Max; i++ ) {
      var NodeObj = Nodes.item(i);
      NodeObj.style.display = 'block';
   }


   var filesNodes = document.getElementsByName("files");
   var filesMax = filesNodes.length;

   for ( var i = 0; i < filesMax; i++ ) {
      var fileNodeObj = filesNodes.item(i);
      fileNodeObj.style.display = 'none';
   }


}


//=================================================================================
// Runs the checkbox
function showHideALL() {

   // If nothing has been checked, it checks the boxes and runs the showALL f(x)
   if ( document.showTree.show.checked ) {
      showALL();
   }
   else {
      hideALL();
   }

}

//=================================================================================

//-->


</script>

</head>

<body onLoad="hideALL()">

<h1>Search of <?php echo $display; ?></h1>

<table cellpadding="0" cellspacing="0" border="0" width="100%">
  <tr>
    <td width="100%" align="right" class="times">

      <form name="showTree">
        <input type="checkbox" name="show" value="1" onclick="showHideALL()"> Show All
      </form>

    </td>
  </tr>
</table>

<hr><br><br>

<?php print_tree($starting_point); ?>

<br><br><hr><h4>This is the end of the file list.</h4><hr><br><br><br>

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

</body>

</html><?php


/////////////////////////////////////////////////////////////////////////////
// Finds and prints a tree of directories and files
function print_tree($starting_point = ".", $indent = 0) {

   if ( _HOW_DEEP != "all" && _HOW_DEEP < $indent ) {
      return;
   }

   $id = make_word($starting_point);

   if ( 0 < $indent ) {
      $separator_white = "|&nbsp; &nbsp; ";
?>
<span class="folders" name="folders" onClick="javascript:showhide('<?php echo $id; ?>')"><?php

      for ( $i = 1; $i < $indent; $i += 1 ) {
         $separator_white .= "|&nbsp; &nbsp; "; ?>|&nbsp; &nbsp; <?php
      }

?>|----<b><?php echo $starting_point; ?></b><br></span>
<span class="files" name="files" id="<?php echo $id; ?>">
<?php

   }
   else {
      $separator_white = "";
?>
<span class="folders_root" name="folders_root" onClick="javascript:showhide('<?php echo $id; ?>')"><b><?php echo $starting_point; ?></b><br></span>
<span class="files_root" name="files_root" id="<?php echo $id; ?>">
<?php

   }



   /////////////////////////////////////////////////////////////////////////////
   $dirs = array();

   if ( $directory_handle = opendir($starting_point) ) {
      while ( false !== ( $file = readdir($directory_handle) ) ) {

         if ( $file != "." && $file != ".." && is_dir("{$starting_point}/{$file}") ) {
            $dirs[] = $file;
         }
      }
      closedir($directory_handle);
   }
   usort($dirs, "caseInsensitive");

   $total_dirs = count($dirs);
   for ( $i = 0; $i < $total_dirs; $i += 1 ) {
      print_tree(str_replace("//", "/", $starting_point . "/") . $dirs[$i], $indent + 1);
   }
   /////////////////////////////////////////////////////////////////////////////


   /////////////////////////////////////////////////////////////////////////////
   if ( !_SHOW_DIRS_ONLY ) {

      $files = array();
   
      if ( $directory_handle = opendir($starting_point) ) {
         while ( false !== ( $file = readdir($directory_handle) ) ) {
   
            if ( is_file("{$starting_point}/{$file}") ) {
               $files[] = $file;
            }
         }
         closedir($directory_handle);
      }
      usort($files, "caseInsensitive");
   
   
      $total_files = count($files);
      for ( $j = 0; $j < $total_files; $j += 1 ) {
         echo $separator_white; ?>|----<a href="<?php echo str_replace("//", "/", $starting_point . "/") . $files[$j]; ?>"><?php echo $files[$j]; ?></a><br>
   <?php
      }
   }
   /////////////////////////////////////////////////////////////////////////////
   
   

   if ( isset($total_files) && $total_files < 1 ) {
      echo $separator_white; ?>|----<i>(there are no files in this directory)</i><br><?php
   }
   echo $separator_white; ?><br></span>
<?php

}
/////////////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////////////////////
// Case-insentative string comparison
function caseInsensitive($a, $b) {
    return strcmp( strtolower($a), strtolower($b) );
}
/////////////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////////////////////
// Remove non-"word" characters
function make_word($text) {
   return preg_replace("/[^\w]/", "_", $text);
}
/////////////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////////////////////
// Find all files in a certain directory
function find_all_files($file_directory) {

   $file_list = array();

   if ( $directory_handle = opendir($file_directory) ) {
      while ( false !== ( $file = readdir($directory_handle) ) ) {

         if ( is_file("{$file_directory}/{$file}") ) {
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



?>