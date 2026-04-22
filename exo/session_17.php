<?php

// ============================================================
// test.php — Vérification du Model
// ============================================================

require 'model.php';

// ============================================================
// Préconditions exactes du seed.sql
// ============================================================
// operator         : 10 lignes
// tag              : 10 lignes
// collection       : 10 lignes
// message          : 10 lignes
// item             : 10 lignes
// search           : 10 lignes
// item_tag         : 25 lignes
// collection_item  : 25 lignes
//
// Données repères :
// - operator id 1 = ada@lovelace.tech
// - item id 1 = Mechanical Keyboard
// - collection operator_id 8 = 3 lignes
// - collection operator_id 1 = 1 ligne

echo "=== TEST MODEL ===\n\n";

// ============================================================
// getAll
// ============================================================

$items = getAll($pdo, 'item');
echo is_array($items) && count($items) === 10
    ? "PASS — getAll('item') : 10 lignes\n"
    : "FAIL — getAll('item') : 10 lignes attendues\n";

$tags = getAll($pdo, 'tag');
echo is_array($tags) && count($tags) === 10
    ? "PASS — getAll('tag') : 10 lignes\n"
    : "FAIL — getAll('tag') : 10 lignes attendues\n";

$operators = getAll($pdo, 'operator');
echo is_array($operators) && count($operators) === 10
    ? "PASS — getAll('operator') : 10 lignes\n"
    : "FAIL — getAll('operator') : 10 lignes attendues\n";

$collections = getAll($pdo, 'collection');
echo is_array($collections) && count($collections) === 10
    ? "PASS — getAll('collection') : 10 lignes\n"
    : "FAIL — getAll('collection') : 10 lignes attendues\n";

$messages = getAll($pdo, 'message');
echo is_array($messages) && count($messages) === 10
    ? "PASS — getAll('message') : 10 lignes\n"
    : "FAIL — getAll('message') : 10 lignes attendues\n";

// ============================================================
// getOne
// ============================================================

$item = getOne($pdo, 'item', 1);
echo is_array($item)
    && isset($item['id'], $item['title'], $item['slug'])
    && $item['id'] == 1
    && $item['title'] === 'Mechanical Keyboard'
    && $item['slug'] === 'mechanical-keyboard'
    ? "PASS — getOne('item', 1) : Mechanical Keyboard\n"
    : "FAIL — getOne('item', 1) : valeur attendue non trouvée\n";

$operator = getOne($pdo, 'operator', 1);
echo is_array($operator)
    && isset($operator['id'], $operator['email'])
    && $operator['id'] == 1
    && $operator['email'] === 'ada@lovelace.tech'
    ? "PASS — getOne('operator', 1) : ada@lovelace.tech\n"
    : "FAIL — getOne('operator', 1) : valeur attendue non trouvée\n";

$missing = getOne($pdo, 'item', 999999);
echo $missing === false
    ? "PASS — getOne('item', 999999) : false\n"
    : "FAIL — getOne('item', 999999) : false attendu\n";

// ============================================================
// getOneBy
// ============================================================

$ada = getOneBy($pdo, 'operator', 'email', 'ada@lovelace.tech');
echo is_array($ada)
    && isset($ada['id'], $ada['email'])
    && $ada['id'] == 1
    && $ada['email'] === 'ada@lovelace.tech'
    ? "PASS — getOneBy('operator', 'email', 'ada@lovelace.tech') : id 1\n"
    : "FAIL — getOneBy('operator', 'email', 'ada@lovelace.tech') : résultat incorrect\n";

$tag = getOneBy($pdo, 'tag', 'slug', 'programming');
echo is_array($tag)
    && isset($tag['id'], $tag['name'], $tag['slug'])
    && $tag['id'] == 1
    && $tag['name'] === 'Programming'
    && $tag['slug'] === 'programming'
    ? "PASS — getOneBy('tag', 'slug', 'programming') : id 1\n"
    : "FAIL — getOneBy('tag', 'slug', 'programming') : résultat incorrect\n";

$nobody = getOneBy($pdo, 'operator', 'email', 'inexistant@rien.xx');
echo $nobody === false
    ? "PASS — getOneBy('operator', 'email', 'inexistant@rien.xx') : false\n"
    : "FAIL — getOneBy('operator', 'email', 'inexistant@rien.xx') : false attendu\n";

// ============================================================
// getAllBy
// ============================================================

