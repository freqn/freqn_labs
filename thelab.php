<!DOCTYPE html>
<html lang="en">      
<head>
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="css/calcstyle.css"/> 
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
	<link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <title>Freqn Labs</title> 
</head>

    <body> 
        
    <!--Calculator UI--> 
    <div id ="wrapper">

        <header>eBay Profit Calculator</header>      
        <form action="thelab.php" method="POST"> 
        <table> 
            <tr>
                <td class="label">Quantity:</td>
                <td class="UI_field"><input class ="field" name="num1" type="text" autocomplete="off" title="How many will you sell?" autofocus/></td>
            </tr> 
            <tr>
                <td class="label">Cost (Ea):</td>
                <td class="UI_field"><input class ="field" name="num2" type="text" autocomplete="off" title="Your investment per item"/></td></tr> 
            <tr>
                <td class="label">Sale (Ea):</td>
                <td class="UI_field"><input class ="field" name="num3" type="text" autocomplete="off" title="How much will it sell for?"/></td></tr> 
            <tr>
                <td class="label" id="shp">Shipping:</td>
                <td class="UI_field"><input class ="field" name="num4" type="text" autocomplete="off" title="Expected total shipping (optional)"/></td></tr> 
        </table> 
        <input id="button" type="submit" value ="Calculate it"> 
        </form> 
                          
      
      
        <!--Calculates the values entered into the form--> 
      
        <?php  
  
        error_reporting(E_ALL ^ E_NOTICE); 
  
            $itemQty = $_POST['num1']; 
            $itemCost = $_POST['num2']; 
            $shipMat = $_POST['num4']; 
            $itemSale = $_POST['num3']; 
          
            $diffPrice = $itemSale - $itemCost; 
          
            // Sets Fees to zero in table and avoids a negative number upon first load 
            // .129 and .30 account for eBay/PayPal seller fees 
            if ($itemSale > 0){ 
            $totFee = ($diffPrice * .129 * $itemQty) + .30 + $shipMat; 
            } else { 
            $totFee = 0; 
            } 
          
            $net = ($diffPrice * $itemQty) - $totFee; 
          
            // Assigns the variable if a number > 0 is entered in both fields 
            // implemented to avoid the 'Division by zero' error 
            if($_POST['num1'] > 0 && $_POST['num2'] > 0){ 
            $diffPricePercent = (($net * 100) / $itemCost) / $itemQty ; 
            } 
      
        ?> 
        <!--Results table--> 
          
        <table> 
            <tr>   
                <td class="result_label">Total Investment</td>
                <td class="rfield"><?php echo $itemCost * $itemQty; ?></td> 
            </tr>
            <tr> 
                <td class="result_label">Gross Profit</td>
                <td class="rfield"><?php echo $diffPrice * $itemQty; ?></td>
            </tr>
            <tr>           
                <td class="result_label">Net Profit</td>
                <td class="rfield" id="profit"><?php echo number_format($net,2)?></td> 
            </tr><tr> 
                <td class="result_label">Percentage</td> 
                <td class="rfield"><?php echo number_format($diffPricePercent,0) ?>%</td>
            </tr>
        </table> 
        
        
        
        
         <!--Visual indicator displaying last bill passed based on Net-->
         
        
        <div id ="bill_display">
        <?php
        
        function say(){
        	   ?> <p class="bill_desc">Your highest bill:</p> <?php ;
            }
        
		  if($net<=0){
		  ?>
		  <p class="bill_desc">Calculate and watch this:</p>
		  <img src="http://freqn.aws.af.cm/images/dollarsign.png" alt="Dollar Sign" width="67" height="77">	
		  <?php
		  } elseif ($net>0 && $net<1){
          say();        
            ?>
            <img class="bill_display" src="http://freqn.aws.af.cm/images/0dollar.png" alt="Zero Dollar Bill">
		  <?php
		  } elseif ($net>=1 && $net<2){
          say();
            ?>
            <img class="bill_display" src="http://freqn.aws.af.cm/images/dollar.png" alt="One Dollar Bill">
            <?php
		  } elseif ($net>=2 && $net<5) {
		  say();
		  ?>
            <img class="bill_display" src="http://freqn.aws.af.cm/images/2dollar.png" alt="Two Dollar Bill">
		  <?php
		  } elseif ($net>=5 && $net<10) {
		  say();
		  ?>
		  <img class="bill_display" src="http://freqn.aws.af.cm/images/5dollar.png" alt="Five Dollar Bill">
		  <?php
		  } elseif ($net>=10 && $net<20) {
		  say();
		  ?>
		  <img class="bill_display" src="http://freqn.aws.af.cm/images/10dollar.png" alt="Ten Dollar Bill">
		  <?php
		  } elseif ($net>=20 && $net<50) {
		  say();
		  ?>
		  <img class="bill_display" src="http://freqn.aws.af.cm/images/20dollar.png" alt="Twenty Dollar Bill">
		  <?php
		  } elseif ($net>=50 && $net<100) {
		  say();
		  ?>
		  <img class="bill_display" src="http://freqn.aws.af.cm/images/50dollar.png" alt="Fifty Dollar Bill">
		  <?php
		  } elseif ($net>=100 && $net <500) {
		  say();
		  ?>
		  <img class="bill_display" src="http://freqn.aws.af.cm/images/100dollar.png" alt="One Hundred Dollar Bill">
		  <?php
		  } elseif ($net>=500 && $net<1000) {
		  say();
		  ?>
		  <img class="bill_display" src="http://freqn.aws.af.cm/images/5hdollar.png" alt="Five Hundred Dollar Bill">
		  <?php
		  } elseif ($net>=1000 && $net<5000) {
		  say();
		  ?>
		  <img class="bill_display" src="http://freqn.aws.af.cm/images/1tdollar.png" alt="One Thousand Dollar Bill">
		  <?php
		  } elseif ($net>=5000 && $net < 10000) {
		  say();
		  ?>
		  <img class="bill_display" src="http://freqn.aws.af.cm/images/5tdollar.png" alt="Five Thousand Dollar Bill">
		  <?php
		  } elseif ($net>=10000 && $net <100000) {
		  say();
		  ?>
		  <img class="bill_display" src="http://freqn.aws.af.cm/images/10tdollar.png" alt="10 Thousand Dollar Bill">
		  <?php
		  } elseif ($net>=100000) {
		  say();
		  ?>
		  <img class="bill_display" src="http://freqn.aws.af.cm/images/100tdollar.png" alt="100 Thousand Dollar Bill">
		  <?php
		}
		?>
	  </div>
	</div> 

        <p id="desc">Calculations are based on free insertion, basic eBay seller & PayPal transaction fees.</p>   
        <nav>
            <ul>
                <li><a href="http://freqn.com/" title="freqn.com"><i class="icon-home"></i></a></li>
                <li><a href="flipper.html" title="js text inverter"><i class="icon-coffee"></i></a></li>
                <li><a href="http://github.com/freqn" title="github"><i class="icon-github-alt"></i></a></li> 
                <li><a href="http://twitter.com/radial77" title="twitter"><i class="icon-twitter"></i></a></li>              
                <li><a href="mailto:freqnlabs@gmail.com" title="contact"><i class="icon-envelope-alt"></i></a></li>
            </ul>
        </nav>

		<footer>		
		<p id="disclaimer">&#169; <?php echo date("Y",time());?> Freqn Labs. All Rights Reserved</p>
        <!--<p id="date"><span id="date"><?php echo "Today is " . date("l, F jS");?></span></p>-->
	   </footer>

       <!-- JavaScript -->

       <script src="http://code.jquery.com/jquery-latest.min.js "></script>
        <script>
            $(document).ready(function() {
            $('.bill_display').fadeIn(2000);
            })
        </script>
	</body>
	</html>