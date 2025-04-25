<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') exit(0);

require_once 'config/database.php';

try {
    $db = (new Database())->getConnection();

    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['code_cours'])) {
        $query = "SELECT intitule AS nom FROM cours WHERE code = :code";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':code', $_GET['code_cours']);
        $stmt->execute();
        $cours = $stmt->fetch(PDO::FETCH_ASSOC);
        echo json_encode($cours ?: ["nom" => "Nom de cours non trouvé"]);
        exit;
    }

    $method = $_SERVER['REQUEST_METHOD'];
    $input = json_decode(file_get_contents("php://input"), true);

    switch ($method) {
        case 'GET':
            $stmt = $db->prepare("SELECT * FROM cours");
            $stmt->execute();
            echo json_encode(["success" => true, "cours" => $stmt->fetchAll(PDO::FETCH_ASSOC)]);
            break;

        case 'POST':
            $stmt = $db->prepare("INSERT INTO cours (code, intitule, volume_horaire, promotion, semestre, annee_academique) 
                                  VALUES (:code, :intitule, :volume_horaire, :promotion, :semestre, :annee_academique)");
            $stmt->execute([
                ":code" => $input['code'],
                ":intitule" => $input['intitule'],
                ":volume_horaire" => $input['volume_horaire'],
                ":promotion" => $input['promotion'],
                ":semestre" => $input['semestre'],
                ":annee_academique" => $input['annee_academique']
            ]);
            echo json_encode(["success" => true, "message" => "Cours ajouté avec succès"]);
            break;

        case 'PUT':
            if (!isset($input['id'])) {
                http_response_code(400);
                echo json_encode(["success" => false, "message" => "ID manquant pour la mise à jour"]);
                break;
            }

            $stmt = $db->prepare("UPDATE cours SET code = :code, intitule = :intitule, volume_horaire = :volume_horaire, 
                                  promotion = :promotion, semestre = :semestre, annee_academique = :annee_academique 
                                  WHERE id = :id");
            $stmt->execute([
                ":code" => $input['code'],
                ":intitule" => $input['intitule'],
                ":volume_horaire" => $input['volume_horaire'],
                ":promotion" => $input['promotion'],
                ":semestre" => $input['semestre'],
                ":annee_academique" => $input['annee_academique'],
                ":id" => $input['id']
            ]);
            echo json_encode(["success" => true, "message" => "Cours mis à jour avec succès"]);
            break;

        case 'DELETE':
            if (!isset($input['id'])) {
                http_response_code(400);
                echo json_encode(["success" => false, "message" => "ID manquant pour suppression"]);
                break;
            }

            $stmt = $db->prepare("DELETE FROM cours WHERE id = :id");
            $stmt->execute([":id" => $input['id']]);
            echo json_encode(["success" => true, "message" => "Cours supprimé avec succès"]);
            break;

        default:
            http_response_code(405);
            echo json_encode(["success" => false, "message" => "Méthode non autorisée"]);
            break;
    }

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["success" => false, "message" => "Erreur serveur", "error" => $e->getMessage()]);
}
