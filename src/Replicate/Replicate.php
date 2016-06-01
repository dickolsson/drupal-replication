<?php

namespace Drupal\replication\Replicate;

use Doctrine\CouchDB\CouchDBClient;
use Drupal\Core\DependencyInjection\DependencySerializationTrait;
use Drupal\replication\Entity\ReplicationLog;
use Relaxed\Replicator\ReplicationTask;
use Relaxed\Replicator\Replicator;

class Replicate implements ReplicateInterface {

  use DependencySerializationTrait;

//  /**
//   * @var \Drupal\Core\Logger\LoggerChannelInterface
//   */
//  protected $logger;

  /**
   * @var \Doctrine\CouchDB\CouchDBClient
   */
  protected $source;

  /**
   * @var \Doctrine\CouchDB\CouchDBClient
   */
  protected $target;

  /**
   * @var array
   */
  protected $result = [];

  /**
   * {@inheritdoc}
   */
  public function setSource($info) {
    $this->source = CouchDBClient::create($info);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setTarget($info) {
    $this->target = CouchDBClient::create($info);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function doReplication() {
    $task = new ReplicationTask();
    $replicator = new Replicator($this->source, $this->target, $task);
    $this->result = $replicator->startReplication();
    return $this->result;
  }

  /**
   * {@inheritdoc}
   */
  public function getResult() {
    return $this->result;
  }

//  protected function errorReplicationLog() {
//    $time = new \DateTime();
//    $history = [
//      'start_time' => $time->format('D, d M Y H:i:s e'),
//      'end_time' => $time->format('D, d M Y H:i:s e'),
//      'session_id' => \md5((\microtime(true) * 1000000)),
//      'start_last_seq' => '',
//    ];
//    $replication_log_id = \md5(
//      $this->getWorkspace()->getMachineName() .
//      $this->target
//    );;
//    /** @var \Drupal\replication\Entity\ReplicationLogInterface $replication_log */
//    $replication_log = ReplicationLog::loadOrCreate($replication_log_id);
//    $replication_log->set('ok', FALSE);
//    //$replication_log->setSourceLastSeq($source->getWorkspace()->getUpdateSeq());
//    $replication_log->setSessionId($history['session_id']);
//    $replication_log->setHistory($history);
//    $replication_log->save();
//    return $replication_log;
//  }

}
