<?php

namespace Drupal\umami_es\Plugin\Normalizer;

use Drupal\serialization\Normalizer\ContentEntityNormalizer;

/**
 * Normalizes / denormalizes Drupal nodes into an array structure good for ES.
 */
abstract class NodeTypeNormalizer extends ContentEntityNormalizer {

  /**
   * The interface or class that this Normalizer supports.
   *
   * @var array
   */
  protected $supportedInterfaceOrClass = ['Drupal\node\Entity\Node'];

  /**
   * The node types this node normalizer supports.
   *
   * @var array
   */
  protected $supportedNodeType;

  /**
   * Supported formats.
   *
   * @var array
   */
  protected $format = ['elasticsearch_helper'];

  /**
   * {@inheritdoc}
   */
  public function supportsNormalization($data, $format = NULL) {
    /** @var \Drupal\node\NodeInterface $data */
    if ($supported = parent::supportsNormalization($data, $format)) {
      $supportedNodeType = (array) $this->supportedNodeType;
      return in_array($data->getType(), $supportedNodeType);
    }

    return FALSE;
  }

  /**
   * {@inheritdoc}
   */
  public function normalize($object, $format = NULL, array $context = []) {
    /** @var \Drupal\node\Entity\Node $object */

    $data = [
      'bundle' => $object->bundle(),
      'id' => $object->id(),
      'uuid' => $object->uuid(),
      'title' => $object->getTitle(),
      'status' => $object->isPublished(),
      'user' => [
        'name' => $object->getRevisionAuthor()->getAccountName(),
        'id' => $object->getRevisionAuthor()->id(),
      ],
    ];

    return $data;
  }

}
