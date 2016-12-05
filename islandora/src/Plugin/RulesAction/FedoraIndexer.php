<?php

namespace Drupal\islandora\Plugin\RulesAction;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\rules\Core\RulesActionBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Provides a 'Index in Fedora' action.
 *
 * @RulesAction(
 *   id = "islandora_fedora_indexer",
 *   label = @Translation("Index in Fedora"),
 *   category = @Translation("Islandora"),
 *   context = {
 *     "entity" = @ContextDefinition("entity",
 *       label = @Translation("Entity"),
 *       description = @Translation("Specifies the entity to index in Fedora.")
 *     ),
 *     "broker_url" = @ContextDefinition("string",
 *       label = @Translation("Broker URL"),
 *       description = @Translation("URL of STOMP Broker"),
 *       default_value = "http://localhost:61613" 
 *     ),
 *     "queue" = @ContextDefinition("string",
 *       label = @Translation("Queue"),
 *       description = @Translation("Queue to publish message"),
 *       default_value = "islandora/indexing/fedora" 
 *     )
 *   }
 * )
 */
class FedoraIndexer extends RulesActionBase implements ContainerFactoryPluginInterface {

  protected $serializer;

  /**
   * Constructs a FedoraIndexer object.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin ID for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Symfony\Component\Serializer\SerializerInterface $serializer
   *   Serialization service.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, SerializerInterface $serializer) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->serializer = $serializer;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('serializer')
    );
  }

  /**
   * Set a system message.
   *
   */
  protected function doExecute(EntityInterface $entity, $broker_url, $queue) {
    $message = new array(
      
    );
    $serialized = $this->serializer->serialize($entity, 'jsonld');
    drupal_set_message($serialized, "info", FALSE);
  }
}
