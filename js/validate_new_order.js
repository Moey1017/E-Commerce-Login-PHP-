function isTotalValid()
{
    if (document.getElementById("total").value.length === 0)
    {
        document.getElementById("totalErrorMessage").innerHTML = "Please enter a total price.";
        return false;
    } else
    {
        let pricePattern = /(\d+\.\d{1,2})/;
        if (!pricePattern.test(document.getElementById('total').value)) {
            document.getElementById('totalErrorMessage').innerHTML = "Not a valid total price.";
            return false;
            
        }
        else
        {
            document.getElementById("totalErrorMessage").innerHTML = "";
            return true;
        }
    }
}

function isOrderFormValid()
{
    let totalIsValid = isTotalValid();
    
    if(totalIsValid)
    {
        return true;
    }
    else
    {
        return false;
    }
}