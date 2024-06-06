<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script>
        function testme(x){
            if(x == 10){
                return true;
            } else {
                return false;
            }
        }
    </script>

    <script>
        <?php 
            $x = 10;

            $test = echo "testme($x);";

            // $x = 5;

            // $test = echo "testme($x);"

       ?>
    </script>


    <title>Test</title>
</head>
<body>
    <p><?php echo $test ?></p>
</body>
</html>