function sendFetchEvent(event, fetchUrl, redirectUrl, smethod = 'POST') {
    event.preventDefault(); 

    let form = event.target;
    let formData = new FormData(form);

    fetch(fetchUrl, {
        method: smethod,
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            if(redirectUrl != "#") {
                window.location.href = redirectUrl;
                document.getElementById("alertBadge").innerHTML = data.message;
                showAlert(); 
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
            showAlert();
        }
    })
    .catch(error => {
        document.getElementById("alertBadge").innerText = "Ошибка при отправке запроса.";
        showAlert();
    });
}

