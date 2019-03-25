<!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign up</h2>
                        <form method="POST" action="index.php?action=registerUser" class="register-form" id="register-form">
                            <div class="form-group">
                                <label for="username"><i class="fa fa-user"></i></label>
                                <input type="text" name="username" id="username" placeholder="Username" required/>
                            </div>
                            <div class="form-group">
                                <label for="name"><i class="fa fa-user"></i></label>
                                <input type="text" name="name" id="name" placeholder="Name" required/>
                            </div>
                            <div class="form-group">
                                <label for="re-pass"><i class="fa fa-key"></i></label>
                                <input type="password" name="pass" id="re_pass" placeholder="Your password" required/>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="submit" id="signup" class="btn btn-success" value="Register"/>
                                </div>
                                <div class="col-md-6">
                                    <?php if(!isset($_SESSION['uname'])){?>
                                        <a class="btn btn-warning" href="index.php?action=login">Back</a>
                                    <?php
                                    }else{
                                    ?>
                                        <a class="btn btn-warning" href="index.php?action=viewUser">Back</a>
                                    <?php }?>

                                </div>

                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="view/img/signup-image.jpg" style="width: 250px; height: 250px;" alt="sing up image"></figure>
                    </div>
                </div>
            </div>
        </section>