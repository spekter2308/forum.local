<template>
    <div :id="'reply-' + id" class="card" style="margin-bottom: 30px;">
        <div class="card-header">
            <div class="level">

                <h6 class="flex">
                    <a href="'/profiles/' + data.owner.name" v-text="data.owner.name">
                    </a> said <span v-text="ago"></span>
                </h6>

                <div v-if="signedIn">
                    <favorite :reply="data"></favorite>
                </div>

            </div>
        </div>

        <div class="card-body">

            <div v-if="editing">
                <div class="form-group">
                    <textarea class="form-control" v-model="body"></textarea>
                </div>

                <button class="btn btn-primary" @click="update">Update</button>
                <button class="btn btn-link" @click="cancel">Cancel</button>
            </div>

            <div v-else v-text="body"></div>
        </div>

        <div class="card-footer level" v-if="canUpdate">
            <button class="btn btn-primary mr" @click="editing = true">Edit</button>
            <button class="btn btn-danger mr" @click="destroy">Delete</button>
        </div>

    </div>
</template>

<script>
    import Favourite from './Favorite';
    import moment from 'moment';

    export default {
        props: ['data'],

        components: {
            'favorite': Favourite
        },

        data() {
            return {
                editing: false,
                id: this.data.id,
                body: this.data.body,
                newBody: ''
            };
        },

        computed: {
            ago() {
                return moment(this.data.created_at).fromNow() + '...';
            },

            signedIn() {
                return window.App.signedIn;
            },

            canUpdate() {
                return this.authorize(user => this.data.user_id == user.id);
            }

        },

        methods: {
            update() {
                axios.patch('/replies/' + this.data.id, {
                    body: this.body
                });
                this.newBody = this.body;
                this.editing = false;
                flash('Updated!');
            },

            cancel() {
                this.$forceUpdate();
                this.body = this.newBody;
                this.editing = false;
            },

            destroy() {
                axios.delete('/replies/' + this.data.id);

                this.$emit('deleted', this.data.id);

                /*$(this.$el).fadeOut(300, () => {
                    flash('Your reply has been deleted');
                });*/
            },

        }
    }
</script>

<style>

</style>