$collectionsOf8 = getAllBy($pdo, 'collection', 'operator_id', 8);
echo is_array($collectionsOf8) && count($collectionsOf8) === 3
    ? "PASS — getAllBy('collection', 'operator_id', 8) : 3 lignes\n"
    : "FAIL — getAllBy('collection', 'operator_id', 8) : 3 lignes attendues\n";

$collectionsOf1 = getAllBy($pdo, 'collection', 'operator_id', 1);
echo is_array($collectionsOf1) && count($collectionsOf1) === 1
    ? "PASS — getAllBy('collection', 'operator_id', 1) : 1 ligne\n"
    : "FAIL — getAllBy('collection', 'operator_id', 1) : 1 ligne attendue\n";

$itemsOf8 = getAllBy($pdo, 'item', 'operator_id', 8);
echo is_array($itemsOf8) && count($itemsOf8) === 3
    ? "PASS — getAllBy('item', 'operator_id', 8) : 3 lignes\n"
    : "FAIL — getAllBy('item', 'operator_id', 8) : 3 lignes attendues\n";

$empty = getAllBy($pdo, 'collection', 'operator_id', 999999);
echo is_array($empty) && count($empty) === 0
    ? "PASS — getAllBy('collection', 'operator_id', 999999) : 0 ligne\n"
    : "FAIL — getAllBy('collection', 'operator_id', 999999) : 0 ligne attendue\n";

// ============================================================
// exists
// ============================================================

echo exists($pdo, 'operator', 'email', 'ada@lovelace.tech') === true
    ? "PASS — exists('operator', 'email', 'ada@lovelace.tech') : true\n"
    : "FAIL — exists('operator', 'email', 'ada@lovelace.tech') : true attendu\n";

echo exists($pdo, 'tag', 'slug', 'programming') === true
    ? "PASS — exists('tag', 'slug', 'programming') : true\n"
    : "FAIL — exists('tag', 'slug', 'programming') : true attendu\n";

echo exists($pdo, 'operator', 'email', 'inexistant@rien.xx') === false
    ? "PASS — exists('operator', 'email', 'inexistant@rien.xx') : false\n"
    : "FAIL — exists('operator', 'email', 'inexistant@rien.xx') : false attendu\n";

// ============================================================
// create → update → delete
// cycle complet sur message
// structure réelle : message(id, operator_id)
// ============================================================

$newId = create($pdo, 'message', [
    'operator_id' => 1
]);

echo $newId === 11
    ? "PASS — create('message') : id 11\n"
    : "FAIL — create('message') : id 11 attendu\n";

// Vérifier que la ligne existe
$created = getOne($pdo, 'message', $newId);
echo is_array($created)
    && isset($created['id'], $created['operator_id'])
    && $created['id'] == 11
    && $created['operator_id'] == 1
    ? "PASS — getOne après create : operator_id 1\n"
    : "FAIL — getOne après create : données incorrectes\n";

// Modifier
$updated = update($pdo, 'message', $newId, [
    'operator_id' => 2
]);

echo $updated === true
    ? "PASS — update('message', 11) : true\n"
    : "FAIL — update('message', 11) : true attendu\n";

// Vérifier la modification
$modified = getOne($pdo, 'message', $newId);
echo is_array($modified)
    && isset($modified['operator_id'])
    && $modified['operator_id'] == 2
    ? "PASS — getOne après update : operator_id 2\n"
    : "FAIL — getOne après update : operator_id 2 attendu\n";

// Supprimer
$deleted = delete($pdo, 'message', $newId);
echo $deleted === true
    ? "PASS — delete('message', 11) : true\n"
    : "FAIL — delete('message', 11) : true attendu\n";

// Vérifier la suppression
$gone = getOne($pdo, 'message', $newId);
echo $gone === false
    ? "PASS — getOne après delete : false\n"
    : "FAIL — getOne après delete : false attendu\n";

// Supprimer un id inexistant
$deleteMissing = delete($pdo, 'message', 999999);
echo $deleteMissing === false
    ? "PASS — delete('message', 999999) : false\n"
    : "FAIL — delete('message', 999999) : false attendu\n";

// Update un id inexistant
$updateMissing = update($pdo, 'message', 999999, ['operator_id' => 1]);
echo $updateMissing === false
    ? "PASS — update('message', 999999) : false\n"
    : "FAIL — update('message', 999999) : false attendu\n";

echo "\n=== TERMINE ===\n";
