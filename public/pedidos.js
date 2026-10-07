$(document).ready(function () {

    function atualizarResumo() {
        const linhas = $('#tabelaPedidos tbody tr');

        $('#totalPedidos').text(linhas.length);
        $('#totalPendentes').text(
            linhas.filter('[data-status="Pendente"]').length
        );
        $('#totalAprovados').text(
            linhas.filter('[data-status="Aprovado"]').length
        );
    }

    function filtrarPedidos() {
        const busca = $('#buscaPedido').val().toLowerCase();
        const status = $('#filtroStatus').val();
        let encontrados = 0;

        $('#tabelaPedidos tbody tr').each(function () {
            const linha = $(this);
            const texto = linha.text().toLowerCase();
            const statusLinha = linha.attr('data-status');

            const correspondeBusca = texto.includes(busca);
            const correspondeStatus = !status || statusLinha === status;
            const mostrar = correspondeBusca && correspondeStatus;

            linha.toggle(mostrar);

            if (mostrar) {
                encontrados++;
            }
        });

        $('#semResultados').toggleClass('d-none', encontrados > 0);

        $('#contadorPedidos').text(
            'Exibindo ' + encontrados +
            (encontrados === 1 ? ' pedido' : ' pedidos')
        );
    }

    $('#buscaPedido').on('input', filtrarPedidos);
    $('#filtroStatus').on('change', filtrarPedidos);

    $('#tabelaPedidos').on('click', '.aprovar', function () {
        const linha = $(this).closest('tr');

        if (confirm('Deseja aprovar este pedido?')) {
            linha.attr('data-status', 'Aprovado');

            linha.find('.status')
                .removeClass('pending rejected')
                .addClass('approved')
                .text('Aprovado');

            linha.find('.actions').html(
                '<span class="text-muted">Em andamento</span>'
            );

            atualizarResumo();
            filtrarPedidos();
        }
    });

    $('#tabelaPedidos').on('click', '.recusar', function () {
        const linha = $(this).closest('tr');

        if (confirm('Deseja recusar este pedido?')) {
            linha.attr('data-status', 'Recusado');

            linha.find('.status')
                .removeClass('pending approved')
                .addClass('rejected')
                .text('Recusado');

            linha.find('.actions').html(
                '<span class="text-muted">Finalizado</span>'
            );

            atualizarResumo();
            filtrarPedidos();
        }
    });

    $('#btnNovoPedido').on('click', function () {
        const solicitante = prompt('Nome do solicitante:');

        if (solicitante === null || solicitante.trim() === '') {
            return;
        }

        const material = prompt('Nome do material solicitado:');

        if (material === null || material.trim() === '') {
            return;
        }

        const quantidade = Number(prompt('Quantidade solicitada:'));

        if (!Number.isInteger(quantidade) || quantidade <= 0) {
            alert('Informe uma quantidade inteira maior que zero.');
            return;
        }

        const linhas = $('#tabelaPedidos tbody tr');
        const codigo = 'PED-' + String(linhas.length + 1).padStart(3, '0');

        const novaLinha = $('<tr>').attr('data-status', 'Pendente');

        [
            codigo,
            solicitante.trim(),
            material.trim(),
            quantidade + ' un.',
            new Date().toLocaleDateString('pt-BR')
        ].forEach(function (valor, indice) {
            const celula = $('<td>').text(valor);

            if (indice === 2) {
                celula.addClass('material-name');
            }

            novaLinha.append(celula);
        });

        novaLinha.append(
            $('<td>').append(
                $('<span>')
                    .addClass('status pending')
                    .text('Pendente')
            )
        );

        novaLinha.append(
            $('<td>').addClass('actions').append(
                $('<button>')
                    .addClass('btn-action aprovar')
                    .text('Aprovar'),
                $('<button>')
                    .addClass('btn-action recusar')
                    .text('Recusar')
            )
        );

        $('#tabelaPedidos tbody').append(novaLinha);

        atualizarResumo();
        filtrarPedidos();

        alert('Pedido adicionado à tabela demonstrativa. Nenhum dado foi salvo.');
    });

    atualizarResumo();
    filtrarPedidos();
});