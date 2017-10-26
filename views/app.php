<?php
require_once __DIR__ . '/../assets.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link type="text/css" rel="stylesheet" href="//cdn.jsdelivr.net/bootstrap/3.3.5/css/bootstrap.css" media="all">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="<?= $ajax ?>"></script>
    <script src="<?= $file_input ?>"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3" style="margin-top: 50px">
            <form action="/" method="post" id="upload" enctype="multipart/form-data">
                <fieldset>
                    <legend>Convert audio to text</legend>
                    <div class="row">
                        <div class="col-md-3 col-sm-6 col-xs-12" style="margin-bottom: 30px">
                            <input type="file" name="audio[]" id="audio" multiple>
                        </div>
                        <div class="col-md-3 col-md-offset-6 col-sm-6 col-xs-12">
                            <input class="btn btn-primary" type="submit" id="submit" value="Get the text file">
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<script>$('#audio').bootstrapFileInput();</script>
</body>
</html>