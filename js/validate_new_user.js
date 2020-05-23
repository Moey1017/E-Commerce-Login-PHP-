function isNameValid()
{
    if (document.getElementById("name").value.length === 0)
    {
        document.getElementById("nameErrorMessage").innerHTML = "Please enter name!";
        return false;
    } else
    {
        document.getElementById("nameErrorMessage").innerHTML = "";
        return true;
    }
}

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

function isPasswordValid()
{
    let passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/;

    if (!passwordRegex.test(document.getElementById('password').value))
    {
        let passwordList = '<ul>';
        passwordList += '<li> Password must be atleast 8 characters. </li>';
        passwordList += '<li> Must contain at least 1 uppercase letter. </li>';
        passwordList += '<li> Must contain at least 1 lowercase letter. </li>';
        passwordList += '<li> Must contain at least 1 digit. </li>';
        passwordList += '<li> Must contain at least 1 special character. </li>';
        passwordList += '</ul>';
        document.getElementById("passwordErrorMessage").innerHTML = passwordList;
        return false;
    } else
    {
        document.getElementById("passwordErrorMessage").innerHTML = "";
        return true;
    }
}

function isConfirmPasswordValid()
{
    if (document.getElementById("confirmPassword").value.length === 0)
    {
        document.getElementById("confirmPasswordErrorMessage").innerHTML = "Please enter password.";
        return false;
    } else
    {
        if (document.getElementById("confirmPassword").value === document.getElementById('password').value) {
            document.getElementById("confirmPasswordErrorMessage").innerHTML = "";
            return true;
        } else {
            document.getElementById("confirmPasswordErrorMessage").innerHTML = "Passwords do not match.";
            return false;
        }
    }
}

function isFormValid()
{
    let nameIsValid = isNameValid();
    let emailIsValid = isEmailValid();
    let passwordIsValid = isPasswordValid();
    let confirmPasswordIsValid = isConfirmPasswordValid();

    if (nameIsValid && passwordIsValid && confirmPasswordIsValid && emailIsValid)
    {
        return true;
    } else
    {
        return false;
    }
}




