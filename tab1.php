<div class="tab">
        <input type="radio" id="tab-1" name="tab-group-1" <?php if ((!isset($_GET["searchquick"]) || $_GET["searchquick"] == "") && (!isset($_GET["searchhistory"]) || $_GET["searchhistory"] == "") && (!isset($_GET["searchquote"]) || $_GET["searchquote"] == "") && (!isset($_GET["searchsymbol"]) || $_GET["searchsymbol"] == "")) echo "checked=\"checked\""; ?>/> <label for="tab-1">Home</label>
		
        <div class="content">
          This stock info site was created by Evan McNulty for Seattle Pacific University's Netcentric Computing class in the Spring of 2014. It is meant for educational and research purposes only.
        </div>
      </div>