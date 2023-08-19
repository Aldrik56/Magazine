<h1>Daftar Mahasiswa</h1>
@if (Route::has('login'))
<div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
    @auth
        <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
    @else
        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

        @if (Route::has('register'))
            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
        @endif
    @endauth
</div>
@endif


<a href="/PDFadmin/create">Create new admin</a>
<table border="1">
    <tr>
        <th>NIM</th>
        <th>Nama</th>
        <th>Prodi</th>
        <th>Tindakan</th>
    </tr>
    @foreach($admins as $admin)
    <tr>
        <td>{{$admin->judul}}</td>
        <td>{{$admin->deskripsi}}</td>
        <td>{{$admin->file}}</td>
        <td>
            <a href="/PDFadmin/{{$admin->id}}">SHOW</a>
            <a href="/PDFadmin/{{$admin->id}}/edit">EDIT</a>
            <form action="/PDFadmin/{{$admin->id}}" method="post">
                @method('DELETE')
                @csrf 
                <button type="submit">DELETE</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>