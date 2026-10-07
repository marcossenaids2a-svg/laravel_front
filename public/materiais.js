
$(document).ready(function () {

    function filtrarMateriais() {
        const busca = $('#buscaMaterial').val().toLowerCase();
        const categoria = $('#filtroCategoria').val();
        const disponibilidade = $('#filtroDisponibilidade').val();

        let encontrados = 0;

        $('#tabelaMateriais tbody tr').each(function () {
            const linha = $(this);
            const texto = linha.text().toLowerCase();

            const correspondeBusca = texto.includes(busca);
            const correspondeCategoria =
                !categoria || linha.attr('data-categoria') === categoria;
            const correspondeDisponibilidade =
                !disponibilidade ||
                linha.attr('data-disponibilidade') === disponibilidade;

            const mostrar =
                correspondeBusca &&
                correspondeCategoria &&
                correspondeDisponibilidade;

            linha.toggle(mostrar);

            if (mostrar) {
                encontrados++;
            }
        });

        $('#semResultados').toggleClass('d-none', encontrados > 0);
        $('#contadorMateriais').text(
            'Exibindo ' + encontrados +
            (encontrados === 1 ? ' material' : ' materiais')
        );
    }

    $('#buscaMaterial').on('input', filtrarMateriais);
    $('#filtroCategoria, #filtroDisponibilidade')
        .on('change', filtrarMateriais);

    $('#btnNovoMaterial').on('click', function () {
        const nome = prompt('Digite o nome do material:');

        if (nome === null || nome.trim() === '') {
            return;
        }

        const categoria = prompt(
            'Digite a categoria: Robótica, Eletrônica, Sensores, Ferramentas, Processamento ou Mecânica'
        );

        if (categoria === null || categoria.trim() === '') {
            return;
        }

        const localizacao = prompt('Digite a localização do material:');

        if (localizacao === null || localizacao.trim() === '') {
            return;
        }

        const quantidade = Number(
            prompt('Digite a quantidade em estoque:')
        );

        if (!Number.isInteger(quantidade) || quantidade < 0) {
            alert('Informe uma quantidade inteira igual ou maior que zero.');
            return;
        }

        const categoriasValidas = [
            'Robótica',
            'Eletrônica',
            'Sensores',
            'Ferramentas',
            'Processamento',
            'Mecânica'
        ];

        const categoriaFinal = categoriasValidas.find(function (item) {
            return item.toLowerCase() === categoria.trim().toLowerCase();
        });

        if (!categoriaFinal) {
            alert('Categoria inválida. Tente novamente.');
            return;
        }

        const linhas = $('#tabelaMateriais tbody tr');
        const proximoNumero = linhas.length + 1;
        const codigo = 'MAT-' + String(proximoNumero).padStart(3, '0');

        const disponibilidade = quantidade > 0
            ? 'Disponível'
            : 'Em uso';

        const classeStatus = quantidade > 0
            ? 'available'
            : 'in-use';

        const novaLinha = $('<tr>')
            .attr('data-categoria', categoriaFinal)
            .attr('data-disponibilidade', disponibilidade);

        [
            codigo,
            nome.trim(),
            categoriaFinal,
            localizacao.trim(),
            quantidade + ' un.',
            quantidade + ' un.'
        ].forEach(function (valor, indice) {
            const celula = $('<td>').text(valor);

            if (indice === 1) {
                celula.addClass('material-name');
            }

            if (indice === 2) {
                celula.empty().append(
                    $('<span>').addClass('category').text(valor)
                );
            }

            novaLinha.append(celula);
        });

        novaLinha.append(
            $('<td>').append(
                $('<span>')
                    .addClass('status ' + classeStatus)
                    .text(disponibilidade)
            )
        );

        $('#tabelaMateriais tbody').append(novaLinha);

        $('#totalMateriais').text(linhas.length);
        $('#totalDisponiveis').text(
            $('#tabelaMateriais tbody tr[data-disponibilidade="Disponível"]').length
        );
        $('#totalEmprestados').text(
            $('#tabelaMateriais tbody tr[data-disponibilidade="Em uso"]').length
        );

        filtrarMateriais();

        alert('Material adicionado à tabela demonstrativa. Ele não foi salvo.');
    });

    filtrarMateriais();
});