<?php

namespace Drupal\islandora_text_extraction\Plugin\Action;

use Drupal\Core\Form\FormStateInterface;
use Drupal\islandora\Plugin\Action\AbstractGenerateDerivative;

/**
 * Emits a Node for generating OCR derivatives event.
 *
 * @Action(
 *   id = "generate_ocr_derivative",
 *   label = @Translation("Get OCR from image"),
 *   type = "node"
 * )
 */
class GenerateOCRDerivative extends AbstractGenerateDerivative {

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    $config = parent::defaultConfiguration();
    $config['path'] = '[date:custom:Y]-[date:custom:m]/[node:nid]-[term:name].txt';
    $config['mimetype'] = 'text/plain';
    $config['queue'] = 'islandora-connector-ocr';
    $config['destination_media_type'] = 'file';
    return $config;
  }

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildConfigurationForm($form, $form_state);
    $form['mimetype']['#disabled'] = 'disabled';
    $form['destination_media_type']['#disabled'] = 'disabled';
    $form['event_type']['#disabled'] = 'disabled';
    return $form;
  }

}
