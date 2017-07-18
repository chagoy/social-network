<template>
	<div class="container">
		<div class="row">
			<div class="col-lg-10 lg-offset-1">
				<div class="panel panel-default" v-for="post in all_posts">
					<div class="panel-heading">
						<img :src="post.user.avatar" alt="" class="avatar">
						{{ post.user.name }}
						<span class="pull-right">
							{{ post.created_at }}
						</span>
					</div>
					<div class="panel-body">
						<p class="">
							{{ post.content }}
						</p>
						<like :id="post.id"></like>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import Like from './Like.vue';

	export default {
		components: {
			Like
		},

		mounted() {
			this.get_feed();
		},

		computed: {
			all_posts() {
				return this.$store.getters.all_posts;
			}
		},

		methods: {
			get_feed() {
				axios.get('/feed')
					.then(({data}) => {
						console.log(data);
						data.forEach((post) => {
							this.$store.commit('add_post', post);
						});
					});
			}
		}
	}
</script>

<style>
	.avatar {
		width: 40px;
		height: 40px;
		border-radius: 50%;
	}
</style>