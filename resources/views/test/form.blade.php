<!DOCTYPE html>
<html>
<body>

<h2>HTML Forms</h2>

<form action="/add" method="post">
 @csrf
  <label for="name"> name:</label><br>
  <input type="text" id="name" name="name" value="default"><br>
  <label for="lname">date:</label><br>
  <input type="datetime-local" id="date" name="date" value="Doe"><br><br>
  <input type="submit" value="Submit">
</form> 



</body>
</html>