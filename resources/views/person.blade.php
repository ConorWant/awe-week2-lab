<!DOCTYPE html>
<html lang='en'>
    <head>
        <meta charset="utf-8">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <script src="https://cdn.tailwindcss.com"></script>

        <title>My test person page</title>

    </head>
    <body class="m-5">
    <h1 class="text-xxl">Person ID {{$id}}</h1>

    <div class="w-full max-w-sm bg-slate-50 border border-2 border-gray-400 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
    <div class="flex flex-col items-center pt-10 pb-10">
        <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="/images/pi.webp" alt="Person Image"/>
        <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{$data['name']??'UNKNOWN'}}</h5>
        <span class="text-base text-gray-500 dark:text-gray-400">{{$data['role']??'UNKNOWN'}}</span>
    </div>
</div>

</body>
</html>