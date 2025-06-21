// document.addEventListener('DOMContentLoaded', function () {
    let removeDiv = document.querySelectorAll('[data-bs-target="#removeProfile"]') ? document.querySelectorAll('[data-bs-target="#removeProfile"]') : "";
    let conformDiv = document.querySelector('.btn-confirm-remove') ? document.querySelector('.btn-confirm-remove') : "";
    if (removeDiv) {
        removeDiv.forEach((btn) => {
            btn.addEventListener('click', (e) => {
                const addressId = btn.getAttribute('data-address');
                document.querySelector('#removeProfile .btn-confirm-remove').setAttribute('data-address', addressId);
            })
        });
    }
    if (conformDiv) {
        conformDiv.addEventListener('click', function () {
            const addressId = this.getAttribute('data-address');
            removeAddress(addressId);
        });
    }

    let addressDiv = document.getElementById('addnewaddress') ? document.getElementById('addnewaddress') : document.querySelector('button .btn');
    let addphone = document.getElementById('addphoneNumber') ? document.getElementById('addphoneNumber') : "";
    let dmyForms = document.querySelectorAll('.dummyForm') ? document.querySelectorAll('.dummyForm') : "";
    if (addressDiv && dmyForms) {
        dmyForms.forEach(form => {
            form.addEventListener('submit', (e) => {
                e.preventDefault();
            })
        });
        addressDiv.addEventListener('click', (event) => {
            event.preventDefault();
            const phoneValue = addphone.value;
            const phoneRegx = /^\d{10}$/;
            let name = document.getElementById('addfname') ? document.getElementById('addfname').value : "Address";
            let tag = document.getElementById('addtag') ? document.getElementById('addtag').value : "New";
            let line = document.getElementById('addline');
            let address = document.getElementById('addaddress');
            let nearby = document.getElementById('addnearby');
            let data = [];

            if (line.value === "") {
                noti("alert", "Please Enter address line", "warning");
            }
            else if (address.value === "") {
                noti("alert", "Please Enter address", "warning");
            }
            else if (name.value === "") {
                noti("alert", "Please Enter address Email", "warning");
            }
            else if (!phoneRegx.test(phoneValue)) {
                noti("alert", "Please Enter Valid 10 digit Mobile number", "warning")
            } else {
                let newAddress = {
                    name: name,
                    phone: addphone ? "+91" + addphone.value : "",
                    tag: tag,
                    line: line.value,
                    address: address.value,
                    nearby: nearby ? nearby.value : ""
                };
                data.push(newAddress);
                addAddress(data);
            }

        })
    }

    
// });





function removeAddress(addressId) {
    fetch('remove_address.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ address_id: addressId }),
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.querySelector(`[data-address="${addressId}"]`).closest('.address-box').remove();
                noti("", 'address removed', "success");
            } else {
                noti("error", 'Failed to remove address', "danger");
            }
        })
        .catch(error => console.error('Error:', error));
}
function addAddress(data) {
    fetch('address.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ addresses: data }),
    })
        .then(response => response.text())
        .then(text => {
            // console.log(text)
            const jsonResponse = JSON.parse(text);
            return jsonResponse;
        })
        .then(data => {
            if (data.success) {
                noti("", 'Address added successfully', "success");
                
                setTimeout(() => {
                    window.location.reload();
                }, 700);
            } else {
                noti("error", data.message || 'Failed to add address', "danger");
            }
        })
        .catch(error => console.error("Error: ", error));
}

let timeoutId2 = null;
function updateProfileField(fieldName, fieldValue) {
    if (timeoutId) {
        clearTimeout(timeoutId);
    }

    timeoutId = setTimeout(function () {
        var data = {
            fieldName: fieldName,
            fieldValue: fieldValue
        };

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'updateProfile.php', true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    data = JSON.parse(xhr.response);
                    if (data.status === 'success') {
                        console.log(data.message);
                        noti("Success", data.message, "success");
                    } else {
                        noti("error", data.message, "warning");
                    }
                } else {
                    data = JSON.parse(xhr.response);
                    noti("Error", data.message, "warning");
                }
            }
        };
        xhr.send(JSON.stringify(data));
    }, 500);
}
pname = document.getElementById('pname') ? document.getElementById('pname') : null;
pdob = document.getElementById('pdob') ? document.getElementById('pdob') : null;
pgender = document.getElementById('pgender') ? document.getElementById('pgender') : null;

if (pname && pdob && pgender) {
    pname.addEventListener('input', function () {
        let fullName = pname.value.trim();
        setTimeout(() => {
            updateProfileField('full_name', fullName);
        }, 500);
    });

    pdob.addEventListener('change', function () {
        let dob = pdob.value;
        setTimeout(() => {
            updateProfileField('dob', dob);
        }, 500);
    });

    pgender.addEventListener('change', function () {
        let gender = pgender.value;
        setTimeout(() => {
            updateProfileField('gender', gender);
        }, 500);
    });

}

function saveChanges() {
    var editModal = new bootstrap.Modal(document.getElementById('editProfile'));
    editModal.hide();
    setTimeout(() => {
        window.location.reload();
    }, 700);
}

