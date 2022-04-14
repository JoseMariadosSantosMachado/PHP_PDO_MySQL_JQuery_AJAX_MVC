window.modal_id;
var frm_modal=class frm_modal{ 
    new_modal(url, width) {
        width !== undefined ? width : width = 'lg';
        var id = (new Date).getDate() + "" + (new Date).getMilliseconds();
        var modal_id = id + "_modal";
        var div_modal = '<div class="modal fade" data-backdrop="static" data-keyboard="true" id="' + modal_id + '" style="overflow:hidden;">';
        div_modal += '<div class="modal-dialog modal-' + width + '  modal-dialog-centered modal-dialog-scrollable" id="div_' + id + '"></div>';
        div_modal += '</div>';
        $('body').append(div_modal);
        $('#div_' + id).html(url);
        $('#' + modal_id).modal('show');
        $('.modal-dialog').draggable({
            handle: ".card-header"
        });        
        $('#' + modal_id).on('hidden.bs.modal', function() {
            $('#' + modal_id).remove();
            try {
                $('body').attr("style", "padding-right: 0px;");
                $('body').remove($('#' + modal_id));
                $('.modal-backdrop').remove();                
            } catch (Error) {}
        });
        window.modal_id = modal_id;
        return modal_id;        
    };
    close_modal(modal_id) {
        $('#' + modal_id).remove();
        try {
            $('body').attr("style", "padding-right: 0px;");
            $('body').remove($('#' + modal_id));
        } catch (Error) {}
        $('.modal-backdrop').remove();        
    };
};
window.spinner_id;
var frm_spinner=class frm_spinner{ 
    new_spinner() {
        var id = (new Date).getDate() + "" + (new Date).getMilliseconds();
        var spinner_id = id + "_spinner";
        var div_modal = '<div class="modal fade" data-backdrop="static" tabindex="-1" id="' + spinner_id + '" data-keyboard="false">';
        div_modal += '<div class="modal-dialog modal-sm modal-dialog-centered modal-dialog-scrollable" >';
        div_modal += '<div class="modal-content" style="height: auto;" id="div_' + id + '">';
        div_modal += '<div class="d-flex justify-content-center">';
        div_modal += '<div class="spinner-border text-primary" style="width: 8rem; height: 8rem;" role="status">';
        div_modal += '<span class="sr-only">Carregando...</span>';
        div_modal += '</div>';
        div_modal += '</div>';
        div_modal += '</div>';
        div_modal += '</div>';
        div_modal += '</div>';
        $('body').append(div_modal);
        $('#' + spinner_id).modal('show');
        setTimeout(function(){
            var $head='<div class="card-header">';
            $head += '<div class="card-tools text-center">';
            $head += '<button type="button" class="btn btn-tool btn-secondary" data-dismiss="modal" title="Fechar">Cancelar?</button>';
            $head += '</div>';
            $head += '</div>';
            $('#div_' + id ).prepend($head);
        },5000);
        $('#' + spinner_id).on('hidden.bs.modal', function() {
            $('#' + spinner_id).remove();
            try {
                $('body').attr("style", "padding-right: 0px;");
                $('body').remove($('#' + spinner_id));                
                $('.modal-backdrop').remove();                
            } catch (Error) {}
            $('.modal-backdrop').remove();
        });
        window.spinner_id = spinner_id;
        return spinner_id;        
    };
    close_spinner(spinner_id) {
        $('#' + spinner_id).remove();
        try {
            $('body').attr("style", "padding-right: 0px;");
            $('body').remove($('#' + spinner_id));
        } catch (Error) {}        
        $('.modal-backdrop').remove();        
    };
};
