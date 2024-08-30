<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Blog project</title>
</head>

<body>
    <h3 class=" text-info text-center bg-gray-100 p-2 rounded">Blog Project</h3>

    @yield('blog')
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function fileupload(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var image = document.getElementById("upload");
            image.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

</html>
