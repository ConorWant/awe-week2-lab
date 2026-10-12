<div>
   <p>Product Card</p>
   <p>Name: {{ $product->name}}</p> 
   <p>Description: {{ $product->title}}</p>
   <p>Price: £{{ number_format($product->price/100, 2)}}</p>
</div>