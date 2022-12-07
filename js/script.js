// TOGGLE TOPBAR
const topbar = document.querySelector(".topbar");
let lastScroll = 0;

window.addEventListener("scroll", () => {
    const currentScroll = window.pageYOffset;

    if (currentScroll > lastScroll) {
        topbar.style.top = "-9rem";
    } else {
        topbar.style.top = "0"
    }

    lastScroll = currentScroll;
})

// AUTOMATE ORDER AMOUNT
const automateAmount = (event, price) =>{
    // Get the total amount by multiplying the price into the value of the quantity input field
    let subtotal = price * event.value
    let shipping_fee = document.getElementById("shipping_fee").value;
    let order_amount = subtotal + parseInt(shipping_fee); // Calculate the order amount

    document.getElementById("subtotal").innerHTML = subtotal.toLocaleString(); // Display subtotal with comma separated
    document.getElementById("order_amount").value = order_amount;
    document.getElementById("order_amount_viewer").innerHTML = order_amount.toLocaleString();
}

// HANDLE SEARCH PRODUCT
const searchInput = document.getElementById("search_input");
const searchSugg = document.querySelector(".search_sugg");
searchInput.addEventListener("keyup", function(){
    let xhr = new XMLHttpRequest(); // CREATE OBJECT
    xhr.open("GET", `./ajax_handler.php?product_sq=${this.value}`, true);
    xhr.addEventListener("readystatechange", function(){
        if(this.readyState == 4 && this.status == 200){
            searchSugg.style.display = "block";

            if(this.responseText.trim() == "No Suggestions"){
                searchSugg.innerHTML = this.responseText;
                return;
            }

            const suggestions = JSON.parse(this.responseText);
            let str = '';

            // EXTRACT ALL SUGGESTIONS
            suggestions.map((product)=>{
                str += `<a href="./view_product.php?product_id=${product.product_id}">
                    <img src="./product_img/${product.image}">
                    <p>${product.name}</p>
                </a>`;
            })

            searchSugg.innerHTML = str;
        }
    })
    xhr.send();
})
document.addEventListener("click", function(event) {
    // DO NOT HIDE THE SUGGESTION ELEMENT IF IT IS THE ONE THAT IS BEING CLICKED
    if(event.target === searchSugg) return;
    searchSugg.style.display = "none";
})

// SCROLL THE DOCUMENT UP TO THE PRODUCT LIST
function scrollIntoProduct(){
    document.querySelector(".product_section").scrollIntoView({behavior: 'smooth'});
}

