<?php

namespace Drupal\umami_es\Plugin\ElasticsearchIndex;

use Drupal\elasticsearch_helper\Plugin\ElasticsearchIndexBase;

/**
 * @ElasticsearchIndex(
 *   id = "node_index",
 *   label = @Translation("Umami Node Index"),
 *   indexName = "umami_node_index",
 *   typeName = "node",
 *   entityType = "node"
 * )
 */
class NodeIndex extends ElasticsearchIndexBase {

  /**
   * NOTE: The structure of the indexed data is determined by normalizers,
   * see NodeNormalizer.php.
   */

}
