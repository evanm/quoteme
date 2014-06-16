<div class="tab">
	<input type="radio" id="tab-3" name="tab-group-1" <?php if (isset($_GET["searchhistory"])) echo "checked=\"checked\""; ?>> <label for="tab-3">Get History</label>
        <div class="content">
        <?php
        
        if(empty($strhidmsghist))
        {
        ?>
          Look up history by symbol: <form action="index.php" method="get">
          <input id="searchhistory" name="searchhistory" type="search" style="text-transform:uppercase;" maxlength="4" placeholder="FIZZ" size="7" value="<?php if ((isset($_GET["searchquick"]) && $_GET["searchquick"] != "") || (isset($_GET["searchquote"]))) echo "$stock"; ?>">
          <input type="submit" value="Submit">
          <input type="hidden" value="message" name="hidmsghist">
          </form>
          <br>
          
          <?php
          }
          else 
          {
          
          	?>
          	Look up history by symbol: <form action="index.php" method="get">
          	<input id="searchhistory" name="searchhistory" type="search" style="text-transform:uppercase;" maxlength="4" placeholder="FIZZ" size="7" value="<?php if ((isset($_GET["searchquick"]) && $_GET["searchquick"] != "") || (isset($_GET["searchquote"]))) echo "$stock"; ?>">
          	<input type="submit" value="Submit">
          	<input type="hidden" value="message" name="hidmsghist">
          	</form>
          	<br>
          	<?php
          	
          	$db = $objDBUtil->Open(); 
           // Run a Query to get company name 
           	$query = "SELECT symSymbol, symName FROM symbols " .  
                       "WHERE symSymbol=" . $objDBUtil->DBQuotes($stockhist) ; 
          	$result = @$db->query($query); 
          	$row = @$result->fetch_assoc();
          	if($row==NULL)
          	{
          		$newpage = "index.php?searchsymbol=" . $_GET["searchhistory"] . "&hidmsgsearch=message";
          		header("Location: " . $newpage);
          		@$result->free(); 
          		$db = $objDBUtil->Close();
          		ob_end_flush();
          		exit();
          	}
          	else
          	{
          	extract($row);
              print("<b>Company Name:</b> {$symName}<br>\n");	
              $querysymbol = $objDBUtil->DBQuotes($stockhist); 
          	$query = "select symSymbol, symName, symExchange, symMarketCap, q52WeekLow, q52WeekHigh, qTodaysLow, qTodaysHigh, qShareVolumeQty, qPreviousClosePrice, qCurrentPERatio, qEarningsPerShare, qCashDividendAmount, qCurrentYieldPct, qTotalOutstandingSharesQty, qAskPrice, qBidPrice, qNetChangePct, qNetChangePrice, qPreviousClosePrice, qSymbol, qQuoteDateTime, qLastSalePrice from symbols left outer join quotes on symSymbol=qSymbol where symSymbol={$querysymbol} order by qQuoteDateTime desc limit 500 ";
          
          	$result = @$db->query($query);	
          	$row = @$result->fetch_assoc();
          	extract($row);
          ?>
          	<br>	
          	<table style="margin-left: auto; margin-right: auto; width: 380px; font-size:11px; border:1px; margin-bottom:3px">
          			<tr>
          				<td style="text-align:left">Symbol: <b><?php print($symSymbol); ?></b></td>
          				<td style="text-align:right"><?php print($symExchange);?></td>			
          			</tr>
          	</table>
          	<div STYLE="width:380px;height:200px;overflow:auto">
          	<table style="width: 380px; font-size:11px; border:1px; margin-bottom:3px">
          			<tr style="background-color:#DBE4FF">
          				
          				<td style="text-align:"><b>Date</b></td>
          				<td style="text-align:"><b>Last</b></td>
          				<td style="text-align:" ><b>Change</b></td>
          				<td style="text-align:"><b>%Chg</b></td>
          				<td style="text-align:"><b>Volume</b></td>	
          			</tr>	
          		<?php 
          		while(@$row = $result->fetch_assoc())
          		{
          			extract($row);
          			if($qQuoteDateTime == NULL) $qQuoteDateTime = "No Quote Data"; 
          	   		if($qLastSalePrice == NULL) $qLastSalePrice = "-.--"; 
          		?>	
          				<tr>
          					<td><?php print($qQuoteDateTime); ?></td>
          					<td><?php print($qLastSalePrice); ?></td>
          					<td><?php print(number_format($qNetChangePrice, 2, '.', '')); ?></td>
          					<td><?php print($qNetChangePct); ?>%</td>
          					<td><?php print(number_format($qShareVolumeQty)); ?></td>
          				</tr>		
          		<?php
          		}
          	?>
          	</table>
          	</div>
          <?php
          	}
          }
          ?>
        </div>
</div>