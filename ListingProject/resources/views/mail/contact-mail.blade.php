<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact Mail</title>
</head>
<body>
    <body class="bg-light">
        <div class="container">
          <div class="card p-6 p-lg-10 space-y-4">
            <h3 class="h3 fw-700">
                You got a mail from : {{ $name }}.
            </h3>
            <p> {!! $ContactMessage !!}</p>
          </div>
        </div>
      </body>
</body>
</html>
