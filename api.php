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
        $sql = "SELECT pas_name, dest_name, gender_name, pas_price
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
            echo json_encode(["status" => -1, "message" => "Failed to add record: " . $e->getMessage()]);
        }
    }

    function getDestinations()
    {
        $sql = "SELECT dest_id, dest_name FROM tbldestination";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($records);
    }

    function getGenders()
    {
        $sql = "SELECT gender_id, gender_name FROM tblgender";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($records);
    }
}

$data = json_decode(file_get_contents('php://input'), true);
$operation = isset($data["operation"]) ? $data["operation"] : "Invalid";

$dataHandler = new Data();
switch ($operation) {
    case "getRecord":
        $dataHandler->getRecord();
        break;
    case "addRecord":
        $dataHandler->addRecord($data);
        break;
    case "getDestinations":
        $dataHandler->getDestinations();
        break;
    case "getGenders":
        $dataHandler->getGenders();
        break;
    default:
        echo json_encode(["status" => -1, "message" => "Invalid operation."]);
}
