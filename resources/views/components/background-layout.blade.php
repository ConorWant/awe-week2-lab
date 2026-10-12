<!DOCTYPE html>
<html>
    <head>
        <title>{{ config('app.name', 'Laravel') }}</title>
    </head>
    <body style="background-color: #f0f0f0; font-family: Arial, sans-serif; margin: 5px; padding: 0;">
      <h1>Working with Components</h1>  
        
      <p>Product</p>
      {{ $slot }}

</body>
</html>