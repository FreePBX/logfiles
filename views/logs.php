<?php
$logs = array('1'  => '/var/log/asterisk/full');
?>
<div class="container-fluid">
	<h1><?php echo _('Asterisk Log Files')?></h1>
	<div class = "display full-border">
		<div class="row">
			<div class="col-sm-9">
				<div id="log_view" class="pre"><?php echo _("Loading...")?></div>
			</div>
			<div class="col-sm-3 ">
				<div class="fpbx-container">
					<div class="display full-border">
						<!--Log File-->
						<div class="element-container">
							<div class="row">
								<div class="col-md-12">
									<div class="row">
										<div class="form-group">
											<div class="col-md-3">
												<label class="control-label" for="logfile"><?php echo _("Log File") ?></label>
												<i class="fa fa-question-circle fpbx-help-icon" data-for="logfile"></i>
											</div>
											<div class="col-md-9">
												<select class="form-control" id="logfile" name="logfile">
													<?php
													foreach ($files as $k => $v) {
														$selected = ($k == $full)?'selected':'';
														echo '<option value='.$k.' '.$selected.'>'.$v.'</option>';
													}
													?>
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<span id="logfile-help" class="help-block fpbx-help-block"><?php echo _("Choose a log file")?></span>
								</div>
							</div>
						</div>
						<!--END Log File-->
						<!--lines-->
						<div class="element-container">
							<div class="row">
								<div class="col-md-12">
									<div class="row">
										<div class="form-group">
											<div class="col-md-3">
												<label class="control-label" for="lines"><?php echo _("Lines") ?></label>
												<i class="fa fa-question-circle fpbx-help-icon" data-for="lines"></i>
											</div>
											<div class="col-md-9">
												<input type="text" class="form-control" id="lines" name="lines" value="500">
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<span id="lines-help" class="help-block fpbx-help-block"><?php echo _("How many lines to display.")?></span>
								</div>
							</div>
						</div>
						<!--END lines-->
						<div class="element-container">
							<div class="row">
								<div class="col-md-12">
									<div class="row">
										<div class="form-group">
											<div class="col-md-12">
												<button id="show" name="show"><?php echo _("Show")?></button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="modules/logfiles/assets/js/views/logs.js"></script>
