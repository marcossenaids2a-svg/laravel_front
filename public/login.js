
$(document).ready(function () {
    $('#toggleSenha').on('click', function () {
        const campo = $('#senha');
        const senhaOculta = campo.attr('type') === 'password';

        campo.attr('type', senhaOculta ? 'text' : 'password');

        $(this).text(senhaOculta ? 'Ocultar' : 'Mostrar');
        $(this).attr(
            'aria-label',
            senhaOculta ? 'Ocultar senha' : 'Mostrar senha'
        );
    });
});