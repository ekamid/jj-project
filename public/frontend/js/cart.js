function getCartFromLocalStorage() {
    let cart = localStorage.getItem("aj_cart");
    if (cart) {
        cart = JSON.parse(cart);

        return cart;
    }

    return [];
}

function checkProductStock(id) {
    const baseUrl = window.location.origin;
    $.ajaxSetup({
        beforeSend: function (xhr, options) {
            options.url = baseUrl + `/products/${id}`;
        },
    });

    return $.get();
}

async function addToCart() {
    let _id = $(this).attr("pId");
    let _name = $(this).attr("pName");
    let _price = $(this).attr("pPrice");
    let _image = $(this).attr("pImg");
    let _slug = $(this).attr("pSlug");
    let _quantity = 1;

    const response = await checkProductStock(_id).done(function (response) {
        return response;
    });

    const product = response.data;

    const newItem = {
        id: _id,
        name: _name,
        price: _price,
        image: _image,
        slug: _slug,
        quantity: _quantity,
    };

    const cartedProducts = getCartFromLocalStorage();

    let existingItem = cartedProducts.find((item) => item.id === newItem.id);

    if (existingItem) {
        if (product.stock >= existingItem.stock) {
            alert("Product Out of Stock");
        }
        existingItem.quantity = existingItem.quantity + 1;
    } else {
        cartedProducts.push(newItem);
    }

    localStorage.setItem("aj_cart", JSON.stringify(cartedProducts));

    showCartQtyInBadge();
    calculateAndShowCartTotal();
}

//remove from cart - start

function removeItemFromCart() {
    let _id = $(this).parents("tr").attr("product_id");
    const cartedProducts = getCartFromLocalStorage();

    const updatedCartedProducts = cartedProducts.filter(
        (item) => item.id !== _id
    );

    localStorage.setItem("aj_cart", JSON.stringify(updatedCartedProducts));

    $("#cart_items").html("");
    showCartItems();
    showCartQtyInBadge();
    calculateAndShowCartTotal();
}
// end

// decrease cart quantity by 1 - start

function decreaseCartQuantity() {
    let _id = $(this).parents("tr").attr("product_id");

    const cartedProducts = getCartFromLocalStorage();

    let existingItem = cartedProducts.find((item) => item.id === _id);

    if (existingItem) {
        if (existingItem.quantity > 1) {
            existingItem.quantity = existingItem.quantity - 1;
        } else {
            alert("Least quantity has been decrease");
        }
    }

    $(this).parent().siblings("input").val(existingItem.quantity);
    $(this)
        .parents("tr")
        .find(".total-price")
        .text(`৳${existingItem.quantity * existingItem.price}`);

    localStorage.setItem("aj_cart", JSON.stringify(cartedProducts));

    showCartQtyInBadge();
    calculateAndShowCartTotal();
}

//end

// increase cart quantity by 1 - start

async function increaseCartQuantity() {
    let _id = $(this).parents("tr").attr("product_id");

    const cartedProducts = getCartFromLocalStorage();

    let existingItem = cartedProducts.find((item) => item.id === _id);

    const response = await checkProductStock(_id).done(function (response) {
        return response;
    });

    const product = response.data;

    if (existingItem) {
        if (existingItem.quantity < product.stock) {
            existingItem.quantity = existingItem.quantity + 1;
        } else {
            alert("Product Out Of Stock");
        }
    }

    $(this).parent().siblings("input").val(existingItem.quantity);
    $(this)
        .parents("tr")
        .find(".total-price")
        .text(`৳${existingItem.quantity * existingItem.price}`);

    localStorage.setItem("aj_cart", JSON.stringify(cartedProducts));

    showCartQtyInBadge();
    calculateAndShowCartTotal();
}

// end

function showCartItems() {
    const cartedItems = getCartFromLocalStorage();

    if (cartedItems && cartedItems.length) {
        let cart_items = "";

        cartedItems.forEach(function (item) {
            const { id, name, price, quantity, image } = item;
            const totalPrice = Number(price) * Number(quantity);
            cart_items += `<tr product_id="${id}">
                                    <td class="product-thumbnail">
                                        <img src="${image}" alt="${image}" class="img-fluid">
                                    </td>
                                    <td class="product-name">
                                        <h2 class="h5 text-black">${name}</h2>
                                    </td>
                                    <td>৳${price}</td>
                                    <td>
                                        <div class="input-group mb-3 d-flex align-items-center quantity-container"
                                            style="max-width: 120px;">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-outline-black decrease decrease-cart-quantity" 
                                                    type="button">&minus;</button>
                                            </div>
                                            <input disabled type="text" class="form-control text-center quantity-amount"
                                                value="${quantity}" placeholder="" aria-label="Example text with button addon"
                                                aria-describedby="button-addon1">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-black increase increate-cart-quantity"
                                                    type="button">&plus;</button>
                                            </div>
                                        </div>

                                    </td>
                                    <td  class="total-price">৳${totalPrice}</td>
                                    <td><button type="button" class="btn btn-black btn-sm remove-from-cart">X</button></td>
                                </tr>`;
        });

        $("#cart_items").html(cart_items);
    } else {
        $("#cart_table").html(
            "<h3 class='text-center w-100'>Your Cart is empty..</h3>"
        );

        $("#checkout_btn").removeClass("d-none");
    }

    showCartQtyInBadge();
    calculateAndShowCartTotal();
}

//set carted items to cookies
function setCartToCookie(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
}

function calculateAndShowCartTotal() {
    const deliveryCharge = 50;
    let subTotal = 0;
    const cartedItems = getCartFromLocalStorage();

    setCartToCookie("cartedItems", JSON.stringify(cartedItems), 7);

    cartedItems.forEach(function (item) {
        subTotal += item.quantity * item.price;
    });

    if (subTotal) {
        $("#checkout_btn").removeClass("d-none");
    }

    const total = subTotal + deliveryCharge;

    $("#cart_subtotal").html(`৳${subTotal}`);
    $("#cart_total").html(`৳${total}`);
    $("#cart_delivery_charge").html(`৳${deliveryCharge}`);
}

function getTotalCartQuantity() {
    let total = 0;
    const cartedProducts = getCartFromLocalStorage();

    cartedProducts.forEach(function (product) {
        total += product.quantity;
    });

    return total;
}

function showCartQtyInBadge() {
    let total = getTotalCartQuantity();
    $(".my-cart-badge").text(`${total}`);
}

(function () {
    "use strict";
    showCartQtyInBadge();

    $(".add-to-cart-btn").on("click", addToCart);

    $("#cart_items").on(
        "click",
        ".increate-cart-quantity",
        increaseCartQuantity
    );
    $("#cart_items").on(
        "click",
        ".decrease-cart-quantity",
        decreaseCartQuantity
    );

    $("#cart_items").on("click", ".remove-from-cart", removeItemFromCart);
})();
