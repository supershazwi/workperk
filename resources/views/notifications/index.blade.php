@extends ('layouts.main')

@section ('content')
<div class="py-5">
  <div class="container">
    <h2>Notifications</h2>
    <table class="table bg-white" id="results">
      <thead class="thead-dark">
        <tr>
          <th scope="col">Notification</th>
          <th scope="col"><i class="far fa-clock"></i></th>
        </tr>
      </thead>
      <tbody>
        @foreach($notifications as $notification)
          <tr>
            <td><p style="margin-bottom: 0rem;">{{$notification->user->name}} <a href="{{$notification->url}}">{{$notification->message}}</a></p></td>
            <td><p style="margin-bottom: 0rem;" class="text-muted">{{$notification->created_at->diffForHumans()}}</p></td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection

@section ('footer')   
<script type="text/javascript">
  $(document).ready(function() {
      $('#results').DataTable( {
        "order": [],
      });
  } );
</script>
@endsection