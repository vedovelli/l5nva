;(function($)
{
  'use strict';

  $(document).ready(function(){

    var $categoryForm = $('.category-form');

    $categoryForm.on('submit', function()
    {
      $(this).find('.dave-btn-salvar').button('loading');
    });

  });

})(window.jQuery);