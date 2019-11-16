function submit_order()
{
    var data = JSON.stringify(cart);
    $('input#JSCartData').val(data);
    $('form#JSCartForm').submit();
}
function update_cart_qty(hash)
{
    var field = $('input#'+hash);
    var totalPrice = 0;
    for(i =0 ; i < cart.length; i++)
    {

        var cartItem = cart[i];
        var cartItemHash = cartItem.hash.trim();
        var cartItemPrice = Math.abs(parseFloat(cartItem.PRICE));
        var orderQty = Math.abs(parseInt(field.val()));
        var hash = hash.trim();

        if(cartItemHash == hash)
        {
                console.log('match ');
                cartItem.QTY =  orderQty;
                var tp = orderQty * cartItemPrice;
                cartItem.TP = tp;
                $('td[class="'+hash+'"]').text(tp);
        }else{
            console.log(hash  +' !== '+ cart[i].hash);
            console.log('my compare is' +hash)
            console.log('no match');
        }
        totalPrice += (cartItem.PRICE * cartItem.QTY)

    }
    $('table#orderTotalTable').html('');
    $('table#orderTotalTable').append(
        "<tr ><td colspan='3' class='text-center h4'>order total</td><td colspan='3' class='text-center h5'>"+ totalPrice + "</td>"
    );
    $('table#orderTotalTable').append(
        "<tr  class='text-center'><Td colspan='6'><a id='submitOrderForm' onclick='submit_order();' class='btn btn-info form-control' href='#submitOrderForm'>Submit Order</a></td>"
    );
}
function tp_calc()
{

    qty = $('#store_add_qty').val();
    price = $('#store_add_price').val();
    result = parseFloat(qty) * parseFloat(price);
    $('#store_add_tp').val(result);
    if(result != NaN && isFinite(result))
    {
        $('#store_add_tp').removeAttr('disabled');
    }
}
let cart = new Array();

function refresh_cart_ui()
{
    try{
    var table  = $('table#BASKET').html('');
    table.append('<tbody><td>id</td><td>name</td><td>Prife</td><td>QTY</td><td>TP</td><td>REMOVE</td></tbody>')
    for(var i=0; i < cart.length; i++)
    {
        var x = cart[i];
        var hash = x['hash'];
        var name = x['NAME'];
        var myQTY = x['QTY'];
        console.log('its '+typeof(myQTY));
        var myTP = x['TP'];
        var id = x['ID'];
        var price = x['PRICE'] ;
        var tpval =  (x['TP'] > 0 )  ?  x['TP']  :  0;
        var scriptQty = 'onchange="update_cart_qty(\''+hash+'\');"';
        var scriptRemove = 'onclick="remove_cart_item(\''+hash+'\')"';
        var qty = "<input type='number' id='"+hash+"'  class='form-control' step=(any) " + scriptQty  + "\" value=\""+myQTY+"\" />";
        var remove = "<a href='#' class='btn btn-danger form-control' " + scriptRemove +">Remove</a>";
        var tp = '<td class=\''+hash+'\'>'+tpval+'</td>';
        var view = "<tr>";
        view +=  "<td>" +  id + "</td>";
        view +=  "<td>" +  name+ "</td>";
        view +=  "<td>" +  price + "</td>";
        view +=  "<td>" +  qty + "</td>";
        view += tp;
        view +=                 "<Td>"+remove+"</td>";

        view += "</tr>";
        $('table#BASKET').append(view);
    }}
    catch(Exception)
    {

    }


}
function remove_cart_item(id)
{
    var newCart =new Array();
    for(let i=0;i<cart.length;i++)
    {
        x = cart[i];

        if(x.hash== id)
        {
            //delete(cart[i] );


        }else{
            newCart.push(cart[i]);
            console.log(id + ' ! === '+ x['hash']);
        }
    }
    cart = newCart;
update_cart_qty('AAA');
        refresh_cart_ui();

}
function JSCart(ID,NAME,PRICE)
{

    item = new Object();
    item ['hash']= Date.now() + '_' + (Math.floor(Math.random() * 100 +1));
    item['NAME']= NAME ;
    item['ID']= ID;
    item['PRICE'] = PRICE ;
    item['QTY'] = 0;
    item['TP'] = 0;
    cart.push(item);
    console.log(item);
    refresh_cart_ui();
}
