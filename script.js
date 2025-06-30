document.addEventListener("DOMContentLoaded",()=>{
    let itemQty = document.getElementsByClassName("itemQty");
    let grandTotal = document.getElementById("grand-total-price")
    for(let i = 0; i < itemQty.length; i++) {
        itemQty[i].addEventListener("input",(e)=>{
            let cartId = itemQty[i].getAttribute("data-cart-id");
            let priceElem = document.querySelector(`.pprice[data-cart-id="${cartId}"]`)
            let totalPriceElem = document.querySelector(`.total-price-item[data-cart-id="${cartId}"]`)
            if(totalPriceElem) {
                totalPriceElem.innerHTML = (e.target.value * priceElem.value).toLocaleString("en-US",{minimumFractionDigits: 2});
                let priceElems = document.querySelectorAll(".pprice");
                let grandTotalPrice = 0;
                for(let j = 0; j < priceElems.length; j++) {
                    let tempCartId = priceElems[j].getAttribute("data-cart-id")
                    let itemQtyById = document.querySelector(`.itemQty[data-cart-id="${tempCartId}"]`);
                    grandTotalPrice += (itemQtyById.value * priceElems[j].value);
                }
                grandTotal.innerHTML = grandTotalPrice.toLocaleString("en-US",{minimumFractionDigits: 2});
            }
        })
    }
})