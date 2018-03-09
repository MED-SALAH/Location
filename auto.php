<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Example of Twitter Typeahead</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script  type="text/javascript" src="js/typeahead.bundle.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            // Defining the local dataset
            var cars = ['Audi', 'BMW', 'Bugatti', 'Ferrari', 'Ford', 'Lamborghini', 'Mercedes Benz', 'Porsche', 'Rolls-Royce', 'Volkswagen'];

            // Constructing the suggestion engine
            var cars = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.whitespace,
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                local: cars
            });

            // Initializing the typeahead
            $('.typeahead').typeahead({
                    hint: true,
                    highlight: true, /* Enable substring highlighting */
                    minLength: 1 /* Specify minimum characters required for showing result */
                },
                {
                    name: 'cars',
                    source: cars
                });
        });
    </script>
    <style type="text/css">
        .bs-example {
            font-family: sans-serif;
            position: relative;
            margin: 100px;
        }
        .typeahead, .tt-query, .tt-hint {
            border: 2px solid #CCCCCC;
            border-radius: 8px;
            font-size: 22px; /* Set input font size */
            height: 30px;
            line-height: 30px;
            outline: medium none;
            padding: 8px 12px;
            width: 396px;
        }
        .typeahead {
            background-color: #FFFFFF;
        }
        .typeahead:focus {
            border: 2px solid #0097CF;
        }
        .tt-query {
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
        }
        .tt-hint {
            color: #999999;
        }
        .tt-menu {
            background-color: #FFFFFF;
            border: 1px solid rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            margin-top: 12px;
            padding: 8px 0;
            width: 422px;
        }
        .tt-suggestion {
            font-size: 22px;  /* Set suggestion dropdown font size */
            padding: 3px 20px;
        }
        .tt-suggestion:hover {
            cursor: pointer;
            background-color: #0097CF;
            color: #FFFFFF;
        }
        .tt-suggestion p {
            margin: 0;
        }
    </style>
</head>
<body>
<div class="bs-example">
    <h2>Type your favorite car name</h2>
    <input type="text" class="typeahead tt-query" autocomplete="off" spellcheck="false">
</div>
</body>
</html>