import Vuex from 'vuex'
import Vue from 'vue'

Vue.use(Vuex)

export const store = new Vuex.Store({
	state: {
		nots: [],
		posts: [],
		auth_user: {}
	},

	getters: {
		//helps return data from the state
		all_nots(state) {
			return state.nots;
		},

		all_nots_count(state) {
			return state.nots.length;
		},

		all_posts(state) {
			return state.posts;
		}
	},

	mutations: {
		//changes the state, only thing that can do it
		add_not(state, not) {
			state.nots.push(not);
		},

		add_post(state, post) {
			state.posts.push(post);
		},

		add_auth_user(state, user) {
			state.auth_user = user;
		},

		update_post_likes(state, payload) {
			var post = state.posts.find((p) => {
				return p.id === payload.id;
			});

			post.likes.push(payload.like);
		},

		unlike_post(state, payload) {
			var post = state.posts.find((p) => {
				return p.id === payload.post_id;
			});

			var like = post.likes.find((l) => {
				return l.id === payload.like_id;
			});

			var index = post.likes.indexOf(like);

			post.likes.splice(index, 1);
		}
	},

	actions: {
		//calls a method or a mutation. multiple can be called at a time
	}
});