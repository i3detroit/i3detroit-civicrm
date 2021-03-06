<?php
/*
 +--------------------------------------------------------------------+
 | Copyright CiviCRM LLC. All rights reserved.                        |
 |                                                                    |
 | This work is published under the GNU AGPLv3 license with some      |
 | permitted exceptions and without any warranty. For full license    |
 | and copyright information, see https://civicrm.org/licensing       |
 +--------------------------------------------------------------------+
 */

namespace Civi\Test;

class ExampleDataLoader {

  /**
   * These are "heavy" properties which are not cached. i.e.
   *  - They are generated by `$ex->build($example);`
   *  - They are not generated by '$ex->getExamples();'
   *  - They are returned by `$this->getFull()`
   *  - They are not returned by `$this->getMeta()`.
   */
  const HEAVY_FIELDS = 'data,asserts';

  /**
   * @var array|null
   */
  private $metas;

  /**
   * Get a list of all examples, including basic metadata (name, title, workflow).
   *
   * @return array
   *   Ex: ['my_example' => ['title' => ..., 'workflow' => ..., 'tags' => ...]]
   * @throws \ReflectionException
   */
  public function getMetas(): array {
    if ($this->metas === NULL) {
      // $cache = new \CRM_Utils_Cache_NoCache([]);
      $cache = \CRM_Utils_Constant::value('CIVICRM_TEST') ? new \CRM_Utils_Cache_NoCache([]) : \Civi::cache('long');
      $cacheKey = \CRM_Utils_String::munge(__CLASS__);
      $this->metas = $cache->get($cacheKey);
      if ($this->metas === NULL) {
        $this->metas = $this->findMetas();
        $cache->set($cacheKey, $this->metas);
      }
    }
    return $this->metas;
  }

  public function getMeta(string $name): ?array {
    $all = $this->getMetas();
    return $all[$name] ?? NULL;
  }

  /**
   * @param string $name
   *
   * @return array|null
   */
  public function getFull(string $name): ?array {
    $example = $this->getMeta($name);
    if ($example === NULL) {
      return NULL;
    }

    $obj = $this->createObj($example['file'], $example['class']);
    $obj->build($example);
    return $example;
  }

  /**
   * Get a list of all examples, including basic metadata (name, title, workflow).
   *
   * @return array
   *   Ex: ['my_example' => ['title' => ..., 'workflow' => ..., 'tags' => ...]]
   * @throws \ReflectionException
   */
  protected function findMetas(): array {
    $classes = array_merge(
      // This scope of search is decidedly narrow - it should probably be expanded.
      $this->scanExampleClasses(\Civi::paths()->getPath('[civicrm.root]/'), 'Civi/Test/ExampleData', '\\'),
      $this->scanExampleClasses(\Civi::paths()->getPath('[civicrm.root]/'), 'CRM/*/WorkflowMessage', '_'),
      $this->scanExampleClasses(\Civi::paths()->getPath('[civicrm.root]/'), 'Civi/*/WorkflowMessage', '\\'),
      $this->scanExampleClasses(\Civi::paths()->getPath('[civicrm.root]/'), 'Civi/WorkflowMessage', '\\'),
      $this->scanExampleClasses(\Civi::paths()->getPath('[civicrm.root]/tests/phpunit/'), 'CRM/*/WorkflowMessage', '_'),
      $this->scanExampleClasses(\Civi::paths()->getPath('[civicrm.root]/tests/phpunit/'), 'Civi/*/WorkflowMessage', '\\')
    );

    $all = [];
    foreach ($classes as $file => $class) {
      $obj = $this->createObj($file, $class);
      $offset = 0;
      foreach ($obj->getExamples() as $example) {
        $example['file'] = $file;
        $example['class'] = $class;
        if (!isset($example['name'])) {
          $example['name'] = $example['class'] . '#' . $offset;
        }
        $all[$example['name']] = $example;
        $offset++;
      }
    }

    return $all;
  }

  /**
   * @param $classRoot
   *   Ex: Civi root dir.
   * @param $classDir
   *   Folder to search (within the parent).
   * @param $classDelim
   *   Namespace separator, eg underscore or backslash.
   * @return array
   *   Array(string $includeFile => string $className).
   */
  private function scanExampleClasses($classRoot, $classDir, $classDelim): array {
    $civiRoot = \Civi::paths()->getPath('[civicrm.root]/');
    $classRoot = \CRM_Utils_File::addTrailingSlash($classRoot, '/');
    // Prefer include-paths relative to civiRoot - eg make tests/phpunit/* loadable at runtime.
    $includeRoot = \CRM_Utils_File::isChildPath($civiRoot, $classRoot) ? $civiRoot : $classRoot;

    $r = [];
    $exDirs = (array) glob($classRoot . $classDir);
    foreach ($exDirs as $exDir) {
      foreach (\CRM_Utils_File::findFiles($exDir, '*.ex.php') as $file) {
        $file = str_replace(DIRECTORY_SEPARATOR, '/', $file);
        $includeFile = \CRM_Utils_File::relativize($file, $includeRoot);
        $classFile = \CRM_Utils_File::relativize($file, $classRoot);
        $class = str_replace('/', $classDelim, preg_replace('/\.ex\.php$/', '',
          $classFile));
        $r[$includeFile] = $class;
      }
    }
    return $r;
  }

  private function createObj(?string $file, ?string $class): ExampleDataInterface {
    if ($file) {
      include_once $file;
    }
    if (!class_exists($class)) {
      throw new \CRM_Core_Exception("Failed to read example (class '{$class}' in file '{$file}')");
    }

    return new $class();
  }

}
