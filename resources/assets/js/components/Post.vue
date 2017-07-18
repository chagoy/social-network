<template>
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">

					<div class="panel-body">
						<textarea class="form-control" rows="5" v-model="content">
						</textarea>
						<br>
						<button class="btn btn-success pull-right" :disabled="not_working" @click="create_post()">
							Create a post
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				content: '',
				not_working: true
			}
		},

		watch: {
			content() {
				if(this.content.length > 0) {
					this.not_working = false;
				} else {
					this.not_working = true;
				}
			}
		},

		mounted() {

		},

		methods: {
			create_post() {
				axios.post('/create/post', {
					content: this.content
				})
					.then(({data}) => {
						this.content = '';
						new Noty({
							type: 'success',
							layout: 'bottomRight',
							text: 'Post published.'
						}).show();
						document.getElementById("noty_audio").play();
						console.log(data);
					});
			}
		}
	}
</script>