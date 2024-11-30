document.addEventListener("DOMContentLoaded", () => {
    // Validimi për Sign Up
    const SignUp = document.querySelector("#form");
    SignUp.addEventListener("submit", (e) => {
        e.preventDefault();

        const inputs = SignUp.querySelectorAll(".input-box input");
        let isValid = true;
        let password, confirmPassword;

        inputs.forEach((input) => {
            const value = input.value.trim();

           
            if (!value) {
                alert(`Fusha '${input.placeholder}' është e detyrueshme.`);
                isValid = false;
                return;
            }

            if (input.type === "email" && !/\S+@\S+\.\S+/.test(value)) {
                alert("Ju lutem vendosni një email të vlefshëm.");
                isValid = false;
                return;
            }

            if (input.type === "password") {
                if (input.placeholder === "Password") password = value;
                if (input.placeholder === "Confirm password") confirmPassword = value;
            }

          
            if (input.type === "tel" && !/^\d+$/.test(value)) {
                alert("Numri i telefonit duhet të përmbajë vetëm shifra.");
                isValid = false;
                return;
            }
        });

        if (password && confirmPassword && password !== confirmPassword) {
            alert("Fjalëkalimet nuk përputhen.");
            isValid = false;
        }

      
        if (isValid) {
            alert("Regjistrimi i suksesshëm!");
            SignUp.reset();
        }
    });
});
    // Validimi për Log In
    const LogIn = document.querySelector(".wrapper form[action='']");
    LogIn.addEventListener("submit", (e) => {
        e.preventDefault();

        const email = LogIn.querySelector("input[type='email']").value.trim();
        const password = LogIn.querySelector("input[type='text']").value.trim();

        if (!email || !password) {
            alert("Të gjitha fushat janë të detyrueshme.");
            return;
        }

        if (!/\S+@\S+\.\S+/.test(email)) {
            alert("Ju lutem vendosni një email të vlefshëm.");
            return;
        }

        if (password.length < 6) {
            alert("Fjalëkalimi duhet të ketë të paktën 6 karaktere.");
            return;
        }

        alert("Hyrja e suksesshme!");
        LogIn.reset();
    });
