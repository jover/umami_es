<?php

namespace Drupal\umami_es\Plugin\Normalizer;

use Drupal\image\Entity\ImageStyle;

class NodeRecipeNormalizer extends NodeTypeNormalizer {

  protected $supportedNodeType = ['recipe'];

  /**
   * {@inheritdoc}
   */
  public function normalize($object, $format = NULL, array $context = []) {
    /** @var \Drupal\node\Entity\Node $object */

    $data = parent::normalize($object, $format, $context);

    $data['image'] = "";
    if ($object->hasField('field_image') && !$object->get('field_image')->isEmpty()) {
      $imageUrl = $object->get('field_image')->entity->getFileUri();
      if ($imageUrl) {
        $imageUrl = ImageStyle::load('square_small')->buildUrl($imageUrl);
        $imageUrl = str_ireplace('http://default/', 'http://dev.elasticsearch.be/', $imageUrl);
        $image = new \stdClass();
        $image->url = $imageUrl;
        $data['image'] = $image;
      }
    }

    $data['difficulty'] = "none";
    if ($object->hasField('field_difficulty') && !$object->get('field_difficulty')->isEmpty()) {
      $data['difficulty'] = $object->get('field_difficulty')
        ->getValue()[0]['value'];
    }

    return $data;
  }

}
