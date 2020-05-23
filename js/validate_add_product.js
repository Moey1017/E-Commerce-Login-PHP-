function isNameValid()
{
    if (document.getElementById("name").value.length === 0)
    {
        document.getElementById("nameErrorMessage").innerHTML = "Please enter a name.";
        return false;
    } else
    {
        document.getElementById("nameErrorMessage").innerHTML = "";
        return true;
    }
}

function isCategoryValid()
{
    if (document.getElementById("category").value.length === 0)
    {
        document.getElementById("categoryErrorMessage").innerHTML = "Please enter a category.";
        return false;
    } else
    {
        document.getElementById("categoryErrorMessage").innerHTML = "";
        return true;
    }
}

function isBrandValid()
{
    if (document.getElementById("brand").value.length === 0)
    {
        document.getElementById("brandErrorMessage").innerHTML = "Please enter a brand.";
        return false;
    } else
    {
        document.getElementById("brandErrorMessage").innerHTML = "";
        return true;
    }
}

function isImageURLValid()
{
    let validFileExt = "jpg|png|jpeg";

    let ext = document.getElementById("image").value.split('.').pop();

    if (!ext.match(validFileExt))
    {
        document.getElementById("imageErrorMessage").innerHTML = "Image must use one of the following extensions: " + validFileExt;
        return false;
    } else
    {
        if (document.getElementById("image").value.length === 0)
        {
            document.getElementById("imageErrorMessage").innerHTML = "Enter image name with file extension";
            return false;
        } else
        {
            document.getElementById("imageErrorMessage").innerHTML = "";
            return true;
        }
    }
}

function isPriceValid()
{
    if (document.getElementById("price").value.length === 0)
    {
        document.getElementById("priceErrorMessage").innerHTML = "Please enter a price.";
        return false;
    } else
    {
        let pricePattern = /^(\d*([.,](?=\d{3}))?\d+)+((?!\2)[.,]\d\d)?$/;
        if (!pricePattern.test(document.getElementById('price').value)) {
            document.getElementById('priceErrorMessage').innerHTML = "Not a valid price.";
            console.log('Price Failed');
            return false;
            
        }
        document.getElementById("priceErrorMessage").innerHTML = "";
        return true;
    }
}

function isDescriptionValid()
{
    if (document.getElementById("description").value.length === 0)
    {
        document.getElementById("descriptionErrorMessage").innerHTML = "Please enter a description.";
        return false;
    } else
    {
        document.getElementById("descriptionErrorMessage").innerHTML = "";
        return true;
    }
}

function isAvailabilityValid()
{
    if (document.getElementById("availability").value.length === 0)
    {
        document.getElementById("availabilityErrorMessage").innerHTML = "Please enter a quantity.";
        return false;
    } else
    {
        if (document.getElementById('availability').value <= 0) {
            document.getElementById("availabilityErrorMessage").innerHTML = "Availability must be greater than 0.";
            return false;
        }
        document.getElementById("availabilityErrorMessage").innerHTML = "";
        return true;
    }
}

function isFormValid() {
    let nameIsValid = isNameValid();
    let categoryIsValid = isCategoryValid();
    let brandIsValid = isBrandValid();
    let priceIsValid = isPriceValid();
    let descriptionIsValid = isDescriptionValid();
    let availabilityIsValid = isAvailabilityValid();
    let imageIsValid = isImageURLValid();
    

    if (nameIsValid && categoryIsValid && brandIsValid && priceIsValid && descriptionIsValid && availabilityIsValid && imageIsValid)
    {
        return true;
    } else
    {
        return false;
    }
}
