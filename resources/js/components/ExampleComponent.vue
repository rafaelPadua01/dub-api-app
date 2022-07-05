<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        I'm an example component.
			<v-btn color="primary" class="mr-2">Buton</v-btn>
                	<v-alert dissmisible type="success">Instaled suessfuly</v-alert>
		   		
			 </div>
			
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
