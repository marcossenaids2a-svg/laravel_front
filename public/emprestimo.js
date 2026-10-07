
$(document).ready(function () {

    function filtrarEmprestimos() {
        const busca = $('#busca').val().toLowerCase();
        const status = $('#filtroStatus').val();
        let encontrados = 0;

        $('#tabelaEmprestimos tbody tr').each(function () {
            const linha = $(this);
            const texto = linha.text().toLowerCase();
            const statusLinha = linha.attr('data-status');

            const correspondeBusca = texto.includes(busca);
            const correspondeStatus = !status || statusLinha === status;

            if (correspondeBusca && correspondeStatus) {
                linha.show();
                encontrados++;
            } else {
                linha.hide();
            }
        });

        $('#semResultados').toggleClass('d-none', encontrados > 0);
    }

    $('#busca').on('input', filtrarEmprestimos);
    $('#filtroStatus').on('change', filtrarEmprestimos);

    $('#tabelaEmprestimos').on('click', '.devolver', function () {
        const linha = $(this).closest('tr');

        if (linha.attr('data-status') === 'Devolvido') {
            return;
        }

        if (confirm('Deseja registrar a devolução deste material?')) {
            linha.attr('data-status', 'Devolvido');
            linha.find('.status')
                .removeClass('active pending')
                .addClass('returned')
                .text('Devolvido');

            $(this).replaceWith(
                '<span class="text-muted">Concluído</span>'
            );

            filtrarEmprestimos();
        }
    });

    $('#btnNovoEmprestimo').on('click', function () {
        const material = prompt('Digite o nome do material:');

        if (material === null || material.trim() === '') {
            return;
        }

        const responsavel = prompt('Digite o nome do responsável:');

        if (responsavel === null || responsavel.trim() === '') {
            return;
        }

        alert(
            'Formulário demonstrativo preenchido para "' +
            material.trim() +
            '", responsável: ' +
            responsavel.trim() +
            '. Nenhum dado foi salvo.'
        );
    });

});