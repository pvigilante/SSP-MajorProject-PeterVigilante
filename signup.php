<?php
require_once("header.php");
?>

<div class="container">

    <div class="row">
        <div class="col-12">
            <h1>Sign-Up for Free Account</h1>
        </div>
        <form action="/actions/login.php" class="col-12" method="post">
            <?php
            include($_SERVER["DOCUMENT_ROOT"] . "/includes/error_check.php");
            ?>
            <!-- 
                First Name / Last Name
                Email
                Address
                Province 
                Postal
                Password
                Confirm Password
            -->
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="first_name">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name">
                </div>
                <div class="form-group col-md-6">
                    <label for="last_name">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="last_name">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-12">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
                <div class="form-group col-md-6">
                    <label for="password2">Confirm Password</label>
                    <input type="password" class="form-control" id="password2" name="password2" placeholder="Confirm Password">
                </div>
            </div>
            <div class="form-group">
                <label for="inputAddress">Address</label>
                <input type="text" class="form-control" id="inputAddress" name="address" placeholder="1234 Main St">
            </div>
            <div class="form-group">
                <label for="inputAddress2">Address 2</label>
                <input type="text" class="form-control" id="inputAddress2" name="address2" placeholder="Apartment, studio, or floor">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputCity">City</label>
                    <input type="text" class="form-control" name="city" id="inputCity">
                </div>
                <div class="form-group col-md-4">
                    <label for="province">Province</label>
                    <select id="province" name="province" class="form-control">
                        <option selected disabled>Choose...</option>
                        <?php
                        $provinces = [
                            "Britsh Columbia",
                            "Alberta",
                            "Saskatchewan",
                            "Manitoba",
                            "Ontario",
                            "Quebec",
                            "New Brunswick",
                            "Nova Scotia",
                            "PEI",
                            "Nunavit",
                            "Labradour",
                            "Yukon",
                            "NWT"
                        ];
                        for($i = 0; $i < count($provinces); $i++){
                            echo "<option value='".($i + 1)."'>$provinces[$i]</option>";
                            //echo "<option value='".$i."'>".$provinces[$i]."</option>";
                            //echo "<option value=\"$i\">$provinces[$i]</option>";
                            //echo '<option value=\"'.$i.'\">'.$provinces[$i].'</option>';
                        }

                        ?>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="postal_code">Postal Code</label>
                    <input type="text" class="form-control" name="postal_code" id="postal_code">
                </div>
            </div>
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="agree_terms" id="gridCheck">
                    <label class="form-check-label" for="gridCheck">
                    Do you agree to our Terms &amp; Conditions?
                    </label>
                </div>
            </div>

            <div class="form-group">
                Sign-Up for Newsletter?
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="newsletter" id="newsletter_yes" value="true" checked>
                    <label class="form-check-label" for="newsletter_yes">
                        Yes
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="newsletter" id="newsletter_no" value="false">
                    <label class="form-check-label" for="newsletter_no">
                        No
                    </label>
                </div>
            </div>

            <div class="form-group">
                Are your posting or looking?
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="role" id="newsletter_yes" value="3" checked>
                    <label class="form-check-label" for="newsletter_yes">
                        Looking
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="role" id="newsletter_no" value="2">
                    <label class="form-check-label" for="newsletter_no">
                        Posting
                    </label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary" name="action" value="signup">Sign Up</button>
        </form>
    </div>

</div>

<?php
require_once("footer.php");
?>