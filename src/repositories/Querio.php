<?php

namespace src\repositories;

use Exception;
use PDO;
use PDOException;
use Ramsey\Uuid\Rfc4122\UuidV4;
use src\database\Database;
use src\exceptions\app\CreateFailException;
use src\exceptions\app\GetFailException;
use src\exceptions\app\ListingAllFailException;
use src\exceptions\pdo\ColumnDoesntHaveADefaultValueException;
use src\exceptions\pdo\ColumnNotFoundException;
use src\exceptions\pdo\IntegerValueException;
use src\exceptions\pdo\TableOrViewNotFoundException;
use stdClass;

class Querio
{

    public static PDO|null $db = null;
    protected static string|null $queryString = null;
    public static string $table = "";
    /** @var array<string, mixed> */
    protected static array|null $bind = null;
    protected static bool|null $selectIsOne = null;
    protected static string $calledClass = "";

    function __construct()
    {
        self::$db = Database::instance();
    }

    public static function getTable()
    {
        return static::$table;
    }



    /**
     * @param array $data
     * @return self
     */
    static function insert(array $data): self
    {
        $t = self::getTable();
        self::$queryString = "INSERT INTO {$t}";
        self::values($data);
        return new self;
    }

    /**
     * @param array<string, mixed> $binds
     * @return self
     */
    static function values(array $binds = []): self
    {
        self::$bind = $binds;
        $keys = implode(", ", array_keys($binds));
        $keysUsingInBind = ":" . implode(", :", array_keys($binds));
        self::$queryString .= " ({$keys}) VALUES ({$keysUsingInBind})";

        return new self;
    }


    /**
     * @param string $column
     * @param string $operation
     * @param mixed $value
     * @return self
     */
    static function where(string $column, string $operation, mixed $value): self
    {
        $columnWithoutTable = $column;
        if (str_contains($column, '.'))
            [$table, $columnWithoutTable] = explode(".", $column);

        self::$queryString .= " WHERE {$column} {$operation} :{$columnWithoutTable}";
        self::$bind[$columnWithoutTable] = $value;
        return new self;
    }


    /**
     * @param string $column
     * @param string $operation
     * @param mixed $value
     * @return self
     */
    static function andWhere(string $column, string $operation, mixed $value): self
    {
        $columnWithoutTable = $column;
        if (str_contains($column, '.'))
            [$table, $columnWithoutTable] = explode(".", $column);

        self::$queryString .= " AND {$column} {$operation} :{$columnWithoutTable}";
        self::$bind[$columnWithoutTable] = $value;
        return new self;
    }

    /**
     * @param string $column
     * @param string $operation
     * @param mixed $value
     * @return self
     */
    static function orWhere(string $column, string $operation, mixed $value): self
    {
        $columnWithoutTable = $column;
        if (str_contains($column, '.'))
            [$table, $columnWithoutTable] = explode(".", $column);

        self::$queryString .= " OR {$column} {$operation} :{$column}";
        self::$bind[$column] = $value;
        return new self;
    }


    /**
     * @param string $column
     * @param array<string, mixed> $values
     * @return self
     */
    static function andIn(string $column, array $values): self
    {
        $columnWithoutTable = $column;
        if (str_contains($column, '.'))
            [$table, $columnWithoutTable] = explode(".", $column);

        $params = [];
        foreach ($values as $key => $value) {
            $params[":{$column}{$key}"] = $value;
            self::$bind[":{$column}{$key}"] = $value;
        }
        $paramsIn = implode(", ", array_keys($params));

        self::$queryString .= " AND {$column} IN ({$paramsIn})";

        return new self;
    }

    /**
     * @param string $column
     * @param array<string, mixed> $values
     * @return self
     */
    static function whereIn(string $column, array $values): self
    {
        $columnWithoutTable = $column;
        if (str_contains($column, '.'))
            [$table, $columnWithoutTable] = explode(".", $column);

        $params = [];
        foreach ($values as $key => $value) {
            $params[":{$column}{$key}"] = $value;
            self::$bind[":{$column}{$key}"] = $value;
        }
        $paramsIn = implode(", ", array_keys($params));


        self::$queryString .= " WHERE {$column} IN ({$paramsIn})";
        return new self;
    }

