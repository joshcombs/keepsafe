<div class="navbar-inner">
	<!-- Responsive Navbar Part 1: Button for triggering responsive navbar (not covered in tutorial). Include responsive CSS to utilize. -->
	<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	</button>
	<a class="brand" href="/index.php">KeepSafe Security</a>
	<!-- Responsive Navbar Part 2: Place all navbar contents you want collapsed withing .navbar-collapse.collapse. -->
	<div class="nav-collapse collapse">
		<ul class="nav">
			<li class="<?php echo ($page_id == "index" ? "active" : "");?>"><a href="/index.php">Home</a></li>
			<li class="<?php echo ($page_id == "about" ? "active" : "");?>"><a href="/about.php">About</a></li>
			<li class="<?php echo ($page_id == "contact" ? "active" : "");?>"><a href="/contact.php">Contact</a></li>
			<li class="<?php echo ($page_id == "support" ? "active" : "");?>"><a href="/support.php">Support</a></li>
			<li><a href="#payment" role="button" data-toggle="modal">Make a Payment</a>
			<!-- Read about Bootstrap dropdowns at http://twitter.github.com/bootstrap/javascript.html#dropdowns -->
			<li class="dropdown">
				<a class="dropdown-toggle"
				data-toggle="dropdown"
				href="#">
				Services
				<b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="/monitoring.php">Monitoring</a></li>
					<li><a href="#">Video Surveillance</a></li>
					<li><a href="#">Burglar Alarms</a></li>
					<li><a href="#">Fire Alarms</a></li>
					<li class="divider"></li>
					<li class="nav-header">RESOURCES</li>
					<li><a href="/manuals.php">Manuals</a></li>
					<li><a href="#">Update Call List</a></li>
					<li><a href="#">Setup Service Call</a></li>
					<li><a href="#">Free Quote</a></li>
				</ul>
			</li>
		</ul>
			<ul class="nav pull-right">
				<?php
					if (logged_in($user_data['user_id']) === true) {
						echo "<li class=\"dropdown\">
						<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">
						Hi ".ucfirst($user_data['first_name'])."
						<b class=\"caret\"></b></a>
						<ul class=\"dropdown-menu\">
						<li class=\"nav-header\">User Settings</li>
						<li><a href=\"/my_account.php\"><i class=\"icon-user\"></i> My Account</a></li>
						<li><a href=\"/changepassword.php\"><i class=\"icon-gear\"></i> Change Password</a></li>
						<li><a href=\"/logout.php\"><i class=\"icon-lock\"></i> Logout</a></li></ul>";

						if (has_access($session_user_id, 1) === true) {
							echo '<li class=" '.($page_id == "adminhome" ? "active" : "").'"><a href="/admin.php"><i class="icon-home"></i> Admin</a></li>';
						} else if (has_access($session_user_id, 2) === true) {
							echo '<li class=" '.($page_id == "customer" ? "active" : "").'"><a href="admin.php">Moderator</a></li>';
						}

					} else {
						echo $login_links;
					}
					?>
			</ul>
	</div><!--/.nav-collapse -->
</div><!-- /.navbar-inner -->


<!-- Modal -->
<div id="payment" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<legend>Make A Payment</legend>
	</div>
	<div class="modal-body">

		<form id="paypalform" method="post" action="https://www.paypal.com/cgi-bin/webscr" class="form-horizontal">
			<input type="hidden" value="_xclick" name="cmd">
			<input type="hidden" value="mark@keepsafesecurity.net" name="business">
			<input type="hidden" value="" name="image_url">
			<input type="hidden" value="1" name="no_shipping">
			<input type="hidden" value="Invoice Payment" name="item_name">

			<div class="control-group">
				<label class="control-label" for="account">Account #:</label>
				<input type="hidden" value="account" name="on0">
				<div class="controls">
					<input type="text" id="account" size="15" name="os0" placeholder="1234" value="<?php echo $user_data['account'] ?>"<?php if (logged_in() === true) { echo 'disabled'; }?>><br>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="invoice">Invoice #:</label>
				<input type="hidden" value="invoice" name="on1">
				<div class="controls">
					<input type="text" id="invoice" size="15" name="os1" placeholder="123456"><br>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="amount">Amount: </label>
				<input type="hidden" value="amount" name="amount">
				<div class="controls">
					<input type="text" id="amount" size="15" maxlength="15" name="amount" placeholder="$30" name="amount"><br>
				</div>
			</div>
			<div class="controls">
				<button class="btn btn-primary input-medium" type="submit" id="submit_button">Process Payment</button>
				<button type="reset" class="btn input-medium">Cancel</button>
			</div>
		</form>
	</div>
</div>