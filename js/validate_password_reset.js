function isEmailValid()
{
    if (document.getElementById('email').value.length === 0)
    {
        document.getElementById('emailErrorMessage').innerHTML = "Please enter email.";
    } else
    {
        let regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

        if (!regex.test(document.getElementById('email').value.toLowerCase()))
        {
            document.getElementById('emailErrorMessage').innerHTML = "Not an email address.";
            return false;
        } else
        {
            document.getElementById('emailErrorMessage').innerHTML = "";
            return true;
        }
    }
}

function isConfirmEmailValid()
{
    if (document.getElementById("confirmEmail").value.length === 0)
    {
        document.getElementById("confirmEmailErrorMessage").innerHTML = "Please enter email.";
        return false;
    } else
    {
        if (document.getElementById("confirmEmail").value === document.getElementById('email').value) {
            document.getElementById("confirmEmailErrorMessage").innerHTML = "";
            return true;
        } else {
            document.getElementById("confirmEmailErrorMessage").innerHTML = "Emails do not match.";
            return false;
        }
    }
}

function isFormValid()
{
    let emailIsValid = isEmailValid();
    let confirmEmailIsValid = isConfirmEmailValid();

    if (emailIsValid && confirmEmailIsValid)
    {
        return true;
    } else
    {
        return false;
    }
}







