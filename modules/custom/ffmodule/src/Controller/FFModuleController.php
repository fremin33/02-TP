<?php

namespace Drupal\ffmodule\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\ffmodule\Service\FFModuleService;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class DefaultController.
 */
class FFModuleController extends ControllerBase
{
    /**
     * @var FFModuleService
     */
    private $ffService;

    /**
     * @param ContainerInterface $container
     * @return ControllerBase|FFModuleController
     */
    public static function create(ContainerInterface $container)
    {
        $ffService = $container->get('ffmodule.service');
        return new static($ffService);
    }

    /**
     * FFModuleController constructor.
     * @param $ffService
     */
    public function __construct($ffService)
    {
        $this->ffService = $ffService;
    }

    /**
     * @return array
     * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
     * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
     */
    public function getAllNodes()
    {
        return [
            '#theme' => 'ffmodule',
            '#title' => 'All Nodes Contents',
            '#allNodes' => $this->ffService->getAllNodes(),
        ];
    }


    /**
     * @param $field
     * @return array
     * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
     * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
     */
    public function getAllNodesByField($field)
    {
        $title = 'All ' . ucfirst($field) . ' of Nodes Content';
        return [
            '#theme' => 'ffmodule',
            '#title' => $title,
            '#allNodes' => $this->ffService->getAllNodesByFields($field),
        ];
    }


    /**
     * @param $contentType
     * @return array
     * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
     * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
     */
    public function getAllNodesByContentType($contentType)
    {
        $title = 'All Nodes ' . ucfirst($contentType) . 's';
        return [
            '#theme' => 'ffmodule',
            '#title' => $title,
            '#allNodes' => $this->ffService->getAllNodesByContentType($contentType),
        ];
    }

    /**
     * @param null $contentType
     * @param null $field
     * @return array
     * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
     * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
     */
    public function getAllNodesByContentTypeAndField($contentType = null, $field = null)
    {
        $title = 'All ' . ucfirst($field) . ' of Nodes ' . ucfirst($contentType) . 's';
        return [
            '#theme' => 'ffmodule',
            '#title' => $title,
            '#allNodes' => $this->ffService->getAllNodesByContentTypeAndField($contentType, $field),
        ];
    }


}
