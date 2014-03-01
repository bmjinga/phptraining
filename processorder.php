<!DOCTYPE html>
<?php
// Create short variable names
$tireqty = $_POST['tireqty'];
$oilqty = $_POST['oilqty'];
$sparkqty = $_POST['sparkqty'];
$find = $_POST['find'];
$address = $_POST ['address'];
$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];
$date = date('H:i, jS F Y')
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Bob's Auto Parts - Order Results</title>
    </head>
    <body>
     <h1>Bob's Auto Parts</h1>
     <h2>Order Results</h2>
             <?php
             echo "<p>Order Processed at ".date('H:i, jS F Y')."</p>";
             echo '<p>Your order is as follows: </p>';
                                       
             
             $totalqty = 0;
             $totalqty = $tireqty + $oilqty + $sparkqty;
             echo "Items Ordered: ".$totalqty."<br />";
             
             If ($totalqty == 0) {
                 echo "You did not order anything on the previous page!<br />";
             } else {
                 if ($tireqty > 0) {
                     echo $tireqty." tires<br />";
                 } 
                     if ($oilqty > 0) {
                         echo $oilqty." bottles of oil<br />";
                     }       
                         if ($sparkqty > 0) {
                             echo $sparkqty." spark plugs<br />";
                         }
                  }
             $totalamount = 0.00;
             
             //Price
             define('TIREPRICE', 100);
             define('OILPRICE', 10);
             define('SPARKPRICE', 4);
             
             $totalamount = $tireqty * TIREPRICE
                          + $oilqty * OILPRICE
                          + $sparkqty * SPARKPRICE;
             
             If ($totalamount ==0) {
                 echo"";
             }
             
             else {
             echo "Subtotal: $".number_format ($totalamount,2)."<br />";
             
             $taxrate = 0.10; // loacal sales tax is 10%
             $totalamount = $totalamount * (1 + $taxrate);
             echo "Total including tax: $".number_format($totalamount,2)."<br />";
             }         
             //How customer found us
             if($find == "a") {
                 echo "<p>Regular customer.</p>";
             }  elseif($find == "b") {
                   echo "<p>Customer referred by TV adver.</p>";
             }  elseif($find == "c") {
                    echo "<p>Customer referred by phone directory.</p>";
             }   elseif($find == "d") {
                    echo "<p>Customer referred by word of mouth </p>";
             }  else {
                    echo "<p>We don not know how this customer found us.</p>";
             }

             If ($totalamount == 0) {
                 echo "";
             }  
             else {
             echo "Address to ship to is ".$address."<br />";
             }
                $outputstring = $date."\t".$tireqty." tires \t".$oilqty." oil \t".$sparkqty." spark plugs \t\$".$totalamount."\t". $address."\n";
                
                //open file for appending
             @  $fp = fopen("$DOCUMENT_ROOT/../orders/orders.txt", 'ab');
                
                flock($fp, LOCK_EX); //lock the file for writing
                
                if (!$fp) {
                    echo "<p><strong> Your order could not be processed at this time.
                        Please try again later.</strong></p></body></html>";
                    exit;
                    }
                    
                    fwrite($fp, $outputstring, strlen($outputstring));
                    flock($fp, LOCK_UN); //realease write lock
                    fclose($fp);
                    
                    echo "<p>Order written.</p>";
                
             ?>
             
    </body>
</html>