    /**
     * @param string $column
     * @return self
     */
    static function whereIsNull(string $column): self
    {
        self::$queryString .= " WHERE {$column} IS NULL";
        return new self;
    }

    /**
     * @param string $column
     * @return self
     */
    static function whereIsNotNull(string $column): self
    {
        self::$queryString .= " WHERE {$column} IS NOT NULL";
        return new self;
    }

    /**
     * @return stdClass|array<int, object>|bool|self
     */
    static function finish(): stdClass|array|bool|self
    {
        try {
            $firstWord = strstr(self::$queryString, ' ', true);
            if (!is_string($firstWord)) {
                return false;
            }
            $operation = strtolower(trim($firstWord));
            $isSelect = $operation === 'select';


            if (!$isSelect) {
                $stmt = self::$db->prepare(self::$queryString);
                $r = $stmt->execute(self::$bind ?? []);


                foreach (self::$bind as $k => $v) {
                    if (strpos($k, "\x00") !== false) {
                        unset(self::$bind[$k]);
                    }
                }



                if ($operation === 'insert') {
                    $called = self::$calledClass;
                    return $called::getById(self::$db->lastInsertId());
                } else if ($operation === 'update') {
                    $called = self::$calledClass;
                    if (isset(self::$bind["id"]))
                        return $called::getById(self::$bind["id"]);
                    else
                        return $called::getByUuid(self::$bind["uuid"]);
                }
                return $r;
            } else {
                if (self::$selectIsOne)
                    self::limit();


                $stmt = self::$db->prepare(self::$queryString);
                $stmt->execute(self::$bind ?? []);

                $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, self::$calledClass);

                if (self::$selectIsOne) {
                    $found = $stmt->fetch();
                    if (!$found)
                        return false;
                    return $found;
                } else {
                    $found = $stmt->fetchAll();
                    if (!$found)
                        return false;
                    return $found;
                }
            }
        } catch (PDOException $e) {
            if (str_contains($e->getMessage(), "doesn't have a default value")) {
                new ColumnDoesntHaveADefaultValueException(['message from pdo' => $e->errorInfo[2]]);
            } else if (str_contains($e->getMessage(), 'Base table or view not found')) {
                new TableOrViewNotFoundException(['message from pdo' => $e->errorInfo[2]]);
            } else if (str_contains($e->getMessage(), 'Column not found')) {
                new ColumnNotFoundException(['message from pdo' => $e->errorInfo[2]]);
            } else if (str_contains($e->getMessage(), 'Incorrect integer value')) {
                new IntegerValueException(['message from pdo' => $e->errorInfo[2]]);
            } else {
                dd($e->getMessage(), self::$bind, self::$queryString);
            }
            return false;
        }
    }

    /**
     * @param array<int, string> $fields
     * @param bool $selectIsOne - false as default
     */
    static function select(array $fields = [], bool $selectIsOne = false): self
    {
        self::$bind = [];
        $t = self::getTable();
        if (empty($fields))
            $fieldsInString = "{$t}.*";
        else
            $fieldsInString = implode(', ', $fields);

        self::$selectIsOne = $selectIsOne;
        self::$queryString = "SELECT {$fieldsInString} FROM {$t}";
        return new self;
    }


    /**
     * @param array<int, string> $fields
     * @return self
     */
    static function selectOne(array $fields = []): self
    {
        return self::select($fields, true);
    }

    /**
     * @param int $limit - 1 as default
     */
    static function limit(int $limit = 1): self
    {
        self::$queryString .= " LIMIT {$limit}";
        return new self;
    }

    /**
     * @param string $table
     * @param string $firstColumn
     * @param string $operation
     * @param string $secondColumn
     * @return self
     */
    static function innerJoin(string $table, string $firstColumn, string $operation, string $secondColumn): self
    {
        self::$queryString .= " INNER JOIN {$table} ON {self::$table}.{$firstColumn} {$operation} {$table}.{$secondColumn}";
        return new self;
    }

    /**
     * @param string $table
     * @param string $firstColumn
     * @param string $operation
     * @param string $secondColumn
     * @return self
     */
    static function leftJoin(string $table, string $firstColumn, string $operation, string $secondColumn): self
    {
        self::$queryString .= " LEFT JOIN {$table} ON {self::$table}.{$firstColumn} {$operation} {$table}.{$secondColumn}";
        return new self;
    }

    /**
     * @param string $table
     * @param string $firstColumn
     * @param string $operation
     * @param string $secondColumn
     * @return self
     */
    static function rightJoin(string $table, string $firstColumn, string $operation, string $secondColumn): self
    {
        self::$queryString .= " RIGHT JOIN {$table} ON {self::$table}.{$firstColumn} {$operation} {$table}.{$secondColumn}";
        return new self;
    }

    /**
     * @param string $table
     * @param string $firstColumn
     * @param string $operation
     * @param string $secondColumn
     * @return self
     */
    static function fullJoin(string $table, string $firstColumn, string $operation, string $secondColumn): self
    {
        self::$queryString .= " FULL OUTER JOIN {$table} ON {self::$table}.{$firstColumn} {$operation} {$table}.{$secondColumn}";
        return new self;
    }


    /**
     * @param string $table
     * @return self
     */
    static function table(string $table): self
    {
        self::$calledClass = get_called_class();
        self::$table = $table;
        return new self;
    }

    /**
     * @param array<string, mixed> $data
     * @return self
     */
    static function update(array $data): self
    {
        $t = self::getTable();
        self::$queryString = "UPDATE {$t} SET ";
        foreach ($data as $key => $value) {
            self::$queryString .= "{$key} = :{$key}, ";
        }
        self::$queryString = rtrim(self::$queryString, ", ");
        self::$bind = $data;
        return new self;
    }



    /**
     * @return self
     */
    static function delete(): self
    {
        $t = self::getTable();
        self::$queryString = "DELETE FROM {$t}";
        return new self;
    }

    /**
     * @return self
     */
    static function softDelete(): self

    {
        $t = self::getTable();
        self::$queryString = "UPDATE {$t} SET deleted_at = NOW()";
        return new self;
    }

    /**
     * @return ?PDO
     */
    static function getPDO(): ?PDO
    {
        return self::$db;
    }

    static function transactionBegin(): self
    {
        self::$db->beginTransaction();
        return new self;
    }

    static function transactionCommit(): self
    {
        self::$db->commit();
        return new self;
    }

    static function transactionRollback(): self
    {
        self::$db->rollback();
        return new self;
    }


    /**
     * @param int $offset
     */
    static function offset(int $offset): self
    {
        self::$queryString .= " OFFSET {$offset}";
        return new self;
    }

    /**
     * @param string $column
     * @param string $type
     */
    static function order(string $column, string $type): self
    {
        self::$queryString .= " ORDER BY {$column} {$type}";
        return new self;
    }


    static function getPagination(int $itemsInPage = 5): stdClass
    {
        $stdclass = new stdClass();

        $raw = self::finish();
        $pagina = (isset($_GET['page']) ? $_GET['page'] : 1) - 1;
        $offset = $pagina * $itemsInPage;
        $paginated = self::order("id", "DESC")->limit($itemsInPage)->offset($offset)->finish(0);
        $quantitiesOfPages = ceil(count($raw ? $raw : []) / $itemsInPage);
        $links = pagination($quantitiesOfPages);


        $stdclass->raw = $raw;
        $stdclass->currentPage = $pagina  + 1;
        $stdclass->offset = $offset;
        $stdclass->paginated = $paginated;
        $stdclass->quantitiesOfPages = $quantitiesOfPages;
        $stdclass->quantitiesPerPage = $itemsInPage;
        $stdclass->links = $links;

        return $stdclass;
    }


    // static Functions ready for uses

    /**
     * @param array $data
     * @return bool|array<string, mixed>|object
     */
    static function create(array $data): bool|array|object
    {
        self::$calledClass = get_called_class();
        $data['uuid'] = UuidV4::uuid4()->toString();
        $created = self::table(self::getTable())->insert($data)->finish();

        if (!$created)
            new CreateFailException(["payload" => $data]);

        return $created;
    }



    static function getById(int $id): mixed
    {
        self::$calledClass = get_called_class();
        return self::getByColumn("id", $id);
    }

    /**
     * @param string $uuid
     * @return static|bool
     */
    static function getByUuid(string $uuid): static|bool
    {
        self::$calledClass = get_called_class();
        $i = self::getByColumn("uuid", $uuid);

        if (!$i)
            new GetFailException(["from" => self::$calledClass, "payload" => ["uuid" => $uuid], "method" => "getByUuid"]);

        return $i;
    }

    static function getByColumn(string $column, string $value, string $operation = "="): mixed
    {
        self::$calledClass = get_called_class();
        return self::table(self::getTable())->selectOne()->where($column, $operation, $value)->finish();
    }

    /**
     * @param int $id
     * @return bool
     */
    static function deleteById(int $id): bool
    {
        self::$calledClass = get_called_class();
        return self::table(self::getTable())->delete()->where('id', "=", $id)->finish();
    }

    /**
     * @param int $iuud
     * @return bool
     */
    static function deleteByUuid(string $uuid): bool
    {
        self::$calledClass = get_called_class();
        return self::table(self::getTable())->delete()->where('uuid', "=", $uuid)->finish();
    }


    static function softDeleteById(int $id): bool|stdClass
    {
        self::$calledClass = get_called_class();
        return self::table(self::getTable())->softDelete()->where('id', "=", $id)->finish();
    }

    static function softDeleteByUuid(string $uuid): bool|stdClass
    {
        self::$calledClass = get_called_class();
        return self::table(self::getTable())->softDelete()->where('uuid', "=", $uuid)->finish();
    }


    static function updateById(int $id, array $data): mixed
    {
        self::$calledClass = get_called_class();
        return self::table(self::getTable())->update($data)->where("id", "=", $id)->finish();
    }

    static function updateByUuid(string $uuid, array $data): mixed
    {
        self::$calledClass = get_called_class();
        return self::table(self::getTable())->update($data)->where("uuid", "=", $uuid)->finish();
    }

    /**
     * Save the record
     * @return mixed
     */
    static function save(): mixed
    {
        self::$calledClass = get_called_class();
        if (isset(self::$bind['id'])) {
            return self::updateById(self::$bind['id'], self::$bind);
        } else if (isset(self::$bind['uuid'])) {
            return self::updateByUuid(self::$bind['uuid'], self::$bind);
        }
        return self::create(self::$bind);
    }

    /**
     * Find all records
     * @param array<int, string> $fields
     * @return bool|array<int, object>
     */
    static function getAll(array $fields = ['*']): array|bool
    {

        self::$calledClass = get_called_class();
        $all = self::table(self::getTable())->select($fields)->finish();

        if (!$all)
            new ListingAllFailException(["from" => self::$calledClass]);

        return $all;
    }



    /**
     * Find all records with deleted_at is null
     * @param array<int, string> $fields
     * @return bool|array<int, object>
     */
    static function getAllActivates(array $fields = ['*']): array|bool
    {

        self::$calledClass = get_called_class();
        $all = self::table(self::getTable())->select($fields)->whereIsNull("deleted_at")->finish();

        if (!$all)
            new ListingAllFailException(["from" => self::$calledClass]);

        return $all;
    }



    /**
     * Find all records with deleted_at is not null
     * @param array<int, string> $fields
     * @return bool|array<int, object>
     */
    static function getAllDeactivates(array $fields = ['*']): array|bool
    {

        self::$calledClass = get_called_class();
        $all = self::table(self::getTable())->select($fields)->whereIsNotNull("deleted_at")->finish();

        if (!$all)
            new ListingAllFailException(["from" => self::$calledClass]);

        return $all;
    }
}
