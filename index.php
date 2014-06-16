<!DOCTYPE html>
<!-- This site validates as HTML 5 at http://validator.w3.org/ -->
<!-- This site validates as CSS 3 at http://jigsaw.w3.org/css-validator -->
<?php  // This must be the FIRST line in a PHP webpage file
ob_start();    // Enable output buffering
//
// Specify no-caching header controls for page
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control:no-store,no-cache,must-revalidate"); //HTTP/1.1
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
?>

<html lang='en'>
<head>
  <meta charset=utf-8>
  <title>Quote Me On That</title>
  <link type="text/css" rel="stylesheet" href="mystyle.css">
</head>

<?php
$strhidmsg = NULL;
$stock = NULL;
require "dbutil.inc";  
$objDBUtil = new dbutil;
$searchhid = @$_REQUEST['hidmsgsearch'];
$searchstock = @$_REQUEST['searchsymbol']; 
$strhidmsg = @$_REQUEST["hidmsg"];
$strhidmsghist = @$_REQUEST["hidmsghist"];
$stock = @$_REQUEST["searchquote"];
$stockhist = @$_REQUEST["searchhistory"];
session_start();
$_SESSION['stockrequest'] = @$stock;
?>


<body>
 <?php include 'header.php';?>
  <div class="floater">
      <?php include 'persistentquote.php';?>
    <div class="tabs">
        <?php include 'tab1.php';?>
        <?php include 'tab2.php';?>
        <?php include 'tab3.php';?>
        <?php include 'tab4.php';?>
    </div>
  </div>
</body>
</html>
<?php
@$result->free(); 
$db = $objDBUtil->Close();
ob_end_flush();
?>