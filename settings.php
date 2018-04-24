<?php

/**
 * Default settings
 */

$settings['install_profile'] = 'minimal';

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

/* $settings['memcache']['extension'] = 'Memcached'; */
/* $settings['memcache_stampede_protection'] = TRUE; */
/* $settings['memcache_servers'] = array(getenv('DRUPAL_MEMCACHED_SERVER') . ':11211' => 'default'); */
/* $settings['memcache_storage']['key_prefix'] = getenv('DRUPAL_MEMCACHED_KEY_PREFIX'); */
/* $settings['cache']['bins']['render'] = 'cache.backend.memcache'; */
/* $settings['cache']['bins']['dynamic_page_cache'] = 'cache.backend.memcache'; */
/* $class_loader->addPsr4('Drupal\\memcache\\', 'modules/contrib/memcache/src'); */
/* $settings['bootstrap_container_definition'] = [ */
/*   'parameters' => [], */
/*   'services' => [ */
/*     'database' => [ */
/*       'class' => 'Drupal\Core\Database\Connection', */
/*       'factory' => 'Drupal\Core\Database\Database::getConnection', */
/*       'arguments' => ['default'], */
/*     ], */
/*     'settings' => [ */
/*       'class' => 'Drupal\Core\Site\Settings', */
/*       'factory' => 'Drupal\Core\Site\Settings::getInstance', */
/*     ], */
/*     'memcache.config' => [ */
/*       'class' => 'Drupal\memcache\DrupalMemcacheConfig', */
/*       'arguments' => ['@settings'], */
/*     ], */
/*     'memcache.backend.cache.factory' => [ */
/*       'class' => 'Drupal\memcache\DrupalMemcacheFactory', */
/*       'arguments' => ['@memcache.config'] */
/*     ], */
/*     'memcache.backend.cache.container' => [ */
/*       'class' => 'Drupal\memcache\DrupalMemcacheFactory', */
/*       'factory' => ['@memcache.backend.cache.factory', 'get'], */
/*       'arguments' => ['container'], */
/*     ], */
/*     'lock.container' => [ */
/*       'class' => 'Drupal\memcache\Lock\MemcacheLockBackend', */
/*       'arguments' => ['container', '@memcache.backend.cache.container'], */
/*     ], */
/*     'cache_tags_provider.container' => [ */
/*       'class' => 'Drupal\Core\Cache\DatabaseCacheTagsChecksum', */
/*       'arguments' => ['@database'], */
/*     ], */
/*     'cache.container' => [ */
/*       'class' => 'Drupal\memcache\MemcacheBackend', */
/*       'arguments' => ['container', '@memcache.backend.cache.container', '@lock.container', '@memcache.config', '@cache_tags_provider.container'], */
/*     ], */
/*   ], */
/* ]; */

/**
 * Include site specific settings
 */

if (file_exists($app_root . '/' . $site_path . '/settings.site.php')) {
  include $app_root . '/' . $site_path . '/settings.site.php';
}

/**
 * Include local settings
 */

if (file_exists($app_root . '/' . $site_path . '/settings.local.php')) {
  include $app_root . '/' . $site_path . '/settings.local.php';
}
