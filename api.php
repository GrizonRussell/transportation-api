<?php

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

class Data
{
    private $conn;

    function __construct()
    {
        include "connection.php";
        $this->conn = $conn;
    }

    function getRecord()
    {
        $sql = "SELECT pas_id, pas_name, dest_name, gender_name, pas_price
                FROM tblpassengers
                INNER JOIN tblgender ON tblpassengers.pas_genderId = tblgender.gender_id
                INNER JOIN tbldestination ON tblpassengers.pas_destinationId = tbldestination.dest_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($records);
    }

    function addRecord($data)
    {
        try {
            $this->conn->beginTransaction();

            $sql = "INSERT INTO tblpassengers (pas_name, pas_genderId, pas_destinationId, pas_price) VALUES (?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$data["pas_name"], $data["pas_genderId"], $data["pas_destinationId"], $data["pas_price"]]);
            $pas_id = $this->conn->lastInsertId();
            $this->conn->commit();
            echo json_encode(["status" => 1, "message" => "Record added successfully.", "pas_id" => $pas_id]);
        } catch (Exception $e) {
            $this->conn->rollBack();
            echo json_encode(["status" => 0, "message" => $e->getMessage()]);
        }
    }

    function updateRecord($data)
    {
        try {
            $sql = "UPDATE tblpassengers SET pas_name = ?, pas_genderId = ?, pas_destinationId = ?, pas_price = ? WHERE pas_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$data["pas_name"], $data["pas_genderId"], $data["pas_destinationId"], $data["pas_price"], $data["pas_id"]]);
            echo json_encode(["status" => 1, "message" => "Record updated successfully."]);
        } catch (Exception $e) {
            echo json_encode(["status" => 0, "message" => $e->getMessage()]);
        }
    }

    function deleteRecord($data)
    {
        try {
            $sql = "DELETE FROM tblpassengers WHERE pas_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$data["pas_id"]]);
            echo json_encode(["status" => 1, "message" => "Record deleted successfully."]);
        } catch (Exception $e) {
            echo json_encode(["status" => 0, "message" => $e->getMessage()]);
        }
    }

    function getDestinations()
    {
        $sql = "SELECT dest_id, dest_name FROM tbldestination";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $destinations = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($destinations);
    }

    function getGenders()
    {
        $sql = "SELECT gender_id, gender_name FROM tblgender";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $genders = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($genders);
    }
}

    $data = json_decode(file_get_contents("php://input"), true);
    $object = new Data();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        switch ($data['operation']) {
        case 'getRecord':
            $object->getRecord();
            break;
        case 'addRecord':
            $object->addRecord($data);
            break;
        case 'updateRecord':
            $object->updateRecord($data);
            break;
        case 'deleteRecord':
            $object->deleteRecord($data);
            break;
        case 'getDestinations':
            $object->getDestinations();
            break;
        case 'getGenders':
            $object->getGenders();
            break;
        }
    }
?>
