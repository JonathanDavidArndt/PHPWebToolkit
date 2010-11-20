<?php


/////////////////////////////////////////////////////////////////////////////
// These variables can come from either GET or POST
if ( !empty($_GET['dir'])    ) { $_POST['dir']    = urldecode($_GET['dir']); }
if ( !empty($_GET['mode'])   ) { $_POST['mode']   = urldecode($_GET['mode']); }
if ( !empty($_GET['action']) ) { $_POST['action'] = urldecode($_GET['action']); }
/////////////////////////////////////////////////////////////////////////////



/////////////////////////////////////////////////////////////////////////////
// Load global vars into local vars
empty($_POST['dir'])    ? $dir    = "." : $dir    = $_POST['dir'];
empty($_POST['action']) ? $action = ""  : $action = $_POST['action'];

empty($_POST['owner_execute']) ? $owner_execute = 0  : $owner_execute = 1;
empty($_POST['owner_write'])   ? $owner_write   = 0  : $owner_write   = 1;
empty($_POST['owner_read'])    ? $owner_read    = 0  : $owner_read    = 1;

empty($_POST['group_execute']) ? $group_execute = 0  : $group_execute = 1;
empty($_POST['group_write'])   ? $group_write   = 0  : $group_write   = 1;
empty($_POST['group_read'])    ? $group_read    = 0  : $group_read    = 1;

empty($_POST['everyone_execute']) ? $everyone_execute = 0  : $everyone_execute = 1;
empty($_POST['everyone_write'])   ? $everyone_write   = 0  : $everyone_write   = 1;
empty($_POST['everyone_read'])    ? $everyone_read    = 0  : $everyone_read    = 1;
/////////////////////////////////////////////////////////////////////////////



/////////////////////////////////////////////////////////////////////////////
if ( empty($_POST['mode']) ) {
   $mode = compile_mode($owner_execute, $owner_write, $owner_read, $group_execute, $group_write, $group_read, $everyone_execute, $everyone_write, $everyone_read);
}
else {
   $mode = $_POST['mode'];
}
/////////////////////////////////////////////////////////////////////////////



/////////////////////////////////////////////////////////////////////////////
if ( $dir == "." ) {
   $dir_disp = "the current directory";
}
else {
   $dir_disp = "the directory \"{$dir}\"";
}
/////////////////////////////////////////////////////////////////////////////


?><html>

<head>

<title>chmod all files in <?php echo $dir_disp; ?></title>

<style>

