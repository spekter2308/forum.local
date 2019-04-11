<template>
    <div>
        <div v-for="(reply, index) of items">
            <reply :data="reply" @deleted="remove(index)"></reply>
        </div>

        <new-reply></new-reply>
    </div>

</template>

<script>
    import NewReply from './NewReply';
    import Reply from './Reply';


    export default {
        props: ['data'],

        components: {
            'new-reply': NewReply,
            'reply': Reply
        },

        data() {
            return {
                items: this.data
            }
        },

        methods: {
            remove(index) {
                this.items.splice(index, 1);

                this.$emit('removed')

                flash('Reply was deleted');
            }
        }
    }
</script>

<style>

</style>