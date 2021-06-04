<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title>Register</title>
</head>

<body>

    <?php include __DIR__ . '/includes/header.php'; ?>

    <div class="container">
        <h3 class="text-center font-weight-bold  mt-4">Register</h3>

        <form>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" id="password" required>
            </div>
            <div class="form-group">
                <label for="conPassword">Confirm Password</label>
                <input type="password" name="conPassword" class="form-control" id="conPassword" required>
            </div>
            <button type="submit" class="btn btn-primary" name="btn-register">Submit</button>
        </form>
    </div>

</body>

</html>