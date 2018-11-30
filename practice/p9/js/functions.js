
    var price = 0;
    var subtotal_price = 0;
    var tax_price = 0;
    var shipping_price = 0;
    var total_price = 0;
    
    var products = [{ name: 'Fruit Cake', type: 'fruit_cake', price: 30 },
                    { name: 'Pinata', type: 'pinata', price: 20 }];
    var fees = [{ name: 'Shipping', type: shipping_price },
                { name: 'Subtotal', type: subtotal_price },
                { name: 'Tax', type: tax_price },
                { name: 'Total', type: total_price }];
    
    window.onload = startPage();

    function startPage() {
        displayCart();
        displayOptions();
        displayTerms();
        displayPurchase();
    }
    
    function displayCart() {
        $('#cart').append("<table align='center'>");
        $('#cart').append("<tr><td><strong>Product</strong></td>"
                              + "<td><strong>Unit Price</strong></td>"
                              + "<td><strong>Quantity</strong></td>"
                              + "<td><strong>Total</strong></td></tr>");
                              
        for (var p of products) {
            $('#cart').append("<tr><td>" + p.name + "</td>"
                              + "<td>$" + p.price + "</td>"
                              + "<td><input type='text' name='" + p.type + "_price'></td>"
                              + "<td><div id='" + p.type + "_total'>$0</div></td></tr>");
        }
        
        for (var f of fees) {
            $('#cart').append("<tr><td>" + f.name + "</td>"
                              + "<td></td>"
                              + "<td></td>"
                              + "<td><div id='" + f.name + "'>$" + f.type + "</div></td></tr>");
        }
        $('#cart').append('</table>');
        
        //$('input[name=fruit_cake_price]:value').change(function() {
           //updateCart();
        //});
        
    }
    
    function updateCart() {
        $('#Shipping').empty();
        $('#Shipping').append('$' + shipping_price);
        
        subtotal_price = price + shipping_price;
        $('#Subtotal').empty();
        $('#Subtotal').append('$' + subtotal_price);
        
        tax_price = subtotal_price * .1;
        $('#Tax').empty();
        $('#Tax').append('$' + tax_price);
        
        total_price = subtotal_price + tax_price;
        $('#Total').empty();
        $('#Total').append('$' + total_price);
    }
    
    function displayOptions() {
        $('#options').append("<form>"
                                + "<input type='radio' name='shipping' value='next_day'>Next-Day Delivery: $15.00<br>"
                                + "<input type='radio' name='shipping' value='three_day'>Three-Day Delivery: $10.00<br>"
                                + "<input type='radio' name='shipping' value='regular'>Regular Shipping (5-8 days): $5.00<br>"
                                + "<br></form>");
    }
    
    function displayTerms() {
        $('input[name=shipping]').click(function() {
            switch ($('input[name=shipping]:checked').val()) {
                case 'next_day':
                    shipping_price = 15;
                    break;
                case 'three_day':
                    shipping_price = 10;
                    break;
                case 'regular':
                    shipping_price = 5;
                    break;
                default:
                    shipping_price = 0;
                    break;
            }
            updateCart();
        });
    }
    
    function displayPurchase() {
        $('#accept').click( function() {
            console.log("clicked!");
            verifyPurchase()
        });
    }
    
    function verifyPurchase() {
        console.log($('input[name=shipping]:checked').val());
        if (!$('#terms_accepted').prop('checked')) {
            return;
        }
        goToCart();
    }
    
    function goToCart() {
        console.log("Purchase successful!");
    }