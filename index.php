<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="row text-center">
            <div class="col-md-12">
                <h3>Lucky Picker</h3>
                <div>
                    <button class="btn btn-primary" onclick="generateLuckyPick()">Generate</button>
                </div>
                <div class="generated-numbers pt-3">
                    <table class="table">
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    function generateLuckyPick() {
        $.ajax({
            url: "./lucky-picker.php",
            success: function(data){
                data = JSON.parse(data);
                let html = '<tr>';
                data.forEach((item)=>{
                    item.forEach((val)=>{
                        html += `<td>${val}</td>`;
                    });
                });
                html += '</tr>';
                $('.generated-numbers table tbody').append(html);
            }
        });
    }
</script>
</html>