@extends('layouts.master')
@section('titleDetail')
 - Orders
@endsection
@section('content')
<div id="adminContainer">
    <div id="sentShow">
        @if($sentB == false)
        <form method="POST" action="{{url('orders')}}">
            {{csrf_field()}}
            <input type="hidden" value=true name="sentB"/> 
            <button type="submit">VIEW SENT ORDERS</button>
        </form>
        @else
        <form>
            <a href="{{url('orders')}}">
            <button type="submit">REMOVE SENT ORDERS</button></a>
        </form>
        @endif
    </div>
    <div id="orderContent">
        <table>
            <tr style="font-weight:bold;">
                <td>Order No.</td>
                <td>Customer</td>
                <td>Price</td>
                <td>VIEW</td>
                <td>SENT</td>
            </tr>
            @for($i = 0; $i < count($orders); $i++)
            @if($orders[$i]->sent == false and $sentB == false)
            <tr>
                <td>{{$orders[$i]->id}}</td>
                <td>{{$users[$i]->name}}</td>
                <td>${{number_format($totals[$i], 2)}}</td>
                <td><a href="{{url('orders/'.$orders[$i]->id)}}"><button class="pBtn" style="--c:#dadada; color:#ff7b00;">VIEW</button></a></td>
                <td>@if($orders[$i]->sent == 1)
                    true
                    @else 
                    false 
                    @endif
                </td>
                </tr>
            @elseif($sentB == true)
            <tr>
                <td>{{$orders[$i]->id}}</td>
                <td>{{$users[$i]->name}}</td>
                <td>${{number_format($totals[$i], 2)}}</td>
                <td><a href="{{url('orders/'.$orders[$i]->id)}}"><button class="pBtn" style="--c:#dadada; color:#ff7b00;">VIEW</button></a></td>
                <td>@if($orders[$i]->sent == 1)
                    true
                    @else 
                    false 
                    @endif
                </td>
            </tr>
            @endif
            @endfor
        </table>
    </div>
</div>
@endsection