

var element = document.getElementById('mail')

var url = new URLSearchParams(document.location.search)

var urlMail = url.get('mail')

document.getElementById('mail').value=urlMail

var error = url.get('login')


if(error != null){
    $('#errorConnexion').show();
}