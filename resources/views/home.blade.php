@extends('layouts.app')

@section('content')
<v-app>
	<appbar-component app></appbar-component>
		
		<v-main>
						
		</v-main>
	
		<footer-component app></footer-component>
</v-app>

<script>
	export default {
	data: () => ({
	}),
	created(){
		return this.$router.push('/home');
	}
}
</script>
@endsection
