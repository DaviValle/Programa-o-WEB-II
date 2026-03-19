const marcaSelect = document.getElementById('marcaSelect');
const modeloSelect = document.getElementById('modeloSelect');

function carregarMarcas() {
    fetch('https://parallelum.com.br/fipe/api/v1/carros/marcas')
        .then(response => response.json())
        .then(marcas => {
            marcaSelect.innerHTML = '<option value="">Selecione uma marca</option>';

            marcas.forEach(marca => {
                const option = document.createElement('option');
                option.value = marca.codigo; 
                option.textContent = marca.nome; 
                marcaSelect.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Erro ao carregar marcas:', error);
            marcaSelect.innerHTML = '<option value="">Erro ao carregar marcas</option>';
        });
}

function carregarModelos(codigoMarca) {
    modeloSelect.disabled = true;
    modeloSelect.innerHTML = '<option value="">Carregando modelos...</option>';

    fetch(`https://parallelum.com.br/fipe/api/v1/carros/marcas/${codigoMarca}/modelos`)
        .then(response => response.json())
        .then(dados => {
            const modelos = dados.modelos;

            modeloSelect.innerHTML = '';

            if (modelos.length > 0) {
                modeloSelect.innerHTML = '<option value="">Selecione um modelo</option>';
                modelos.forEach(modelo => {
                    const option = document.createElement('option');
                    option.value = modelo.codigo;
                    option.textContent = modelo.nome;
                    modeloSelect.appendChild(option);
                });
                modeloSelect.disabled = false;
            } else {
                modeloSelect.innerHTML = '<option value="">Nenhum modelo encontrado</option>';
            }
        })
        .catch(error => {
            console.error('Erro ao carregar modelos:', error);
            modeloSelect.innerHTML = '<option value="">Erro ao carregar modelos</option>';
        });
}

marcaSelect.addEventListener('change', function() {
    const codigoMarca = this.value;

    if (codigoMarca) {
        carregarModelos(codigoMarca);
    } else {
        modeloSelect.disabled = true;
        modeloSelect.innerHTML = '<option value="">Primeiro selecione uma marca</option>';
    }
});

carregarMarcas();