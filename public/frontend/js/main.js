// ── Menu: hambúrguer (mobile) ──
const btnHamburguer = document.getElementById('btn-hamburguer');
const navLinks = document.querySelector('.nav-links');

if (btnHamburguer && navLinks) {
    btnHamburguer.addEventListener('click', () => {
        navLinks.classList.toggle('aberto');
        btnHamburguer.classList.toggle('ativo');
    });
}

// ── Menu: dropdown do usuário ──
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

// ── Navbar: sombra ao rolar a página ──
const navbar = document.getElementById('navbar');
if (navbar) {
    window.addEventListener('scroll', () => {
        navbar.classList.toggle('scrolled', window.scrollY > 30);
    });
}


console.log("funciona");
fetch('../src/modules/plantas/cardPlanta.php')
    .then(resposta => resposta.json())
    .then(dados => {
        console.log(dados);

        const catalogo = document.getElementById('catalogo-plantas');
        if (!catalogo) return;

        dados.forEach(planta => {
            console.log(planta.nome_comum);
            const Planta_element = document.createElement("div");
            Planta_element.classList.add("card-planta");

            Planta_element.innerHTML = `
                <img src="${planta.imagem_url}" alt="${planta.nome_comum}">
                <h2>${planta.nome_comum}</h2>
                <p>${planta.descricao}</p>
                <a href="pagina-planta.php?id=${planta.id}">
                    Ver planta
                </a>
            `;

            catalogo.appendChild(Planta_element);
        });
    })
    .catch(erro => console.error('Erro ao buscar plantas:', erro));



fetch('../src/modules/registro/gerarAlertaRegistro.php')
    .then(res => res.json())
    .then(alertas => {
        const container = document.getElementById('lista-alertas');
        if (!container) return;

        const mapaTexto = {
            'rega': 'regada',
            'adubo': 'adubada',
            'poda': 'podada'
        };

        const agrupado = {};

        alertas.forEach(alerta => {
            const chave = alerta.id_progresso;

            if (!agrupado[chave]) {
                agrupado[chave] = {
                    nome_comum: alerta.nome_comum,
                    id_progresso: alerta.id_progresso,
                    acoes: []
                };
            }

            agrupado[chave].acoes.push(
                `não é ${mapaTexto[alerta.tipo_acao]} há ${alerta.dias_sem_acao} dias!`
            );
        });

        Object.values(agrupado).forEach(planta => {
            const item = document.createElement('a');
            item.href = `paginaPlanta-user.html?id=${planta.id_progresso}`;
            item.classList.add('alerta-item');

            const listaAcoes = planta.acoes
                .map(acao => `<li>${acao}</li>`)
                .join('');

            item.innerHTML = `
                <strong>${planta.nome_comum}</strong>
                <ul>${listaAcoes}</ul>
            `;

            container.appendChild(item);
        });
    })
    .catch(erro => console.error('Erro ao buscar alertas:', erro));


// ── Previsão do tempo ──
const LAT_CANOAS = -29.9178;
const LON_CANOAS = -51.1836;

fetch(`https://api.open-meteo.com/v1/forecast?latitude=${LAT_CANOAS}&longitude=${LON_CANOAS}&current=temperature_2m,weather_code&daily=temperature_2m_max,temperature_2m_min,weather_code&timezone=America/Sao_Paulo`)
    .then(res => res.json())
    .then(dados => {
        console.log(dados);

        const container = document.getElementById('previsao-tempo');
        if (!container) return;

        const tempAtual = dados.current.temperature_2m;
        const codigoAtual = dados.current.weather_code;

        const condicoes = {
            0: 'Céu limpo',
            1: 'Principalmente limpo',
            2: 'Parcialmente nublado',
            3: 'Nublado',
            45: 'Neblina',
            48: 'Neblina',
            51: 'Garoa leve',
            53: 'Garoa',
            55: 'Garoa intensa',
            61: 'Chuva leve',
            63: 'Chuva',
            65: 'Chuva forte',
            80: 'Pancadas de chuva',
            95: 'Tempestade'
        };

        function getCondicao(codigo) {
            return condicoes[codigo] || 'Tempo variável';
        }

        let html = `
            <div class="clima-atual">
                <h2>${tempAtual}°C</h2>
                <p>${getCondicao(codigoAtual)}</p>
                <p>Canoas, RS</p>
            </div>
            <div class="previsao-dias">
        `;

        dados.daily.time.forEach((data, i) => {
            const condicaoTexto = getCondicao(dados.daily.weather_code[i]);
            const min = Math.round(dados.daily.temperature_2m_min[i]);
            const max = Math.round(dados.daily.temperature_2m_max[i]);

            const dataFormatada = new Date(data + 'T00:00:00').toLocaleDateString('pt-BR', {
                weekday: 'short',
                day: '2-digit',
                month: '2-digit'
            });

            html += `
                <div class="dia-previsao">
                    <p class="data-dia">${dataFormatada}</p>
                    <p class="condicao-dia">${condicaoTexto}</p>
                    <p class="temp-dia">${max}° / ${min}°</p>
                </div>
            `;
        });

        html += `</div>`;

        container.innerHTML = html;
    })
    .catch(erro => {
        console.error('Erro ao buscar previsão:', erro);
        const container = document.getElementById('previsao-tempo');
        if (container) {
            container.innerHTML = '<p>Não foi possível carregar a previsão.</p>';
        }
    });