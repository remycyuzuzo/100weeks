<?php


/**
 * @class DB 
 * | this class contains basic functions for directly operate the database
 */

class DB
{

    /**
     * This function helps to specifically select data from the database
     * @param string $sql parse the database query
     * @param MYSQLI $conn the database connection
     */
    public static function selectFromDb($sql, $conn)
    {
        $res = $conn->query($sql);

        // echo $conn->error;
        if ($res !== false) {
            if ($res->num_rows > 0) {
                return $res;
            } else return null;
        } else return false;
    }

    /**
     * This function helps to specifically select data from the database
     * @param string $sql parse the database query
     * @param MYSQLI $conn the database connection
     */
    public static function executeStandardQuery($sql, $conn)
    {
        $result = $conn->query($sql);
        if ($result) {
            $verdict['result'] = true;
        } else {
            $verdict['result'] = false;
            $verdict['errorMessage'] =  $conn->error;
        }
        return $verdict;
    }

    /**
     * This function is used to insert data into the database table
     * @param string $table The table name
     * @param array $columns the array of columns to be inserted into
     * @param array $data The array containing all data to be inserted into the table
     * @return array Returns ['result'=>true] if data are inserted successfully, returns false+error message
     * @param MYSQLI $conn the database connection
     */
    public static function insertIntoDb(string $table, array $data, $conn)
    {
        // construct the query string adding the column and values parts

        /**
         * @var string $sql a string querying the database to insert stuff
         */
        $i = 0;

        foreach ($data as $column => $value) {
            $columns[$i] = $column;
            $values[$i] = $value;
            $i++;
        }

        $sql = "INSERT INTO $table (";
        for ($i = 0; $i < count($columns); $i++) {
            $sql .= $columns[$i];
            if ((count($columns) - 1) !== $i) $sql .= ",";
            else $sql .= ")";
        }
        $sql .= " VALUES(";
        for ($i = 0; $i < count($values); $i++) {
            // using conditions to identify numbers from strings in order to enclose in quotes or not
            $sql .= (is_numeric($values[$i])) ? $values[$i] : "'$values[$i]'";
            if ((count($values) - 1) !== $i) $sql .= ",";
            else $sql .= ")";
        }
        /**
         * @var MySQLI_Result $result is an object containing query result information
         */
        $result = $conn->query($sql);
        $verdict = [];

        // check whether the data actually entered the database or nor
        if ($result) {
            $verdict['result'] = true;
            $verdict["last_id"] = $conn->insert_id;
        } else {
            $verdict['result'] = false;
            $verdict['errorMessage'] =  $conn->error;
        }
        return $verdict;
    }


    public function updateFromTable(string $table, array $data, mixed $condition, $conn)
    {
        // construct the query string adding the column and values parts

        /**
         * @var string $sql a string querying the database to insert stuff
         */
        $sql = $this->makeUpdateQueryString($data, $table, $condition);

        /** @var MySQLI_Result $result is an object containing query result information */
        $result = $conn->query($sql);

        // check whether the data actually entered the database or nor
        if ($result) {
            return true;
        } else {
            throw new DBError("can't update in this table, the system thrown this error instead: \n" . $conn->error, 3);
        }
    }

    private function makeUpdateQueryString(array $data, string $table, $condition)
    {
        $sql = "UPDATE $table SET ";
        $i = 1;
        foreach ($data as $column => $value) {
            if ((count($data) + 1) !== $i) {
                $sql .= ($i == 1) ? "" : ", ";
                $sql .= "$column = ";
                $sql .= (is_numeric($value)) ? $value : "'$value'";
            }
            $i += 1;
        }
        if ($condition == "") $condition = 1;
        $sql .= " WHERE $condition";

        return $sql;
    }
}
