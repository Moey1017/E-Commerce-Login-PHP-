function isCompanyValid()
{
    if (document.getElementById("company_name").value.length === 0)
    {
        document.getElementById("companyErrorMessage").innerHTML = "Please enter a company Name.";
        return false;
    } else
    {
        document.getElementById("companyErrorMessage").innerHTML = "";
        return true;
    }
}

function isPhoneNumberValid()
{
    if (document.getElementById("phone_number").value.length === 0)
    {
        document.getElementById("phoneErrorMessage").innerHTML = "Please enter a phone number.";
        return false;
    } else
    {
        document.getElementById("phoneErrorMessage").innerHTML = "";
        return true;
    }
}

function isEmailValid()
{
    if (document.getElementById("email").value.length === 0)
    {
        document.getElementById("emailErrorMessage").innerHTML = "Please enter a email.";
        return false;
    } else
    {
        document.getElementById("emailErrorMessage").innerHTML = "";
        return true;
    }
}

function isLocationValid()
{
    if (document.getElementById("location").value.length === 0)
    {
        document.getElementById("locationErrorMessage").innerHTML = "Please enter a location.";
        return false;
    } else
    {
        document.getElementById("locationErrorMessage").innerHTML = "";
        return true;
    }
}

function isFormValid()
{
    let companyIsValid = isCompanyValid();
    let emailIsValid = isEmailValid();
    let locationIsValid= isLocationValid();
    let phoneIsValid = isPhoneNumberValid();
    
    if(companyIsValid && emailIsValid && locationIsValid && phoneIsValid)
    {
        return true;
    }
    else
    {
        return false;
    }
}


