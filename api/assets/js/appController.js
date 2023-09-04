function sendFetchEvent(event, fetchUrl, redirectUrl) {
    event.preventDefault(); 

    let form = event.target;
    let formData = new FormData(form);

    fetch(fetchUrl, {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            if(redirectUrl != "#") {
                window.location.href = redirectUrl; 
            }
        } else {
            document.getElementById("alertBadge").innerHTML = data.message + '<br>';
            for (let key in data.errors) {
                document.getElementsByName(key)[0].classList.toggle("is-invalid");
                document.getElementById("alertBadge").innerHTML += data.errors[key] + '<br>';
                setTimeout(() => {
                    document.getElementsByName(key)[0].classList.toggle("is-invalid");
                }, 2000);
            }
        }
    })
    .catch(error => {
        document.getElementById("alertBadge").innerText = "Ошибка при отправке запроса.";
    });
}


document.getElementById('loginForm').addEventListener('submit', function(event) {
    sendFetchEvent(event, '/api/login', '/');
});

document.getElementById('registerForm').addEventListener('submit', function(event) {
    sendFetchEvent(event, '/api/register', '/');
});

