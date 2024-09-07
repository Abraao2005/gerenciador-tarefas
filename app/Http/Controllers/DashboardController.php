<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tarefa;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

    public function showDashboard()
    {
        // Inicializa um array de dados
        $data = [];
        $tarefas = new Tarefa();

        // Verifica se o usuário está na sessão
        if (session()->has('user')) {
            $data['user'] = session('user');
            $id = $data["user"][0]->id;

            $data["tarefas"] = $tarefas->getTarefas($id);
            return view('dashboard.dashboard', $data);
        }

        // Caso não tenha um usuário, verifica se há um userId na sessão
        if (session()->has('userId')) {
            $user = new User();
            $data['user'] = $user->getUser(session('userId'));
            $id = $data["user"][0]->id;
            // Adiciona mensagens de erro ou sucesso, se existirem
            $data['erro'] = session('erro', null);
            $data['save'] = session('save', null);
            $data["tarefas"] = $tarefas->getTarefas($id);

            return view('dashboard.dashboard', $data);
        }

        // Se nenhum usuário ou userId estiver presente, redireciona para a página inicial
        return redirect()->route('home');
    }



    public function tarefaSave(Request $req)
    {
        $tarefa = new Tarefa();
        try {
            $userId = $req->input("userId");
            $title = $req->input("taskTitle");
            $description = $req->input("taskDescription");
            $status = $req->input("taskStatus") == "pending" ? 0 : 1;
            !$userId || !$title || !$description ? throw new Exception("Algum dado não informado") : "";
            if (strlen($title) > 50) {
                throw new Exception("Não é possivel adicionar um título com mais de 50 caracteres");
            }
            $tarefa->saveTarefa($title, $description, $status, $userId);
            return redirect()->route("dashboard")->with("userId", $userId)->with("save", "Tarefa foi salva!");
        } catch (Exception $err) {
            return redirect()->route("dashboard")->with("userId", $userId)->with("erro", $err->getMessage());
        }
    }
    public function tarefaDelete(Request $req)
    {
        $tarefa = new Tarefa();
        try {
            $userId = (int)$req->input('userId');
            $tarefaId = (int)$req->input('id');
            !is_int($tarefaId) || !is_int($userId) ? throw new Exception("Tarefa não encontrada!") : "";

            $tarefa->deleteTarefa($tarefaId);
            return redirect()->route("dashboard")->with("userId", $userId)->with("save", "Tarefa foi deletada!");
        } catch (Exception $err) {
            return redirect()->route("dashboard")->with("userId", $userId)->with("erro", $err->getMessage());
        }
    }
    public function tarefaUpdate(Request $req)
    {
        $tarefa = new Tarefa();
        try {
            $taskId = $req->input("taskId");
            $userId = $req->input("userId");
            $title = $req->input("taskTitle");
            $description = $req->input("taskDescription");
            $status = $req->input("taskStatus") == "pending" ? 0 : 1;
            !$userId || !$title || !$description ? throw new Exception("Algum dado não informado") : "";
            if (strlen($title) > 50) {
                throw new Exception("Não é possivel adicionar um título com mais de 50 caracteres");
            }

            $tarefa->updateTarefa($taskId, $userId, $title, $description, $status);
            return redirect()->route("dashboard")->with("userId", $userId)->with("save", "Tarefa foi atualizada!");
        } catch (Exception $err) {
            return redirect()->route("dashboard")->with("userId", $userId)->with("erro", $err->getMessage());
        }
    }
}
