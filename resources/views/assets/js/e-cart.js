// ************************************************
// E-Cart - Fork Shopping Cart API
// ************************************************
var cartCopy = [];

var billetsCart = (function() {

    cart = [];

    // Constructor
    function Item(billet_id, reference, duedate, value, addition, discount, price, count, company_id) {
        this.billet_id = billet_id.toString().trim();
        this.reference = reference;
        this.duedate = duedate;
        this.value = value;
        this.addition = addition;
        this.discount = discount;
        this.price = price;
        this.count = count;
        this.company_id = company_id;
    }

    // Save cart
    function saveCart() {
        sessionStorage.setItem('billetsCart', JSON.stringify(cart));
        $('#cartPayment').val(JSON.stringify(cart))
        $('#cartBillets').val(JSON.stringify(cart))
    }

    // Load cart
    function loadCart() {
        cart = JSON.parse(sessionStorage.getItem('billetsCart'));
    }

    if (sessionStorage.getItem("billetsCart") != null) {
        loadCart();
    }

    // =============================
    var obj = {};

    // Add to cart
    obj.addItemToCart = function(billet_id, reference, duedate, value, addition, discount, price, count, company_id) {
        var item = new Item(billet_id, reference, duedate, value, addition, discount, price, count, company_id);
        cart.push(item);
        saveCart();
    }

    // Remove item from cart
    obj.removeItemFromCart = function(billetId) {
        for(var item in cart) {
            if(cart[item].billet_id == billetId) {
                cart[item].count --;
                if(cart[item].count === 0) {
                    cart.splice(item, 1);
                }
                break;
            }
        }
        saveCart();
    }

    // Clear cart
    obj.clearCart = function() {
        cart = [];
        saveCart();
    }

    // Count cart
    obj.totalCount = function() {
        var totalCount = 0;
        for(var item in cart) {
            totalCount += cart[item].count;
        }
        return totalCount;
    }

    // Total cart
    obj.totalCart = function() {
        var totalCart = 0;
        for(var item in cart) {
            totalCart += cart[item].price * cart[item].count;
        }
        return Number(totalCart.toFixed(2));
    }

    // Total fees
    obj.totalFees = function() {
        var totalFees = 0;
        for(var item in cart) {
            if(cart[item].addition != 0) {
                totalFees += parseFloat(cart[item].addition);
            }
        }
        return Number(totalFees.toFixed(2));
    }

    // Total sum
    obj.totalSum = function() {
        var totalSum = 0.00;

        for(var item in cart) {
            if(cart[item].value != 0){
                totalSum += cart[item].value;
            }
        }
        return Number(totalSum.toFixed(2));
    }

    return obj;
})();
