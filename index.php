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

/**
 * Model
 */
$bible = new DouayRheims();

/**
 * Controller
 */
// read all the passages and look the up compiling an output array
$page = isset($_GET['q']) ? $_GET['q'] : '';
$source = "./pages/$page.txt";
if (!file_exists($source)
      || !($passages = file($source))) {
  $page_title = 'Index of Verse Collections';
  $view = new ThemeIndex(new Navigation());
}
else {
  $page_title = trim(array_shift($passages));
  $build = array();
  foreach ($passages as $passage) {
    $verse = new Verse($passage);
    $build[] = $bible->lookup($verse);
  }
  $output = '';
  foreach ($build as $verse) {
    $theme = new ThemeVerse($verse);
    if ($html = $theme->html()) {
      $output .= '<div class="verse">';
      $output .= '<p>' . $html . "</p>\n";
      $output .= '<hr />' . "\n";
      $output .= '</div>';
    }
  }
  $view = new Theme($output);
}

/**
 * View
 */
// Expecting to have $build set
require_once './includes/view.phtml';
