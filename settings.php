<?php

/**
 * Default settings
 */

$databases['default']['default'] = array (
  'database' => getenv('DRUPAL_DB'),
  'username' => getenv('DRUPAL_DB_USERNAME'),
  'password' => getenv('DRUPAL_DB_PASSWORD'),
  'host' => getenv('DRUPAL_DB_HOST'),
  'port' => '3306',
  'driver' => 'mysql',
  'prefix' => '',
  'collation' => 'utf8mb4_general_ci',
);

$config_directories = array(
  CONFIG_SYNC_DIRECTORY => '../config/sync',
);

$settings['hash_salt'] = getenv('DRUPAL_HASH_SALT');

$settings['update_free_access'] = FALSE;

$settings['container_yamls'][] = $app_root . '/' . $site_path . '/services.yml';

$settings['file_scan_ignore_directories'] = [
  'node_modules',
  'bower_components',
];

$settings['entity_update_batch_size'] = 50;

$settings['allow_authorize_operations'] = FALSE;

$conf['cache_backends'][] = 'sites/all/modules/memcache/memcache.inc';
$conf['cache_default_class'] = 'MemCacheDrupal';
$conf['cache_class_cache_form'] = 'DrupalDatabaseCache';
$conf['page_cache_without_database'] = TRUE;
$conf['page_cache_invoke_hooks'] = FALSE;
$conf['lock_inc'] = 'sites/all/modules/contrib/memcache/memcache-lock.inc';
$conf['memcache_stampede_protection'] = TRUE;
$conf['memcache_pagecache_header'] = TRUE;
$conf['memcache_servers'] = array(getenv('DRUPAL_MEMCACHED_SERVER') . ':11211' => 'default');

/**
 * Include local settings
 */

if (file_exists($app_root . '/' . $site_path . '/settings.local.php')) {
  include $app_root . '/' . $site_path . '/settings.local.php';
}
