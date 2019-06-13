@if($successMsg = session('success'))
    @push('js')
        <script>
            Toast.fire({
                type: 'success',
                title: '{{$successMsg}}'
            });
        </script>
    @endpush
@endif
