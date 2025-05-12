<?php

use Ramsey\Uuid\Rfc4122\UuidV4;
use Ramsey\Uuid\Uuid;
use src\database\Database;
use src\support\Sessions;

/**
 * Its responsible for get a session from index 'old'
 *
 * @param string $key
 * @return mixed
 */
function old(string $key)
{
    if (isset($_SESSION['old']) and isset($_SESSION['old'][$key]))
        return $_SESSION['old'][$key];

    return null;
}



/**
 * Its responsible for return if an index exist in 'isWrong' from $_SESSION
 *
 * @param string $key
 * @return mixed
 */
function isWrong(string $key)
{
    $sessionIsWrong = isset($_SESSION['isWrong']);
    if (!$sessionIsWrong)
        return null;
    else
        return isset($_SESSION['isWrong'][$key]);
}

/**
 * Its responsible for return a text from 'isWrong' in $_SESSION
 *
 * @param string $key
 * @return mixed
 */
function isWrongText(string $key)
{
    $sessionIsWrong = isset($_SESSION['isWrong']);
    if (!$sessionIsWrong)
        return null;
    else
        return isset($_SESSION['isWrong'][$key]) ? $_SESSION['isWrong'][$key] : null;
}


/**
 * Its responsible for forget multiples sessions
 *
 * @param array<int, string> $sessions
 * @return void
 */
function forgetSessions($sessions = []): void
{
    foreach ($sessions as $index => $session) {
        if (isset($_SESSION[$session])) unset($_SESSION[$session]);
    }
}

/**
 * Its responsible for return 'is-invalid' or 'is-valid' when isWrong contais a key
 *
 * @param string $key
 * @return mixed
 */
function applyWrong(string $key)
{
    if (Sessions::get('isWrong')) {
        $keyWrong = isWrong($key) ? 'is-invalid' : 'is-valid';
        return $keyWrong;
    }
    return null;
}

/**
 * Its responsible for return the text from isWrongText
 *
 * @param string $key
 * @return mixed
 */
function applyWrongText(string $key)
{
    if (Sessions::get('isWrong'))
        return isWrongText($key);
    return null;
}

/**
 * Its verify if session 'old' exists
 *
 * @return boolean
 */
function hasOld()
{
    return Sessions::get('old');
}

/**
 * Its apply old in checkbox simple
 *
 * @param string $key
 * @return string
 */
function applyOldCheck(string $key): string
{
    $isChecked = '';
    if (hasOld())
        $isChecked = old($key) ? 'checked' : '';
    else
        $isChecked = 'checked';
    return $isChecked;
}


/**
 * Its apply old in simple select
 *
 * @param mixed $value
 * @param string $key
 * @return mixed
 */
function applyOldSelectSimple($value, $key)
{
    if (!hasOld())
        return null;
    else
        return ($value === old($key)) ? 'selected' : '';
}

/**
 * Its responsible for apply old in input
 *
 * @param string $key
 * @return mixed
 */
function applyOldInput(string $key)
{
    if (hasOld())
        return old($key);
    else
        return null;
}


function make_log(string $conteudo, string $processo_uuid, ?string $etapa = null, ?string $usuario_chave = null, ?string $usuario_nome = null)
{
    $db = ((Database::setConfig())::get());
    $insert = "INSERT INTO sfp_ammx.logs (etapa, usuario_chave, usuario_nome, conteudo, processo_uuid, uuid) VALUES (:etapa, :usuario_chave, :usuario_nome, :conteudo, :processo_uuid, :uuid);";
    $stmt = $db->prepare($insert);
    return $stmt->execute([
        ":uuid" => UuidV4::uuid4()->toString(),
        ":etapa" => $etapa,
        ":usuario_chave" => $usuario_chave ?? user()->key,
        ":usuario_nome" => $usuario_nome ?? user()->name,
        ":conteudo" => $conteudo,
        ":processo_uuid" => $processo_uuid
    ]);
}


function notEmpty(string $v)
{
    return !empty($v);
}


function user()
{
    return (object) [
        "name" => $_SESSION["usuarioNome"] ?? 'test',
        "key" => $_SESSION["usuarioLogin"] ?? 'test'
    ];
}
