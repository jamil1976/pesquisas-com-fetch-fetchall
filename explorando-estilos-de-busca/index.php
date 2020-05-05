<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("05.05 - Explorando estilos de busca");

require __DIR__ . "/../source/autoload.php";

use Source\Database\Connect;

/*
 * [ fetch ] http://php.net/manual/pt_BR/pdostatement.fetch.php
 *
 * o comando fetch traz somente o primeiro resultado. para abrir os demais usamos um while
 *
 */
fullStackPHPClassSession("fetch", __LINE__);
$connect = Connect::getInstance();
$read = $connect->query("SELECT * FROM users LIMIT 3");

if(!$read->rowcount()){
    echo "<p class='trigger warning'>Não obteve resulltados!</p>";
} else {
    while ($user = $read->fetch()){
        var_dump($user);
    }
}


/*
 * [ fetch all ] http://php.net/manual/pt_BR/pdostatement.fetchall.php
 *
 * O fetch All já traz em um só comando  um array de todos os resultados. Por ser tratar de
 * um array como resultado usamos o foreach para abri-lo
 *
 */
fullStackPHPClassSession("fetch all", __LINE__);

$read = $connect->query("SELECT * FROM users LIMIT 3");
foreach ($read->fetchAll() as $user){
    var_dump($user);
}

/*
 * [ fetch save ] Realizar um fetch diretamente em um PDOStatement resulta em um clear no buffer da consulta. Você
 * pode armazenar esse resultado em uma variável para manipilar e exibir posteriormente.
 */
fullStackPHPClassSession("fetch save", __LINE__);
$read = $connect->query("SELECT * FROM users LIMIT 2");
$result = $read->fetchAll();

//Sem fazer o foreach para separar os resultados
//ele vai abrir o resultado em um unico array de objetos
var_dump($result);

/*
 * [ fetch modes ] http://php.net/manual/pt_BR/pdostatement.fetch.php
 *
 * Os tres modos de busca em PHP
 */
fullStackPHPClassSession("fetch styles", __LINE__);
$read = $connect->query("SELECT * FROM users LIMIT 1");
foreach ($read->fetchAll() as $user){
    var_dump($user, $user->first_name);
}

$read = $connect->query("SELECT * FROM users LIMIT 1");
foreach ($read->fetchAll(PDO::FETCH_ASSOC) as $user){
    var_dump($user, $user['last_name']);
}

$read = $connect->query("SELECT * FROM users LIMIT 1");
foreach ($read->fetchAll(PDO::FETCH_NUM) as $user){
    var_dump($user, $user[3]);
}

$read = $connect->query("SELECT * FROM users LIMIT 1");
foreach ($read->fetchAll(PDO::FETCH_CLASS, \Source\Database\Entity\UserEntity::class) as $user) {
    /** @var \Source\Database\Entity\UserEntity $user */
    var_dump($user, $user->getFirstName());
}