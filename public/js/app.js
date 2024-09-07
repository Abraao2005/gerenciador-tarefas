document.addEventListener("DOMContentLoaded", function () {
    // Função para atualizar o modal de edição com dados da tarefa
    function updateEditModal(button) {
        let editTaskModal = document.querySelector("#editTaskModal");

        // Preenche os campos do modal
        let editTaskTitle = document.querySelector("#editTaskTitle");
        let editTaskDescription = document.querySelector("#editTaskDescription");
        let editTaskStatus = document.querySelector("#editTaskStatus");
        let taskId = document.querySelector("#editTaskId");

        // Atualiza os valores
        editTaskTitle.value = button.getAttribute("titulo");
        editTaskDescription.value = button.getAttribute("descricao");
        editTaskStatus.value = button.getAttribute("status") == 0 ? "pending" : "done";
        taskId.value = button.getAttribute("tarefaId");
    }

    // Adiciona event listeners aos botões de alterar
    document.querySelectorAll(".btn-alterar").forEach(function (btnAlterar) {
        btnAlterar.addEventListener("click", function () {
            updateEditModal(btnAlterar);
        });
    });

    // Oculta elementos com a classe "apper-none" após 5 segundos
    document.querySelectorAll(".apper-none").forEach(function (element) {
        setTimeout(() => {
            element.style.display = "none";
        }, 5000);
    });

    // Função para filtrar as tarefas
    function filterTarefas() {
        let filtro = document.querySelector("#filtro");

        if (filtro) {
            filtro.addEventListener("change", function () {
                document.querySelectorAll(".tarefas").forEach(tarefa => {
                    let button = tarefa.querySelector("button");
                    let status = button.getAttribute("status");

                    tarefa.classList.remove("show", "hide");

                    if (filtro.value === "all") {
                        tarefa.classList.add("show");
                    } else if (filtro.value === "pending") {
                        tarefa.classList.add(status == 0 ? "show" : "hide");
                    } else if (filtro.value === "done") {
                        tarefa.classList.add(status == 1 ? "show" : "hide");
                    }
                });
            });
        }
    }

    filterTarefas();
});
