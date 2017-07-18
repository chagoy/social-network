<template>
	<li>
		<a href="/notifications">
			Unread Notifications
			<span class="badge">
				{{ all_nots_count }}
			</span>
		</a>
	</li>
</template>

<script>
	export default {

		mounted() {
			this.get_unread()
		},

		computed: {
			all_nots_count() {
				return this.$store.getters.all_nots_count;
			}
		},

		methods: {
			get_unread() {
				axios.get('/get_unread')
					.then(({data}) => {
						data.forEach((not) => {
							this.$store.commit('add_not', not);
						});
					});
			}
		}
	}
</script>