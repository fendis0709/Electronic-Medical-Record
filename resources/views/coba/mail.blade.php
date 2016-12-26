<html>
    <head>
        <title>Email</title>
    </head>
    <body>
        <form action="{{ url('send') }}" method="POST">
            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
            <input name="to" type="email" placeholder="Email Tujuan"/>
            <input name="content" type="text" placeholder="Konten email"/>
            <button name="action" type="submit">Submit data</button>
        </form>
    </body>
</html>