<?php
/**
 * User: boshurik
 * Date: 2019-02-23
 * Time: 13:47
 */

namespace BoShurik\Mapper\Tests\Mapping;

use BoShurik\Mapper\Mapping\MappingRegistry;
use BoShurik\Mapper\Mapping\NoMappingException;
use BoShurik\Mapper\Tests\Fixtures\User\Moderator;
use BoShurik\Mapper\Tests\Fixtures\User\User;
use BoShurik\Mapper\Tests\Fixtures\User\UserDto;
use PHPUnit\Framework\TestCase;

class MappingRegistryTest extends TestCase
{
    public function testCanAddMapping()
    {
        $registry = new MappingRegistry();
        $registry->add(User::class, UserDto::class, function(){});

        $mapping = $registry->get(User::class, UserDto::class);
        $this->assertTrue(is_callable($mapping));
    }

    public function testCanGetMappingByObject()
    {
        $registry = new MappingRegistry();
        $registry->add(User::class, UserDto::class, function(){});

        $mapping = $registry->get(new User(), new UserDto());
        $this->assertTrue(is_callable($mapping));
    }

    public function testCanGetMappingForChild()
    {
        $registry = new MappingRegistry();
        $registry->add(User::class, UserDto::class, function(){});

        $mapping = $registry->get(new Moderator(), new UserDto());
        $this->assertTrue(is_callable($mapping));
    }

    public function testNoMappingException()
    {
        $this->expectException(NoMappingException::class);

        $registry = new MappingRegistry();
        $registry->get(User::class, UserDto::class);
    }
}