<?php
namespace App\Service;


use App\Config;
use App\Request;
use Dibi\Connection;
use Dibi\Exception;
use App\Response;
use Dibi\UniqueConstraintViolationException;

class Rest
{

    public function __construct()
    {
        $config = new Config(__DIR__ . '/../../config.json');
        $this->db = new Connection((array) $config->db);
    }


    public function get(Request $request)
    {
        try {
            $data = $this->db->select('*')->from($request->variable('table'))->where((array) $request->data())->fetchAll();
        } catch (Exception $e) {
            echo $e;
            return new Response(500, 'Chyba v databázi, kontaktujte správce');
        }
        return new Response(200, $data);
    }

    public function getOne(Request $request)
    {
        try {
            $data = $this->db->select('*')->from($request->variable('table'))->where('id = %u', $request->variable('id'))->fetch();
        } catch (Exception $e) {
            return new Response(500, 'Chyba v databázi, kontaktujte správce');
        }
        return new Response(200, $data);
    }

    public function post(Request $request)
    {
        try {
            $this->db->insert($request->variable('table'), $request->data())->execute();
        } catch (UniqueConstraintViolationException $e) {
            return new Response(400, 'Duplicitní záznam');
        } catch (Exception $e) {
            return new Response(500, 'Chyba v databázi, kontaktujte správce');
        }
        return new Response(201, $this->db->getInsertId());
    }

    public function put(Request $request)
    {
        try {
            $this->db->update($request->variable('table'), $request->data())->where($request->variable('id'))->execute();
        } catch (UniqueConstraintViolationException $e) {
            return new Response(400, 'Duplicitní záznam');
        } catch (Exception $e) {
            return new Response(500, 'Chyba v databázi, kontaktujte správce');
        }
        if ($this->db->getAffectedRows()) {
            return new Response(204, null);
        } else {
            return new Response(403, 'Nebyla změněna žádná data, neboť v stávající databázi již jsou identická.');
        }
    }

    public function delete(Request $request)
    {
        try {
            return $this->db->delete($request->variable('table'))->where($request->variable('id'))->execute();
        } catch (Exception $e) {
            return new Response(500, 'Chyba v databázi, kontaktujte správce');
        }
    }


}