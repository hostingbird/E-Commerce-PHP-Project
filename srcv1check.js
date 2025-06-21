let n = document.querySelectorAll('input[type="radio"]');
document.getElementById('placeorder').addEventListener('click', (e) => {
    e.preventDefault();
    echo(document.getElementById('placeorder'));
});

function postToAnotherPage(data) {
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = 'secure-checkout.php';
    for (const key in data) {
        if (data.hasOwnProperty(key)) {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = key;
            input.value = data[key];
            form.appendChild(input);
        }
    }

    document.body.appendChild(form);
    form.submit();
}