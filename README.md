# Mapper [![Build Status](https://travis-ci.com/BoShurik/mapper.svg?branch=master)](https://travis-ci.com/BoShurik/mapper)

## Usage

```php
$registry = new MappingRegistry();
$registry->add(User::class, UserDto::class, function(User $user, MapperInterface $mapper, array $context) {
    $dto = $context[Mapper::DESTINATION_CONTEXT] ?? new UserDto();
    $dto->name = $user->getName();

    return $dto;
});

$mapper = new Mapper($registry);

$user = new User('name');
$dto = $mapper->map($user, UserDto::class);

// Map to existing object. You can get it from $context[Mapper::DESTINATION_CONTEXT]
$dto = $mapper->map($user, new UserDto());
```