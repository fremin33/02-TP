<?php

namespace Drupal\eshop;


class EshopStorage{

  public function getNids($contentType){
    return \Drupal::entityQuery('node')
                    ->condition('type', $contentType)
                    ->execute();
  }

  public function getNodes($contentType){
    return \Drupal::entityTypeManager()
    ->getStorage('node')
    ->loadMultiple($this->getNids($contentType));
  }



}
