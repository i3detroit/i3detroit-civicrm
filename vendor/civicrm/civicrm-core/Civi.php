<?php

use Civi\Core\Format;

/**
 * Class Civi
 *
 * The "Civi" class provides a facade for accessing major subsystems,
 * such as the service-container and settings manager. It serves as a
 * bridge which allows procedural code to access important objects.
 *
 * General principles:
 *  - Each function provides access to a major subsystem.
 *  - Each function performs a simple lookup.
 *  - Each function returns an interface.
 *  - Whenever possible, interfaces should be well-known (e.g. based
 *    on a standard or well-regarded provider).
 */
class Civi {

  /**
   * A central location for static variable storage.
   * @var array
   * ```
   * `Civi::$statics[__CLASS__]['foo'] = 'bar';
   * ```
   */
  public static $statics = [];

  /**
   * Retrieve a named cache instance.
   *
   * @param string $name
   *   The name of the cache. The 'default' cache is biased toward
   *   high-performance caches (eg memcache/redis/apc) when
   *   available and falls back to single-request (static) caching.
   *   Ex: 'short' or 'default' is useful for high-speed, short-lived cache data.
   *       This is appropriate if you believe that latency (millisecond-level
   *       read time) is the main factor. For example: caching data from
   *       a couple SQL queries.
   *   Ex: 'long' can be useful for longer-lived cache data. It's appropriate if
   *       you believe that longevity (e.g. surviving for several hours or a day)
   *       is more important than  millisecond-level access time. For example:
   *       caching the result of a simple metadata-query.
   *
   * @return CRM_Utils_Cache_Interface
   *   NOTE: Beginning in CiviCRM v5.4, the cache instance complies with
   *   PSR-16 (\Psr\SimpleCache\CacheInterface).
   */
  public static function cache($name = 'default') {
    return \Civi\Core\Container::singleton()->get('cache.' . $name);
  }

  /**
   * Get the service container.
   *
   * @return \Symfony\Component\DependencyInjection\ContainerInterface
   */
  public static function container() {
    return Civi\Core\Container::singleton();
  }

  /**
   * Get the event dispatcher.
   *
   * @return \Symfony\Component\EventDispatcher\EventDispatcherInterface
   */
  public static function dispatcher() {
    // NOTE: The dispatcher object is initially created as a boot service
    // (ie `dispatcher.boot`). For compatibility with the container (eg
    // `RegisterListenersPass` and `createEventDispatcher` addons),
    // it is also available as the `dispatcher` service.
    //
    // The 'dispatcher.boot' and 'dispatcher' services are the same object,
    // but 'dispatcher.boot' is resolvable earlier during bootstrap.
    return Civi\Core\Container::getBootService('dispatcher.boot');
  }

  /**
   * @return \Civi\Core\Lock\LockManager
   */
  public static function lockManager() {
    return \Civi\Core\Container::getBootService('lockManager');
  }

  /**
   * Find or create a logger.
   *
   * @param string $channel
   *   Symbolic name (or channel) of the intended log.
   *   This should correlate to a service "log.{NAME}".
   *
   * @return \Psr\Log\LoggerInterface
   */
  public static function log($channel = 'default') {
    return \Civi\Core\Container::singleton()->get('psr_log_manager')->getLog($channel);
  }

  /**
   * Obtain the core file/path mapper.
   *
   * @return \Civi\Core\Paths
   */
  public static function paths() {
    return \Civi\Core\Container::getBootService('paths');
  }

  /**
   * Obtain the formatting object.
   *
   * @return \Civi\Core\Format
   */
  public static function format(): Format {
    return new Civi\Core\Format();
  }

  /**
   * Fetch a service from the container.
   *
   * @param string $id
   *   The service ID.
   * @return mixed
   */
  public static function service($id) {
    return \Civi\Core\Container::singleton()->get($id);
  }

  /**
   * Reset all ephemeral system state, e.g. statics,
   * singletons, containers.
   */
  public static function reset() {
    self::$statics = [];
    Civi\Core\Container::singleton();
  }

  /**
   * @return CRM_Core_Resources
   */
  public static function resources() {
    return CRM_Core_Resources::singleton();
  }

  /**
   * Obtain the contact's personal settings.
   *
   * @param NULL|int $contactID
   *   For the default/active user's contact, leave $domainID as NULL.
   * @param NULL|int $domainID
   *   For the default domain, leave $domainID as NULL.
   * @return \Civi\Core\SettingsBag
   * @throws CRM_Core_Exception
   *   If there is no contact, then there's no SettingsBag, and we'll throw
   *   an exception.
   */
  public static function contactSettings($contactID = NULL, $domainID = NULL) {
    return \Civi\Core\Container::getBootService('settings_manager')->getBagByContact($domainID, $contactID);
  }

  /**
   * Obtain the domain settings.
   *
   * @param int|null $domainID
   *   For the default domain, leave $domainID as NULL.
   * @return \Civi\Core\SettingsBag
   */
  public static function settings($domainID = NULL) {
    return \Civi\Core\Container::getBootService('settings_manager')->getBagByDomain($domainID);
  }

}
