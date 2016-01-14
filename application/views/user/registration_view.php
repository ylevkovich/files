<h2>Registration</h2>
<form name="registration" id="reg" method="post" action="/user/registration">
    <table>
        <tr>
            <td>
                <label>Login</label>
            </td>
            <td>
                <input name="login" id="login" type="text"/>
                <output id="login_used"></output>
            </td>
        </tr>
        <tr>
            <td>
                <label>Password</label>
            </td>
            <td>
                <input name="password" id="pass" type="password">
                <output id="pass_equal"></output>
            </td>
        </tr>
        <tr>
            <td>
                <label>Repeat password</label>
            </td>
            <td>
                <input name="repeat_password" id="repeat" type="password"/>
            </td>
        </tr>
        <tr>
            <td>
                <label>email</label>
            </td>
            <td>
                <input name="email" type="text" id="email"/>
                <output id="email_pattern"></output>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="submit" name="submit">
            </td>
        </tr>
    </table>
</form>
<div id="output"></div>