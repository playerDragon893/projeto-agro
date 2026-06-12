
const plantas = [
    {
        id: 1,
        name: "banana",
        price:"1,99"
    },
    {
        id: 2,
        name: "tomate",
        price:"3,99"
    },
     {
        id: 3,
        name: "abobora",
        price:"9,99"
    }
]


plantas.forEach(planta =>{
    const card = document.createElement("div");
    

     card.innerHTML = `
        <h2>${planta.name}</h2>
        <p>R$ ${planta.price}</p>
        <a href="../../backend/apis-php/pagina-planta.php?id=${planta.id}">
        Ver produto
        </a>
    `;
    document.body.appendChild(card);
});