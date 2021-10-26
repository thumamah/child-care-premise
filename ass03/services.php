<!doctype html>
<html lang="en">

<head>
    <link rel="icon" type="image/png" href="images/logo_transparent.png" />
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <link rel="stylesheet" href="Mystyle1.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


</head>

<body>
    <?php
        include "header.php";
    ?>

    <div class="container">

        <header>
            <div id="serviceCard" class="card text-white bg-danger mb-3">
                <div class="card-body">
                    <h5 id="card-title1" class="card-title">Our Services and Facilitation</h5>
                    <p class="card-text"></p>
                </div>
            </div>
        </header>
        <div class="row">

            <?php
            // calling connection
            require('/home/s3022041/sqlC/dbConnect.php');
            // query to select all from page ordering by or_no
            $query = "SELECT * FROM service where service_id = 1";
            $result = mysqli_query($connection, $query);
            if (($result) == 1) {
                // creating new variable fetching result row as an associative array.
                $first = mysqli_fetch_assoc($result);
            }

            ?>

            <div class="col-md-4">
                <div class="card" style="width: 20rem;">
                    <img class="card-img-top" src="<?php echo ($first['image']) ?>" style="height: 216PX;" alt="School bus">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo ($first['name']) ?></h5>
                        <p class="card-text"><?php echo ($first['description']) ?></p>
                        <a href="<?php echo ($first['link']) ?>" class="btn btn-primary">Know more about it</a>
                    </div>
                </div>
            </div>


            <?php
            // calling connection
            require('/home/s3022041/sqlC/dbConnect.php');
            // query to select all from page ordering by or_no
            $query = "SELECT * FROM service where service_id = 2";
            $result = mysqli_query($connection, $query);
            if (($result) == 1) {
                // creating new variable fetching result row as an associative array.
                $second = mysqli_fetch_assoc($result);
            }

            ?>

            <div class="col-md-4">

                <div class="card" style="width: 20rem;">
                    <img class="card-img-top" src="<?php echo ($second['image']) ?>" alt="Children educator">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo ($second['name']) ?></h5>
                        <p class="card-text"><?php echo ($second['description']) ?></p>
                        <a href="<?php echo ($second['link']) ?>" class="btn btn-primary">Our Educators</a>
                    </div>
                </div>
            </div>

            <?php
            // calling connection
            require('/home/s3022041/sqlC/dbConnect.php');
            // query to select all from page ordering by or_no
            $query = "SELECT * FROM service where service_id = 3";
            $result = mysqli_query($connection, $query);
            if (($result) == 1) {
                // creating new variable fetching result row as an associative array.
                $third = mysqli_fetch_assoc($result);
            }

            ?>

            <div class="col-md-4">
                <div class="card" style="width: 20rem;">
                    <img class="card-img-top" src="<?php echo ($third['image']) ?>" style="height: 145px;" alt="Children in a peer">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo ($third['name']) ?></h5>
                        <p class="card-text"><?php echo ($third['description']) ?></p>
                        <a href="<?php echo ($third['link']) ?>" class="btn btn-primary">Info about Social Skills</a>
                    </div>
                </div>
            </div>

        </div>

        <br>

        <?php
        // calling connection
        require('/home/s3022041/sqlC/dbConnect.php');
        // query to select all from page ordering by or_no
        $query = "SELECT * FROM service where service_id = 4";
        $result = mysqli_query($connection, $query);
        if (($result) == 1) {
            // creating new variable fetching result row as an associative array.
            $fourth = mysqli_fetch_assoc($result);
        }

        ?>

        <div class="row">

            <div class="col-md-4">
                <div class="card" style="width: 20rem;">
                    <img class="card-img-top" src="<?php echo ($fourth['image']) ?>" style="height: 257px;" alt="Child's day">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo ($fourth['name']) ?></h5>
                        <p class="card-text"><?php echo ($fourth['description']) ?></p>

                        <form id="form" action="day_details.php" method="GET">

                            <input type="submit" value="Know what your kid did at school" class="btn btn-primary float-left mb-3">
                        </form>

                    </div>
                </div>
            </div>

            <?php
            // calling connection
            require('/home/s3022041/sqlC/dbConnect.php');
            // query to select all from page ordering by or_no
            $query = "SELECT * FROM service where service_id = 5";
            $result = mysqli_query($connection, $query);
            if (($result) == 1) {
                // creating new variable fetching result row as an associative array.
                $fifth = mysqli_fetch_assoc($result);
            }

            ?>

            <div class="col-md-4">
                <div class="card" style="width: 20rem;">
                    <img class="card-img-top" src="<?php echo ($fifth['image']) ?>" style="height: 305px;" alt="Children eating">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo ($fifth['name']) ?></h5>
                        <p class="card-text"><?php echo ($fifth['description']) ?></p>
                        <a href="<?php echo ($fifth['link']) ?>" class="btn btn-primary">Know more about it</a>
                    </div>
                </div>
            </div>

            <?php
            // calling connection
            require('/home/s3022041/sqlC/dbConnect.php');
            // query to select all from page ordering by or_no
            $query = "SELECT * FROM service where service_id = 6";
            $result = mysqli_query($connection, $query);
            if (($result) == 1) {
                // creating new variable fetching result row as an associative array.
                $sixth = mysqli_fetch_assoc($result);
            }

            ?>

            <div class="col-md-4">
                <div class="card" style="width: 20rem;">
                    <img class="card-img-top" src="<?php echo ($sixth['image']) ?>" style="height: 208px;" alt="">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo ($sixth['name']) ?></h5>
                        <p class="card-text"><?php echo ($sixth['description']) ?></p>
                        <a href="<?php echo ($sixth['link']) ?>" class="btn btn-primary">Know more about it</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous">
    </script>
    <?php
    include "footer.html";
    ?>
</body>

</html>