<?php
/**
 * User: boshurik
 * Date: 2019-02-23
 * Time: 13:20
 */

namespace BoShurik\Mapper;

interface MapperInterface
{
    public const DESTINATION_CONTEXT = '__destination';

    /**
     * @param object|string $destination
     */
    public function map(object $source, $destination, array $context = []): object;
}