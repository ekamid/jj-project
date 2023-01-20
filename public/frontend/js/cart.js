(function () {
    "use strict";
    countAndShowCartQuantity();

    function getCartFromLocalStorage() {
        let cart = localStorage.getItem("aj_cart");
        if (cart) {
            cart = JSON.parse(cart);

            return cart;
        }

        return [];
    }

    function getTotalCartQuantity() {
        let total = 0;
        const cartedProducts = getCartFromLocalStorage();

        cartedProducts.forEach(function (product) {
            total += product.quantity;
        });

        return total;
    }

    function countAndShowCartQuantity() {
        let total = getTotalCartQuantity();
        $(".my-cart-badge").text(`${total}`);
    }

    function addToCart() {
        let _id = $(this).attr("pId");
        let _name = $(this).attr("pName");
        let _price = $(this).attr("pPrice");
        let _image = $(this).attr("pImg");
        let _slug = $(this).attr("pSlug");
        let _quantity = 1;

        const newItem = {
            id: _id,
            name: _name,
            price: _price,
            image: _image,
            slug: _slug,
            quantity: _quantity,
        };

        const cartedProducts = getCartFromLocalStorage();

        let existingItem = cartedProducts.find(
            (item) => item.id === newItem.id
        );

        if (existingItem) {
            existingItem.quantity = existingItem.quantity + 1;
        } else {
            cartedProducts.push(newItem);
        }

        localStorage.setItem("aj_cart", JSON.stringify(cartedProducts));

        countAndShowCartQuantity();
    }

    $(".add-to-cart-btn").on("click", addToCart);
})();