body {
   margin-top:2%;
   margin-left:2%;
   margin-right:2%;
   margin-bottom:2%;
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

<div align="center">
  <center>

  <table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
      <td align="center"><h1>chmod all files in <?php echo $dir_disp; ?></h1>

<?php

/////////////////////////////////////////////////////////////////////////////
if ( $action == "chmodNOW" ) {
   
   $file_list = find_all_files($dir);

   if ( empty($file_list) ) {
?>

<table cellpadding="4" cellspacing="0" border="1" width="100%">
  <tr bgcolor="#C0C0C0">
    <td><br><h4>There are no files in <?php echo $dir_disp; ?></h4></td>
  </tr>
</table>

<?php

   }
   else {

?>

<table cellpadding="4" cellspacing="0" border="1" width="100%">
  <tr bgcolor="#C0C0C0">
    <td colspan="2"><h4>Results</h4></td>
  </tr>

<?php
  
      $total_file_list = count($file_list);
      for ( $i = 0; $i < $total_file_list; $i += 1 ) {

         $file = "{$dir}/{$file_list[$i]}";

         switch ( $mode ) {

            case "0000": $success = chmod($file, 0000); break;
            case "0001": $success = chmod($file, 0001); break;
            case "0002": $success = chmod($file, 0002); break;
            case "0003": $success = chmod($file, 0003); break;
            case "0004": $success = chmod($file, 0004); break;
            case "0005": $success = chmod($file, 0005); break;
            case "0006": $success = chmod($file, 0006); break;
            case "0007": $success = chmod($file, 0007); break;
            case "0010": $success = chmod($file, 0010); break;
            case "0011": $success = chmod($file, 0011); break;
            case "0012": $success = chmod($file, 0012); break;
            case "0013": $success = chmod($file, 0013); break;
            case "0014": $success = chmod($file, 0014); break;
            case "0015": $success = chmod($file, 0015); break;
            case "0016": $success = chmod($file, 0016); break;
            case "0017": $success = chmod($file, 0017); break;
            case "0020": $success = chmod($file, 0020); break;
            case "0021": $success = chmod($file, 0021); break;
            case "0022": $success = chmod($file, 0022); break;
            case "0023": $success = chmod($file, 0023); break;
            case "0024": $success = chmod($file, 0024); break;
            case "0025": $success = chmod($file, 0025); break;
            case "0026": $success = chmod($file, 0026); break;
            case "0027": $success = chmod($file, 0027); break;
            case "0030": $success = chmod($file, 0030); break;
            case "0031": $success = chmod($file, 0031); break;
            case "0032": $success = chmod($file, 0032); break;
            case "0033": $success = chmod($file, 0033); break;
            case "0034": $success = chmod($file, 0034); break;
            case "0035": $success = chmod($file, 0035); break;
            case "0036": $success = chmod($file, 0036); break;
            case "0037": $success = chmod($file, 0037); break;
            case "0040": $success = chmod($file, 0040); break;
            case "0041": $success = chmod($file, 0041); break;
            case "0042": $success = chmod($file, 0042); break;
            case "0043": $success = chmod($file, 0043); break;
            case "0044": $success = chmod($file, 0044); break;
            case "0045": $success = chmod($file, 0045); break;
            case "0046": $success = chmod($file, 0046); break;
            case "0047": $success = chmod($file, 0047); break;
            case "0050": $success = chmod($file, 0050); break;
            case "0051": $success = chmod($file, 0051); break;
            case "0052": $success = chmod($file, 0052); break;
            case "0053": $success = chmod($file, 0053); break;
            case "0054": $success = chmod($file, 0054); break;
            case "0055": $success = chmod($file, 0055); break;
            case "0056": $success = chmod($file, 0056); break;
            case "0057": $success = chmod($file, 0057); break;
            case "0060": $success = chmod($file, 0060); break;
            case "0061": $success = chmod($file, 0061); break;
            case "0062": $success = chmod($file, 0062); break;
            case "0063": $success = chmod($file, 0063); break;
            case "0064": $success = chmod($file, 0064); break;
            case "0065": $success = chmod($file, 0065); break;
            case "0066": $success = chmod($file, 0066); break;
            case "0067": $success = chmod($file, 0067); break;
            case "0070": $success = chmod($file, 0070); break;
            case "0071": $success = chmod($file, 0071); break;
            case "0072": $success = chmod($file, 0072); break;
            case "0073": $success = chmod($file, 0073); break;
            case "0074": $success = chmod($file, 0074); break;
            case "0075": $success = chmod($file, 0075); break;
            case "0076": $success = chmod($file, 0076); break;
            case "0077": $success = chmod($file, 0077); break;
            case "0100": $success = chmod($file, 0100); break;
            case "0101": $success = chmod($file, 0101); break;
            case "0102": $success = chmod($file, 0102); break;
            case "0103": $success = chmod($file, 0103); break;
            case "0104": $success = chmod($file, 0104); break;
            case "0105": $success = chmod($file, 0105); break;
            case "0106": $success = chmod($file, 0106); break;
            case "0107": $success = chmod($file, 0107); break;
            case "0110": $success = chmod($file, 0110); break;
            case "0111": $success = chmod($file, 0111); break;
            case "0112": $success = chmod($file, 0112); break;
            case "0113": $success = chmod($file, 0113); break;
            case "0114": $success = chmod($file, 0114); break;
            case "0115": $success = chmod($file, 0115); break;
            case "0116": $success = chmod($file, 0116); break;
            case "0117": $success = chmod($file, 0117); break;
            case "0120": $success = chmod($file, 0120); break;
            case "0121": $success = chmod($file, 0121); break;
            case "0122": $success = chmod($file, 0122); break;
            case "0123": $success = chmod($file, 0123); break;
            case "0124": $success = chmod($file, 0124); break;
            case "0125": $success = chmod($file, 0125); break;
            case "0126": $success = chmod($file, 0126); break;
            case "0127": $success = chmod($file, 0127); break;
            case "0130": $success = chmod($file, 0130); break;
            case "0131": $success = chmod($file, 0131); break;
            case "0132": $success = chmod($file, 0132); break;
            case "0133": $success = chmod($file, 0133); break;
            case "0134": $success = chmod($file, 0134); break;
            case "0135": $success = chmod($file, 0135); break;
            case "0136": $success = chmod($file, 0136); break;
            case "0137": $success = chmod($file, 0137); break;
            case "0140": $success = chmod($file, 0140); break;
            case "0141": $success = chmod($file, 0141); break;
            case "0142": $success = chmod($file, 0142); break;
            case "0143": $success = chmod($file, 0143); break;
            case "0144": $success = chmod($file, 0144); break;
            case "0145": $success = chmod($file, 0145); break;
            case "0146": $success = chmod($file, 0146); break;
            case "0147": $success = chmod($file, 0147); break;
            case "0150": $success = chmod($file, 0150); break;
            case "0151": $success = chmod($file, 0151); break;
            case "0152": $success = chmod($file, 0152); break;
            case "0153": $success = chmod($file, 0153); break;
            case "0154": $success = chmod($file, 0154); break;
            case "0155": $success = chmod($file, 0155); break;
            case "0156": $success = chmod($file, 0156); break;
            case "0157": $success = chmod($file, 0157); break;
            case "0160": $success = chmod($file, 0160); break;
            case "0161": $success = chmod($file, 0161); break;
            case "0162": $success = chmod($file, 0162); break;
            case "0163": $success = chmod($file, 0163); break;
            case "0164": $success = chmod($file, 0164); break;
            case "0165": $success = chmod($file, 0165); break;
            case "0166": $success = chmod($file, 0166); break;
            case "0167": $success = chmod($file, 0167); break;
            case "0170": $success = chmod($file, 0170); break;
            case "0171": $success = chmod($file, 0171); break;
            case "0172": $success = chmod($file, 0172); break;
            case "0173": $success = chmod($file, 0173); break;
            case "0174": $success = chmod($file, 0174); break;
            case "0175": $success = chmod($file, 0175); break;
            case "0176": $success = chmod($file, 0176); break;
            case "0177": $success = chmod($file, 0177); break;
            case "0200": $success = chmod($file, 0200); break;
            case "0201": $success = chmod($file, 0201); break;
            case "0202": $success = chmod($file, 0202); break;
            case "0203": $success = chmod($file, 0203); break;
            case "0204": $success = chmod($file, 0204); break;
            case "0205": $success = chmod($file, 0205); break;
            case "0206": $success = chmod($file, 0206); break;
            case "0207": $success = chmod($file, 0207); break;
            case "0210": $success = chmod($file, 0210); break;
            case "0211": $success = chmod($file, 0211); break;
            case "0212": $success = chmod($file, 0212); break;
            case "0213": $success = chmod($file, 0213); break;
            case "0214": $success = chmod($file, 0214); break;
            case "0215": $success = chmod($file, 0215); break;
            case "0216": $success = chmod($file, 0216); break;
            case "0217": $success = chmod($file, 0217); break;
            case "0220": $success = chmod($file, 0220); break;
            case "0221": $success = chmod($file, 0221); break;
            case "0222": $success = chmod($file, 0222); break;
            case "0223": $success = chmod($file, 0223); break;
            case "0224": $success = chmod($file, 0224); break;
            case "0225": $success = chmod($file, 0225); break;
            case "0226": $success = chmod($file, 0226); break;
            case "0227": $success = chmod($file, 0227); break;
            case "0230": $success = chmod($file, 0230); break;
            case "0231": $success = chmod($file, 0231); break;
            case "0232": $success = chmod($file, 0232); break;
            case "0233": $success = chmod($file, 0233); break;
            case "0234": $success = chmod($file, 0234); break;
            case "0235": $success = chmod($file, 0235); break;
            case "0236": $success = chmod($file, 0236); break;
            case "0237": $success = chmod($file, 0237); break;
            case "0240": $success = chmod($file, 0240); break;
            case "0241": $success = chmod($file, 0241); break;
            case "0242": $success = chmod($file, 0242); break;
            case "0243": $success = chmod($file, 0243); break;
            case "0244": $success = chmod($file, 0244); break;
            case "0245": $success = chmod($file, 0245); break;
            case "0246": $success = chmod($file, 0246); break;
            case "0247": $success = chmod($file, 0247); break;
            case "0250": $success = chmod($file, 0250); break;
            case "0251": $success = chmod($file, 0251); break;
            case "0252": $success = chmod($file, 0252); break;
            case "0253": $success = chmod($file, 0253); break;
            case "0254": $success = chmod($file, 0254); break;
            case "0255": $success = chmod($file, 0255); break;
            case "0256": $success = chmod($file, 0256); break;
            case "0257": $success = chmod($file, 0257); break;
            case "0260": $success = chmod($file, 0260); break;
            case "0261": $success = chmod($file, 0261); break;
            case "0262": $success = chmod($file, 0262); break;
            case "0263": $success = chmod($file, 0263); break;
            case "0264": $success = chmod($file, 0264); break;
            case "0265": $success = chmod($file, 0265); break;
            case "0266": $success = chmod($file, 0266); break;
            case "0267": $success = chmod($file, 0267); break;
            case "0270": $success = chmod($file, 0270); break;
            case "0271": $success = chmod($file, 0271); break;
            case "0272": $success = chmod($file, 0272); break;
            case "0273": $success = chmod($file, 0273); break;
            case "0274": $success = chmod($file, 0274); break;
            case "0275": $success = chmod($file, 0275); break;
            case "0276": $success = chmod($file, 0276); break;
            case "0277": $success = chmod($file, 0277); break;
            case "0300": $success = chmod($file, 0300); break;
            case "0301": $success = chmod($file, 0301); break;
            case "0302": $success = chmod($file, 0302); break;
            case "0303": $success = chmod($file, 0303); break;
            case "0304": $success = chmod($file, 0304); break;
            case "0305": $success = chmod($file, 0305); break;
            case "0306": $success = chmod($file, 0306); break;
            case "0307": $success = chmod($file, 0307); break;
            case "0310": $success = chmod($file, 0310); break;
            case "0311": $success = chmod($file, 0311); break;
            case "0312": $success = chmod($file, 0312); break;
            case "0313": $success = chmod($file, 0313); break;
            case "0314": $success = chmod($file, 0314); break;
            case "0315": $success = chmod($file, 0315); break;
            case "0316": $success = chmod($file, 0316); break;
            case "0317": $success = chmod($file, 0317); break;
            case "0320": $success = chmod($file, 0320); break;
            case "0321": $success = chmod($file, 0321); break;
            case "0322": $success = chmod($file, 0322); break;
            case "0323": $success = chmod($file, 0323); break;
            case "0324": $success = chmod($file, 0324); break;
            case "0325": $success = chmod($file, 0325); break;
            case "0326": $success = chmod($file, 0326); break;
            case "0327": $success = chmod($file, 0327); break;
            case "0330": $success = chmod($file, 0330); break;
            case "0331": $success = chmod($file, 0331); break;
            case "0332": $success = chmod($file, 0332); break;
            case "0333": $success = chmod($file, 0333); break;
            case "0334": $success = chmod($file, 0334); break;
            case "0335": $success = chmod($file, 0335); break;
            case "0336": $success = chmod($file, 0336); break;
            case "0337": $success = chmod($file, 0337); break;
            case "0340": $success = chmod($file, 0340); break;
            case "0341": $success = chmod($file, 0341); break;
            case "0342": $success = chmod($file, 0342); break;
            case "0343": $success = chmod($file, 0343); break;
            case "0344": $success = chmod($file, 0344); break;
            case "0345": $success = chmod($file, 0345); break;
            case "0346": $success = chmod($file, 0346); break;
            case "0347": $success = chmod($file, 0347); break;
            case "0350": $success = chmod($file, 0350); break;
            case "0351": $success = chmod($file, 0351); break;
            case "0352": $success = chmod($file, 0352); break;
            case "0353": $success = chmod($file, 0353); break;
            case "0354": $success = chmod($file, 0354); break;
            case "0355": $success = chmod($file, 0355); break;
            case "0356": $success = chmod($file, 0356); break;
            case "0357": $success = chmod($file, 0357); break;
            case "0360": $success = chmod($file, 0360); break;
            case "0361": $success = chmod($file, 0361); break;
            case "0362": $success = chmod($file, 0362); break;
            case "0363": $success = chmod($file, 0363); break;
            case "0364": $success = chmod($file, 0364); break;
            case "0365": $success = chmod($file, 0365); break;
            case "0366": $success = chmod($file, 0366); break;
            case "0367": $success = chmod($file, 0367); break;
            case "0370": $success = chmod($file, 0370); break;
            case "0371": $success = chmod($file, 0371); break;
            case "0372": $success = chmod($file, 0372); break;
            case "0373": $success = chmod($file, 0373); break;
            case "0374": $success = chmod($file, 0374); break;
            case "0375": $success = chmod($file, 0375); break;
            case "0376": $success = chmod($file, 0376); break;
            case "0377": $success = chmod($file, 0377); break;
            case "0400": $success = chmod($file, 0400); break;
            case "0401": $success = chmod($file, 0401); break;
            case "0402": $success = chmod($file, 0402); break;
            case "0403": $success = chmod($file, 0403); break;
            case "0404": $success = chmod($file, 0404); break;
            case "0405": $success = chmod($file, 0405); break;
            case "0406": $success = chmod($file, 0406); break;
            case "0407": $success = chmod($file, 0407); break;
            case "0410": $success = chmod($file, 0410); break;
            case "0411": $success = chmod($file, 0411); break;
            case "0412": $success = chmod($file, 0412); break;
            case "0413": $success = chmod($file, 0413); break;
            case "0414": $success = chmod($file, 0414); break;
            case "0415": $success = chmod($file, 0415); break;
            case "0416": $success = chmod($file, 0416); break;
            case "0417": $success = chmod($file, 0417); break;
            case "0420": $success = chmod($file, 0420); break;
            case "0421": $success = chmod($file, 0421); break;
            case "0422": $success = chmod($file, 0422); break;
            case "0423": $success = chmod($file, 0423); break;
            case "0424": $success = chmod($file, 0424); break;
            case "0425": $success = chmod($file, 0425); break;
            case "0426": $success = chmod($file, 0426); break;
            case "0427": $success = chmod($file, 0427); break;
            case "0430": $success = chmod($file, 0430); break;
            case "0431": $success = chmod($file, 0431); break;
            case "0432": $success = chmod($file, 0432); break;
            case "0433": $success = chmod($file, 0433); break;
            case "0434": $success = chmod($file, 0434); break;
            case "0435": $success = chmod($file, 0435); break;
            case "0436": $success = chmod($file, 0436); break;
            case "0437": $success = chmod($file, 0437); break;
            case "0440": $success = chmod($file, 0440); break;
            case "0441": $success = chmod($file, 0441); break;
            case "0442": $success = chmod($file, 0442); break;
            case "0443": $success = chmod($file, 0443); break;
            case "0444": $success = chmod($file, 0444); break;
            case "0445": $success = chmod($file, 0445); break;
            case "0446": $success = chmod($file, 0446); break;
            case "0447": $success = chmod($file, 0447); break;
            case "0450": $success = chmod($file, 0450); break;
            case "0451": $success = chmod($file, 0451); break;
            case "0452": $success = chmod($file, 0452); break;
            case "0453": $success = chmod($file, 0453); break;
            case "0454": $success = chmod($file, 0454); break;
            case "0455": $success = chmod($file, 0455); break;
            case "0456": $success = chmod($file, 0456); break;
            case "0457": $success = chmod($file, 0457); break;
            case "0460": $success = chmod($file, 0460); break;
            case "0461": $success = chmod($file, 0461); break;
            case "0462": $success = chmod($file, 0462); break;
            case "0463": $success = chmod($file, 0463); break;
            case "0464": $success = chmod($file, 0464); break;
            case "0465": $success = chmod($file, 0465); break;
            case "0466": $success = chmod($file, 0466); break;
            case "0467": $success = chmod($file, 0467); break;
            case "0470": $success = chmod($file, 0470); break;
            case "0471": $success = chmod($file, 0471); break;
            case "0472": $success = chmod($file, 0472); break;
            case "0473": $success = chmod($file, 0473); break;
            case "0474": $success = chmod($file, 0474); break;
            case "0475": $success = chmod($file, 0475); break;
            case "0476": $success = chmod($file, 0476); break;
            case "0477": $success = chmod($file, 0477); break;
            case "0500": $success = chmod($file, 0500); break;
            case "0501": $success = chmod($file, 0501); break;
            case "0502": $success = chmod($file, 0502); break;
            case "0503": $success = chmod($file, 0503); break;
            case "0504": $success = chmod($file, 0504); break;
            case "0505": $success = chmod($file, 0505); break;
            case "0506": $success = chmod($file, 0506); break;
            case "0507": $success = chmod($file, 0507); break;
            case "0510": $success = chmod($file, 0510); break;
            case "0511": $success = chmod($file, 0511); break;
            case "0512": $success = chmod($file, 0512); break;
            case "0513": $success = chmod($file, 0513); break;
            case "0514": $success = chmod($file, 0514); break;
            case "0515": $success = chmod($file, 0515); break;
            case "0516": $success = chmod($file, 0516); break;
            case "0517": $success = chmod($file, 0517); break;
            case "0520": $success = chmod($file, 0520); break;
            case "0521": $success = chmod($file, 0521); break;
            case "0522": $success = chmod($file, 0522); break;
            case "0523": $success = chmod($file, 0523); break;
            case "0524": $success = chmod($file, 0524); break;
            case "0525": $success = chmod($file, 0525); break;
            case "0526": $success = chmod($file, 0526); break;
            case "0527": $success = chmod($file, 0527); break;
            case "0530": $success = chmod($file, 0530); break;
            case "0531": $success = chmod($file, 0531); break;
            case "0532": $success = chmod($file, 0532); break;
            case "0533": $success = chmod($file, 0533); break;
            case "0534": $success = chmod($file, 0534); break;
            case "0535": $success = chmod($file, 0535); break;
            case "0536": $success = chmod($file, 0536); break;
            case "0537": $success = chmod($file, 0537); break;
            case "0540": $success = chmod($file, 0540); break;
            case "0541": $success = chmod($file, 0541); break;
            case "0542": $success = chmod($file, 0542); break;
            case "0543": $success = chmod($file, 0543); break;
            case "0544": $success = chmod($file, 0544); break;
            case "0545": $success = chmod($file, 0545); break;
            case "0546": $success = chmod($file, 0546); break;
            case "0547": $success = chmod($file, 0547); break;
            case "0550": $success = chmod($file, 0550); break;
            case "0551": $success = chmod($file, 0551); break;
            case "0552": $success = chmod($file, 0552); break;
            case "0553": $success = chmod($file, 0553); break;
            case "0554": $success = chmod($file, 0554); break;
            case "0555": $success = chmod($file, 0555); break;
            case "0556": $success = chmod($file, 0556); break;
            case "0557": $success = chmod($file, 0557); break;
            case "0560": $success = chmod($file, 0560); break;
            case "0561": $success = chmod($file, 0561); break;
            case "0562": $success = chmod($file, 0562); break;
            case "0563": $success = chmod($file, 0563); break;
            case "0564": $success = chmod($file, 0564); break;
            case "0565": $success = chmod($file, 0565); break;
            case "0566": $success = chmod($file, 0566); break;
            case "0567": $success = chmod($file, 0567); break;
            case "0570": $success = chmod($file, 0570); break;
            case "0571": $success = chmod($file, 0571); break;
            case "0572": $success = chmod($file, 0572); break;
            case "0573": $success = chmod($file, 0573); break;
            case "0574": $success = chmod($file, 0574); break;
            case "0575": $success = chmod($file, 0575); break;
            case "0576": $success = chmod($file, 0576); break;
            case "0577": $success = chmod($file, 0577); break;
            case "0600": $success = chmod($file, 0600); break;
            case "0601": $success = chmod($file, 0601); break;
            case "0602": $success = chmod($file, 0602); break;
            case "0603": $success = chmod($file, 0603); break;
            case "0604": $success = chmod($file, 0604); break;
            case "0605": $success = chmod($file, 0605); break;
            case "0606": $success = chmod($file, 0606); break;
            case "0607": $success = chmod($file, 0607); break;
            case "0610": $success = chmod($file, 0610); break;
            case "0611": $success = chmod($file, 0611); break;
            case "0612": $success = chmod($file, 0612); break;
            case "0613": $success = chmod($file, 0613); break;
            case "0614": $success = chmod($file, 0614); break;
            case "0615": $success = chmod($file, 0615); break;
            case "0616": $success = chmod($file, 0616); break;
            case "0617": $success = chmod($file, 0617); break;
            case "0620": $success = chmod($file, 0620); break;
            case "0621": $success = chmod($file, 0621); break;
            case "0622": $success = chmod($file, 0622); break;
            case "0623": $success = chmod($file, 0623); break;
            case "0624": $success = chmod($file, 0624); break;
            case "0625": $success = chmod($file, 0625); break;
            case "0626": $success = chmod($file, 0626); break;
            case "0627": $success = chmod($file, 0627); break;
            case "0630": $success = chmod($file, 0630); break;
            case "0631": $success = chmod($file, 0631); break;
            case "0632": $success = chmod($file, 0632); break;
            case "0633": $success = chmod($file, 0633); break;
            case "0634": $success = chmod($file, 0634); break;
            case "0635": $success = chmod($file, 0635); break;
            case "0636": $success = chmod($file, 0636); break;
            case "0637": $success = chmod($file, 0637); break;
            case "0640": $success = chmod($file, 0640); break;
            case "0641": $success = chmod($file, 0641); break;
            case "0642": $success = chmod($file, 0642); break;
            case "0643": $success = chmod($file, 0643); break;
            case "0644": $success = chmod($file, 0644); break;
            case "0645": $success = chmod($file, 0645); break;
            case "0646": $success = chmod($file, 0646); break;
            case "0647": $success = chmod($file, 0647); break;
            case "0650": $success = chmod($file, 0650); break;
            case "0651": $success = chmod($file, 0651); break;
            case "0652": $success = chmod($file, 0652); break;
            case "0653": $success = chmod($file, 0653); break;
            case "0654": $success = chmod($file, 0654); break;
            case "0655": $success = chmod($file, 0655); break;
            case "0656": $success = chmod($file, 0656); break;
            case "0657": $success = chmod($file, 0657); break;
            case "0660": $success = chmod($file, 0660); break;
            case "0661": $success = chmod($file, 0661); break;
            case "0662": $success = chmod($file, 0662); break;
            case "0663": $success = chmod($file, 0663); break;
            case "0664": $success = chmod($file, 0664); break;
            case "0665": $success = chmod($file, 0665); break;
            case "0666": $success = chmod($file, 0666); break;
            case "0667": $success = chmod($file, 0667); break;
            case "0670": $success = chmod($file, 0670); break;
            case "0671": $success = chmod($file, 0671); break;
            case "0672": $success = chmod($file, 0672); break;
            case "0673": $success = chmod($file, 0673); break;
            case "0674": $success = chmod($file, 0674); break;
            case "0675": $success = chmod($file, 0675); break;
            case "0676": $success = chmod($file, 0676); break;
            case "0677": $success = chmod($file, 0677); break;
            case "0700": $success = chmod($file, 0700); break;
            case "0701": $success = chmod($file, 0701); break;
            case "0702": $success = chmod($file, 0702); break;
            case "0703": $success = chmod($file, 0703); break;
            case "0704": $success = chmod($file, 0704); break;
            case "0705": $success = chmod($file, 0705); break;
            case "0706": $success = chmod($file, 0706); break;
            case "0707": $success = chmod($file, 0707); break;
            case "0710": $success = chmod($file, 0710); break;
            case "0711": $success = chmod($file, 0711); break;
            case "0712": $success = chmod($file, 0712); break;
            case "0713": $success = chmod($file, 0713); break;
            case "0714": $success = chmod($file, 0714); break;
            case "0715": $success = chmod($file, 0715); break;
            case "0716": $success = chmod($file, 0716); break;
            case "0717": $success = chmod($file, 0717); break;
            case "0720": $success = chmod($file, 0720); break;
            case "0721": $success = chmod($file, 0721); break;
            case "0722": $success = chmod($file, 0722); break;
            case "0723": $success = chmod($file, 0723); break;
            case "0724": $success = chmod($file, 0724); break;
            case "0725": $success = chmod($file, 0725); break;
            case "0726": $success = chmod($file, 0726); break;
            case "0727": $success = chmod($file, 0727); break;
            case "0730": $success = chmod($file, 0730); break;
            case "0731": $success = chmod($file, 0731); break;
            case "0732": $success = chmod($file, 0732); break;
            case "0733": $success = chmod($file, 0733); break;
            case "0734": $success = chmod($file, 0734); break;
            case "0735": $success = chmod($file, 0735); break;
            case "0736": $success = chmod($file, 0736); break;
            case "0737": $success = chmod($file, 0737); break;
            case "0740": $success = chmod($file, 0740); break;
            case "0741": $success = chmod($file, 0741); break;
            case "0742": $success = chmod($file, 0742); break;
            case "0743": $success = chmod($file, 0743); break;
            case "0744": $success = chmod($file, 0744); break;
            case "0745": $success = chmod($file, 0745); break;
            case "0746": $success = chmod($file, 0746); break;
            case "0747": $success = chmod($file, 0747); break;
            case "0750": $success = chmod($file, 0750); break;
            case "0751": $success = chmod($file, 0751); break;
            case "0752": $success = chmod($file, 0752); break;
            case "0753": $success = chmod($file, 0753); break;
            case "0754": $success = chmod($file, 0754); break;
            case "0755": $success = chmod($file, 0755); break;
            case "0756": $success = chmod($file, 0756); break;
            case "0757": $success = chmod($file, 0757); break;
            case "0760": $success = chmod($file, 0760); break;
            case "0761": $success = chmod($file, 0761); break;
            case "0762": $success = chmod($file, 0762); break;
            case "0763": $success = chmod($file, 0763); break;
            case "0764": $success = chmod($file, 0764); break;
            case "0765": $success = chmod($file, 0765); break;
            case "0766": $success = chmod($file, 0766); break;
            case "0767": $success = chmod($file, 0767); break;
            case "0770": $success = chmod($file, 0770); break;
            case "0771": $success = chmod($file, 0771); break;
            case "0772": $success = chmod($file, 0772); break;
            case "0773": $success = chmod($file, 0773); break;
            case "0774": $success = chmod($file, 0774); break;
            case "0775": $success = chmod($file, 0775); break;
            case "0776": $success = chmod($file, 0776); break;
            case "0777": $success = chmod($file, 0777); break;

            default:
               $mode    = "0644";
               $success = chmod($file, 0644);
            break;
         }

?>

  <tr<?php if ( $i % 2 == 1 ) { echo " bgcolor=\"#C0C0C0\""; } ?>>
    <td valign="top" width="0*" nowrap><?php $success ? print("chmod {$mode} success!") : print("<font class=\"alert\">chmod {$mode} failure!</font>"); ?></td>
    <td valign="top" width="100%" class="fixedwidth"><?php echo $file_list[$i]; ?></td>
  </tr>

<?php
      }

      echo "</table>\n\n";
      echo "<br>\n<br>\n";
   }
}
/////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////
switch ( $mode{1} ) {

   case "0":
      $owner_execute = 0;
      $owner_write   = 0;
      $owner_read    = 0;
   break;

   case "1":
      $owner_execute = 1;
      $owner_write   = 0;
      $owner_read    = 0;
   break;

   case "2":
      $owner_execute = 0;
      $owner_write   = 1;
      $owner_read    = 0;
   break;

   case "3":
      $owner_execute = 1;
      $owner_write   = 1;
      $owner_read    = 0;
   break;

   case "4":
      $owner_execute = 0;
      $owner_write   = 0;
      $owner_read    = 1;
   break;

   case "5":
      $owner_execute = 1;
      $owner_write   = 0;
      $owner_read    = 1;
   break;

   case "7":
      $owner_execute = 1;
      $owner_write   = 1;
      $owner_read    = 1;
   break;

   default:
      $owner_execute = 0;
      $owner_write   = 1;
      $owner_read    = 1;
   break;
}

/////////////////////////////////////////////////////////////////////////////



/////////////////////////////////////////////////////////////////////////////
switch ( $mode{2} ) {

   case "0":
      $group_execute = 0;
      $group_write   = 0;
      $group_read    = 0;
   break;

   case "1":
      $group_execute = 1;
      $group_write   = 0;
      $group_read    = 0;
   break;

   case "2":
      $group_execute = 0;
      $group_write   = 1;
      $group_read    = 0;
   break;

   case "3":
      $group_execute = 1;
      $group_write   = 1;
      $group_read    = 0;
   break;

   case "5":
      $group_execute = 1;
      $group_write   = 0;
      $group_read    = 1;
   break;

   case "6":
      $group_execute = 0;
      $group_write   = 1;
      $group_read    = 1;
   break;

   case "7":
      $group_execute = 1;
      $group_write   = 1;
      $group_read    = 1;
   break;

   default:
      $group_execute = 0;
      $group_write   = 0;
      $group_read    = 1;
   break;
}

/////////////////////////////////////////////////////////////////////////////



/////////////////////////////////////////////////////////////////////////////
switch ( $mode{3} ) {

   case "0":
      $everyone_execute = 0;
      $everyone_write   = 0;
      $everyone_read    = 0;
   break;

   case "1":
      $everyone_execute = 1;
      $everyone_write   = 0;
      $everyone_read    = 0;
   break;

   case "2":
      $everyone_execute = 0;
      $everyone_write   = 1;
      $everyone_read    = 0;
   break;

   case "3":
      $everyone_execute = 1;
      $everyone_write   = 1;
      $everyone_read    = 0;
   break;

   case "5":
      $everyone_execute = 1;
      $everyone_write   = 0;
      $everyone_read    = 1;
   break;

   case "6":
      $everyone_execute = 0;
      $everyone_write   = 1;
      $everyone_read    = 1;
   break;

   case "7":
      $everyone_execute = 1;
      $everyone_write   = 1;
      $everyone_read    = 1;
   break;

   default:
      $everyone_execute = 0;
      $everyone_write   = 0;
      $everyone_read    = 1;
   break;
}

/////////////////////////////////////////////////////////////////////////////

?>

        <form action="chmod.php" method="post" name="chmodform" target="_self">

        <table border="1" cellpadding="0" cellspacing="0" width="100%">
          <tr>
            <td width="50%" align="center">

              <table border="0" cellpadding="0" cellspacing="18" width="100%">
                <tr>
                  <td align="center">
                    <label for="dir"><h4>Directory:</h4></label>
                    <input type="text" name="dir" size="48" value="<?php echo $dir; ?>" id="dir"><br><br></td>
                </tr>
                <tr>

                  <td align="center"><h4>Permissions:</h4>
                    <table border="0" cellpadding="0" cellspacing="8" width="450">
                      <tr>
                        <td width="33%">

                          <fieldset><legend>Owner</legend>

                            <table border="0" cellpadding="8" cellspacing="0" width="100%">
                              <tr>
                                <td width="100%">
                                  <input type="checkbox" name="owner_read" onClick="javascript:update_mode_display()" value="1" id="owner_read"<?php if ( !empty($owner_read) ) { echo " checked"; } ?>>&nbsp;<label for="owner_read">Read</label><br><br>
                                  <input type="checkbox" name="owner_write" onClick="javascript:update_mode_display()" value="1" id="owner_write"<?php if ( !empty($owner_write) ) { echo " checked"; } ?>>&nbsp;<label for="owner_write">Write</label><br><br>
                                  <input type="checkbox" name="owner_execute" onClick="javascript:update_mode_display()" value="1" id="owner_execute"<?php if ( !empty($owner_execute) ) { echo " checked"; } ?>>&nbsp;<label for="owner_execute">Execute</label><br>
                                </td>
                              </tr>
                            </table>

                          </fieldset>

                        </td>
                        <td width="34%">

                          <fieldset><legend>Group</legend>

                            <table border="0" cellpadding="8" cellspacing="0" width="100%">
                              <tr>
                                <td width="100%">
                                  <input type="checkbox" name="group_read" onClick="javascript:update_mode_display()" value="1" id="group_read"<?php if ( !empty($group_read) ) { echo " checked"; } ?>>&nbsp;<label for="group_read">Read</label><br><br>
                                  <input type="checkbox" name="group_write" onClick="javascript:update_mode_display()" value="1" id="group_write"<?php if ( !empty($group_write) ) { echo " checked"; } ?>>&nbsp;<label for="group_write">Write</label><br><br>
                                  <input type="checkbox" name="group_execute" onClick="javascript:update_mode_display()" value="1" id="group_execute"<?php if ( !empty($group_execute) ) { echo " checked"; } ?>>&nbsp;<label for="group_execute">Execute</label><br>
                                </td>
                              </tr>
                            </table>

                          </fieldset>

                        </td>
                        <td width="33%">

                          <fieldset><legend>Other</legend>

                            <table border="0" cellpadding="8" cellspacing="0" width="100%">
                              <tr>
                                <td width="100%">
                                  <input type="checkbox" name="everyone_read" onClick="javascript:update_mode_display()" value="1" id="everyone_read"<?php if ( !empty($everyone_read) ) { echo " checked"; } ?>>&nbsp;<label for="everyone_read">Read</label><br><br>
                                  <input type="checkbox" name="everyone_write" onClick="javascript:update_mode_display()" value="1" id="everyone_write"<?php if ( !empty($everyone_write) ) { echo " checked"; } ?>>&nbsp;<label for="everyone_write">Write</label><br><br>
                                  <input type="checkbox" name="everyone_execute" onClick="javascript:update_mode_display()" value="1" id="everyone_execute"<?php if ( !empty($everyone_execute) ) { echo " checked"; } ?>>&nbsp;<label for="everyone_execute">Execute</label><br>
                                </td>
                              </tr>
                            </table>

                          </fieldset>

                        </td>
                      </tr>
                    </table>

                    <input type="text" size="4" maxlength="4" value="<?php echo $mode; ?>" class="grayed" name="mode_display" readonly><br><br>
                  </td>
                </tr>
                <tr>
                  <td colspan="2" width="100%" align="center">
                    <input type="submit" value="chmodNOW" accesskey="C">
                    <input type="hidden" name="action" value="chmodNOW">
                  </td>
                </tr>
              </table>

            </td>
          </tr>
        </table>

        </form>

      </td>
    </tr>
  </table>

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
    <td>dir</td>
    <td>&lt;name of a directory&gt;</td>
  </tr>
  <tr>
    <td>mode</td>
    <td>0444, 0600, 0644, 0666, 0750, 0755, 0766, 0777, etc...</td>
  </tr>
  <tr>
    <td>action</td>
    <td>"chmodNOW"</td>
  </tr>
</table>


<script language="JavaScript">
<!--

function update_mode_display() {

   chmodform.owner_execute.checked ? owner_execute = 1 : owner_execute = 0;
   chmodform.owner_write.checked   ? owner_write   = 1 : owner_write   = 0;
   chmodform.owner_read.checked    ? owner_read    = 1 : owner_read    = 0;

   chmodform.group_execute.checked ? group_execute = 1 : group_execute = 0;
   chmodform.group_write.checked   ? group_write   = 1 : group_write   = 0;
   chmodform.group_read.checked    ? group_read    = 1 : group_read    = 0;

   chmodform.everyone_execute.checked ? everyone_execute = 1 : everyone_execute = 0;
   chmodform.everyone_write.checked   ? everyone_write   = 1 : everyone_write   = 0;
   chmodform.everyone_read.checked    ? everyone_read    = 1 : everyone_read    = 0;

   o_per = owner_execute    + ( 2 * owner_write )    + ( 4 * owner_read );
   g_per = group_execute    + ( 2 * group_write )    + ( 4 * group_read );
   e_per = everyone_execute + ( 2 * everyone_write ) + ( 4 * everyone_read );

   mode = "0" + o_per + g_per + e_per;

   chmodform.mode_display.value = mode;
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
function is_valid_mode($mode) {

   $digits[0] = substr($mode, 0, 1);
   $digits[1] = substr($mode, 1, 1);
   $digits[2] = substr($mode, 2, 1);
   $digits[3] = substr($mode, 3, 1);

   if ( $digits[0] != "0" )                                           { return false; }
   if ( !is_numeric($digits[1]) || $digits[1] < 0 || 7 < $digits[1] ) { return false; }
   if ( !is_numeric($digits[2]) || $digits[2] < 0 || 7 < $digits[2] ) { return false; }
   if ( !is_numeric($digits[3]) || $digits[3] < 0 || 7 < $digits[3] ) { return false; }

   return true;
}
/////////////////////////////////////////////////////////////////////////////



/////////////////////////////////////////////////////////////////////////////
function compile_mode($owner_execute, $owner_write, $owner_read, $group_execute, $group_write, $group_read, $everyone_execute, $everyone_write, $everyone_read) {

   $o_per = $owner_execute    + ( 2 * $owner_write )    + ( 4 * $owner_read );
   $g_per = $group_execute    + ( 2 * $group_write )    + ( 4 * $group_read );
   $e_per = $everyone_execute + ( 2 * $everyone_write ) + ( 4 * $everyone_read );

   return "0{$o_per}{$g_per}{$e_per}";
}
/////////////////////////////////////////////////////////////////////////////




?>
