function getURL()
{
    var idUrl = window.location; // http://google.com?id=test
    var query_string = idUrl.search;
    var search_params = new URLSearchParams(query_string);
    var page_number = search_params.get('page_number');
    var int_page_number = parseInt(page_number);
    return int_page_number;
}


async function ajaxPagination()
{
    let url = "php/pagination_links.php";
    let urlParameters = "";

    try
    {
        const response = await fetch(url,
                {
                    method: "POST",
                    headers: {'Content-type': 'application/x-www-form-urlencoded; charset=UTF-8'},
                    body: urlParameters
                });

        updateWebpage(await response.json());
    } catch (error)
    {
        console.log("Fetch failed: ", error);
    }

    function updateWebpage(jsonData)
    {
        let page_link;
        page_link = '<ul>';
        for (let i = 0; i < jsonData[0].num_of_links; i++)
        {
            page_link += '<li><a href="products.php?page_number=' + (i + 1) + '">0' + (i + 1) + '.</a></li>';
        }
        page_link += '</ul>';
        document.querySelector('div.product_pagination').innerHTML = page_link;
        ajaxAllProducts(getURL());
    }
}

async function ajaxAllProducts(page_number)
{
    let url = "php/get_all_products.php";
    let urlParameters = {page_number: page_number};
    try
    {
        const response = await fetch(url,
                {
                    method: "POST",
                    headers: {'Content-type': 'application/x-www-form-urlencoded; charset=UTF-8'},
                    body: JSON.stringify(urlParameters)
                });

        updateWebpage(await response.json());
    } catch (error)
    {
        console.log("Fetch failed: ", error);
    }

    function updateWebpage(jsonData)
    {
        let productString;
        for (let i = 0; i < jsonData.length; i++)
        {
            productString = '<div class="product">';
            productString += '<div class="product_header"><img src="' + jsonData[i].product_image + '" alt="'+jsonData[i].product_image+'"></div>';
            productString += '<div class="product_footer"><div class="product_details">';
            productString += '<div class="productInformation">Name: ' +jsonData[i].product_name+'</div>';
            productString += '<div class="productInformation">Price: €' +jsonData[i].price+'</div>';
            productString += '<div class="productInformation">Brand: ' +jsonData[i].brand+'</div></div>';
            productString += '<div class="product_details">';
            productString += '<div class="productInformation">Quantity: ' +jsonData[i].quantity + '</div>';
            productString += '<div class="productInformation">Description: ' + jsonData[i].description + '</div></div>';
            productString += '</div>';
            productString += '<a href="update_product.php?product_id=' + jsonData[i].product_id + '"><div class="productButtons"><div class="edit_btn"><button>Edit</button></div></a>';
            productString += '<a href="php/delete_product_transaction.php?product_id=' + jsonData[i].product_id + '"><div class="delete_btn"><button>Delete</button></div></div></div>';

            document.getElementById('products_container').innerHTML += productString;
        }
    }
}


