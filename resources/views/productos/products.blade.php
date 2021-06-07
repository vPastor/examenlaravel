@extends((Request::ajax()) ? 'layouts.ajax' : 'layouts.app')

@section('content')
<div class="row">

  <div class="col-lg-3">
    <!--TODO: SEARCH-->
    <h2 class="my-4">Buscar <br>(en este genero)</h2>
    <form method="POST" action="">
      {{ csrf_field() }}
      <input type="hidden" name="category" value="{{Request()->id}}">
      <div class="form-group">
        <div class="form-check">
          <input name="search" class="form-text" type="text">
        </div>
      </div>
    </form>
    <!--Fin BLOQUE-->


    <!--TODO: SELECCIONAR GENERO-->
    <h2 class="my-4">Genero</h2>
    <div class="list-group">
      @foreach ($filters->category as $key=>$category)
      <a href="{{url('category', [$key])}}" class="list-group-item">{{$category}}</a>
      @endforeach
    </div>

    <!--Fin BLOQUE-->

  </div>

  <div class="col-lg-9">
    <!--TODO: BANNER-->
    @if($showBanner)
    <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
    <ol class="carousel-indicators">
        @for ($i = 0; $i < sizeof($products); $i++) <li data-target="#carouselExampleIndicators" data-slide-to="0">
          </li>
          @endfor
      </ol>
      <div class="carousel-inner" role="listbox">
        @foreach ($products as $key =>$product)
        <div class="carousel-item {{$key==0 ? 'active' : '' }}">
          <img class="d-block img-fluid" src="{{ asset('img/'.$product->image) }}" alt="Second slide">
        </div>
        @endforeach
        <div class="carousel-item">
          <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="Second slide">
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
    @endif
    <!--Fin BLOQUE-->


    <!--TODO: LISTA DE PELICULAS-->
    <div class="row">
      <div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100">
          <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
          <div class="card-body">
            <h4 class="card-title">
              <a href="#">Item Five</a>
            </h4>
            <h5>$24.99</h5>
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur! Lorem ipsum dolor sit amet.</p>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn-block btn-primary">Comprar</button>
            <button type="submit" class="btn-block btn-primary">Alquilar</button>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100">
          <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
          <div class="card-body">
            <h4 class="card-title">
              <a href="#">Item Five</a>
            </h4>
            <h5>$24.99</h5>
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur! Lorem ipsum dolor sit amet.</p>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn-block btn-primary">Comprar</button>
            <button type="submit" class="btn-block btn-primary">Alquilar</button>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100">
          <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
          <div class="card-body">
            <h4 class="card-title">
              <a href="#">Item Five</a>
            </h4>
            <h5>$24.99</h5>
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur! Lorem ipsum dolor sit amet.</p>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn-block btn-primary">Comprar</button>
            <button type="submit" class="btn-block btn-primary">Alquilar</button>
          </div>
        </div>
      </div>
      <!--SI no hay productos mostrar:-->
      <p>No products to show</p>
    </div>

    <!--Fin BLOQUE-->


  </div>

</div>

<!--TODO: ACCIONES DE CARRITO-->
<form class="addCart">
          <input type="hidden" name="prod_id" value="{{$product->id}}">
          <select name="qty">@for ($i = 1; $i < 10; $i++)  <option value="{{$i}}">{{$i}}</option>@endfor</select>
          <button name="compra" type="submit" value="alquilar">alquilar</button>
          <button name="compra" type="submit" value="comprar">comprar</button>
          </form> 
<script>
  //Escribir aqui el codigo necesario de AXIOS
  //Al hacer click se obtiene la info del producto para saber si hay stock
  //Si hay stock se envia una petición para guardar en el carrito ese producto. SE guardara como comprado o alquilado
  $('.addCart').submit(function(e){
      e.preventDefault();
      var data = $(this).serialize()
      console.log(data)
      axios.post('stock', data) 
      .then(response => {
        if (response == false) {
          window.alert('Lo sentimos, no tenemos este producto actualmente')
        } else {
          axios.post('compra', response.data)
        }
      })
      //Sustituir 0 por la cantidad que tengamos en el carrito
      $('#carrito').html(sizeof(app('request')->session()->get('carrito',[]));
</script>
 <!--Fin BLOQUE-->

@endsection
