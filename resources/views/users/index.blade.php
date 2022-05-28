@foreach ($users as $item)
<div class="form-group" style="padding-top: 2%">
    <label for="exampleFormControlInput1">Quiz name :</label>
   {{$item->username}}
  </div>
  <div class="form-group" style="padding-top: 2%">
      <label for="exampleFormControlInput1">Start time :</label>
      {{$item->email}}
    </div>
    <div class="form-group" style="padding-top: 2%">
      <label for="exampleFormControlInput1">duration :</label>
 {{$item->password}}
    </div>
@endforeach
