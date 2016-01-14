window.onload = function () {
    (function () {
        var form = $get('reg'),
            login = $get('login'),
            pass = $get('pass'),
            repeat = $get('repeat'),
            mail = $get('email'),
            output = $get('output'),
            bool = true,
            bool_user = true;


        function $get(element) {
            return document.getElementById(element);
        }

        function create(message) {
            var out = document.createElement('output'),
                text = document.createTextNode(message),
                output = $get('output');
            out.appendChild(text);
            out.className = 'error';
            output.appendChild(out);
        }

        function checkEmpty(str) {
            if (str == "") return false;
            var count = 0;
            for (var i = 0; i < str.length; i++) {
                if (str.charAt(i) == " ") {
                    count++;
                }
            }
            if (count == str.length) {
                return false;
            }
            return true;
        }

        function clean() {
            bool = true;
            while (output.childNodes[0]) {
                output.removeChild(output.childNodes[0]);
            }
            login.classList.remove("invalid-data");
            pass.classList.remove("invalid-data");
            mail.classList.remove("invalid-data");
        }

        function checkEmail(str) {
            var pattern = /((\w*)\d*)*@(\w)*\.{1}(\w){1,4}/;
            if (pattern.test(str) == false) {
                $get("email_pattern").innerText = "enter a valid email";
                bool = false;
            }
            else {
                $get("email_pattern").innerText = "";
            }
        }

        function checkPassword() {
            if (pass.value.toString() !== repeat.value.toString()) {
                bool = false;
                $get('pass_equal').innerText = "passwords do not match";
            }
            else {
                $get('pass_equal').innerText = "";
            }
        }

        form.onsubmit = function () {
            clean();
            checkPassword();
            checkEmail(mail.value);
            if (!checkEmpty(login.value)) {
                create("enter login");
                login.classList.add("invalid-data");
                bool = false;
            }
            if (!checkEmpty(pass.value)) {
                create("enter pass");
                pass.classList.add("invalid-data");
                bool = false;
            }
            if (!checkEmpty(repeat.value)) {
                create("enter repeat pass");
                bool = false;
            }
            if (!checkEmpty(mail.value)) {
                create("enter email");
                mail.classList.add("invalid-data");
                bool = false;
            }

            if (bool_user == true && bool == true) {
                return true;
            }
            else {
                return false;
            }
        }

        login.onblur = function () {
            var xhr = new XMLHttpRequest();  // I do not think you need to do cross-browser
            xhr.onreadystatechange = function () {
                if (xhr.status == 200 && xhr.readyState == 4) {
                    if (xhr.responseText == '1') {

                        $get("login_used").innerText = "Login " + login.value + " It is already in use";
                        bool_user = false;
                    }
                    else {
                        $get("login_used").innerText = "";
                        bool_user = true;
                    }
                }
            }
            xhr.open('get', '/user/confirnLogin/?login=' + login.value, false);//xhr.open('get', '/core/login_return.php?login' + login.value, false);
            xhr.send();
        }
    }).call(this);
};