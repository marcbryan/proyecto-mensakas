@extends('layouts.app')

@section('styles')
body::after{height: 42px;}
.container{max-width:inherit;padding:0;display:flex;flex-direction:row;}
.summ-container{flex-grow:2;}
.summ-container > div.total{border-top: 1px solid #E1E8EE;text-align:end;border-bottom: 1px solid #E1E8EE;text-align:end;}
.summ{display:flex;flex-direction:column;min-height: 72px;}
html, body {font-family: 'Roboto', sans-serif;}
.shopping-cart {width: 750px;background: #FFFFFF;box-shadow: 1px 2px 3px 0px rgba(0,0,0,0.10);display: flex;flex-direction: column;}
.title {height: 60px;border-bottom: 1px solid #E1E8EE;padding: 20px 30px;color: #5E6977;font-size: 18px;font-weight: 400;}
.item {padding: 20px 30px;height: 120px;display: flex;}
div.item.item-border-top {border-top:1px solid #E1E8EE}
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
.description span:last-child {font-weight: 300;color: #86939E;font-size:13px;}
.quantity {padding-top: 20px;margin-right: 60px;min-width: 100.5px;}
.quantity input {-webkit-appearance: none;border: none;text-align: center;width: 32px;font-size: 16px;color: #43484D;font-weight: 300;}
button[class*=btn] {width: 30px;height: 30px;background-color: #E1E8EE;border-radius: 6px;border: none;cursor: pointer;}
button:focus,input:focus {outline:0;}
.total-price {width: 83px;padding-top: 27px;text-align: center;font-size: 16px;color: #43484D;font-weight: 300;}
@media (max-width: 800px) { .shopping-cart {width: 100%;height: auto;overflow: hidden;} .item {height: auto;flex-wrap: wrap;justify-content: center;} .image img {width: 50%;} .image,.quantity,.description {width: 100%;text-align: center;margin: 6px 0;display:block!important;} .buttons {margin-right: 20px;}}
@endsection

@section('links')
<script type="text/javascript">
  $(function() {
    $('.nav-link').remove();
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
        totalProd = parseFloat(price*value).toFixed(2);
        item.find('> div.total-price').text(totalProd+"€");
        updateProductFromSummary(item.attr('item-id'), value, totalProd);
      } else {
        value = 0;
        item.find('> div.total-price').text('');
        removeProductFromSummary(item.attr('item-id'));
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
        if (value == 1) {
          addProductToSummary(item.attr('item-id'), item.attr('item-name'), parseFloat(price).toFixed(2));
        } else {
          updateProductFromSummary(item.attr('item-id'), value, parseFloat(price*value).toFixed(2));
        }
      } else {
        value = 100;
        updateProductFromSummary(item.attr('item-id'), value, parseFloat(price*value).toFixed(2));
      }

      item.find('> div.total-price').text((price*value).toFixed(2)+"€");
      $input.val(value);
    });

    $('input#next').click(function() {
      var items = $('div.summ > div[item-id]');
      if (items.length == 0) {
        alert('No puedes continuar, tu carro está vacío!');
      } else {
        var obj_items = [];
        items.each(function(index, item) {
          var item = $(item);
          var obj_item = {
            id: item.attr('item-id'),
            name: item.attr('item-name'),
            quantity: item.find('span[qty]').attr('qty'),
            price: item.find('span[price]').attr('price')
          }
          obj_items.push(obj_item);
        });
        var order = {
          items: obj_items,
          price: $("span#total").text()
        }
        var form = $('form#sendOrder');
        form.find('> input[name="json"]').text(JSON.stringify(order));
        //form.submit();
      }
    });

    function addProductToSummary(id, name, price) {
      $('div.summ').append('<div class="p-3" item-id="'+id+'" item-name="'+name+'"><p>'+name+' | x<span qty="1">1</span> | <span price="'+price+'">'+price+'</span>€</p></div>');
      updateTotalPrice();
    }
    function removeProductFromSummary(id) {
      $('div.summ > div[item-id="'+id+'"]').remove();
      updateTotalPrice();
    }
    function updateProductFromSummary(id, qty, newPrice) {
      var prod = $('div.summ > div[item-id="'+id+'"] > p');
      var qtySpan = prod.find('> span[qty]');
      qtySpan.attr('qty', qty);
      qtySpan.text(qty);
      var price = prod.find('> span[price]');
      price.attr('price', newPrice);
      price.text(newPrice);
      updateTotalPrice();
    }
    function updateTotalPrice() {
      var total = 0;
      var span_prices = $('div.summ span[price]');
      span_prices.each(function(index, span) {
        total += parseFloat($(span).attr('price'));
      });
      $('span#total').text(total.toFixed(2));
    }
  });
</script>
@endsection

@section('content')
@php $products = session('products'); @endphp
@if (isset($products))
<div class="shopping-cart">
  <div class="title">
    Artículos
  </div>
  @if (count($products) > 0)
    @foreach($products as $product)
    @if ($loop->index == 0)
    <div class="item" item-id="{{$product->id}}" item-name="{{$product->nameIn('ES')}}" price="{{$product->price}}">
    @else
    <div class="item item-border-top" item-id="{{$product->id}}" item-name="{{$product->nameIn('ES')}}" price="{{$product->price}}">
    @endif
      <div class="buttons">
        <span class="delete-btn"></span>
        <span class="like-btn"></span>
      </div>
      <div class="image">
        <img src="item.png" alt="" />
      </div>
      <div class="description d-flex flex-column justify-content-center">
        <span class="align-self-center">{{$product->nameIn('ES')}}</span>
        <span class="align-self-center">Precio: {{$product->price}}€</span>
      </div>

      <div class="quantity">
        <button class="plus-btn" type="button" name="button">
          <img src="/images/plus.svg" alt="" />
        </button>
        <input type="text" name="name" value="0" autocomplete="off" disabled style="background:transparent;">
        <button class="minus-btn" type="button" name="button">
          <img src="/images/minus.svg" alt="" />
        </button>
      </div>
      <div class="total-price"></div>
    </div>
    @endforeach
  @else
  <div class="alert alert-danger mt-5" role="alert">
			  <h4 class="alert-heading">UPS!</h4>
			  <p>Lamentablemente no hay productos añadidos a este restaurante.</p>
			</div>
  @endif
</div>
<div class="summ-container">
  <p class="title">Resumen de tu pedido</p>
  <div class="summ">
  </div>
  <div class="p-3 total">
    <strong>Total: <span id="total">0</span>€</strong>
  </div>
  <div class="d-flex justify-content-end mt-2">
    <input type="button" class="btn btn-success mr-2" id="next" value="Siguiente"/>
  </div>
  <form id="sendOrder" class="d-none" action="" method="post">
    @csrf
    @method('PUT')
    <input type="text" name="json">
    <input type="submit" class="btn btn-primary" value="Enviar">
  </form>
</div>
@else
  @php header("Location: /"); @endphp
@endif
@endsection
