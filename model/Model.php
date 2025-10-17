<?php

require_once __DIR__ . '/../class/phpformbuilder/database/DB.php';

include_once __DIR__ . '/../conf/conf.php';

abstract class BaseModel
{

    protected static string $table;


    public abstract static function find(int $id): ?static;
    public abstract static function findAll(): array;
    public abstract static function create(array $data): bool | int;
    public abstract static function update(int $id, array $data): bool;
    public abstract static function delete(int $id): bool;
    public abstract function fill(array $data): static;

    protected static function mapToObject(array $data): static
    {
        $object = new static();

        // Use fill() method if it exists (handles enum conversion)
        if (method_exists($object, 'fill')) {
            return $object->fill($data);
        }

        // Fallback to direct assignment
        foreach ($data as $key => $value) {
            if (property_exists($object, $key)) {
                $object->$key = $value;
            }
        }
        return $object;
    }
}
