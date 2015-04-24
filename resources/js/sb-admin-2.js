$(function() {

    var $categories = $('#categories'),
        $owner = $('#owner'),
        $members = $('#members'),
        $tornarMeLider = $('#tornarMeLider'),
        $projectForm = $('#project-form'),
        $filtroCategories = $('#filtroCategories'),
        $filtro = $('#filtro'),
        $description = $('#description'),
        $sectionModal = $('#modalSection'),
        url = window.location;

    $('.select2').select2({allowClear: true});

    $projectForm.on('submit', function()
    {
      $(this).find('.dave-btn-salvar').button('loading');
    });

    /**
    * CMD + Enter para salvar
    */
    $description.on('keydown', function(event)
    {
      if(event.keyCode == 13 && event.metaKey)
      {
        $projectForm.submit();
      }
    });

    $sectionModal.on('shown.bs.modal', function()
    {
      $(this).find('#section').focus();
    });

    $sectionModal.on('hidden.bs.modal', function()
    {
      window.location.hash = '';
    });

    $(window).on('hashchange', function(event)
    {
      if(window.location.hash == '#secao')
      {
        $sectionModal.modal('show');
      }
    });

    $filtro.on('change', function()
    {
      var select = $(this),
          url = select.data('url'),
          val = select.val();

      if(val === null || val === '')
      {
        window.location = url;
      } else {
        window.location = url +'?orderby='+encodeURIComponent($(this).val());
      }
    });

    $filtroCategories.on('change', function()
    {
      var select = $(this),
          url = select.data('url'),
          val = select.val();

      if(val === null)
      {
        window.location = url;
      } else {
        window.location = url +'?categories='+encodeURIComponent($(this).val());
      }

    });

    if($tornarMeLider.length)
    {
      $tornarMeLider.on('click', function(event)
      {
        event.preventDefault();
        $owner.val($(this).data('userId')).trigger('change');
      });
    }

    $('#side-menu').metisMenu();

    $('.dave-datepicker').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,
        language: 'pt-BR',
        teste: 'teste'
    });

});

//Loads the correct sidebar on window load,
//collapses the sidebar on window resize.
// Sets the min-height of #page-wrapper to window size
$(function() {
    $(window).bind("load resize", function() {
        topOffset = 50;
        width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
        if (width < 768) {
            $('div.navbar-collapse').addClass('collapse');
            topOffset = 100; // 2-row-menu
        } else {
            $('div.navbar-collapse').removeClass('collapse');
        }

        height = ((this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height) - 1;
        height = height - topOffset;
        if (height < 1) height = 1;
        if (height > topOffset) {
            $("#page-wrapper").css("min-height", (height) + "px");
        }
    });

    var url = window.location;
    var element = $('ul.nav a').filter(function() {
        return this.href == url || url.href.indexOf(this.href) == 0;
    }).addClass('active').parent().parent().addClass('in').parent();
    if (element.is('li')) {
        element.addClass('active');
    }
});
