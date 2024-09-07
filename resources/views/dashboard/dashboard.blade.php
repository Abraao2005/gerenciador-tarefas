@extends('template.dashboard')

@section('conteudo')
    <!-- Cabeçalho -->
    <style>
        .show {
            display: flex !important;
        }

        .hide {
            display: none !important;
        }
    </style>
    <header class="bg-primary text-white text-center py-3">
        <h1>Gerenciador de Tarefas</h1>
    </header>

    <div class="container mt-5">
        <!-- Botão para abrir o modal -->
        <div class="input-group mb-3 d-flex justify-content-center ">
            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#taskModal">
                Adicionar Tarefa
            </button>
            <select id="filtro" class="form-selec">
                <option value="all">Todos</option>
                <option value="pending">Pendente</option>
                <option value="done">Concluido</option>

            </select>
        </div>

        @if (isset($save))
            <div class="alert alert-success apper-none" role="alert">
                {{ $save }}
            </div>
        @endif

        @if (isset($erro))
            <div class="alert alert-danger apper-none" role="alert">
                {{ $erro }}
            </div>
        @endif

        <!-- Lista de Tarefas -->
        <ul class="list-group list-unstyled text-black" id="taskList">
            <ul class="list-unstyled">
                @if (isset($tarefas))
                    @foreach ($tarefas as $tarefa)
                        <li
                            class="bg-white d-flex justify-content-between align-items-center p-3 mb-2 border rounded tarefas">
                            <div class="d-flex flex-column">
                                <p class="mb-0 fw-bold text-truncate" desc="{{ $tarefa->descricao }}">{{ $tarefa->titulo }}
                                </p>
                                <p class="mb-0 small">Status: {{ $tarefa->status == 0 ? 'Em andamento' : 'Completa' }}</p>
                            </div>
                            <div class="d-flex align-items-center">
                                <button class="btn btn-primary btn-sm me-2 btn-alterar" status="{{ $tarefa->status }}"
                                    titulo="{{ $tarefa->titulo }}" descricao="{{ $tarefa->descricao }}"
                                    tarefaId="{{ $tarefa->id }}" data-bs-toggle="modal"
                                    data-bs-target="#editTaskModal">Alterar</button>
                                <a href="{{ route('tarefaDelete', ['id' => $tarefa->id, 'userId' => $user[0]->id]) }}"
                                    class="btn btn-danger btn-sm text-white me-2">Excluir</a>

                            </div>
                        </li>
                    @endforeach
                @endif

            </ul>
        </ul>
    </div>

    <!-- Modal  -->
    <div class="modal fade" id="taskModal" tabindex="-1" aria-labelledby="taskModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="taskModalLabel">Nova Tarefa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="taskForm" action="{{ route('tarefaSave') }}" method="post">
                        @csrf
                        <input type="hidden" name="userId" value="{{ $user[0]->id }}">
                        <div class="mb-3">
                            <label for="taskTitle" class="form-label">Título</label>
                            <input type="text" class="form-control" id="taskTitle" name="taskTitle" required>
                        </div>
                        <div class="mb-3">
                            <label for="taskDescription" class="form-label">Descrição</label>
                            <textarea class="form-control" id="taskDescription" name="taskDescription" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="taskStatus" class="form-label">Status</label>
                            <select class="form-select" id="taskStatus" name="taskStatus">
                                <option value="pending" selected>Pendente</option>
                                <option value="done">Concluído</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" form="taskForm">Salvar Tarefa</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editTaskModal" tabindex="-1" aria-labelledby="editTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTaskModalLabel">Editar Tarefa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editTaskForm" action="{{ route('tarefaUpdate') }}" method="post">
                        @csrf
                        <input type="hidden" name="userId" value="{{ $user[0]->id }}">
                        <input type="hidden" id="editTaskId" name="taskId" value="">
                        <div class="mb-3">
                            <label for="editTaskTitle" class="form-label">Título</label>
                            <input type="text" class="form-control" id="editTaskTitle" name="taskTitle" required>
                        </div>
                        <div class="mb-3">
                            <label for="editTaskDescription" class="form-label">Descrição</label>
                            <textarea class="form-control" id="editTaskDescription" name="taskDescription" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="editTaskStatus" class="form-label">Status</label>
                            <select class="form-select" id="editTaskStatus" name="taskStatus">
                                <option value="pending">Pendente</option>
                                <option value="done">Concluído</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" form="editTaskForm">Salvar Tarefa</button>
                </div>
            </div>
        </div>
    </div>


    <script src="{{ url('js/app.js') }}"></script>

@endsection
