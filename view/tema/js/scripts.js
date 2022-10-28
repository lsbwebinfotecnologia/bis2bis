$(function() {
  $('.date').mask('0000-00-00');
  $('.time').mask('00:00:00');
  $('.date_time').mask('00/00/0000 00:00:00');
  $('.cep').mask('00000-000');
  $('.phone').mask('(00) 00000-0000');
  $('.percent').mask('##0,00%', {reverse: true});

  $('.cnpj').mask('00.000.000/0000-00', {reverse: true});
  $('.cpf').mask('000.000.000-00', {reverse: true});
  $('.money').mask('##.##0,00', {reverse: true});
  $('.centimetro').mask('##0.00', {reverse: true});
  $('.gramas').mask('###0.00', {reverse: true});

});