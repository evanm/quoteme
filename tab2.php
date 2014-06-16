<div class="tab">
        <input type="radio" id="tab-2" name="tab-group-1" <?php if ((isset($_GET["searchquick"]) && $_GET["searchquick"] != "") || (isset($_GET["searchquote"]))) echo "checked=\"checked\""; ?>> <label for="tab-2">Get Quote</label>

        <div class="content">
        <?php
        if(empty($strhidmsg))
        {
        ?>
        <form action="index.php" method="get">
          Look up by symbol: <input id="searchquote" name="searchquote" style="text-transform:uppercase;" maxlength="4" type="search" placeholder="FIZZ" size="7" value="<?php if (isset($_GET["searchhistory"])) echo "$stockhist"; ?>">
          <input type="submit" value="Submit">
          <input type="hidden" value="message" name="hidmsg">
          </form>
          <br>
          <br>
          
          <?php
          }
          else 
          {
          	?>
            <form action="index.php" method="get">
              Look up by symbol: <input id="searchquote" name="searchquote" style="text-transform:uppercase;" maxlength="4" type="search" placeholder="FIZZ" size="7" value="<?php if (isset($_GET["searchhistory"])) echo "$stockhist"; ?>">
              <input type="submit" value="Submit">
              <input type="hidden" value="message" name="hidmsg">
              </form>
              <br>
              <?php
          
          	$db = $objDBUtil->Open(); 
           // Run a Query to get company name 
              $query = "SELECT symSymbol, symName FROM symbols " .  
                       "WHERE symSymbol=" . $objDBUtil->DBQuotes($stock) ; 
          	$result = $db->query($query); 
          	$row = @$result->fetch_assoc(); 
          	if($row==NULL)
          	{
          		$newpage = "index.php?searchsymbol=" . $_GET["searchquote"] . "&hidmsgsearch=message";
          		header("Location: " . $newpage);
          		@$result->free(); 
          		$db = $objDBUtil->Close();
          		ob_end_flush();
          		exit();	
          	}
          	else
          	{
          	extract($row);
          	print "<b>Company Name:</b> {$symName}<br>\n";	
              $querysymbol = $objDBUtil->DBQuotes($stock); 
          	$query = "select symSymbol, symName, symExchange, symMarketCap, q52WeekLow, q52WeekHigh, qTodaysLow, qTodaysHigh, qShareVolumeQty, qPreviousClosePrice, qCurrentPERatio, qEarningsPerShare, qCashDividendAmount, qCurrentYieldPct, qTotalOutstandingSharesQty, qAskPrice, qBidPrice, qNetChangePct, qNetChangePrice, qPreviousClosePrice, qSymbol, qQuoteDateTime, qLastSalePrice from symbols left outer join quotes on symSymbol=qSymbol where symSymbol={$querysymbol} order by qQuoteDateTime desc limit 10 ";
          
          	$result = @$db->query($query);	
          
          
          	$row = @$result->fetch_assoc();
          
          	extract($row);
          ?>
          	<table style="margin-left: auto; margin-right: auto; width: 380px; font-size:12px; border:1px;">
          	
          		<tr style="border-bottom:1px; background-color:#DBE4FF">
          			<td> <?php print "<b>Symbol:</b> " . $symSymbol ; ?> </td>
          			<td><b>Date:</b></td>
          			<td><b><?php print($qQuoteDateTime);?></b></td>
          			<td><b><?php print($symExchange);?></b></td>
          		</tr>
          		<tr>
          			<td>Last</td>
          			<td><?php if($qLastSalePrice == NULL)
          						{
          							print("n/a");
          						}
          						else
          						{
          						print($qLastSalePrice);
          						} ?>
          			</td>
          			<td>Prev Close</td>
          			<td><?php if($qPreviousClosePrice == NULL)
          						{
          							print("n/a");
          						}
          						else
          						{
          						print($qPreviousClosePrice);
          						} ?>
          			</td>
          		</tr>
          		<tr>
          			<td>Change</td>
          			<td><?php if($qNetChangePrice == NULL)
          						{
          							print("n/a");
          						}
          						else
          						{
          						print($qNetChangePrice);
          						} ?>
          			</td>
          			<td>Bid</td>
          			<td><?php if($qBidPrice == NULL)
          						{
          							print("n/a");
          						}
          						else
          						{
          						print($qBidPrice);
          						} ?>
          			</td>
          		</tr>
          		<tr>
          			<td>%Change</td>
          			<td><?php if($qNetChangePct == NULL)
          						{
          							print("n/a");
          						}
          						else
          						{
          						print($qNetChangePct);
          						} ?>
          			</td>
          			<td>Ask</td>
          			<td><?php if($qAskPrice == NULL)
          						{
          							print("n/a");
          						}
          						else
          						{
          						print($qAskPrice);
          						} ?>
          			</td>
          
          		</tr>
          		<tr>
          			<td>High</td>
          			<td><?php if($qTodaysHigh == NULL)
          						{
          							print("n/a");
          						}
          						else
          						{
          						print($qTodaysHigh);
          						} ?>
          			</td>
          			<td>52 Week High</td>
          			<td><?php if($q52WeekHigh == NULL)
          						{
          							print("n/a");
          						}
          						else
          						{
          						print($q52WeekHigh);
          						} ?>
          			</td>
          		</tr>
          		<tr>
          			<td>Low</td>
          			<td><?php if($qTodaysLow == NULL)
          						{
          							print("n/a");
          						}
          						else
          						{
          						print($qTodaysLow);
          						} ?>
          			</td>
          			<td>52 Week Low</td>
          			<td><?php if($q52WeekLow == NULL)
          						{
          							print("n/a");
          						}
          						else
          						{
          						print($q52WeekLow);
          						} ?>
          			</td>
          		</tr>
          		<tr>
          			<td>Daily Volume</td>
          			<td><?php if($qShareVolumeQty == NULL)
          						{
          							print("n/a");
          						}
          						else
          						{
          						print(number_format($qShareVolumeQty));
          						} ?>
          			</td>
          			<td>&nbsp;</td>
          			<td>&nbsp;</td>
          		</tr>
          		<tr style="background-color:#DBE4FF">
          			<td><b>Fundamentals</b></td>
          			<td>&nbsp;</td>
          			<td>&nbsp;</td>
          			<td>&nbsp;</td>
          		</tr>
          		<tr>
          			<td>PE Ratio</td>
          			<td><?php if($qCurrentPERatio== NULL)
          						{
          							print("n/a");
          						}
          						else
          						{
          						print($qShareVolumeQty);
          						} ?>
          			</td>
          			<td>Market Cap.</td>
          			<td><?php if($symMarketCap== NULL)
          						{
          							print("n/a");
          						}
          						else
          						{
          						print("$" . number_format($symMarketCap) . " Mil");
          						}?>
          			</td>
          		</tr>
          		<tr>
          			<td>Earnings/share</td>
          			<td><?php if($qEarningsPerShare== NULL)
          						{
          							print("n/a");
          						}
          						else
          						{
          						print($qEarningsPerShare) ;
          						}?>
          			</td>
          			<td># Shr Out.</td>
          			<td><?php if($qTotalOutstandingSharesQty == NULL)
          						{
          							print("n/a");
          						}
          						else
          						{
          						print(number_format($qTotalOutstandingSharesQty)); 
          						}?>
          			</td>
          		</tr>
          		<tr>
          			<td>Div/Share</td>
          			<td><?php if($qCashDividendAmount == NULL)
          						{
          							print("n/a");
          						}
          						else
          						{
          						print($qCashDividendAmount) ; 
          						}?>
          			</td>
          			<td>Div. Yield</td>
          			<td><?php if($qCurrentYieldPct == NULL)
          						{
          							print("n/a");
          						}
          						else
          						{
          						print($qCurrentYieldPct) . "%";
          						}?>
          			</td>
          		</tr>
          	</table>
          	<br>	
          	
          <?php
          }
          }
          ?>
        </div>
      </div>