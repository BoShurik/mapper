<?php
/**
 * User: boshurik
 * Date: 2019-02-23
 * Time: 13:42
 */

namespace BoShurik\Mapper\Mapping;

class MappingRegistry
{
    /**
     * @var array
     */
    private $mapping;

    public function __construct()
    {
        $this->mapping = [];
    }

    /**
     * @param string $source
     * @param string $destination
     * @param callable $mapping
     */
    public function add(string $source, string $destination, callable $mapping): void
    {
        $this->mapping[$source][$destination] = $mapping;
    }

    /**
     * @param object|string $source
     * @param object|string $destination
     * @return callable
     */
    public function get($source, $destination): callable
    {
        $sourceClasses = $this->getClasses($source);
        $destinationClasses = $this->getClasses($destination);

        $sourceMapping = null;
        foreach ($sourceClasses as $sourceClass) {
            if (isset($this->mapping[$sourceClass])) {
                $sourceMapping = $this->mapping[$sourceClass];
                break;
            }
        }

        if ($sourceMapping === null) {
            throw new NoMappingException(sprintf('No mapping for %s', $sourceClasses[0]));
        }

        foreach ($destinationClasses as $destinationClass) {
            if (isset($sourceMapping[$destinationClass])) {
                return $sourceMapping[$destinationClass];
            }
        }

        throw new NoMappingException(sprintf('No mapping for %s and %s', $sourceClasses[0], $destinationClasses[0]));
    }

    /**
     * @param object|string $target
     * @return string[]
     */
    private function getClasses($target): array
    {
        if (is_object($target)) {
            return array_merge([
                get_class($target)
            ], class_parents($target));
        } else {
            return [$target];
        }
    }
}