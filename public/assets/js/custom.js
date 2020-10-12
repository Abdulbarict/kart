
//restrict download image
$("body").on("contextmenu", "img", function(e) {
    return false;
});
$('img').on('dragstart', function(event) { event.preventDefault(); });

function encodeURL(str) {

    str = (str + '');
    return encodeURIComponent(str)
    .replace(/!/g, '%21')
    .replace(/'/g, '%27')
    .replace(/\(/g, '%28')
    .replace(/\)/g, '%29')
    .replace(/\*/g, '%2A')
    .replace(/~/g, '%7E')
    .replace(/%20/g, '+');
} 

function isPhoneValid(phone) {

    var phone = phone.replace(/[^0-9]/g,'');

    if (phone.length<5)
        return false;
    else
        return true;
} 

function validateData(list, name, address, phone, zip, location, address_required) {
   // alert(list.length);
   // alert(list);
    list        = list.length > 0 ? true : false;
    phone       = isPhoneValid(phone);
    address     = address == '' ? false : true;
    name        = name == '' ? false : true;
    zip         = zip == '' ? false : true;
    location    = location == '' ? false : true;
    
    var arr = [];

    if (!list) {
        arr.push('Your cart is empty!');
    }

    if (!name) {
        arr.push('Please enter name!');
    }

    if (!phone) {
        arr.push('Enter a valid mobile number!');
    }

    if (!address && address_required) {
      
        arr.push('Address field is empty!');
    }

    if (!zip && address_required) {
      
    }
    return arr;
} 

function ItemsforMassage(items) {

    var total = 0;
    if (items.length > 0) {
        
        var item_str = '_Total items:_ *' + items.length + '*\n';

        for( var i = 0; i < items.length; i++ ) {
           

            item_str = item_str + "*" + (i + 1) + "* - " + $.trim(items[i].product_name) + " x " + items[i].product_quantity + "\n";

            total = total + parseFloat(items[i].product_price) * parseFloat(items[i].product_quantity);
        }
    }

    return {item_str, total};
} 

function formatMessage(items, total, price, order_note, extra_charge, identifier, delivery, name, address, phone, zip, location) {

    var items       = ItemsforMassage(items);
    
    var address_str = address == '' ? '' : '\n*_Address:_*\n' + address + '\n' + zip ;
    
    if (location != '') {

        var address_str = address_str + '\n*_Location:_*\nhttps://www.google.com/maps?q=' + location ;
    }

    var note_str    = order_note == '' ? '' : '\n*_Order Note:_*\n' + order_note + '\n' ;
    
    var charge_str  = extra_charge ? '\n_Inc Extra Charge: ' + extra_charge + '_\n' : '';
    var total_str   = price ? '\nTotal Payable: *' + total + '*' + charge_str : '';

    var option      = delivery.data('value');
   
    if (identifier == '')
    {
       
        var message = delivery.val() == 1 ? '*(' + option + ')*\n' : '';
    }
    else
        var message = delivery.val() == 1 ? '*(' + option + ' - ' + identifier + ')*\n' : '*(' + identifier + ')*\n';

    message = message + '\n' + items.item_str + total_str  + '\n' + note_str + '\n*_Name:_*\n' + name  + '\n*_Mobile:_*\n' + phone + address_str + '\n\n===============\nPlease confirm via reply.';

    return message;
} 

function insertDate(data, message, shop_phone) {
    
 
    $.ajax({
        method: 'POST',
        url: window.location.pathname,
        data: data,
        success: function(res) {

            if(res.success=='true')
            sendMessage(res.Prefix, message, shop_phone);
            else
            alert("Something went wrong!!");
          
            //alert(JSON.stringify(res.success));
        },
        error: function(e) {

            console.log(e);
            alert("Something went wrong!!");
        }
    });
} 

function sendMessage(token, message, wa_number) {

    console.log("*New Order : #" + (token) + "*\n" + message);
    url = "https://api.whatsapp.com/send?phone="+ wa_number + "&text=" + encodeURL("*New Order : #" + (token) + "*\n" + message);
  
    window.location.assign(url);
} 

function itemCount() {

    let cartList = JSON.parse($('#cart_list').val());
    
    if(cartList.length == 0) {

        $('.badge-wrapper').addClass('d-none');
    }else{

        $('.badge-wrapper').removeClass('d-none');
        $('.sc-cart-count').html(cartList.length);
    }
} 

function updateCart() {

    let cartList = JSON.parse($('#cart_list').val());
    itemCount();
    $.each(cartList, function(index, value) {

        $('#badge-quantity'+value.product_id).html(value.product_quantity);
        if (value.product_quantity > 0) {

            $('#badge-quantity' + value.product_id).removeClass('d-none');
        } else {

            $('#badge-quantity' + value.product_id).addClass('d-none');
        }
    });
} 

function search() {

    $('#about').hide();
    $('.category-link').removeClass('active');
    $('.all-category').addClass('active');
    var input = $('#search-input').val().toString().toUpperCase();
    var products = $('.product-details');
    var count = products.length;
    products.each(function(i, obj) {
        var value = $(this).data('product_name').toString().toUpperCase();
        if(value.indexOf(input) > -1) {
            $(this).fadeIn();
        }else{
            count--
            $(this).fadeOut();
        }
    });

    if(input.length === 0){
        $('#about').fadeIn();
    }
    if(count === 0){
        $('#noresult').removeClass('d-none');
        $('#noresult').removeClass('d-none');
        $('#noresult').html('<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> No result found');
    }else{
        $('#noresult').empty();
        $('#noresult').addClass('d-none');
    }
} 

function getLocation() {

    if (navigator.geolocation) {

        return navigator.geolocation.getCurrentPosition(showPosition);
    } else {

        return "Geolocation is not supported by this browser.";
    }
} 

function showPosition(position) {

    return (position.coords.latitude, position.coords.longitude);
}
