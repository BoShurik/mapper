<?php
/**
 * User: boshurik
 * Date: 2019-02-23
 * Time: 13:20
 */

namespace BoShurik\Mapper;

use BoShurik\Mapper\Mapping\MappingRegistry;

class Mapper implements MapperInterface
{
    public const DESTINATION_CONTEXT = '__destination';

    /**
     * @var MappingRegistry
     */
    private $registry;

    public function __construct(MappingRegistry $registry)
    {
        $this->registry = $registry;
    }

    /**
     * @inheritDoc
     */
    public function map(object $source, $destination, array $context = []): object
    {
        $mapping = $this->registry->get($source, $destination);
        if (is_object($destination)) {
            $context[self::DESTINATION_CONTEXT] = $destination;
        }

        return $mapping($source, $this, $context);
    }
}