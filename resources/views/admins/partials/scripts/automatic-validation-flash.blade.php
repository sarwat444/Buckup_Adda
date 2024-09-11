@if($errors->any())
    @foreach($errors->all() as $error)
        <script>
            toast("error","{{$error}}");
        </script>
    @endforeach
@endif
