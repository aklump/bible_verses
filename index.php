<?php
/**
 * @file
 * Builds a list of bible passages based on verse numbers using a public API
 *
 * @ingroup bible_verses Bible Verses
 * @{
 */

require_once './includes/bible.phpm';
require_once './includes/theme.phpm';
require_once './config.php';

/**
 * Model
 */
$bible = new $classes['bible']();

/**
 * Controller
 */
// read all the passages and look the up compiling an output array
$page = isset($_GET['q']) ? $_GET['q'] : '';
$source = "./pages/$page.txt";
$output = '';
$page_title = '';
if (!file_exists($source)
      || !($passages = file($source))) {
  $page_title = 'Index of Verse Collections';
  $view = new $themes['index'](new $classes['navigation']());
}
else {
  //$page_title = trim(array_shift($passages));
  $build = array();
  foreach ($passages as $passage) {
    // Headers (markup style beginning with '#')
    if (preg_match('/^(#+)(.*)/', $passage, $markup)) {
      if (empty($page_title) && $markup[1] == '#') {
        $page_title = $markup[2];
      }
      else {
        $tag = 'h' . strlen($markup[1]);
        $output .= '<' . $tag . '>' . $markup[2] . '</' . $tag . '>' . "\n";
      }
    }

    // Bible verses (all others)
    else {
      $verse = new $classes['verse']($passage);
      $verse = $bible->lookup($verse);
      $verse = new $themes['verse']($verse);
      $output .= $verse->html();
    }
  }
  $view = new Theme($output);
}

/**
 * View
 */
// Expecting to have $build set
require_once './includes/view.phtml';
