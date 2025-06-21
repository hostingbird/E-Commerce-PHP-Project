document.getElementById("resendOtp").addEventListener("click", function () {
    fetch("verify-otp.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({ resend_otp: true })
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                noti("Resend OTP:" , data.success , "success");
            } else {
                noti("Resend OTP:" , data.error , "warning");
            }
        })
        .catch(error => {
            noti("Resend OTP:" , error , "warning");
        });
});

document.getElementById("validateOtp").addEventListener("click", function () {
    const otpInputs = document.querySelectorAll("#otp > input");
    let otp = "";
    var redirect = document.getElementById('redirect') ? document.getElementById('redirect').value ? document.getElementById('redirect').value : "" : "";
    otpInputs.forEach(input => {
        otp += input.value;
    });

    if (otp.length === 6 && /^\d+$/.test(otp)) {
        fetch("verify-otp.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ otp: otp , redirect: redirect})
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = responce.redirect;
                } else {
                    // document.getElementById("errorMsg").textContent = data.error;
                    noti(" " , data.error , "warning");
                }
            })
            .catch(error => {
                console.error("Error:", error);
                noti("Error ","An error occurred during verification.","danger");
            });
    } else {
        noti("Warning","Please enter a valid 6-digit OTP.","warning");
    }
});

document.addEventListener("DOMContentLoaded", function (event) {
    const inputs = document.querySelectorAll("#otp > input");
    inputs.forEach((input, index) => {
        input.addEventListener("keydown", function (event) {
            if (event.key === "Backspace") {
                input.value = "";
                if (index !== 0) inputs[index - 1].focus();
            } else if (event.key >= "0" && event.key <= "9") {
                input.value = event.key;
                if (index !== inputs.length - 1) inputs[index + 1].focus();
                event.preventDefault();
            }
        });
    });
});