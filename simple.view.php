<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Yanone+Kaffeesatz:400,300' rel='stylesheet' type='text/css'>
    <link href='https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:600&display=swap" rel="stylesheet">

    <title>btcu-code-pay</title>
  </head>
  <body>
  <h1>Widget Modal</h1>
  <button id="button">Click For Btcu pay modal</button>
  <div id="modal">
    <btcu-widget amount="<?php echo $amount; ?>" currency="<?php echo $currency; ?>"  order_id="<?php echo $order_id; ?>"></btcu-widget>
  </div>
    <script>
      console.log('modal');
      document.getElementById("button").click();
    </script>
    <script src="./btcu-pay/btcu.js"></script>
  </body>
</html>
