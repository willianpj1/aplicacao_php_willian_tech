<?php

namespace app\controller;

use app\database\builder\InsertQuery;
use app\database\builder\DeleteQuery;
use app\database\builder\SelectQuery;

class User extends Base
{

    public function lista($request, $response)
    {
        try {
            $dadosTemplate = [
                'titulo' => 'Lista de Usuario'
            ];
            return $this->getTwig()
                ->render($response, $this->setView('listauser'), $dadosTemplate)
                ->withHeader('Content-Type', 'text/html')
                ->withStatus(200);
        } catch (\Exception $e) {
        }
    }
    public function cadastro($request, $response)
    {
        try {
            $dadosTemplate = [
                'titulo' => 'Cadastro de Usuario'
            ];
            return $this->getTwig()
                ->render($response, $this->setView('user'), $dadosTemplate)
                ->withHeader('Content-Type', 'text/html')
                ->withStatus(200);
        } catch (\Exception $e) {
        }
    }
    public function insert($request, $response)
    {

        try {
            $nome = $_POST['nome'];
            $sobrenome = $_POST['sobrenome'];
            $cpf = $_POST['cpf'];
            $rg = $_POST['rg'];
            $senha = $_POST['password'];

            $FieldsAndValues = [

                'nome' => $nome,
                'sobrenome' => $sobrenome,
                'senha' => $senha,
                'cpf' => $cpf,
                'rg' => $rg
            ];

            $IsSave = InsertQuery::table('usuario')->save($FieldsAndValues);

            if (!$IsSave) {
                echo 'Erro ao salvar';
                die;
            }
            echo "Salvo com sucesso!";
            die;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function listuser($request, $response)
    {
        #Captura todas a variaveis de forma mais segura VARIAVEIS POST.
        $form = $request->getParsedBody();

        #Qual a coluna da tabela deve ser ordenada.
        $order = $form['order'][0]['column'];

        #Tipo de ordenação
        $orderType = $form['order'][0]['dir'];

        #Em qual registro se inicia o retorno dos registro, OFFSET
        $form['start'];

        #Limite de registro a serem retornados do banco de dados LIMIT
        $form['length'];

        #O termo pesquisado
        $term = $form['search']['value'];

        $query = SelectQuery::select('id,nome,sobrenome')->from('usuario');

        /*if (!is_null($term) && ($term !== '')) {
            $query->where('usuario.nome', 'ilike', "{%$term%}", 'or')
                ->where('sobrenome', 'ilike', "{%$term%}");
        }*/
        $users = $query->fetchAll();
        
        $userData = [];
        foreach ($users as $key => $value) {
            $userData[$key] = [
                $value['id'],
                $value['nome'],
                $value['sobrenome'], 
                "<button class='btn btn-danger'>Excluir</button>
            <button class='btn btn-primary'>Editar</button>"
            ];
        }
            'status' => true,
            'recordsTotal' => 2,
            'recordsFiltered' => 2,
            'data' => [[
                1,
                'João',
                'Silva',
                "<button class='btn btn-danger'>Excluir</button>
                <button class='btn btn-primary'>Editar</button>"
            ]]
        ];
        $payload = json_encode($data);

        $response->getBody()->write($payload);

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);

        var_dump($from);
        /*
        order[0][column]
        order[0][dir]
        order[0][name]
        start
        length
        search[value]
*/


        echo 'oi';
        die;
    }
    public function delete($request, $response)
    {
        try {
            $id = $_POST['id'];
            $IsDelete = DeleteQuery::table('usuario')
                ->where('id', '=', $id)
                ->delete();

            if (!$IsDelete) {
                echo 'Erro ao deletar';
                die;
            }
            echo "Deletado com sucesso!";
            die;
        } catch (\Throwable $th) {
            echo "Erro: " . $th->getMessage();
            die;
        }
    }
}
