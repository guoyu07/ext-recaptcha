<html>
<head>
    <title>reCAPTCHA demo: Simple page</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
        function onSubmit(token) {
            document.getElementById("demo-form").submit();
        }
    </script>
</head>
<body>
<form id='demo-form' action="{{url('/api/siteverify/set')}}" method="POST">
    {{ csrf_field() }}
    <div>
        <label>name</label>
        <input type="text" name="name">
    </div>
    <div class="g-recaptcha" data-sitekey="6Le6xDAUAAAAAAKmkX_bX_5K5IF8itrFRgMiIdPq"></div><br/>
    <input type="submit">

</form>
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</body>
</html>