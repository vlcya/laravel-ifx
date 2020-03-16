<?php

namespace Poyii\Informix\Schema;

use Illuminate\Database\Schema\Builder;

class IfxBuilder extends Builder
{
    /**
     * Determine if the given table exists.
     *
     * @param  string  $table
     *
     * @return bool
     */
    public function hasTable($table)
    {
        $sql = $this->grammar->compileTableExists();

        //$database = $this->connection->getDatabaseName();

        $table = $this->connection->getTablePrefix().$table;

        return count($this->connection->select($sql, [$table])) > 0;
    }

    /**
     * Implement dropAllTables.
     *
     * @return bool
     */
     public function dropAllTables() {
        $query = 'SELECT tabname FROM systables WHERE tabid > 99';
        $pdo  = $this->connection->getPdo();
        $prep = $pdo->prepare($query);
        $prep->execute();
        $tables = $prep->fetchAll(\PDO::FETCH_BOTH);

        $executeReturnCode = true;

        foreach ($tables as $table) {
            $dropTableQuery = sprintf('DROP TABLE %s;' . PHP_EOL,  $table[0]);
            $prep = $pdo->prepare($dropTableQuery);
            $executeReturnCode &= $prep->execute();
        }

        return $executeReturnCode;
    }

    /**
     * Get the column listing for a given table.
     *
     * @param  string  $table
     *
     * @return array
     */
    public function getColumnListing($table)
    {
        //$database = $this->connection->getDatabaseName();

        $table = $this->connection->getTablePrefix().$table;

        $sql = $this->grammar->compileColumnExists($table);

        $results = $this->connection->select($sql, [$table]);

        return $this->connection->getPostProcessor()->processColumnListing($results);
    }
}
