<div class="tab">
        <input type="radio" id="tab-4" name="tab-group-1" <?php if (isset($_GET["searchsymbol"])) echo "checked=\"checked\""; ?>/> <label for="tab-4">Find Symbol</label>

        <div class="content">
          <?php
          if(empty($searchhid))
          {
          
          ?>
          	Find symbol by company name:
          	<form action="index.php" method="get" id="stocksearch">
          		<input id="searchsymbol" name="searchsymbol" type="search" placeholder="General Electric"> <input type="submit" value="Submit">
          		<input type="hidden" value="message" name="hidmsgsearch">
          	</form>
          <?php
          }
          else
          {
          ?>
          
          Find different symbol by company name:
          	<form action="index.php" method="get" id="stocksearch">
          		<input id="searchsymbol" name="searchsymbol" type="search" placeholder="General Electric"> <input type="submit" value="Submit"/>
          		<input type="hidden" value="message" name="hidmsgsearch"/>
          	</form>
          	<br/>
          	<?php
          	$db = $objDBUtil->Open();  	    
          	$query = "select symName, symSymbol from symbols where symName like \"%$searchstock%\" order by symName asc limit 500";
          	$result = @$db->query($query);	
          	$row = @$result->fetch_assoc();
          	if($row==NULL)
          	{
          	print("There are no results that are similar to '$searchstock'");
          	}
          	else
          	{
          	$query = "select symName, symSymbol from symbols where symName like \"%$searchstock%\" or symSymbol like \"%$searchstock%\" order by symName asc limit 500";
          	$result = @$db->query($query);
          ?>
          Companies similar to: "<?php print("$searchstock");?>"
          <br/>
          	<?php
          	print("Displaying " . $result->num_rows . " results");
          	?>   	
          <div STYLE="width:380px;height:200px;overflow:auto; margin:auto; padding-left:0px; padding-right:0px;">
          	<table style="width: 380px; font-size:11px; border:1px; margin-bottom:3px;">
          			<tr style="background-color:#DBE4FF" >
          				<td style="text-align:left; padding-left: 10px">Company</td>
          				<td style="text-align:left">Symbol</td>
          				<td></td>
          			</tr>
          <?php
          		while($row = @$result->fetch_assoc())
          			{
          				extract($row);
          ?>	
          				<tr>
          					<td style="text-align:left; padding-left: 0px"><?php print($symName); ?></td>
          					<td style="text-align:left"><?php print($symSymbol); ?></td>
          					<td style="text-align:left">
          					<a style="display:inline; text-decoration:underline; font-weight:normal" href="index.php?searchquote=<?php print($symSymbol);?>&amp;hidmsg=message">Quote</a> | 
          					<a style="display:inline; text-decoration:underline; font-weight:normal" href="index.php?searchhistory=<?php print($symSymbol); ?>&amp;hidmsghist=message">History</a>
          					</td>
          				</tr>	
          <?php
          			}
          	}
          		
          }
          ?>
          </table>
          </div>
        </div>
      </div>