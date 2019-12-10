function setBold() {
    var menu = document.getElementById('menu').getAttribute("data-page"); // get current page name
    if (menu !== null) {
        // document.getElementById(menu).className = "active";
    }
}
    
    $('#number_of_ticket').on('input', function() {
        ticket = parseInt($(this).val())
        vacancy = parseInt($('#event_vacancy').val())
        if(vacancy < ticket){
            alert('số vé nhiều hơn số vé còn')
        }else{
            price = $('#event_price').val()   
            total = ticket * price
            $('#total').html( total + ' VND' )
        }
    });
    