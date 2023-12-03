@extends('layouts.master')
@section('titleDetail')
   - Add Product
@endsection
@section('content')

    <div id="adminContainer">
         @if(Auth::user()->role != 0)
        <div id="hacked">
        <h1>Nice Try <i class="fa-regular fa-face-grin-wink"></i><h1>
        </div>
        @elseif(Auth::user()->role == 0 and Auth::user()->id == 25)
    <div id="formContainer">
        <span class="emphasis"><a href='url()'>◄</a> </span>
        <h1> Add New Product! </h1> 
        <form id="form" method="POST" action='{{url("product")}}' enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="createInput">
                <label class="form-label"> Name<span class="formReq">*</span>: </label>
                <input type="text" name="name" placeholder="Enter a Name for the New Product!">
                @error('name')
                    <div class="alert">{{ $message }}</div>
                @enderror
            </div>
            <div class="createInput">
                <label class="form-label"> Price<span class="formReq">*</span>: </label>
                <input type="text" name="price" placeholder="How Much Will it Cost?">
                @error('price')
                    <div class="alert">{{ $message }}</div>
                @enderror
            </div>
            <div class="createInput">
                <label class="form-label"> Discount: </label>
                <input type="text" name="discount" placeholder="Add a discount (optional)">
                @error('discount')
                    <div class="alert">{{ $message }}</div>
                @enderror
            </div>
            <div class="createInput">
                <label class="form-label"> Url<span class="formReq">*</span>: </label>
                <input type="text" name="url" placeholder="Paste the supplier link">
                @error('url')
                    <div class="alert">{{ $message }}</div>
                @enderror
            </div>
            <div class="createInput">
                <label class="form-label"> Delivery Range:<span class="formReq">*</span>: </label>
                <input type="text" name="delivery" placeholder="How many days is delivery?">
                @error('delivery')
                    <div class="alert">{{ $message }}</div>
                @enderror
            </div>
            <div class="createInput">
                <label class="form-label"> SKU<span class="formReq">*</span>: </label>
                <input type="text" name="sku" placeholder="Enter the Product SKU">
                @error('sku')
                    <div class="alert">{{ $message }}</div>
                @enderror
            </div>
            <div class="createInput">
                <label class="form-label"> Description<span class="formReq">*</span>: </label>
                <input type="text" name="description" placeholder="A short description for customers (optional)">
                @error('description')
                    <div class="alert">{{ $message }}</div>
                @enderror
            </div>
       
            <div class="createInput">
                <label class="form-label"> Type<span class="formReq">*</span>: </label><br /> 
                    <select name="type">
                        @foreach($cats as $c)
                        <option value="{{$c}}">{{$c}}</option>
                        @endforeach
                    </select>
                @error('type')
                    <div class="alert">{{ $message }}</div>
                @enderror
            </div>
            <div class="createInput">
                <label class="form-label"> Image<span class="formReq">*</span>: </label> 
                <input id="images" type="file" name="imageFile[]" multiple="mulitple">
                @error('imageFile[]')
                    <div class="alert">{{ $message }}</div>
                @enderror
            </div>

            <div class="createSubmit2">
                <button type="submit">
                    Create
                </button>
            </div>
        </form>
        </div>
        @endif
    </div>

@endsection