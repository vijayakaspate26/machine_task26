<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product Create</title>
</head>
<body>

    <h2>Product Create</h2>

    {{-- Success Message --}}
    @if(session('success'))
        <p style="color: green;">
            {{ session('success') }}
        </p>
    @endif
    @if(session('error'))
        <p style="color: red;">
            {{ session('error') }}
        </p>
    @endif
    {{-- Validation Errors --}}
    @if($errors->any())
        <ul style="color:red;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ isset($product) 
        ? route('products.update', $product->id) 
        : route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
       @if(isset($product))
        @method('PUT')
    @endif
        <label>Product Name</label>
        <input type="text" name="name" value="{{isset($product) ? $product->name : ''}}">

        <br><br>

        <label>Category</label>
        <select name="category_id">
            @foreach ($categoryLists as $item)
                <option value="{{ $item->id }}" {{ isset($product) && $product->category_id == $item->id ? 'selected' : '' }}>
                    {{ $item->name }}
                </option>
            @endforeach
        </select>

        <br><br>

        <label>Is Active</label>
        <input type="checkbox" name="is_active" value="1" {{ isset($product) && $product->is_active ? 'checked' : '' }}>

        <br><br>
         <label>Image</label>
        <input type="file" name="image" >

        @if(isset($product) && $product->image)
            <img src="{{ asset('storage/' . $product->image) }}"
                width="100">
        @endif
        <br> <br>
        <label>Price</label>
        <input type="text" name="price"  value="{{ isset($product) ? $product->price : '' }}">

        <br><br>

        <button type="submit">Submit</button>
    </form>

</body>
</html>