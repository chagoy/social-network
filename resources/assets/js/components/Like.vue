<template>
	<div>
	 	<hr>
			<p class="text-center" v-for="like in post.likes">

				<img :src="like.user.avatar" alt="" width="40px" height="40px" class="avatar-like">
				
			</p>
		<hr>
			<button class="btn btn-primary" v-if="!auth_user_likes_post" @click="like()">Like</button>

			<button class="btn btn-danger" v-else @click="unlike()">Unlike</button>

	</div>
</template>

<script>
	export default {
		props: ['id'],

		mounted() {

		},

		computed: {

			post() {
				return this.$store.state.posts.find((post) => {
					return post.id === this.id;
				});
			},

			likers() {
				var likers = [];

				this.post.likes.forEach((like) => {
					likers.push(like.user.id);
				})

				return likers;
			},

			auth_user_likes_post() {
				var check_index = this.likers.indexOf(
					this.$store.state.auth_user.id
					);
				if (check_index == -1) {
					return false;
				} else {
					return true;
				}
			}
		},

		methods: {
			like() {
				axios.get('/like/' + this.id)
					.then(({data}) => {
						this.$store.commit('update_post_likes', {
							id: this.id,
							like: data
						});
						new Noty({
							type: 'success',
							layout: 'bottomRight',
							text: 'Post liked'
						}).show();
					});
			},

			unlike() {
				axios.get('/unlike/' + this.id)
					.then(({data}) => {
						this.$store.commit('unlike_post', {
							post_id: this.id,
							like_id: data
						});
						new Noty ({
							type: 'success',
							layout: 'bottomRight',
							text: 'Post unliked'
						}).show();
					});
			}
		}

	}
</script>

<style>
	.avatar-like {
		border-radius: 50%;
	}
</style>