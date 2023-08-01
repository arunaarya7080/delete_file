<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Deletion Files</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        .center-btn {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
</head>

<body>
    <?php
    function dlt_Directory($dir)
    {
        if (!is_dir($dir)) {
            return false;
        }
        $files = array_diff(scandir($dir), array('.', '..'));
        foreach ($files as $file) {
            $path = $dir . '/' . $file;
            if (is_dir($path)) {
                dlt_Directory($path); // Recursive call for subdirectories
            } else {
                echo "<pre>";
                print_r($path);
                // unlink($path); // Delete files
            }
        }
        // return rmdir($dir); // Remove the empty directory

    }


    $dir = './';
    if (isset($_GET['delete']) && $_GET['delete'] === 'true') {
        if (dlt_Directory($dir)) {
            echo '<script>alert("All Item deleted successfully!");</script>';
        } else {
            echo '<script>alert("Failed to delete item.");</script>';
        }
    }
    ?>
    <div class="container my-5">
        <!-- Content here -->
        <button class="btn btn-danger center-btn" onclick="DltPrompt()">Delete All Files</button>
    </div>
    <script>
        function DltPrompt() {
            // Display a custom prompt for the delete command
            var command = window.prompt(" If you want to delete files, type 'delete' ", "Enter Input");

            // Check the user's input
            if (command && command.toLowerCase() === 'delete') {
                // User entered 'delete', redirect to the same page with delete parameter set to true
                window.location.href = window.location.href + "?delete=true";
            } else {
                // User did not enter 'delete' or clicked cancel, do nothing or show a message
                alert("Deletion canceled.");
            }
        }
    </script>
    <!-- js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>