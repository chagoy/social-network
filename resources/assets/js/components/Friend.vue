<template>
    <div>
        <p class="text-center" v-if="loading">
            Loading...
        </p>
        <p class="text-center" v-if="!loading">
            <button class="btn btn-success" v-if="status == 0" @click="add_friend">Add Friend</button>
            <button class="btn btn-success" v-if="status == 'pending'" @click="accept_friend">Accept Friend</button>
            <span class="text-success" v-if="status == 'waiting'">Awaiting Response</span>
            <span class="text-success" v-if="status == 'friends'">Is Your Friend</span>
        </p>
    </div>
</template>

<script>
    export default {
        props: ['profile_user_id'],

        data() {
            return {
                status: '',
                loading: true
            }
        },

        mounted() {
            axios.get('/check_relationships_status/' + this.profile_user_id)
                .then(({data}) => {
                    this.status = data.status;
                    this.loading = false;
                });
        },

        methods: {
            add_friend() {
                this.loading = true;

                axios.post('/add_friend/' + this.profile_user_id)
                    .then(({data}) => {
                        if (data === 1) {
                            this.status = 'waiting';
                            new Noty({
                                type: 'success',
                                layout: 'bottomRight',
                                text: 'Friend request has been sent'
                            }).show();
                            this.loading = false;
                        }
                    });
            },

            accept_friend() {
                this.loading = true;

                axios.post('/accept_friend/' + this.profile_user_id)
                    .then(({data}) => {
                        if (data === 1) {
                            this.status = 'friends';
                            new Noty({
                                type: 'success',
                                layout: 'bottomRight',
                                text: 'Request accepted'
                            }).show();
                            this.loading = false;
                        }
                    });
            }
        }
    }
</script>
