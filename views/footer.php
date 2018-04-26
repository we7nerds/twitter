<?php
/**
 * Created by PhpStorm.
 * User: we7ne
 * Date: 4/21/2018
 * Time: 7:19 AM
 */
?>

<footer class="footer">

    <div class="container">
        <span class="text-muted"><p>&copy My Website 2018</p></span>
    </div>

</footer>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalTitle">Login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" id="loginAlert" >

                </div>
                <form>
                    <input type="hidden" name="loginActive" id="loginActive" value="1">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Email address">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a id="toggleLogin" href="#">Sign up</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="loginSignupBtn">Login</button>
            </div>
        </div>
    </div>
</div>

<script>

    $("#toggleLogin").click(function() {

        if ($("#loginActive").val() == "1") {

            $("#loginActive").val("0");
            $("#loginModalTitle").html("Sign Up");
            $("#loginSignupBtn").html("Sign Up");
            $("#toggleLogin").html("Login");

        } else {

            $("#loginActive").val("1");
            $("#loginModalTitle").html("Login");
            $("#loginSignupBtn").html("Login");
            $("#toggleLogin").html("Sign Up");

        }

    });

    $("#loginSignupBtn").click(function() {

        $.ajax({
            type: "POST",
            url: "actions.php?action=loginSignup",
            data: "email=" + $("#email").val() + "&password=" + $('#password').val() + "&loginActive=" +
                $("#loginActive").val(),
            success: function(result) {
                if (result == "1") {

                    window.location.assign("index.php");

                } else {

                    $("#loginAlert").html(result).show();

                }
            }
        })

    });

    $(".toggleFollow").click(function() {

        var id = $(this).attr("data-userId");

        $.ajax({
            type: "POST",
            url: "actions.php?action=toggleFollow",
            data: "userId=" + $(this).attr("data-userId"),
            success: function(result) {

                if (result == "1") {

                    $("a[data-userId='" + id + "']").html("Follow");

                } else if (result == "2") {

                    $("a[data-userId='" + id + "']").html("Unfollow");

                }
            }
        })

    });

    $("#postTweetBtn").click(function() {

        $.ajax({
            type: "POST",
            url: "actions.php?action=postTweet",
            data: "tweetContent=" + $("#tweetContent").val(),
            success: function(result) {

                if (result == "1") {

                    $("#tweetSuccess").show();
                    $("#tweetFail").hide();

                } else if (result != "") {

                    $("#tweetFail").html(result).show();
                    $("#tweetSuccess").hide();

                }
            }
        })

    });

</script>


</body>
</html>
