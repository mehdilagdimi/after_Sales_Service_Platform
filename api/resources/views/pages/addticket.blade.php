
{{-- @section('navbar')
    @include('layout.navbar')
@endsection

@section('footer') 
    @include('layout.footer')
@endsection

@yield('navbar') --}}

 {{-- Show only when button above is clicked 'Need assistance?' --}}
 {{-- <form action="{{ route('storeTicket') }}" method='POST' class="addTicket-form hidden"> --}}
 <form action="" method='POST' class="addTicket-form hidden">
    @csrf

    <label for="subject">Subject</label>
    <input name="subject" id='subject' type="text" placeholder='Subject' required>
    <label for="body"></label>
    <textarea name="body" id="body" cols="30" rows="10" required class="">
    </textarea>
    {{-- @error
        <div class="text-sm text-red-200">
            <p> {{ $message }} </p>
        </div>
    @enderror --}}
</form>

{{-- @yield('footer') --}}

