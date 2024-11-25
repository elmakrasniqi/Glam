document.addEventListener('DOMContentLoaded', function() {
    
    const brandSelect = document.getElementById('brand-select');
    const productList = document.querySelector('.product-list');

    function filterProducts(brand) {
        const products = document.querySelectorAll('.product-item');
        
        products.forEach(product => {
            const productBrand = product.getAttribute('data-name');
            
            if (brand === '' || productBrand === brand) {
                product.style.display = 'block';
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
