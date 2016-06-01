<?php

namespace Drupal\replication\Replicate;

interface ReplicateInterface {

  /**
   * Set the source database.
   *
   * @param array $info
   * @return \Drupal\replication\Replicate\ReplicateInterface
   */
  public function setSource($info);

  /**
   * Set the target database.
   *
   * @param array $info
   * @return \Drupal\replication\Replicate\ReplicateInterface
   */
  public function setTarget($info);

  /**
   * Run replication.
   *
   * @return mixed
   */
  public function doReplication();

  /**
   * Returns the result of the replication.
   *
   * @return mixed
   */
  public function getResult();
  
}
