<?php

namespace Drupal\eshop\Controller;


use Drupal\Core\Controller\ControllerBase;
use Drupal\eshop\EshopStorage;


/**
 * Class DefaultController.
 */
class DefaultController extends ControllerBase {

  /**
   * Hello.
   *
   * @return string
   *   Return Hello string.
   */
  public function hello($name) {



    $storage = new EshopStorage();


    // Methode 1 : On créer un objet contentant tous les nodes
    $allNodes = \Drupal::entityTypeManager()
                    ->getViewBuilder('node')
                    ->viewMultiple($storage->getNodes('article'), 'teaser');
    $allNodesString = render($allNodes);
    // dump($allNodesString);

    // Methode 2 : Meme chose, mais au lien d'en faire une string, on en fait un tableau
    $allNodesArray = array();
    foreach ($storage->getNodes('article') as $node) {
      $nodeRenderable = \Drupal::entityTypeManager()
                      ->getViewBuilder('node')
                      ->view($node, 'teaser');
      $allNodesArray[] = render($nodeRenderable);
    }
    // dump($allNodesArray);

    // Methode 3 : Cette fois, on spécifie les champs qu'on veut rendres
    $view_builder = \Drupal::entityTypeManager()->getViewBuilder('node');
    $fieldsArray = array();
    foreach ($storage->getNodes('article') as $node) {
      $build = $view_builder->viewField($node->get('field_tags'));
      $fieldsdArray[] = render($build);
    }
     dump($fieldsdArray);

    return [
      '#theme' => 'eshop',
      '#allnodesstring' => $allNodesString,
      '#allnodearray' => $allNodesArray,
      '#fieldsarray' => $fieldsArray
    ];
  }

}
