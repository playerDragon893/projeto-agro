<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minha Planta</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php 
    session_start();
    include __DIR__ . '/../src/shared/menu.php'; ?>
    <div id="dados-planta">Carregando...</div>

    <hr>

    <div id="dados-fase"></div>

    <hr>

    <h3>Registrar cuidado</h3>
    <textarea id="observacao" placeholder="Observação (opcional)"></textarea><br>
    <button id="btn-rega">Reguei</button>
    <button id="btn-adubo">Adubei</button>
    <button id="btn-poda">Podei</button>
    <button onclick="window.history.back()">← Voltar</button>

<p id="mensagem-status"></p>

    <p id="mensagem-status"></p>

    <script>
        const params = new URLSearchParams(window.location.search);
        const idProgresso = params.get('id');

        fetch(`../src/modules/jardim/gerarPlantaUser.php?id=${idProgresso}`)
            .then(res => res.json())
            .then(dados => {
                console.log(dados);
                const planta = dados.planta;
                const fase = dados.fase_atual;

                document.getElementById('dados-planta').innerHTML = `
                <div class="planta-user-card">
                    <div class="planta-user-header">
                        <div>
                            <h1>${planta.nome_comum}</h1>
                            <h3>${planta.nome_cientifico}</h3>
                            <p class="planta-user-desc">${planta.descricao}</p>
                        </div>
                    </div>

                    <hr class="planta-divider">

                    <div class="planta-user-info-grid">
                        <div class="spec-card">
                            <div class="spec-icon">📅</div>
                            <div class="spec-info">
                                <span class="spec-label">Plantada em</span>
                                <span class="spec-value">${planta.data_inicio_cultivo}</span>
                            </div>
                        </div>

                        <div class="spec-card">
                            <div class="spec-icon">🌱</div>
                            <div class="spec-info">
                                <span class="spec-label">Status</span>
                                <span class="spec-value">${planta.status}</span>
                            </div>
                        </div>

                        <div class="spec-card">
                            <div class="spec-icon">⏳</div>
                            <div class="spec-info">
                                <span class="spec-label">Dias de cultivo</span>
                                <span class="spec-value">${dados.dias_passados}</span>
                            </div>
                        </div>
                    </div>
                </div>
                `;

                if (fase) {
                   document.getElementById('dados-fase').innerHTML = `
                <div class="fase-atual-card">
                    <div class="fase-atual-header">
                        <h2>🌿 Fase Atual</h2>
                        <span class="fase-badge">${fase.nome_fase}</span>
                    </div>

                    <p class="fase-desc">${fase.descricao}</p>

                    <div class="planta-specs-grid">
                        <div class="spec-card">
                            <div class="spec-icon">💧</div>
                            <div class="spec-info">
                                <span class="spec-label">Água por dia</span>
                                <span class="spec-value">${fase.agua_ml_dia} ml</span>
                            </div>
                        </div>

                        <div class="spec-card">
                            <div class="spec-icon">📆</div>
                            <div class="spec-info">
                                <span class="spec-label">Rega</span>
                                <span class="spec-value">A cada ${fase.frequencia_rega_dias} dias</span>
                            </div>
                        </div>
                    </div>

                    <div class="fase-dica-box">
                        💡 ${fase.dica_cuidado}
                    </div>
                </div>
                `;
                }
            })
            .catch(erro => console.error('Erro:', erro));


          
    fetch(`../src/modules/registro/verificarRegistro.php?id=${idProgresso}`)
        .then(res => res.json())
        .then(tiposFeitosHoje => {
            if (tiposFeitosHoje.includes('rega')) {
                document.getElementById('btn-rega').disabled = true;
            }
            if (tiposFeitosHoje.includes('adubo')) {
                document.getElementById('btn-adubo').disabled = true;
            }
            if (tiposFeitosHoje.includes('poda')) {
                document.getElementById('btn-poda').disabled = true;
            }
        })
        .catch(erro => console.error('Erro ao verificar registros:', erro));


        function registrarAcao(tipo) {
            const observacao = document.getElementById('observacao').value;

            fetch('../src/modules/registro/criarRegistro.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    id_progresso_usuario: idProgresso,
                    tipo_acao: tipo,
                    observacao: observacao
                })
            })
            .then(res => res.json())
            .then(resposta => {
                document.getElementById('mensagem-status').innerText = resposta.mensagem || resposta.erro;

                if (!resposta.erro) {
                    document.getElementById(`btn-${tipo}`).disabled = true;
                    document.getElementById('observacao').value = '';
                }
            })
            .catch(erro => console.error('Erro:', erro));
        }

        document.getElementById('btn-rega').addEventListener('click', () => registrarAcao('rega'));
        document.getElementById('btn-adubo').addEventListener('click', () => registrarAcao('adubo'));
        document.getElementById('btn-poda').addEventListener('click', () => registrarAcao('poda'));
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
</body>
</html>