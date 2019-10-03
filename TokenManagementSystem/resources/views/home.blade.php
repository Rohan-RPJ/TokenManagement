@extends('layouts.main')

@section('content')
<style type="text/css">
  .header li .home{
  background-color: #242424;
}
</style>
    <div class="inner-elements"  >
      <div class="animation-area">
        <ul class="circle-area">
          <li></li>
          <li></li>
          <li></li>
          <li></li>
          <li></li>
          <li></li>
        </ul>
        <div class="" >
          <!-- <div class="dept"> -->
              <h3 style="text-align: center;" id="user-name"><span class="dept" > </span> </h3>
          <!-- </div> -->

          <h1>WELCOME TO FILE SUBMISSION!. <br> USING TOKEN MANAGEMENT SYSTEM.</h1>
          <br>
          <h3>A token management system is used to control queues.<br> Queues of people form in various situations and locations in a queue area.</h3>
        </div>
      </div>
    </div>
<script type="text/javascript">
  var user = {!! json_encode(Auth::user()->toArray(), JSON_HEX_TAG) !!};
  //console.log(user);
  //console.log(user);
  var unReadNotifCount = 0;
  if (user['type'] == 'Student') {
    this.unReadNotifCount = {!! $unReadNotifCount !!};
    //console.log(this.unReadNotifCount);
  }
  showUnreadNotifCount(unReadNotifCount);
  document.getElementById('user-name').innerHTML = 'Hello ' + user['type'];
</script>
@endsection
