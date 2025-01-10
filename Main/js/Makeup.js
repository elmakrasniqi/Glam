document.addEventListener('DOMContentLoaded', function() {
    
    const brandSelect = document.getElementById('brand-select');
    const productList = document.querySelector('.product-list');

    function filterProducts(brand) {
        const products = document.querySelectorAll('.product-item');
        
        products.forEach(product => {
            const productBrand = product.getAttribute('data-name');
            
            if (brand === '' || productBrand === brand) {
                product.style.display = 'flex';
            } else {
                product.style.display = 'none';
            }
        });
    }

    filterProducts('');

    brandSelect.addEventListener('change', (e) => {
        const selectedBrand = e.target.value;
        filterProducts(selectedBrand);
    });
});
document.getElementById('search-button').addEventListener('click',function(){
    var query = document.getElementById('search-bar').value.toLowerCase();
    var products = document.querySelectorAll('.product-item');
    
    products.forEach(function(product){
        var productName = product.querySelector('h3').textContent.toLowerCase();
        if(productName.includes(query)){
            product.style.display = 'block';
        }
        else{
            product.style.display = 'none';
        }
    });
});

window.addEventListener("resize", updateGridLayout);
window.addEventListener("load", updateGridLayout);

function updateGridLayout(){
    const screenWidth = window.innerWidth;
    
    let columns;
    
    if(screenWidth>=768){
        columns = 5;
    }else if (screenWidth>=480){
        columns = 2;
    }else{
        columns = 1;
    }
    const productList = document.querySelector(".product-list");
    productList.style.gridTemplateColumns = `repeat(${columns},1fr)`;
}

window.addEventListener("resize",adjustLayout);
window.addEventListener("load", adjustLayout);

function adjustLayout(){
    const searchBar = document.getElementById("search-bar");
    const searchButton = document.getElementById("search-button");
    const brandSelect = document.getElementById("brand-select");
    const search = document.getElementById("search");

    search.style.display = "flex";
    search.style.alignItems = "center";
    search.style.gap = "0";
    
    if(window.innerWidth<=768){
        searchBar.style.width = "70%";
        searchButton.style.padding = "8px 10px";
    }else{
        searchBar.style.width = "80%";
        searchButton.style.padding = "8px 12px";
    }
    if(window.innerWidth<=480){
        brandSelect.style.fontSize = "14px";
    }else{
        brandSelect.style.fontSize = "16px";
    }

}


    

