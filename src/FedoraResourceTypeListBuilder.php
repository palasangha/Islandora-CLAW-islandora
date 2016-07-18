<?php

namespace Drupal\islandora;

use Drupal\Core\Config\Entity\ConfigEntityListBuilder;
use Drupal\Core\Entity\EntityInterface;

/**
 * Provides a listing of Fedora resource type entities.
 */
class FedoraResourceTypeListBuilder extends ConfigEntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['label'] = $this->t('Fedora resource type');
    $header['id'] = $this->t('Machine name');
    $header['rdf_type'] = $this->t('RDF Type');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    $row['label'] = $entity->label();
    $row['id'] = $entity->id();
    $row['rdf_type'] = $entity->getRdfType();
    // You probably want a few more properties here...
    return $row + parent::buildRow($entity);
  }

}
