<?php

function _filter_fw_ext_sidebars_ext_backups_db_restore_option_names_replace($option_names, $params) {
	if (isset($params['stylesheet'])) {
		/** @see FW_Extension_Sidebars::get_fw_option_sidebars_settings_key() */
		$option_names[$params['stylesheet'] . '-fw-sidebars-options'] = get_stylesheet() . '-fw-sidebars-options';
	}

	return $option_names;
}
add_filter(
	'fw_ext_backups_db_restore_option_names_replace',
	'_filter_fw_ext_sidebars_ext_backups_db_restore_option_names_replace',
	10, 2
);