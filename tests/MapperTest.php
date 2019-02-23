<?php
/**
 * User: boshurik
 * Date: 2019-02-23
 * Time: 13:41
 */

namespace BoShurik\Mapper\Tests;

use BoShurik\Mapper\Mapper;
use BoShurik\Mapper\MapperInterface;
use BoShurik\Mapper\Mapping\MappingRegistry;
use BoShurik\Mapper\Tests\Fixtures\User\User;
use BoShurik\Mapper\Tests\Fixtures\User\UserDto;
use PHPUnit\Framework\TestCase;

class MapperTest extends TestCase
{
    public function testExecuteMapping()
    {
        $user = new User();
        $dto = new UserDto();

        $registry = new MappingRegistry();
        $registry->add(User::class, UserDto::class,
            function(User $user, MapperInterface $mapper, array $context) use ($dto) {
                $this->assertArrayHasKey(Mapper::DESTINATION_CONTEXT, $context);
                $this->assertArrayHasKey('key', $context);

                $this->assertEquals($dto, $context[Mapper::DESTINATION_CONTEXT]);
                $this->assertEquals('item', $context['key']);

                return new UserDto();
            }
        );

        $mapper = new Mapper($registry);
        $mapper->map($user, $dto, [
            'key' => 'item',
        ]);
    }
}