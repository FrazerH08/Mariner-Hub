<form action="accountvalidation.php" method='POST'>
        <p> Please fill out this form to sign up </p>

        <label for="firstname"><b>First name:</b></label>
        <input type="text" placeholder="Enter First Name"name="firstname"required> <br>
        <br>

        <label for="lastname"><b>Lastname:</b></label>
        <input type="text" placeholder="Enter last Name"name="lastname"required> <br>
        <br>
        <label for="dob"><b>Date of birth:</b></label>
        <input type="date" id="birthdate"name="birthdate"> <br>
        <br>
        <label for="region"><b>Region:</b></label> 
        <select id="region" name="region"> 
        <option value="Australia">Australia</option>
        <option value="Canada">Canada</option>
        <option value="USA">USA</option>
        <option value="United Kingdom">United Kingdom</option>
        </select>
        <br>
        <br>
        <label for="email"><b>Email:</b></label> <br>
        <input type="text" placeholder="Enter Email" name="email" required> <br>
        <br> <label for="username"><b>Username:</b></label> <br>
        <input type="text" placeholder="Enter Username" name="username" required> <br>
        <br> <label for="password"><b>Password:</b></label> <br>
        <input type="password" placeholder="Enter Password" name="password" required>

        <label>
      <br> <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
        </label>

        <div class="next">
            <button type="submit" name= "submit" value="submit" class="signupbtn" >Next</button>
        </div>
        <p> Already have an account? <a href="login.php"> Sign in now</a></p>
    </form>