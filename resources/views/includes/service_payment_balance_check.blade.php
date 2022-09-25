$('#amount').bind('input',function(){ 
    const balance = $("#balance").val();
    let amount = $(this).val();

    var result = balance - amount;

    if(result < 0) {
        alert('Entered amount, '+ amount + ' is greater than Balance');
        $(this).val('');
        return;
    }
    
});