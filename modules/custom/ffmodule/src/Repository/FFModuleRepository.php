<?php

namespace Drupal\ffmodule\Repository;


/**
 * Class DefaultRepository
 * @package Drupal\ffmodule\Repository
 */
class FFModuleRepository
{

    /**
     * @return array|int
     */
    public function getAllNids()
    {
        return \Drupal::entityQuery('node')
            ->execute();
    }


    /**
     * @param $contentType
     * @return array|int
     */
    public function getNids($contentType)
    {
        return \Drupal::entityQuery('node')
            ->condition('type', $contentType)
            ->execute();
    }

    /**
     * @param $nids
     * @return \Drupal\Core\Entity\EntityInterface[]
     * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
     * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
     */
    public function getNodes($nids)
    {
        return \Drupal::entityTypeManager()
            ->getStorage('node')
            ->loadMultiple($nids);
    }


    /**
     * @return \Drupal\Core\Entity\EntityInterface[]
     * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
     * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
     */
    public function getAllNodes()
    {
        return $this->getNodes($this->getAllNids());
    }


    /**
     * @param $contentType
     * @return \Drupal\Core\Entity\EntityInterface[]
     * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
     * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
     */
    public function getNodesByContentType($contentType)
    {
        return $this->getNodes($this->getNids($contentType));
    }
}
