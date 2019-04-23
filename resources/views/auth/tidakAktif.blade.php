@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="box-warning">
			<h1>Maaf, User Anda Tidak Aktif.</h1>
			<a href="{{{route('logout')}}}" class="btn btn-danger btn-flat" 
                      onclick="event.preventDefault();document.getElementById('logout-form').submit();">Kembali</a>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
		</div>
	</div>
@endsection