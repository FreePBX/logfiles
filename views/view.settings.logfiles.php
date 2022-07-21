<?php
    $table_col = [
        'name' => [
            'title' => _('File Name'),
            'help'  => _('Name of file, relative to Asterisk logpath. Use absolute path for a different location'),
            'class' => 'col-2-fix',
            'data-formatter' => 'logfiles_cell_id',
            'data-sortable' => true
        ],
        'disabled' => [
            'title' => _('Status'),
            'help'  => _('If the file status is disabled it will be skipped during the asterisk configuration files creation process.'),
            'class' => 'text-center',
            'data-formatter' => 'logfiles_cell_dropdown',
            'data-sortable' => true
        ],
        'debug' => [
            'title' => _('Debug'),
            'help'  => _('Messages used for debuging. '
                        . 'Do not report these as error\'s unless you have a specific issue that you are attempting to debug. '
                        . 'Also note that Debug messages are also very verbose and can and do fill up logfiles (and disk storage) quickly.'),
            'class' => 'text-center',
            'data-formatter' => 'logfiles_cell_dropdown',
            'data-sortable' => true
        ],
        'dtmf' => [
            'title' => _('DTMF'),
            'help'  => _('Keypresses as understood by asterisk. Usefull for debuging IVR and VM issues.'),
            'class' => 'text-center',
            'data-formatter' => 'logfiles_cell_dropdown',
            'data-sortable' => true
        ],
        'error' => [
            'title' => _('Error'),
            'help'  => _('Critical errors and issues'),
            'class' => 'text-center',
            'data-formatter' => 'logfiles_cell_dropdown',
            'data-sortable' => true
        ],
        'fax' => [
            'title' => _('Fax'),
            'help'  => _('Transmition and receiving of faxes'),
            'class' => 'text-center',
            'data-formatter' => 'logfiles_cell_dropdown',
            'data-sortable' => true
        ],
        'notice' => [
            'title' => _('Notice'),
            'help'  => _('Messages of specific actions, such as a phone registration or call completion'),
            'class' => 'text-center',
            'data-formatter' => 'logfiles_cell_dropdown',
            'data-sortable' => true
        ],
        'verbose' => [
            'title' => _('Verbose'),
            'help'  => _('Step-by-step messages of every step of a call flow. '
                        . 'Always enable and review if calls dont flow as expected'),
            'class' => 'text-center',
            'data-formatter' => 'logfiles_cell_dropdown',
            'data-sortable' => true
        ],
        'warning' => [
            'title' => _('Warning'),
            'help'  => _('Possible issues with dialplan syntaxt or call flow, but not critical.'),
            'class' => 'text-center',
            'data-formatter' => 'logfiles_cell_dropdown',
            'data-sortable' => true
        ],

        'security' => [
            'title' => _('Security'),
            'help'  => "Security messages.",
            'class' => 'text-center',
            'data-formatter' => 'logfiles_cell_dropdown',
            'data-sortable' => true
        ],
        'acction' => [
            'title' => _('Actions'),
            'class' => 'col-2-fix text-center',
            'data-formatter' => 'logfiles_cell_acction',
            'data-field' => '',
            'data-sortable' => false
        ]
    ];
?>



<div class="alert alert-info" role="alert">
    <h4 class="alert-heading"><?php echo _("Activate remote log"); ?></h4>
    <p><?php echo _('To activate the remote log, you must enable the file "syslog.local0" and add the following line in syslog.'); ?></p>
    <p><b>local0.* action(type="omfwd" target="host|ip" port="514" protocol="tcp")</b></p>
</div>

<div id="toolbar-grid">
    <div class="btn-group">
        <button type="button" class="btn btn-default" id="logfiles_add_new_line">
            <i class="fa fa-plus">&nbsp;</i><?php echo _("New Log")?>
        </button>
    </div>
</div>
<table id="logfile_entries" class="table table-condensed table-striped"
	data-cache="false"
    data-toolbar="#toolbar-grid"
	data-show-columns="false"
	data-show-toggle="false"
	data-pagination="true"
	data-search="true"
	data-show-refresh="true"
	data-escape="true" 
	data-unique-id="name"
	data-toggle="table"
    data-url="ajax.php?module=logfiles&amp;command=logfiles_get_all">
	<thead>
		<tr >
            <?php
                foreach ($table_col as $key => $val)
                {
                    $for_code = sprintf(" data-field='%s' ", empty($val['data-field']) ? $key : $val['data-field'] );

                    $for_code .= ( empty($val['data-sortable'])  ? '' : ( ($val['data-sortable'] == true) ? ' data-sortable="true" ' : '') );
                    $for_code .= ( empty($val['class'])          ? '' : sprintf(' class="%s" ', $val['class']) );
                    $for_code .= ( empty($val['help'])           ? '' : sprintf(' data-title-tooltip="%s" ', $val['help']) );
                    $for_code .= ( empty($val['data-formatter']) ? '' : sprintf(' data-formatter="%s" ', $val['data-formatter']) );

                    echo sprintf('<th scope="col" %s>%s</th>', $for_code, $val['title']);
                }
            ?>
		</tr>
	</thead>
</table>