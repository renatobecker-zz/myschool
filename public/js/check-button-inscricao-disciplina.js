$(function () {
    $('.button-checkbox').on('click', function (e) {

        e.preventDefault();
        // configurações
        var $widget = $(this),
            $button = $widget.find('button'),
            $checkbox = $widget.find('input:checkbox');
            $logged = $(this).data("logged") == 't';
            $disciplina = $(this).data("disciplina_id");    

            $span_count = "span_count_" + $disciplina;

        if ( $logged == true ) { 
            
            $.ajaxSetup({
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
            });

            $.ajax({
                    type: "POST",
                    url : "/disciplinas/inscricao_usuario",
                    data : {disciplina_id : $disciplina, inscrever : Boolean($checkbox.is(':checked'))},
                    success : function(data){
                        if ( $.isNumeric( data )) {

                            var id = $span_count;
                            var element = document.getElementById(id); //.value(data);     

                            if (element) {
                                element.innerHTML = data;
                            }
                        }
                    }
                },"json");

        } else {
            window.location.href = "/entrar";
        }    
    });
});