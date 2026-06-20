//card

console.log("funciona");
fetch('/projeto-agro/src/modules/plantas/cardPlanta.php')
    .then(resposta => resposta.json())
    .then(dados =>{
        console.log(dados);
        
        
        dados.forEach(planta => {
            console.log(planta.nome_comum);
            const Planta_element = document.createElement("div");    
            Planta_element.classList.add("card-planta");

            Planta_element.innerHTML = `
               
                <h2>${planta.nome_comum}</h2>
                <p>${planta.descricao}</p>
                <a href="planta.html?id=${planta.id}">
                    Ver planta
                </a>
            `;
            
            document.body.appendChild(Planta_element);
        
        });
    
    })


;