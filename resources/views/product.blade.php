<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
product pages

  {{-- Success Message --}}
@if(session('success'))
    <div style="color:green;">
        {{ session('success') }}
    </div>
@endif

<table border="10"> 
    
    <th> id </th>
    <th> product name </th>
    <th> category </th>
    <th> actions </th>
    @foreach ($product as $item)
         <tr> 
        <td> {{$item->id}} </td> 
        <td>{{$item->name}}</td>
        <td>{{$item->category->name}}</td>
        <td>

        {{-- Edit Button --}}
        <a href="{{ route('products.edit', $item->id) }}">
            <button type="button">Edit</button>
        </a>

        {{-- Delete Button --}}
        <form action="{{ route('products.destroy', $item->id) }}" 
            method="POST" 
            style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit"
                    onclick="return confirm('Are you sure want to delete?')">
                Delete
            </button>
        </form>
        </td>

    </tr>

    @endforeach
   

</table>
</body>
</html>