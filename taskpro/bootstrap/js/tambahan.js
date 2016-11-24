 $(function () {
    $(".textarea").wysihtml5();
    $('#listcategori').on('change',function(){
            var isica = $('#listcategori option:selected').val();
            $('#categories_id').val(isica);
            $('#id_categories').val(isica);
    });
    $('#articlelist').on('change',function(){
            var isic = $('#articlelist option:selected').val();
            $('#article_id').val(isic);
        });
     $('#listmenuid').on('change',function(){
            var isic_menu = $('#listmenuid option:selected').val();
            $('#menu_id').val(isic_menu);
        });
     $('#listporto').on('change',function(){
            var isic_menup = $('#listporto option:selected').val();
            $('#id_porto').val(isic_menup);
        });
  });