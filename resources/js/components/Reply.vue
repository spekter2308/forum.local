<template>
    
</template>

<script>
    import Favourite from './Favorite';

    export default {
        props: ['attributes'],

        components: {
            'favorite': Favourite
        },

        data() {
            return {
                editing: false,
                body: this.attributes.body,
                newBody: ''
            };
        },

        methods: {
            update() {
                axios.patch('/replies/' + this.attributes.id, {
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
                axios.delete('/replies/' + this.attributes.id);

                $(this.$el).fadeOut(300, () => {
                    flash('Your reply has been deleted');
                });
            },

        }
    }
</script>

<style>

</style>