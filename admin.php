<?php
if (!defined('SOCIALBUTT_PATH')) die('Hacking attempt!');

global $conf, $template, $page;

load_language('plugin.lang', SOCIALBUTT_PATH);


if (isset($_POST['submit']))
{
  $conf['SocialButtons'] = array(
    'position' => $_POST['position'],
    'twitter' => array(
      'enabled' => isset($_POST['twitter']['enabled']),
      'size' => $_POST['twitter']['size'],
      'count' => $_POST['twitter']['count'],
      'via' => trim($_POST['twitter']['via']),
      ),
    'google' => array(
      'enabled' => isset($_POST['google']['enabled']),
      'size' => $_POST['google']['size'],
      'annotation' => $_POST['google']['annotation'],
      ),
    'tumblr' => array(
      'enabled' => isset($_POST['tumblr']['enabled']),
      'type' => $_POST['tumblr']['type'],
      'img_size' => $_POST['tumblr']['img_size'],
      ),
    'facebook' => array(
      'enabled' => isset($_POST['facebook']['enabled']),
      'color' => $_POST['facebook']['color'],
      'layout' => $_POST['facebook']['layout'],
      ),
    'pinterest' => array(
      'enabled' => isset($_POST['pinterest']['enabled']),
      'layout' => $_POST['pinterest']['layout'],
      'img_size' => $_POST['pinterest']['img_size'],
      ),
    );
  
  conf_update_param('SocialButtons', serialize($conf['SocialButtons']));
  array_push($page['infos'], l10n('Information data registered in database'));
  
  // the prefilter changes, we must delete compiled templatess
  $template->delete_compiled_templates();
}


$template->assign($conf['SocialButtons']);
$template->assign(array(
  'SOCIALBUTT_PATH' => SOCIALBUTT_PATH,
  'img_sizes' => array_merge(ImageStdParams::get_all_types(), array('Original')),
  ));

$template->set_filename('socialbutt_content', realpath(SOCIALBUTT_PATH . 'template/admin.tpl'));
$template->assign_var_from_handle('ADMIN_CONTENT', 'socialbutt_content');

?>