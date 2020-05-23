async function ajaxDisplayAllsuppliers()
{
    let url = "php/get_all_suppliers.php";
    try
    {
        const response = await fetch(url,
                {
                    method: "GET",
                    headers: {'Content-type': 'application/x-www-form-urlencoded; charset=UTF-8'}
                });

        updateWebpage(await response.json());
    } catch (error)
    {
        console.log("Fetch failed: ", error);
    }


    /* use the fetched data to change the content of the webpage */
    function updateWebpage(jsonData)
    {
        let htmlString = '<table class="table supplier_table"><tr><th>ID</th><th>Company</th><th>Phone Number</th><th>Email</th><th>Location</th></tr>';
        for (let i = 0; i < jsonData.length; i++)
        {
            htmlString += '<tr class="details"><td>' + jsonData[i].supplier_id + '</td><td>' + jsonData[i].company_name + '</td><td>' + jsonData[i].phone_number+ '</td><td>' + jsonData[i].email + '</td><td>' + jsonData[i].location + '</td></tr>';
        }
        htmlString += '</table>';
        document.getElementById('supplier_table').innerHTML = htmlString;
    }
}

async function ajaxDisplayOrderRecords()
{
    let url = "php/get_all_order_records.php";
    try
    {
        const response = await fetch(url,
                {
                    method: "GET",
                    headers: {'Content-type': 'application/x-www-form-urlencoded; charset=UTF-8'}
                });

        updateWebpage(await response.json());
    } catch (error)
    {
        console.log("Fetch failed: ", error);
    }


    /* use the fetched data to change the content of the webpage */
    function updateWebpage(jsonData)
    {
        let htmlString = '<table class="table order_records"><tr><th>ID</th><th>Date</th><th>Total</th><th>Supplier ID</th></tr>';
        for (let i = 0; i < jsonData.length; i++)
        {
            htmlString += '<tr class="details"><td>' + jsonData[i].id_order_from_supplier + '</td><td>' + jsonData[i].date + '</td><td>' + jsonData[i].total+ '</td><td>' + jsonData[i].supplier_id + '</td>';
        }
        htmlString += '</table>';
        document.getElementById('order_records_table').innerHTML = htmlString;
    }
}

