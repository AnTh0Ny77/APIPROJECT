<?
namespace Src\Services;
use Pdo;
use PDOException;

class QueryCrafter { 

    public  $Table;
    public  $Db;

    public function __construct(string $table , $db){
        $this->Table = $table;
        $this->Db = $db;
    }

    public function findOne(array $array) {
        try {
            $clause = '';
            $data = [];
            foreach ($array as $key => $value) {
                $value = filter_var($value, FILTER_SANITIZE_STRING);
                $clause .= "AND $key = :$key ";
                $data[":$key"] = $value;
            }
            $table = $this->Db->Pdo->quote($this->Table);
            $request = "SELECT * FROM $table WHERE 1 = 1 $clause";
    
            $request = $this->Db->Pdo->prepare($request);
            $request->execute($data);
            $request = $request->fetch(PDO::FETCH_ASSOC);
    
            if ($request != false) {
                return $request;
            }
            return null;
        } catch (PDOException $e) {
            $error = $e->getMessage();
        }
    }


    public function findBy(array $array, int $limit, array $order) {
        try {
            $clause = '';
            $data = [];
            foreach ($array as $key => $value) {
                $clause .= "AND $key = :$key ";
                $data[":$key"] = $value;
            }
    
            $orderclause = '';
            if (!empty($order)) {
                $orderclause .= ' ORDER BY ';
                foreach ($order as $key => $value) {
                    if ($key === array_key_last($order)) {
                        $orderclause .= " $key $value ";
                    } else {
                        $orderclause .= " $key $value, ";
                    }
                }
            }
    
            $limitclause = '';
            if ($limit > 0) {
                $limitclause = "LIMIT $limit";
            }
    
            $table = $this->Db->Pdo->quote($this->Table);
            $request = "SELECT * FROM $table WHERE 1 = 1 $clause $orderclause $limitclause";
    
            $request = $this->Db->Pdo->prepare($request);
            $request->execute($data);
            return $request->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $error = $e->getMessage();
        }
    }
}