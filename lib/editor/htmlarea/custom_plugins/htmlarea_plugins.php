<?php
/**
 * Created by Nadav Kavalerchik.
 * Contact info: nadavkav@gmail.com
 * Date: 1/13/11 Time: 10:05 PM
 * Description: settings for HTMLAREA editor custom_plugins extension
 * (this file should be placed inside moodle/admin/settings folder)
 */

$dir = $CFG->dirroot."/lib/editor/htmlarea/custom_plugins/";

// Open a known directory, and proceed to read its contents
if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
          //echo "filename: $file : filetype: " . filetype($dir . $file) . "\n";
          if ($file == '.' or $file == '..' or $file == 'lang') continue;
          if (filetype($dir.$file) == 'dir') $plugins[$file] = $file;
        }
        closedir($dh);
    }
}
$langfolder = $CFG->dirroot.'/lib/editor/htmlarea/custom_plugins/lang/';

$temp = new admin_settingpage('htmlareasettings', get_string('htmlareasettings','customplugins','', $langfolder));

$temp->add(new admin_setting_configmultiselect('editor_customplugins', get_string('editor_customplugins', 'customplugins','',$langfolder),
  get_string('editor_customplugins_info', 'customplugins','',$langfolder ), array(), $plugins));

$temp->add(new admin_setting_configcheckbox('editor_showtableoperations', get_string('editor_showtableoperations', 'customplugins','',$langfolder),
                   get_string('editor_showtableoperations_info', 'customplugins','',$langfolder), 0));

$ADMIN->add('appearance', $temp);

?>
