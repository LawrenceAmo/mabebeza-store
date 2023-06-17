<x-guest-layout>
    <div class="container my-5 p-5">
        <div class="alert alert-danger text-center">
            <h1>Error: 403 - Login Required</h1>
            <p>Oops! You must be logged in to proceed with the checkout .</p>
            <a href="{{ route('login')}}" class="btn btn-sm rounded btn-info">Log in</a>
        </div>
    </div>
</x-guest-layout>
