@extends('layouts.app')

@section('content')

    <div class="grid sm:grid-cols-2 gap-2 pt-12 sm:pt-20 mx-auto w-4/5">
        <div class="mx-auto">
            <img
                src="../public/{{ $product->image_path }}"
                alt="{{ $product->name }}">
        </div>
@if ( Session::has('success') )
<h4 class="alert alert-success" id="">
    <button data-dismiss="alert" class="close close-sm" type="button">
        <i class="fa fa-times"></i>
    </button>
    {{ Session::get('success') }}</h4>
@endif
@if ( Session::has('fail') )
<h4 class="alert alert-danger" id="">
    <button data-dismiss="alert" class="close close-sm" type="button">
        <i class="fa fa-times"></i>
    </button>
    {{ Session::get('fail') }}</h4>
@endif
@if($errors->any())
<h4 class="alert alert-danger">
    <button data-dismiss="alert" class="close close-sm" type="button">
        <i class="fa fa-times"></i>
    </button>{{$errors->first()}}</h4>
@endif
        <div>
            <h1 class="text-4xl text-gray-600 font-bold pb-8">
                {{ $product->name }}
            </h1>

            <p class="font-bold text-l text-black pb-8">
               Price: <span class="text-red-500">$ {{ $product->price }}</span>
            </p>

            <p class="font-bold text-l text-black pb-8">
                Shipping: <span class="text-red-500">$ {{ $product->shipping_cost }}</span>
            </p>

            <p class="font-thin text-s text-black pb-8">
                {{ $product->details }}
            </p>

            <p class="text-gray-800 text-thin text-l leading-6 pb-12">
                {{ $product->description }}
            </p>

            <a
                href="{{ route('add.to.cart', $product->id) }}"
                class="px-10 py-6 text-l uppercase text-white font-bold bg-blue-600 rounded-full w-full"
                role="button"
                aria-pressed="true">
                Add To Cart
            </a>
        </div>
        <script>
     window.setTimeout(function () {
        // Closing the alert
        $('.alert').alert('close');
    }, 5000);
</script>
@endsection
