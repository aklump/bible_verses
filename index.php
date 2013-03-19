<?php
/**
 * @file
 * Builds a list of bible passages based on verse numbers using a public API
 *
 * @ingroup bible_quotes Bible Quotes
 * @{
 */

require_once './includes/bible.phpm';

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
  die("Page $page not found");
}

$page_title = trim(array_shift($passages));
$build = array();
foreach ($passages as $passage) {
  $verse = new Verse($passage);
  $build[] = $bible->lookup($verse);
}

/**
 * View
 */
// Expecting to have $build set
require_once './includes/view.phtml';
