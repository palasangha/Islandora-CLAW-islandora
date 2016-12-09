<?php

namespace Drupal\islandora\Plugin\RulesAction;

use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\rules\Core\RulesActionBase;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides an action to broadcast a message to a list of queues.
 *
 * @RulesAction(
 *   id = "islandora_message_broadcaster",
 *   label = @Translation("Broadcast Message"),
 *   category = @Translation("Islandora"),
 *   context = {
 *     "message" = @ContextDefinition("string",
 *       label = @Translation("Message"),
 *       description = @Translation("The message to broadcast.")
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
class MessageBroadcaster extends RulesActionBase implements ContainerFactoryPluginInterface {

  protected $serializer;

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
  public function __construct(array $configuration, $plugin_id, $plugin_definition) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition
    );
  }

  /**
   * Set a system message.
   *
   */
  protected function doExecute($message, $broker_url, $queue) {
    drupal_set_message($message, "info", FALSE);
  }

}
