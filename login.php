<form action="login_validation.php" method='POST'>
        <br> <label for="username"><b>Username:</b></label> <br>
        <input type="text" placeholder="Enter Username" name="username" required> <br>
        <br> <label for="password"><b>Password:</b></label> <br>
        <input type="password" placeholder="Enter Password" name="password" required>
        <label>
      <br> <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
        </label>
        <div class="next">
            <button type="submit" name= "submit" value="submit" class="signupbtn" >Login</button>
        </div>
        <p> Need to sign up? <a href="signup.php"> Register now</a></p>
    </form>
    <?php
    if(isset($_POST['submit'])){
        $username =mysqli_real_escape_string($conn,$_POST['username']);
        $password =mysqli_real_escape_string($conn,$_POST['password']);

        $result = mysqli_query($conn,"SELECT * FROM users WHERE username='$username' AND password='$password'") or die("Error");
        $row = mysqli_fetch_assoc($result);

        if(is_array($row) && !empty($row)){
            $_SESSION['valid'] = $row['username'];
            $_SESSION['valid'] = $row['password'];
        }else{
            echo "<h1>username or password is incorrect  please go back</h1><br>";
            echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button></a>";
        }
        if(isset($_SESSION['valid'])){
            echo "You are logged in! Welcome back {$username}";
            header("Location: welcome.php");
        }
    }else{
    }
    ?>