@extends('layouts.app')

@section('styles')
html, body {font-family: 'Roboto', sans-serif;}
.shopping-cart {width: 750px;height: 423px;margin: 80px auto;background: #FFFFFF;box-shadow: 1px 2px 3px 0px rgba(0,0,0,0.10);border-radius: 6px;display: flex;flex-direction: column;}
.title {height: 60px;border-bottom: 1px solid #E1E8EE;padding: 20px 30px;color: #5E6977;font-size: 18px;font-weight: 400;}
.item {padding: 20px 30px;height: 120px;display: flex;}
.item:nth-child(3) {border-top:1px solid #E1E8EE;border-bottom:1px solid #E1E8EE;}
.buttons {position: relative;padding-top: 30px;margin-right: 60px;}
.delete-btn,.like-btn {display: inline-block;Cursor: pointer;}
.delete-btn {width: 18px;height: 17px;background: url('/images/delete_icn.svg') no-repeat center;}
.like-btn {position: absolute;top: 9px;left: 15px;background: url('/images/twitter-heart.png');width: 60px;height: 60px;background-size: 2900%;background-repeat: no-repeat;}
.is-active {animation-name: animate;animation-duration: .8s;animation-iteration-count: 1;animation-timing-function: steps(28);animation-fill-mode: forwards;}
@keyframes animate {0% { background-position: left; } 50% { background-position: right; } 100% { background-position: right; }}
.image {margin-right:50px;margin-top:auto;margin-bottom:auto;}
.description {margin-right: 60px;width: 190px;}
.description span {display: block;color: #43484D;font-weight: 400;}
.description span:first-child {margin-bottom: 5px;}
.description span:last-child {font-weight: 300;margin-top: 8px;color: #86939E;}
.quantity {padding-top: 20px;margin-right: 60px;}
.quantity input {-webkit-appearance: none;border: none;text-align: center;width: 32px;font-size: 16px;color: #43484D;font-weight: 300;}
button[class*=btn] {width: 30px;height: 30px;background-color: #E1E8EE;border-radius: 6px;border: none;cursor: pointer;}
button:focus,input:focus {outline:0;}
.total-price {width: 83px;padding-top: 27px;text-align: center;font-size: 16px;color: #43484D;font-weight: 300;}
@media (max-width: 800px) { .shopping-cart {width: 100%;height: auto;overflow: hidden;} .item {height: auto;flex-wrap: wrap;justify-content: center;} .image img {width: 50%;} .image,.quantity,.description {width: 100%;text-align: center;margin: 6px 0;display:block!important;} .buttons {margin-right: 20px;}}
@endsection

@section('links')
<script type="text/javascript">
  $(function() {
    $('.like-btn').on('click', function() {
      $(this).toggleClass('is-active');
    });

    $('.minus-btn').on('click', function(e) {
      e.preventDefault();
      var $this = $(this);
      var $input = $this.closest('div').find('input');
      var item = $this.parent().parent();
      var price = item.attr('price');
      var value = parseInt($input.val());
      if (value > 1) {
        value = value - 1;
        item.find('> div.total-price').text(price*value+"€");
      } else {
        value = 0;
        item.find('> div.total-price').text('');
      }
      $input.val(value);
    });

    $('.plus-btn').on('click', function(e) {
      e.preventDefault();
      var $this = $(this);
      var $input = $this.closest('div').find('input');
      var item = $this.parent().parent();
      var price = item.attr('price');
      var value = parseInt($input.val());
      if (value < 100) {
        value = value + 1;
      } else {
        value =100;
      }
      item.find('> div.total-price').text(price*value+"€");
      $input.val(value);
    });
  });
</script>
@endsection

@section('content')
@php $products = session('products'); @endphp
@if (isset($products))
<div class="shopping-cart">
  <div class="title">
    Carrito de la compra
  </div>
  @if (count($products) > 0)
    @foreach($products as $product)
    <div class="item" price="{{$product->price}}">
      <div class="buttons">
        <span class="delete-btn"></span>
        <span class="like-btn"></span>
      </div>
      <div class="image">
        <img src="item.png" alt="" />
      </div>
      <div class="description d-flex">
        <span class="align-self-center">{{$product->nameIn('ES')}}</span>
        <span class="d-none"></span>
      </div>

      <div class="quantity">
        <button class="plus-btn" type="button" name="button">
          <img src="/images/plus.svg" alt="" />
        </button>
        <input type="text" name="name" value="0">
        <button class="minus-btn" type="button" name="button">
          <img src="/images/minus.svg" alt="" />
        </button>
      </div>
      <div class="total-price"></div>
    </div>
    @endforeach
  @else
  <p>No hay productos que puedas añadir al carrito :(</p>
  @endif
</div>
@else
  @php header("Location: /"); @endphp
@endif
@endsection
