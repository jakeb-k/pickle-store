@extends('layouts.master')
@section('titleDetail')
 - Admin 
@endsection 
@section('content')
<div id="adminContainer">
    <div id="adminOps">
        <div class="dropdown2">
                <button class="dropbtn2"><i class="fa-solid fa-filter"> </i></button>
                <div class="dropdown-content2">
                    <h3>Filter Options </h3>
                    <table>
                        <tr>
                        @foreach($cats as $c)
                        @if($loop->index % 5 == 0)
                        </tr><tr>
                        <td>
                            <form method="POST" action='{{url("admin/filter")}}'>
                                {{csrf_field()}}
                            <input type="hidden" value="{{$c}}" name="filter" />
                            <button type="submit"> {{$c}}</button>
                            </form></td>
                        @else
                        <td>
                            <form method="POST" action='{{url("admin/filter")}}'>
                                {{csrf_field()}}
                            <input type="hidden" value="{{$c}}" name="filter" />
                            <button type="submit"> {{$c}}</button>
                            </form></td>
                        @endif
                        @endforeach
                        </tr>
                    </table>
                </div>
            </div>
            <div id="shopNow" style="margin-top:50px;">
             <a href='{{url("product/create")}}'>
                <button class="pBtn">Create Product</button>
             </a>
        </div>
    </div>
        
    <div id="adminContent">
    <table>
        <tr style="font-weight:bold;">
            <td>Image</td>
            <td>Name</td>
            <td>SKU</td>
            <td>Price</td>
            <td>Type</td>
            <td>EDIT</td>
            <td>DELETE </td>
            <td>Available</td>
        </tr>
        @foreach($products as $product)
        <?php $images = explode(",",$product->image); ?>
        <tr>
            <td> @if($product->image ?? "")
                    <img src="{{ Storage::disk('public')->url('images/'.$images[0]) }}" /> 
                    
                @else
                     <img src="{{url('images/noImg.jpg')}}" /> 
                @endif</td>
            <td style="width:300px; ">{{$product->name}}</td>
            <td>{{$product->sku}}</td>
            <td>{{$product->price}}</td>
            <td style="font-size:large;"><b>{{$product->type}}</b></td>
            <td>
                <a href='{{url("product/$product->id/edit")}}'><button>EDIT</button></a>  
            </td>
            <td>
                <form method="POST" action='{{url("product/$product->id")}}' enctype="multipart/form-data">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                    <input name="product_id" type="hidden" value="{{$product->id}}" /> 
                    <button type="submit">
                        DELETE
                    </button>
                </form>
            </td>
            <td>
                <a href='{{url("product/$product->id/available")}}'>
                    @if($product->available == 1)
                    True
                    @else
                    False
                    @endif
                </a> 
            </td>
        </tr>
        @endforeach
    </table>
    </div>
</div>
@endsection
