<?php
$logs = array('1'  => '/var/log/asterisk/full');
?>
<div class="container-fluid">
	<h1><?php echo _('Asterisk Log Files')?></h1>
	<div class = "display full-border">
		<div class="row">
			<div class="col-sm-9">
				<div class="fpbx-container">
					<div class="display full-border">
						<div id="log_view" class="pre"></div>
					</div>
				</div>
			</div>
			<div class="col-sm-3">
				<!--Log File-->
				<div class="element-container">
					<div class="row">
						<div class="col-md-12">
							<div class="row">
								<div class="form-group">
									<div class="col-md-3">
										<label class="control-label" for="logfile"><?php echo _("Log File") ?></label>
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
									</div>
									<div class="col-md-9">
										<input type="text" class="form-control" id="lines" name="lines" value="500">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--END lines-->
				<button id="show" name="show"><?php echo _("Show")?></button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="modules/logfiles/assets/js/views/logs.js"></script>';
