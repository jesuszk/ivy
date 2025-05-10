<?php

namespace src\services\shared;

use src\repositories\shared\UploadsRepository;

class UploadsService
{
    function __construct(private UploadsRepository $uploadsRepository) {}


    /**
     * Remove todos os anexos anteriores para o campo onde
     * processo_uuid, origem e origem_campo sejam iguais.
     * @return bool
     */
    function removePrevious(): bool
    {
        $configs = json_decode($_POST['configs'], true);
        return $this->uploadsRepository->delete()
            ->where("processo_uuid", '=', $configs["processo_uuid"])
            ->andWhere("origem", '=', $configs["origem"])
            ->andWhere("origem_campo", '=', $configs["origem_campo"])
            ->finish();
    }


    /**
     * Realiza validações simples de erro e tamanho
     * Upload para o diretório configurado no env
     * Cria registro na tabela uploads
     * @return array<string, mixed>|false
     */
    function save(): array|false
    {
        $file = $_FILES['file'];
        $file_name = $file['name'];
        $file_path = $file['tmp_name'];
        $file_size = $file['size'];
        $file_error = $file['error'];

        if ($file_error) {
            throw new \Exception('Error uploading file');
        }

        if ($file_size > 1024 * 1024 * 5) {
            throw new \Exception('File size too large');
        }


        $file_type = pathinfo($file_name, PATHINFO_EXTENSION);
        $new_file_name = uniqid() . uniqid() . '.' . $file_type;
        $new_file_path = $_ENV["APP_UPLOADS_DIR"] . '/' . $new_file_name;
        move_uploaded_file($file_path, $new_file_path);

        $configs = json_decode($_POST['configs'], true);
        $configs["usuario_chave"] = $_SESSION["usuarioLogin"];
        $configs["usuario_nome"] = $_SESSION["usuarioNome"];
        $configs["arquivo_nome"] = $new_file_name;
        $configs["arquivo_nome_original"] = $file_name;
        $configs["arquivo_tipo"] = $file_type;
        $configs["arquivo_tamanho"] = $file_size;
        $configs["arquivo_caminho"] = $new_file_path;

        return $this->uploadsRepository->do($configs);
    }


    /**
     * Atualiza os dados na tabela uploads
     * @return array|bool
     */
    function update(): array|bool
    {
        $json = file_get_contents('php://input');
        $object = (array) json_decode($json);
        $this->uploadsRepository->delete()
            ->where("processo_uuid", "=", $object["processo_uuid"])
            ->andWhere("origem_campo", "=", $object["origem_campo"])
            ->finish();
        return $this->uploadsRepository->updateByUuid($object['uuid'], $object);
    }
}
