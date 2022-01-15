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

        echo $conn->error;
        if ($res !== false) {
            if ($res->num_rows > 0) {
                return $res;
            } else return null;
        } else return false;
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
        } else {
            $verdict['result'] = false;
            $verdict['errorMessage'] =  $conn->error;
        }
        return $verdict;
    }
}
