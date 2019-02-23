<?php
/**
 * User: boshurik
 * Date: 2019-02-23
 * Time: 13:20
 */

namespace BoShurik\Mapper;

interface MapperInterface
{
    /**
     * @param object $source
     * @param object|string $destination
     * @param array $context
     * @return object
     */
    public function map(object $source, $destination, array $context = []): object;
}