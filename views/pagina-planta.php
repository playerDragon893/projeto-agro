<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plantou Colheu — Detalhes da Planta</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,300;0,9..144,400;0,9..144,600;0,9..144,700;0,9..144,800;1,9..144,400&family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php 
     include __DIR__ . '/../src/shared/auth.php'; 
    include __DIR__ . '/../src/shared/menu.php'; 
    ?>
</body>
</html>

<script>
async function comecarCultivo(idPlanta, data) {
    try {
        const resposta = await fetch(
           "/src/modules/users/addPlantaUser.php",
            {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    id_planta: idPlanta,
                    data_inicio_cultivo: data
                })
            }
        );

        const resultado = await resposta.json();
        
        if (resultado.sucesso) {
            console.log(resultado);
            alert("Cultivo iniciado com sucesso!");
            window.location.href = "jardim.php";
        } else {
            console.error(resultado.ERR);
            alert("Erro ao iniciar cultivo: " + (resultado.ERR || "Erro desconhecido"));
        }
    } catch(erro) {
        console.error(erro);
        alert("Erro ao iniciar cultivo");
    }
}

const params = new URLSearchParams(window.location.search);
const id = params.get("id");
console.log("ID da planta:", id);

if (!id) {
    document.body.innerHTML += `<div style="max-width: 600px; margin: 4rem auto; text-align: center; font-family: sans-serif;">
        <h2>Planta não encontrada</h2>
        <p>Por favor, selecione uma planta válida no catálogo.</p>
        <button onclick="window.history.back()" style="padding: 0.55rem 1.2rem; border: 2px solid var(--verde-claro); border-radius: 8px; cursor: pointer;">← Voltar</button>
    </div>`;
} else {
  
fetch(`../src/modules/plantas/paginaPlanta.php?id=${id}`)
        .then(res => res.json())
        .then(dados => {
            console.log("Dados recebidos:", dados);
            
            const planta = dados.planta;
            const fases = dados.fases;
            
            const card = document.createElement("div");
            card.classList.add("pagina-planta-card"); 
            card.innerHTML = `
                <div class="planta-header-wrapper">
                    <div class="planta-title-block">
                        <h1>${planta.nome_comum}</h1>
                        <h3>${planta.nome_cientifico}</h3>
                        <p class="planta-descricao">${planta.descricao}</p>
                    </div>
                    <div class="planta-image-block">
                        <img src="${planta.imagem_url || '../public/frontend/img/default-plant.jpg'}" alt="${planta.nome_comum}" onerror="this.src='data:image/svg+xml;utf8,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%22100%22 height=%22100%22 viewBox=%220 0 100 100%22><rect width=%22100%22 height=%22100%22 fill=%22%23e7f0e1%22/><text x=%2250%25%22 y=%2250%25%22 dominant-baseline=%22middle%22 text-anchor=%22middle%22 font-size=%2235%22 fill=%22%232f7a3d%22>🌱</text></svg>'">
                    </div>
                </div>
                
                <hr class="planta-divider">
                
                <div class="planta-specs-grid">
                    <div class="spec-card">
                        <div class="spec-icon">☀️</div>
                        <div class="spec-info">
                            <span class="spec-label">Horas de Sol</span>
                            <span class="spec-value">${planta.horas_sol_dia} h/dia</span>
                        </div>
                    </div>
                    <div class="spec-card">
                        <div class="spec-icon">🪱</div>
                        <div class="spec-info">
                            <span class="spec-label">Tipo de Solo</span>
                            <span class="spec-value">${planta.tipo_solo}</span>
                        </div>
                    </div>
                    <div class="spec-card">
                        <div class="spec-icon">🧪</div>
                        <div class="spec-info">
                            <span class="spec-label">pH do Solo</span>
                            <span class="spec-value">${planta.ph_solo_ideal}</span>
                        </div>
                    </div>
                    <div class="spec-card">
                        <div class="spec-icon">⛅</div>
                        <div class="spec-info">
                            <span class="spec-label">Clima</span>
                            <span class="spec-value">${planta.clima_adequado}</span>
                        </div>
                    </div>
                    <div class="spec-card">
                        <div class="spec-icon">🌡️</div>
                        <div class="spec-info">
                            <span class="spec-label">Temperatura</span>
                            <span class="spec-value">${planta.temperatura_min}°C a ${planta.temperatura_max}°C</span>
                        </div>
                    </div>
                    <div class="spec-card">
                        <div class="spec-icon">💧</div>
                        <div class="spec-info">
                            <span class="spec-label">Umidade Ideal</span>
                            <span class="spec-value">${planta.umidade_ideal}</span>
                        </div>
                    </div>
                    <div class="spec-card">
                        <div class="spec-icon">🗺️</div>
                        <div class="spec-info">
                            <span class="spec-label">Região Ideal</span>
                            <span class="spec-value">${planta.regiao_ideal}</span>
                        </div>
                    </div>
                    <div class="spec-card">
                        <div class="spec-icon">🫙</div>
                        <div class="spec-info">
                            <span class="spec-label">Tipo de Adubo</span>
                            <span class="spec-value">${planta.tipo_adubo}</span>
                        </div>
                    </div>
                    <div class="spec-card">
                        <div class="spec-icon">📅</div>
                        <div class="spec-info">
                            <span class="spec-label">Adubação</span>
                            <span class="spec-value">${planta.frequencia_adubacao}</span>
                        </div>
                    </div>
                    <div class="spec-card">
                        <div class="spec-icon">📐</div>
                        <div class="spec-info">
                            <span class="spec-label">Espaçamento</span>
                            <span class="spec-value">${planta.espacamento_cm} cm</span>
                        </div>
                    </div>
                    <div class="spec-card">
                        <div class="spec-icon">⬇️</div>
                        <div class="spec-info">
                            <span class="spec-label">Profundidade</span>
                            <span class="spec-value">${planta.profundidade_plantio_cm} cm</span>
                        </div>
                    </div>
                </div>

                <hr class="planta-divider">
                
                <div class="planta-problems-section">
                    <h2>⚠️ Problemas Comuns</h2>
                    <div class="problems-grid">
                        <div class="problem-card pest">
                            <strong>🐛 Pragas Comuns:</strong>
                            <p>${planta.pragas_comuns || 'Nenhuma registrada'}</p>
                        </div>
                        <div class="problem-card disease">
                            <strong>🍄 Doenças Comuns:</strong>
                            <p>${planta.doencas_comuns || 'Nenhuma registrada'}</p>
                        </div>
                    </div>
                </div>
                
                <hr class="planta-divider">

                <div class="planta-actions">
                    <button onclick="window.history.back()" class="btn btn-secondary">
                        ← Voltar
                    </button>
                    <button id="btn-comecar-cultivo" class="btn btn-primary">
                        🌱 Começar cultivo
                    </button>
                </div>

                <div id="modal-cultivo" class="modal">
                    <div class="modal-content">
                        <h2>Iniciar cultivo de ${planta.nome_comum}</h2>
                        <p class="modal-subtitle">Escolha a data em que você plantou ou planeja plantar para começarmos o acompanhamento.</p>

                        <label for="data-plantio">Data de plantio:</label>
                        <input type="date" id="data-plantio">

                        <div class="modal-botoes">
                            <button id="btn-cancelar" class="btn btn-secondary">
                                Cancelar
                            </button>
                            <button id="btn-confirmar" class="btn btn-primary">
                                Confirmar Cultivo
                            </button>
                        </div>
                    </div>
                </div>
            `;
            
            const fasesTitle = document.createElement("h2");
            fasesTitle.classList.add("fases-secao-titulo");
            fasesTitle.innerHTML = "📈 Fases de Crescimento e Cuidados";
            
            const fasesContainer = document.createElement("div");
            fasesContainer.classList.add("pagina-planta-fase-container");
            
            fases.forEach(fase => {
                const fase_planta = document.createElement("div");
                fase_planta.classList.add("planta-fase");

                fase_planta.innerHTML = `
                    <div class="fase-badge-number">${fase.ordem}</div>
                    <div class="fase-body">
                        <div class="fase-header">
                            <h2>Fase ${fase.ordem}</h2>
                            <h3>${fase.nome_fase}</h3>
                        </div>
                        <p class="fase-desc">${fase.descricao}</p>
                        <div class="fase-details">
                            <span class="fase-duracao">🕒 <strong>Duração:</strong> ${fase.duracao_dias} dias</span>
                            <span class="fase-dica">💡 <strong>Dica:</strong> ${fase.dica_cuidado}</span>
                        </div>
                    </div>
                `;

                fasesContainer.appendChild(fase_planta);
            });

            document.body.appendChild(card);
            document.body.appendChild(fasesTitle);
            document.body.appendChild(fasesContainer);
            
            // Eventos do modal
            const modal = document.getElementById("modal-cultivo");
            const btnComecar = document.getElementById("btn-comecar-cultivo");
            const btnCancelar = document.getElementById("btn-cancelar");
            const btnConfirmar = document.getElementById("btn-confirmar");
            const inputData = document.getElementById("data-plantio");
            
            // Define data padrão como hoje
            const hoje = new Date().toISOString().split('T')[0];
            inputData.value = hoje;

            btnComecar.addEventListener("click", () => {
                modal.style.display = "flex";
                modal.classList.add("show");
            });

            btnCancelar.addEventListener("click", () => {
                modal.style.display = "none";
                modal.classList.remove("show");
            });
            
            // Fechar ao clicar fora do conteúdo do modal
            modal.addEventListener("click", (e) => {
                if (e.target === modal) {
                    modal.style.display = "none";
                    modal.classList.remove("show");
                }
            });
            
            btnConfirmar.addEventListener("click", () => {
                const data = inputData.value;
                if (!data) {
                    alert("Por favor, selecione uma data válida.");
                    return;
                }
                comecarCultivo(id, data);
            });
        })
        .catch(erro => {
            console.error("Erro ao buscar dados da planta:", erro);
            document.body.innerHTML += `<div style="max-width: 600px; margin: 4rem auto; text-align: center; font-family: sans-serif; color: var(--alerta);">
                <h2>Erro ao carregar dados</h2>
                <p>Ocorreu um problema ao conectar ao banco de dados.</p>
                <button onclick="window.history.back()" style="padding: 0.55rem 1.2rem; border: 2px solid var(--verde-claro); border-radius: 8px; cursor: pointer; background: white;">← Voltar</button>
            </div>`;
        });
}


const btnDropdown = document.getElementById('btn-dropdown');
if (btnDropdown) {
    btnDropdown.addEventListener('click', (e) => {
        e.stopPropagation();
        btnDropdown.closest('.nav-dropdown').classList.toggle('aberto');
    });

    document.addEventListener('click', () => {
        document.querySelectorAll('.nav-dropdown.aberto').forEach(el => el.classList.remove('aberto'));
    });
}
</script>
