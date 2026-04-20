<?php

// ============================================================
// test.php — Vérification du Model
// ============================================================
// Modifier la ligne ci-dessous avec vos informations de connexion.

$pdo = new PDO(
    'mysql:host=localhost;dbname=VOTRE_BASE;charset=utf8mb4',
    'VOTRE_USER',
    'VOTRE_MDP',
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
);

require 'model.php';

// ============================================================
// getAll
// ============================================================

$items = getAll($pdo, 'item');
echo is_array($items) && count($items) > 0
    ? "PASS — getAll('item') : " . count($items) . " lignes\n"
    : "FAIL — getAll('item') : aucun résultat\n";

$themes = getAll($pdo, 'theme');
echo is_array($themes) && count($themes) > 0
    ? "PASS — getAll('theme') : " . count($themes) . " lignes\n"
    : "FAIL — getAll('theme') : aucun résultat\n";

$categories = getAll($pdo, 'category');
echo is_array($categories) && count($categories) > 0
    ? "PASS — getAll('category') : " . count($categories) . " lignes\n"
    : "FAIL — getAll('category') : aucun résultat\n";

// ============================================================
// getOne
// ============================================================

$item = getOne($pdo, 'item', 1);
echo is_array($item) && isset($item['id'])
    ? "PASS — getOne('item', 1) : trouvé\n"
    : "FAIL — getOne('item', 1) : non trouvé\n";

$missing = getOne($pdo, 'item', 999999);
echo $missing === false
    ? "PASS — getOne('item', 999999) : false attendu\n"
    : "FAIL — getOne('item', 999999) : devrait retourner false\n";

// ============================================================
// getOneBy
// ============================================================

$operator = getOneBy($pdo, 'operator', 'email', 'admin@example.com');
echo is_array($operator) && isset($operator['email'])
    ? "PASS — getOneBy('operator', 'email', 'admin@example.com') : trouvé\n"
    : "FAIL — getOneBy('operator', 'email', 'admin@example.com') : non trouvé\n";

$nobody = getOneBy($pdo, 'operator', 'email', 'inexistant@rien.xx');
echo $nobody === false
    ? "PASS — getOneBy('operator', 'email', 'inexistant@rien.xx') : false attendu\n"
    : "FAIL — getOneBy('operator', 'email', 'inexistant@rien.xx') : devrait retourner false\n";

// ============================================================
// getAllBy
// ============================================================

$collections = getAllBy($pdo, 'collection', 'operator_id', 1);
echo is_array($collections)
    ? "PASS — getAllBy('collection', 'operator_id', 1) : " . count($collections) . " lignes\n"
    : "FAIL — getAllBy('collection', 'operator_id', 1) : retour invalide\n";

$empty = getAllBy($pdo, 'collection', 'operator_id', 999999);
echo is_array($empty) && count($empty) === 0
    ? "PASS — getAllBy('collection', 'operator_id', 999999) : tableau vide attendu\n"
    : "FAIL — getAllBy('collection', 'operator_id', 999999) : devrait retourner un tableau vide\n";

// ============================================================
// exists
// ============================================================

echo exists($pdo, 'operator', 'email', 'admin@example.com') === true
    ? "PASS — exists('operator', 'email', 'admin@example.com') : true\n"
    : "FAIL — exists('operator', 'email', 'admin@example.com') : devrait être true\n";

echo exists($pdo, 'operator', 'email', 'inexistant@rien.xx') === false
    ? "PASS — exists('operator', 'email', 'inexistant@rien.xx') : false\n"
    : "FAIL — exists('operator', 'email', 'inexistant@rien.xx') : devrait être false\n";

// ============================================================
// create → update → delete (cycle complet sur message)
// ============================================================

$newId = create($pdo, 'message', [
    'name'    => 'Test User',
    'email'   => 'test@test.com',
    'content' => 'Message de test'
]);

echo $newId !== false && $newId > 0
    ? "PASS — create('message') : id = $newId\n"
    : "FAIL — create('message') : échec insertion\n";

// Vérifier que la ligne existe
$created = getOne($pdo, 'message', $newId);
echo is_array($created) && $created['email'] === 'test@test.com'
    ? "PASS — getOne après create : données cohérentes\n"
    : "FAIL — getOne après create : données incohérentes\n";

// Modifier
$updated = update($pdo, 'message', $newId, [
    'content' => 'Message modifié'
]);

echo $updated === true
    ? "PASS — update('message', $newId) : succès\n"
    : "FAIL — update('message', $newId) : échec\n";

// Vérifier la modification
$modified = getOne($pdo, 'message', $newId);
echo is_array($modified) && $modified['content'] === 'Message modifié'
    ? "PASS — getOne après update : contenu modifié\n"
    : "FAIL — getOne après update : contenu non modifié\n";

// Supprimer
$deleted = delete($pdo, 'message', $newId);
echo $deleted === true
    ? "PASS — delete('message', $newId) : succès\n"
    : "FAIL — delete('message', $newId) : échec\n";

// Vérifier la suppression
$gone = getOne($pdo, 'message', $newId);
echo $gone === false
    ? "PASS — getOne après delete : false attendu\n"
    : "FAIL — getOne après delete : la ligne existe encore\n";

// Supprimer un id inexistant
$deleteMissing = delete($pdo, 'message', 999999);
echo $deleteMissing === false
    ? "PASS — delete('message', 999999) : false attendu\n"
    : "FAIL — delete('message', 999999) : devrait retourner false\n";

// Update un id inexistant
$updateMissing = update($pdo, 'message', 999999, ['content' => 'x']);
echo $updateMissing === false
    ? "PASS — update('message', 999999) : false attendu\n"
    : "FAIL — update('message', 999999) : devrait retourner false\n";

echo "\n— Terminé —\n";
