<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Search Form</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Google Scholar Search</h2>
    <form id="searchForm">
        <div class="form-group">
            <label for="fullName">Full Name:</label>
            <input type="text" class="form-control" id="fullName" name="fullName">
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
    <div id="searchResults" class="mt-3"></div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function(){
    $('#searchForm').submit(function(e){
        e.preventDefault();
        var fullName = $('#fullName').val();
        if(fullName){
            $.ajax({
                url: 'seach_schola.php',
                type: 'GET',
                data: {fullName: fullName},
                success: function(response){
                    $('#searchResults').html(response);
                    console.log(response);
                }
            });
        } else {
            alert('Please enter a full name.');
        }
    });
});
</script>

</body>
</html>
