async function ajaxGetSupplierOptions()
{
    let url = "php/get_supplier_options_transaction.php";

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
        let htmlString = '';
        for (let i = 0; i < jsonData.length; i++)
        {
            htmlString += '<option value="' + jsonData[i].supplier_id + '">' + jsonData[i].supplier_id + ". " +  jsonData[i].company_name + '</option>';
        }
        document.getElementById('supplier_options').innerHTML = htmlString;
    }
}