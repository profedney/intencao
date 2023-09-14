document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("votoForm");

    form.addEventListener("submit", function(event) {
        event.preventDefault();

        const candidato = document.getElementById("candidato").value;

        fetch("processa_voto.php", {
            method: "POST",
            body: JSON.stringify({ candidato }),
            headers: {
                "Content-Type": "application/json"
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Voto registrado com sucesso!");
                form.reset();
            } else {
                alert("Ocorreu um erro ao registrar o voto.");
            }
        })
        .catch(error => {
            console.error("Erro:", error);
        });
    });
});
