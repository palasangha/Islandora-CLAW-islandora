<?php

namespace Drupal\islandora\EventGenerator;

use Drupal\Core\Entity\EntityInterface;
use Drupal\user\UserInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\rules\Core\RulesActionBase;
use Symfony\Component\DependencyInjection\ContainerInterface;

abstract class EventGeneratorActionBase extends RulesActionBase implements ContainerFactoryPluginInterface {

  /**
   * @var \Drupal\islandora\EventGenerator\EventGeneratorInterface;
   */
  protected $eventGenerator;

  /**
   * Constructs a MessageBroadcaster action.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin ID for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, EventGeneratorInterface $event_generator) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->eventGenerator = $event_generator;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('islandora.eventgenerator')
    );
  }

}
