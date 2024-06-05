$('.painel-menu ul li a, .main-menu ul li a').click((e) => {
  $('.painel-menu ul li a').removeClass('active')
  $('.main-menu ul li a').removeClass('active')
  $('.main-content div').removeClass('active')
 
  const seletor = $(e.target).attr('href')
  $(`a[href="${seletor}"]`).addClass('active')

  $(`div${seletor}`).addClass('active')
})

$('.deletar-membro').click(function() {
  const id_membro = $(this).attr('id_membro');
  const el = $(this).parent().parent();
  $.ajax({
    method: 'post',
    data: {'id_membro': id_membro},
    url: 'deletar.php'
  }).done(function() {
    el.fadeOut(() => {
      el.remove()
    })
  })
})