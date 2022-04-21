<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="mt-6">
        <label>Estas segur que vols eliminar la categoria {{$company->name}} ? </label>
        <form method="post" action="{{ route('categories.destroy',$company) }}">
            @csrf
            @method('delete')
            <div class="mt-8">
                <button class="py-2 px-4 bg-indigo-50 font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75" type="submit" >Si</button>
                <a href="{{ route('categories.edit',$company) }}" class="py-2 px-4 bg-indigo-50 font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75" type="submit" >No</a>
            </div>
        </form>
    </div>
</body>
</html>