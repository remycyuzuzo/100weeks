<?php


class DB
{


    public static function selectFromDb($sql)
    {
        require "../db_connection.php";
        $res = $conn->query($sql);
        if ($res) {
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
     */
    public static function insertIntoDb($table, array $columns, $data)
    {
        require "../db_connection.php";

        $sql = "INSERT INTO $table (";
        for ($i = 0; $i < count($columns); $i++) {
            $sql .= $columns[$i];
            if ((count($columns) - 1) !== $i) $sql .= ",";
            else $sql .= ")";
        }
        $sql .= " VALUES(";
        for ($i = 0; $i < count($data); $i++) {
            $sql .= (is_numeric($data[$i])) ? $data[$i] : "'$data[$i]'";
            if ((count($data) - 1) !== $i) $sql .= ",";
            else $sql .= ")";
        }

        $result = $conn->query($sql);

        if ($result) {
            return ['result' => true];
        } else {
            return ['result' => false, 'errorMessage' => $conn->error];
        }
    }
}
