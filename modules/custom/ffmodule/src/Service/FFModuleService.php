<?php

namespace Drupal\ffmodule\Service;

use Drupal\ffmodule\Repository\FFModuleRepository;

/**
 * Class FFModuleService
 * @package Drupal\ffmodule\Service
 */
class FFModuleService
{

    /**
     * @return array
     * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
     * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
     */
    public function getAllNodes()
    {
        $repository = new FFModuleRepository();
        return $this->nodesToView($repository->getAllNodes());
    }


    /**
     * @param $field
     * @return array
     * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
     * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
     */
    public function getAllNodesByFields($field)
    {
        $repository = new FFModuleRepository();
        return $this->nodesFieldToView($repository->getAllNodes(), $field);
    }

    /**
     * @param $contentType
     * @return array
     * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
     * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
     */
    public function getAllNodesByContentType($contentType)
    {
        $repository = new FFModuleRepository();
        return $this->nodesToView($repository->getNodesByContentType($contentType));
    }

    /**
     * @param $contentType
     * @param $field
     * @return array
     * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
     * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
     */
    public function getAllNodesByContentTypeAndField($contentType, $field)
    {
        $repository = new FFModuleRepository();
        return $this->nodesFieldToView($repository->getNodesByContentType($contentType), $field);
    }

    /**
     * @param $nodes
     * @param $field
     * @return array
     */
    public function nodesFieldToView($nodes, $field)
    {
        $fieldsFormat = array();
        foreach ($nodes as $node) {
            if ($node->hasField("field_$field")) {
                $fieldsFormat[] = render(\Drupal::entityTypeManager()
                    ->getViewBuilder('node')
                    ->viewField($node->get("field_$field")));
            }
        }
        return $fieldsFormat;
    }


    /**
     * @param $nodes
     * @return array
     */
    public function nodesToView($nodes)
    {
        $nodesFormat = array();
        foreach ($nodes as $node) {
            $nodeRenderable = \Drupal::entityTypeManager()
                ->getViewBuilder('node')
                ->view($node, 'teaser');
            $nodesFormat[] = render($nodeRenderable);
        }
        return $nodesFormat;
    }

}
