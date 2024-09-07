<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use PDOException;

class Tarefa extends Model
{
    use HasFactory;

    public function saveTarefa($title, $description, $status, $userId)
    {
        try {

            DB::insert("INSERT INTO tarefas (userId,titulo,descricao,status,created_at) values (?, ? , ? , ?, NOW())", [$userId, $title, $description, $status]);
        } catch (PDOException $exp) {
            throw new Exception($exp->getMessage());
        }
    }
    public function updateTarefa($taskId, $userId, $title, $description, $status)
    {
        try {
            DB::update(
                "UPDATE tarefas SET userId = ?, titulo = ?, descricao = ?, status = ?, updated_at = NOW() WHERE id = ?",
                [$userId, $title, $description, $status, $taskId]
            );
        } catch (PDOException $exp) {
            throw new Exception($exp->getMessage());
        }
    }

    public function getTarefas($userId)
    {
        try {

            return  DB::select('select * from tarefas where userId = ?', [$userId]);
        } catch (PDOException $exp) {
            throw new Exception($exp->getMessage());
        }
    }

    public function deleteTarefa($tarefaId)
    {
        try {
            DB::delete('DELETE FROM tarefas WHERE id = ?', [$tarefaId]);
        } catch (PDOException $exp) {
            throw new Exception($exp->getMessage());
        }
    }
}
