@if (session('error'))
    <div id="errorMessage" class="mb-4 px-4 py-3 bg-red-100 text-red-700 rounded border border-red-300">
        {{ session('error') }}
    </div>
@endif

@if(session('success'))
    <div id="successMessage" class="mb-4 px-4 py-3 bg-green-100 text-green-700 rounded border border-green-300">
        {{ session('success') }}
    </div>
@endif

{{-- @if ($errors->any())
    <div id="errorBlock" class="mb-4 px-4 py-3 bg-red-100 text-red-700 rounded border border-red-300">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}

<script>
    const successMessage = document.getElementById('successMessage');
    if (successMessage) {
        setTimeout(() => {
            successMessage.style.opacity = '0';
            setTimeout(() => successMessage.remove(), 500);
        }, 3000);
    }

    const errorMessage = document.getElementById('errorMessage');
    if (errorMessage) {
        setTimeout(() => {
            errorMessage.style.opacity = '0';
            setTimeout(() => errorMessage.remove(), 500);
        }, 5000);
    }

    // const errorBlock = document.getElementById('errorBlock');
    // if (errorBlock) {
    //     setTimeout(() => {
    //         errorBlock.style.opacity = '0';
    //         setTimeout(() => errorBlock.remove(), 500);
    //     }, 5000);
    // }
</script>