<?php

require_once('matrix.php');
require_once('svd.php');

class lsa {

  /**
   * Perform latent semantic analysis to get the topic of the documents
   * @param matrix $matrix
   * @param int $features total feature that want to be extracted
   * 
   */
  public function transform($matrix, $features = null) {
    $m = count($matrix->get());
    $n = count($matrix->get()[0]);

    $svd = new svd($matrix);
    $min = min($features ?? $svd::$K, $m, $n);

    $matrix->truncate($svd::$Vt, $n, $min);
    $V = $matrix->transpose($svd::$Vt);

    // get word to topic
    return $matrix->multiply($matrix->get(), $V);
  }
}