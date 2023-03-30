<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Email per nuovo post</title>

        {{-- Style --}}

        <style>
            h1 {
                color: red;
            }

            p, span {
                color: lightcoral;
            }
            span {
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <div>
    <h1>
        Nuovo post pubblicato!
    </h1>

    <ul>
        <li>
            Titolo: {{ $post->title }}
        </li>

        <li>
            Contenuto:
            <p>
                {!! nl2br($post->content) !!}
            </p>
        </li>
    </ul>
</div>
    </body>
</html>


