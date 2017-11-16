jQuery.expr[":"].containsText = jQuery.expr.createPseudo(function(arg) {
    return function( elem ) {
        return jQuery(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
    };
});
$(document).ready(function(){
    $('.result-sort').on('change', function () {
        var url = $(this).val();
        if (url) {
            window.location = url;
        }
        return false;
    });


    $('.phone').mask('+7 (000) 000-00-00', {
        onKeyPress: function(cep, event, currentField, options){
            if(cep.length<3) currentField.val("+7 ");
        }
    });

    $('[name="rooms-selector"]').click(function() {
        var total = $('[name="rooms-selector"]').size();
        var items_checked = $('[name="rooms-selector"]:checked').size();
        var checked = $(this).prop("checked");
        var val = $(this).val();
        if(val=="all" && checked) {
            $('[name="rooms-selector"][value!="all"]').prop('checked', false);
        }else if(val=="all" && !checked){
            $('[name="rooms-selector"][value!="all"]').prop('checked', true);
        }
        else if($(this).val()!="all" && items_checked==0){
            $('[name="rooms-selector"][value="all"]').prop('checked', true);
        }
        else if(val!="all") {
            $('[name="rooms-selector"][value="all"]').prop('checked', false);
            if($(this).prop("checked") && $('[name="rooms-selector"][value!="all"]:checked').size()==(total-1)) {
                $('[name="rooms-selector"][value="all"]').prop('checked', true);
                $('[name="rooms-selector"][value!="all"]').prop('checked', false);
            }
        }
        $('[name="rooms-selector"]:checked').each(function() {
            $('[data-rooms="rooms-'+$(this).val()+'"').show();
        });
        $('[name="rooms-selector"]:not(:checked)').each(function() {
            $('[data-rooms="rooms-'+$(this).val()+'"').hide();
        });
        if($('[name="rooms-selector"][value="all"]').prop("checked")){
            $('[data-rooms]').show();
        }
    });
    $(".tabs").tabs({});
    $(".tablesorter").tablesorter( {sortList: [[0,0], [1,0]]} );
});

function CallPrint(strid) {
    var prtContent = document.getElementById(strid);
    var prtCSS = '';
    var WinPrint = window.open('','','left=50,top=50,width=900,height =640,toolbar=0,scrollbars=1,status=0');
    WinPrint.document.write('<html><head><title>Печать</title>' +
        '<link rel="stylesheet" type="text/css" href="/local/templates/horizont/template_styles.css">' +
        '<link rel="stylesheet" type="text/css" href="/local/templates/horizont/fonts/fonts.css">' +
        '</head><body><div id="print">');
    var print = document.createElement("div");
    print.setAttribute("id", "print");
    print.appendChild(prtContent.cloneNode(true));
    WinPrint.document.body.appendChild(print);
    WinPrint.document.write('</div></body></html>');
    WinPrint.focus();
    WinPrint.print();
    WinPrint.close();
}